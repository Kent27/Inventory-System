<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use DataTables;
use Illuminate\Support\Facades\DB;
class ClientsController extends Controller
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
        return view('clients.index');
    }

    public function datatables(){

        /*$transactions = DB::table('transactions')
            ->join('items', 'items.id', '=', 'transactions.item_id')
            ->join('clients', 'clients.id', '=', 'transactions.client_id')
            ->join('drivers', 'drivers.id', '=', 'transactions.driver_id')
            ->select('clients.name as client_name', 'transactions.*', 'items.name as item_name', 'drivers.name as driver_name');*/
        $clients = Client::select(['clients.*', 'trans.entry_date as last_transaction'])
            ->leftjoin(DB::raw('(SELECT * FROM transactions order by entry_date desc limit 1)
                   trans'), 
            function($join)
            {
               $join->on('trans.client_id', '=', 'clients.id');
            });
            //->join('(select * from transactions) as trans','trans.client_id','=','clients.id');


        return DataTables::eloquent($clients)->make(true);

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate inputs
        $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'numeric|nullable',
            'account_number' => 'numeric|nullable'
        ]);

        $client = new Client;
        $client->name = request('name');
        $client->phone_number = request('phone_number');
        $client->bank_name = request('bank_name');
        $client->account_name = request('account_name');
        $client->account_number = request('account_number');
        $client->address = request('address');
        $client->save();
    }

    public function edit(Request $request)
    {
        //
        $client = Client::find ($request->id);
        $client->name = $request->name;
        $client->phone_number = request('phone_number');
        $client->bank_name = request('bank_name');
        $client->account_name = request('account_name');
        $client->account_number = request('account_number');
        $client->address = request('address');
        $client->save();
        //return response()->json($trd);
    }

    public function deleteClient(Request $request){
        $client = Client::find($request->id)->delete();
        return response()->json();
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
    }
}
