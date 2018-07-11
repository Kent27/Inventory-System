<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use DataTables;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        //
        $items = Item::paginate(5);
        return view("items.index", compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function datatables(){

            $item = Item::select(['id','name','quantity']);
            return Datatables::eloquent($item)->make(true);


    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = array(
            'name' => 'required',
            'quantity' => 'required',
          );
        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails())
        return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));

        else {
          $item = new Item;
          $item->name = $request->name;
          $item->quantity = $request->quantity;
          $item->save();
          return response()->json($item);
        }

    }

    public function editItem(Request $request){

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
    public function edit(Request $request)
    {
        //
        $item = Item::find($request->id);
        $item->name = $request->name;
        $item->quantity = $request->quantity;
        $item->save();
        return response()->json($item);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $item = Item::find($id)->delete();
        return response()->json();

    }
}
