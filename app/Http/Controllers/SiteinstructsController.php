<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siteinstruct;
use App\Document;
use DataTables;
class SiteinstructsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function editPost(request $request){
      $post = Siteinstruct::find ($request->id);
      $post->name = $request->name;
      $post->requester_notes = $request->requester_notes;
      $post->save();
      return response()->json($post);
    }

    public function deletePost(request $request){
      $post = Siteinstruct::find ($request->id)->delete();
      return response()->json();
    }

    public function index()
    {
        //
        $siteinstruct = Siteinstruct::first();
        $post = Siteinstruct::paginate(4);
        return view('siteinstructs.index', compact('siteinstruct', 'post'));
    }

    public function anyData()
    {
        $siteinstructs = Siteinstruct::all();
        /*return DataTables::of($siteinstructs)->editColumn('id', '<a href="#" data-id="1" data-title="1" data-body="1" >{{$id}} </a>')->make(true);*/
        /*$siteinstructs = Siteinstruct::all();
        return json_encode($siteinstructs);*/
        /*return DataTables::of($siteinstructs)->editColumn('id', function(Document $document) {
                  $path = $document->pathname;
                        return '<a  href="'.url('upload/'.$path).'">{{id}}</a>';
                    })->make(true);*/
        return DataTables::of($siteinstructs)->editColumn('action', function(Siteinstruct $siteinstruct){
                $path = "somewhere";
                /*return '<a  href="'.url('uploads/'.$path).'">View</a>';*/
                return '<a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$id}}" data-title="{{$title}}" data-body="{{$row.body}}">
                    <i class="fa fa-eye"></i>
                    </a>
                    <a href="#" class="edit-modal btn btn-warning btn-sm" data-id="{{$value->id}}" data-title="{{$value->title}}" data-body="{{$value->body}}">
                    <i class="glyphicon glyphicon-pencil"></i>
                    </a>
                    <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{$value->id}}" data-title="{{$value->title}}" data-body="{{$value->body}}">
                    <i class="glyphicon glyphicon-trash"></i>
                    </a>';
                })->rawColumns(['action'])->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('siteinstructs.create');
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
        /*$this->validate($request, [
            'doctypes' => 'required',
            'documents' => 'required',
            'documents.*' => 'mimes:doc,xslx,xlsm,xls,xml,txt,pdf,docx,zip,jpg,jpeg,png'

        ]);

        $rules = array(
            'title' => 'required',
            'body' => 'required',
          );
        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails())
        return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));

        else {
          $post = new Siteinstruct;
          $post->title = $request->title;
          $post->body = $request->body;
          $post->save();
          return response()->json($post);
        }

        return "fail";*/
        $this->validate($request, [

            'documents' => 'required',
            'documents.*' => 'mimes:doc,xslx,xlsm,xls,xml,txt,pdf,docx,zip,jpg,jpeg,png'

        ]);

        if($request->hasFile('documents')){
            
            if(Siteinstruct::where('name', request('title'))->first()){
                return back()->with('fail', 'Project "'.request('title').'" already exists');
            }

            /*$si = new Siteinstruct;
            $si->name = request('title');
            $si->access_level = "0";
            $si->requester_notes = request('requester_notes');
            $si->requester_id = auth()->id();
            $si->status = "waiting";

            foreach ($request->file('documents') as $key=>$file) {
                # code...

                $filename = $file->getClientOriginalName();
                $filesize = $file->getClientSize();


                //print_r($key." = ".$filename." & ".request('notes')[$key]);
                $file->storeAs('public/upload', $filename);

                $document = new Document;
                $document->name = $filename;
                $document->type = request('doctypes')[$key];
                $document->notes = request('notes')[$key];
                $document->filepath = "upload/".$filename;
                $document->uploader_id = auth()->id();
                $document->si_id = $si->id;
                $document->save();
            }   
            
            $si->save();*/

            /*$request->file->storeAs('public/upload', $filename);
            
            return $filename;
            $file= new Document;
            $file->name = $filename;
            $file->type = 'SI_Document';
            $file->notes = $filesize;*/
            return back()->with('success', 'Your files has been successfully added');
        }

        return "fail";
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
        //
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
