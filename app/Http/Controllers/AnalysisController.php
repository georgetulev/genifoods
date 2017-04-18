<?php

namespace App\Http\Controllers;

use App\Group;
use App\Type;
use Illuminate\Http\Request;
use App\Analys;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AnalysisController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }

    public function index()
    {
        $groups = Group::with('genes.variants.types.recommendations')->get();
        return view('analysis.index', compact('groups'));
    }

    public function store(Request $request)
    {
       $validator = Validator::make($request->all(),[
           'name' => 'required|max:255',
           'dateOfBirth' => 'required',
           'identity_number' => 'required',
           'reason' => 'required',
           'requested_by' => 'required',
           'executed_by' => 'required',
           'supervised_by' => 'required',
       ]);

        if($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $analys = new Analys();
            DB::transaction(function () use ($request, $analys) {
                $analys->customer_name = $request->get('name');
                $analys->birthdate = date_create($request->get('dateOfBirth'));
                $analys->identity_number = $request->get('identity_number');
                $analys->reason = $request->get('reason');
                $analys->requested_by = $request->get('requested_by');
                $analys->executed_by = $request->get('executed_by');
                $analys->supervised_by = $request->get('supervised_by');

                $types = Type::whereIn('id', $request['types'])->get();
                $listOfRecommendations = [];
                $listOfComments = [];
                // for each type, try to find the best matching recommendations
                foreach ($types as $type) {
                    $maxScore = 0;
                    $validRecommendations = [];
                    $listOfComments[] = $type->comment;

                    $recommendations = $type->recommendations;
                    foreach ($recommendations as $recommendation) {
                        $recommendationTypes = $recommendation->types;

                        // gather all ids
                        $recommendationTypeIds = [];
                        foreach($recommendationTypes as $recommendationType) {
                            $recommendationTypeIds[] = $recommendationType->id;
                        }

                        // determine number if matches
                        $idMatches = count(array_intersect($recommendationTypeIds, $request['types']));
                        $relatedIds = count($recommendationTypeIds);

                        // in case the recommendation does not fully match, skip it
                        if ($idMatches != $relatedIds) {
                            continue;
                        }

                        // otherwise add the recommedation and eventually update the max score
                        if ($idMatches > $maxScore) {
                            $maxScore = $idMatches;
                            $validRecommendations = [$recommendation->description];
                        } else  if ($idMatches > 0  && $idMatches == $maxScore ) {
                            $validRecommendations[] = $recommendation->description;
                        }
                    }
                    // merge the recommendations with the last valid ones
                    $listOfRecommendations = array_merge($listOfRecommendations, $validRecommendations);
                }
                $listOfRecommendations = array_values(array_filter(array_unique($listOfRecommendations)));
                $analys->result = serialize($listOfRecommendations);

                $listOfComments = array_values(array_filter(array_unique($listOfComments)));
                $analys->comments = serialize($listOfComments);

                $analys->save();
                $analys->types()->sync(array_diff($request['types'], array('')));
            });
            return redirect('/results/' . $analys->id);
        }
    }
}
