<?php

namespace App\Http\Controllers;

use App\Recommendation;
use App\Type;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RecommendationController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recommendations = Recommendation::with('types.variant.gene.group')->get();

        return view('recommendations.index',compact('recommendations'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recommendation = new Recommendation;

        return view('recommendations.create', compact('recommendation'));
    }

    private function getRecommendation($id = null)
    {
        if ($id) {
            return Recommendation::findOrFail($id);
        }else {
            return new Recommendation;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->saveRecommendation($request, null);
    }


    /**
     * @param Request $request
     * @param $id
     * @return $this
     */
    private function saveRecommendation(Request $request, $id=null)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'types' => 'required',
        ]);

        if ($validator->fails()) {
            $returnToUrl = $id ? ('recommendations/' . $id . '/edit') : ('recommendations/create');
            return redirect($returnToUrl)
                ->withErrors($validator)
                ->withInput();
        } else {
            $msg = $id ? 'Препоръката бе обновена!' : 'Успешено записана препоръка!';
            DB::transaction(function () use ($request, $id) {

                $recommendation = $this->getRecommendation($id);
                $recommendation->description = $request->description;
                $recommendation->save();
                $recommendation->types()->sync($request['types']);
            });
            return redirect('recommendations')->with('message', $msg);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       return $this->saveRecommendation($request,$id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recommendation = Recommendation::findOrFail($id);

        return view('recommendations.edit', compact('recommendation'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $r = Recommendation::findOrFail($id);
        $t = $r->types()->get();

        foreach($t as $type){
            $type->recommendations()->detach($id);
        }

        $r->delete();

        return redirect('recommendations')->with('message', 'Препоръката бе изтрита!');
    }
}
