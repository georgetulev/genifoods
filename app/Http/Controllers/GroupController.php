<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Session;

class GroupController extends Controller
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
        $groups = Group::all();

        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = new Group;
        return view('groups.create', compact('group'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::findOrFail($id);

        return view('groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::findOrFail($id);

        return view('groups.edit', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->saveGroup($request, null);
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
        return $this->saveGroup($request, $id);
    }

    private function saveGroup(Request $request, $id = null){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:45',
            'function' => 'required',
        ]);

        if ($validator->fails()) {
            $returnToUrl = $id ? ('groups/' . $id . '/edit') : ('groups/create');
            return redirect($returnToUrl)
                ->withErrors($validator)
                ->withInput();
        } else {
            $msg = $id ? 'Промените са записани успешно!' : 'Създадохте нов ген!';
            $group = $this->getGroup($id);
            $group->name = $request->name;
            $group->function = $request->function;
            $group->save();
            return redirect('groups')->with('message', $msg);
        }
    }

    private function getGroup($id = null){

        if($id){
            return Group::findOrFail($id);
        } else {
            return new Group;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();
        return redirect('groups')->with('message', 'Посоченият ген бе изтрит!');


    }

}
