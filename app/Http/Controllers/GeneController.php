<?php

namespace App\Http\Controllers;

use DB;
use App\Gene;
use App\Variant;
use App\Group;
use App\Type;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class GeneController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('q');

        $genes = $query
            ? Gene::search($query)->get()
            : Gene::all();

        $types = Type::listOfTypes();

        return view('genes.index', compact('genes', 'types'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gene = new Gene;
        $groupsList = Group::lists('name', 'id')->all();
        $typesList = Type::listOfTypes();

        return view('genes.create', compact('groupsList', 'typesList', 'gene'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->saveGene($request);
    }

    /**
     * @param Request $request
     * @param null $id
     */
    private function saveGene(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'group' => 'required',
            'nZamqna' => 'required',
            'aZamqna' => 'required',
        ]);

        if($validator->fails()){
            $returnToUrl = $id ? ('genes/' . $id . '/edit') : ('genes/create');
            return redirect($returnToUrl)
                ->withErrors($validator)
                ->withInput();
        } else {
            $msg = $id ? 'Промените са записани успешно!' : 'Успешно създаден полиморфизъм!';
            DB::transaction(function() use ($request, $id) {
                $gene = $this->getGene($id);
                $gene->name = $request->input('name');
                $gene->group_id = $request->input('group');
                $gene->save();

                $variant = $gene->getVariant() ? $gene->getVariant() : new Variant;
                $variant->norm = $request->input('nZamqna');
                $variant->change = $request->input('aZamqna');
                $gene->variants()->save($variant);

                $variantNewValue = $request->input('variants');
                $comments = $request->input('comment');

                foreach ($variantNewValue as $key => $value) {

                    $type = $variant->types()
                        ->where('type', $key)
                        ->first() ?: new Type([
                            'type' => $key,
                            'genotype' => $value,
                            'variant_id' => $variant->id,
                            'comment' => $comments[$key],
                    ]);

                    $type->genotype = $value;
                    $type->comment = $comments[$key];
                    $variant->types()->save($type);
                }
            });
            return redirect('genes')->with('message', $msg);
        }
    }

    private function getGene($id = null)
    {
        if ($id) {
            return Gene::findOrFail($id);
        }
        return new Gene;
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
        $gene = Gene::findOrFail($id);
        $groupsList = Group::lists('name', 'id')->all();
        $typesList = Type::listOfTypes();

        return view('genes.edit', compact('gene', 'groupsList', 'typesList'));
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
        return $this->saveGene($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gene = Gene::findOrFail($id);
        $gene->delete();
        return redirect('genes')->with('message', 'Изтрихте полиморфизъм!');
    }
}
