<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Corp\Http\Requests;
use Corp\Http\Controllers\Controller;
use Gate;
use Corp\User;

class IndexController extends AdminController
{
    //
    
    public function __construct() {
		
		parent::__construct();
		if(Gate::allows('update-post')) {
            abort(403);
		}
		
		
		$this->template = env('THEME').'.admin.index';
		
	}
	
	public function index() {
		$this->title = 'Панель администратора';
		
		return $this->renderOutput();
		
	}
}
