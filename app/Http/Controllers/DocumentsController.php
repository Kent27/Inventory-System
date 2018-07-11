<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use Illuminate\Support\Facades\Storage;

class DocumentsController extends Controller
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
        $url = Storage::url('bodyBkg.jpg');
        return $url;
        return "<img src='upload/".$url."'/>";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('documents.create');
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

        $this->validate($request, [

            'documents' => 'required',
            'documents.*' => 'mimes:doc,xslx,xlsm,xls,xml,txt,pdf,docx,zip,jpg,jpeg,png'

        ]);

        if($request->hasFile('documents')){
            
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
                $document->save();
            }   
            

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
        $url = Storage::url('bodyBkg.jpg');
        return "<img src='".$url."'/>";

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
