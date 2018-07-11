<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    /*public function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }*/

    public function index(){
    	$posts = Post::latest()->get();
    	return view('posts.index', compact('posts'));
    }

    public function show($id){
    	$post = Post::find($id);
    	return view('posts.show',compact('post'));
    }

    public function create(){
    	return view('sessions.create');
    }

    public function store(){
    	//dd(request(['title', 'body']));

    	/*$post = new Post;
    	$post->title = request('title');
    	$post->body = request('body');
    	$post->save();*/
    	$this->validate(request(),[
    		'email' => 'required',
    		'password' => 'required',
    	]);
    	
    	if(! auth()->attempt(['email'=>request('email'),'password'=>request('password')])){
    		return back()->withErrors([
    			'message' => 'Please Check Your Credentials and try again'
    		]);
    	}

    	return redirect()->intended('/home');
    }

    public function destroy(){
    	auth()->logout();
    	return redirect('/');
    }
}
