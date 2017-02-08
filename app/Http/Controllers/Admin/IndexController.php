<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Corp\Http\Requests;
use Corp\Http\Controllers\Controller;
use Gate;
use Auth;
use Corp\User;

class IndexController extends AdminController
{
    //
    
    public function __construct() {
		/* $this->middleware(function ($request, $next) {
            $this->user = Auth::user()->projects;
            dd($this->user);
            return $next($request);
        }); */
        
		// parent::__construct();
        // $this->middleware('auth');
        // $this->user = Auth::user();
        // dd($this->user);
		if(Gate::allows('VIEW_ADMIN')) {
            abort(403);
		}
		
		
		$this->template = env('THEME').'.admin.index';
		
	}
	
	public function index() {
		$this->title = 'Панель администратора';
		
		return $this->renderOutput();
		
	}
}
