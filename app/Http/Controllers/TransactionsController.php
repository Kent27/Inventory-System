<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Trdetail;
use App\Document;
use DataTables;
use App\Client;
use App\Item;
use App\Driver;
use Illuminate\Support\Facades\DB;
use Validator;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class TransactionsController extends Controller
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
        /*$transactions = DB::table('transactions')
            ->join('items', 'items.id', '=', 'transactions.item_id')
            ->select('transactions.client_id', 'transactions.id', 'items.id')
            ->get();
        
        $transactions = Transaction::all();
        dd($transactions);*/
        $clients = Client::all();
        $items = Item::all();
        $drivers = Driver::all();
        $transactions = Transaction::all();
        return view('transactions.index',compact('clients','items','drivers','transactions'));
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

        /*$transactions = DB::table('transactions')
            ->join('items', 'items.id', '=', 'transactions.item_id')
            ->join('clients', 'clients.id', '=', 'transactions.client_id')
            ->join('drivers', 'drivers.id', '=', 'transactions.driver_id')
            ->select('clients.name as client_name', 'transactions.*', 'items.name as item_name', 'drivers.name as driver_name');*/
        $trdetails = Trdetail::select(['clients.name as client_name', 'transactions.entry_date', 'trdetails.*', 'transactions.id as transactions_id', 'items.name as item_name', 'items.id as item_id', 'drivers.name as driver_name','drivers.id as driver_id'])
            ->join('items', 'items.id', '=', 'trdetails.item_id')
            ->join('transactions', 'transactions.id', '=', 'trdetails.tr_id')
            ->join('clients', 'clients.id', '=', 'transactions.client_id')
            ->join('drivers', 'drivers.id', '=', 'trdetails.driver_id');
        /*$transactions = Transaction::select(['clients.name as client_name', 'transactions.*', 'items.name as item_name', 'drivers.name as driver_name'])
            ->join('items', 'items.id', '=', 'transactions.item_id')
            ->join('clients', 'clients.id', '=', 'transactions.client_id')
            ->join('drivers', 'drivers.id', '=', 'transactions.driver_id');*/
        /*dd($transactions);*/
        /*$transactions = Transaction::all();*/

        return DataTables::eloquent($trdetails)->make(true);

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
            'entry_date' => 'required',
            'client' => 'required',
            'drivers' => 'required',
            'items' => 'required',
            'quantity' => 'required',
            'documents.*' => 'mimes:doc,xslx,xlsm,xls,xml,txt,pdf,docx,zip,jpg,jpeg,png'

        ]);
        $tr = new Transaction;
        $tr->entry_date = Carbon::parse($request->entry_date.'00:00:00');
        //$tr->entry_date = $request->entry_date;
        $tr->client_id = request('client');
        $tr->trnotes = request('trnotes');
        $tr->save();
        for($i=1;$i<=$request->cars;$i++){
            if(!isset($request->items[$i])){ //check if the car element is deleted
                continue;
            }
            else{
                parse_str($request->items[$i],$items[$i]);
                parse_str($request->quantity[$i],$quantity[$i]);
                parse_str($request->notes[$i],$notes[$i]);
                foreach($items[$i]['items'.$i] as $key=>$item){
                $updateditem = Item::find($item);
                $trd = new Trdetail;
                $trd->tr_id = $tr->id;
                $trd->item_id = $item;
                $trd->driver_id = $request->drivers[$i];
                $trd->plate_no = $request->plate_no[$i];
                if($request->action == "in"){
                    $trd->in = $quantity[$i]['quantity'.$i][$key];
                    $updateditem->quantity += $quantity[$i]['quantity'.$i][$key];
                }
                else{
                    $trd->out = $quantity[$i]['quantity'.$i][$key];
                    $updateditem->quantity -= $quantity[$i]['quantity'.$i][$key];
                }
                $trd->notes = $notes[$i]['notes'.$i][$key];
                $trd->save();
                $updateditem->save();
                }
            }
            
        }
    
        return back()->with('success', 'Your files has been successfully added');
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
        $trd = Trdetail::find ($request->id);
        $trd->tr_id = $request->tr_id;
        if($request->action=="in"){
            $trd->in = $request->quantity;
        }
        else{
            $trd->out = $request->quantity;
        }
        $trd->driver_id = $request->driver;
        $trd->plate_no = $request->plate_no;
        $trd->item_id = $request->item;
        $trd->notes = $request->notes;
        $trd->save();
        //return response()->json($trd);
    }

    public function deleteDetail(Request $request){
        $trd = Trdetail::find($request->id)->delete();
        return response()->json();
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
    }
}
