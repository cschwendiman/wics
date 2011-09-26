<?
return array(
	'GET /admin' => array('name' => 'admin', 'before' => 'auth', 'do' => function() {
		$view = View::of_layout();
		$view->bind('content', View::make('admin::index'));
		$view->header->topnav->active = $view->content->view;
		return $view;
	}),
	
	'GET /admin/login' => array('name' => 'login', function() {
		Asset::add('bootstrap', 'bootstrap/bootstrap.css');
		Asset::add('jquery', 'js/jquery.js');
		Asset::add('bootstrapalerts', 'bootstrap/js/bootstrap-alerts.js', 'jquery');
		
		$view = View::make('admin::login');
		$view->header = View::make('admin::layout/header');
     	$view->footer = View::make('admin::layout/footer');
		
		return $view;
	}),

	'POST /admin/login' => function() {
		if (Auth::login(Input::get('email'), Input::get('password')))
			return Redirect::to_admin(); 
		else 
			return Redirect::to_login()->with('error', 'Username or password is incorrect');
	},
);