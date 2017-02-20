<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Corp\Http\Requests;
use Corp\Http\Controllers\Controller;

use Auth;
use Gate;
use Menu;

class AdminController extends Controller
{
    //
    
    protected $p_rep;
    protected $a_rep;
    protected $user;
    protected $template;
    protected $content = FALSE;
    protected $title;
    protected $vars;
    
    public function __construct() {
		
         // $this->middleware('auth');
		// $this->user = Auth::user();
		
		// if(!$this->user) {
			// abort(403);
		// }
	}
	
	public function renderOutput() {
		$this->vars = array_add($this->vars,'title',$this->title);
		
		$menu = $this->getMenu();
		
		$navigation = view(config('settings.theme').'.admin.navigation')->with('menu',$menu)->render();
		$this->vars = array_add($this->vars,'navigation',$navigation);
		
		if($this->content) {
			$this->vars = array_add($this->vars,'content',$this->content);
		}
		
		$footer = view(config('settings.theme').'.admin.footer')->render();
		$this->vars = array_add($this->vars,'footer',$footer);
		
		return view($this->template)->with($this->vars);
		
		
		
		
	}
	
	public function getMenu() {
		return Menu::make('adminMenu', function($menu) {
			
            if(Gate::allows('VIEW_ADMIN_ARTICLES')) {
                $menu->add('Статьи',array('route' => 'articles.index'));
            }
            
            if(Gate::allows('VIEW_ADMIN_MENU')){
                $menu->add('Меню',  array('route'  => 'menus.index'));
            }
            
            if(Gate::allows('EDIT_USERS')){
                $menu->add('Привилегии',  array('route'  => 'permissions.index'));
            }
            
            if(Gate::allows('EDIT_USERS')){
                $menu->add('Пользователи',  array('route'  => 'users.index'));
            }
            
            
			$menu->add('Портфолио',  array('route'  => 'articles.index'));
            
			if(isset(Auth::user()->name)){
                $menu->raw(Auth::user()->name,array('class' => 'alert-danger'));
                $menu->add('Logout',array('route' => 'logout','class' => 'alert-danger'));
            }
			
			
		});
	}
	
	
}
