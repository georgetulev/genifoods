<?php

namespace App\Http\Controllers;

use App\Gene;
use App\Group;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Response;

class GeneVariantsSearchController extends Controller
{

    public function search(Request $request)
    {
        $allTypes = [];
        /** @var Gene $gene */
        foreach($this->getGroupsByTerm($request) as $group){
            foreach($group->genes()->get() as $gene){
                $currentTypes = $this->getTypes($gene, $request);
                foreach($currentTypes as $type) {
                    $allTypes[]  = [
                        'id' => $type->id,
                        'text' => implode(' ', [$gene->getGroup()->name, $gene->name, $type->genotype])
                    ];
                }
            }
        }
        return  response()->json($allTypes);
    }

    private function getGeneTerm(Request $request)
    {
        $term = $request->get('term');
        $parts = explode(' ', $term);
        return isset($parts[0]) ? $parts[0] : '';
    }

    private function getTypeTerm(Request $request)
    {
        $term = $request->get('term');
        $parts = explode(' ', $term);
        return isset($parts[1]) ? $parts[1] : '';
    }

    private function getGroupsByTerm(Request $request)
    {
        $geneTerm = $this->getGeneTerm($request);
        if ($geneTerm) {
           return Group::where('name', 'like', "%$geneTerm%")->get();
        }
        return Group::all();
    }

    private function getTypes(Gene $gene, $request)
    {
        $variant = $gene->getVariant();
        $typeTerm = $this->getTypeTerm($request);
        if ($typeTerm) {
            return $variant->types()->where('genotype', 'like', "%$typeTerm%")->get();
        }
        return $variant->types()->get();
    }

}