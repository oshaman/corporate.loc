<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Corp\Http\Requests;
use Corp\Http\Controllers\Controller;

use Auth;
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
		
		$navigation = view(env('THEME').'.admin.navigation')->with('menu',$menu)->render();
		$this->vars = array_add($this->vars,'navigation',$navigation);
		
		if($this->content) {
			$this->vars = array_add($this->vars,'content',$this->content);
		}
		
		$footer = view(env('THEME').'.admin.footer')->render();
		$this->vars = array_add($this->vars,'footer',$footer);
		
		return view($this->template)->with($this->vars);
		
		
		
		
	}
	
	public function getMenu() {
		return Menu::make('adminMenu', function($menu) {
			
			$menu->add('Статьи',array('action' => 'Admin\ArticlesController@index'));
			$menu->add('Портфолио',  array('action' => 'Admin\ArticlesController@index'));
			$menu->add('Меню',  array('action' => 'Admin\ArticlesController@index'));
			$menu->add('Пользователи',  array('action' => 'Admin\ArticlesController@index'));
			$menu->add('Привилегии',  array('action' => 'Admin\ArticlesController@index'));
			
		});
	}
	
	
}
