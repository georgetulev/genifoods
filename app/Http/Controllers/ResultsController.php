<?php

namespace App\Http\Controllers;

use App\Analys;
use Illuminate\Http\Request;

use App\Http\Requests;

class ResultsController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }

    public function index()
    {
       $analysis = Analys::all();
       return view('results.index',compact('analysis'));
    }

    public function show($id)
    {
        $analys = Analys::findOrFail($id);
        return view('analysis.show', compact('analys'));
    }

    public function destroy($id)
    {
        $analys = Analys::findOrFail($id);
        $types = $analys->types()->get();

        foreach($types as $type){
            $type->analysis()->detach($id);
        }

        $analys->delete();

        return redirect('results')->with('message', 'Резултатът бе изтрит.');
    }

}
