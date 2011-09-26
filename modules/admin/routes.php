<?
return array(
	'GET /admin' => array('name' => 'adminindex', 'before' => 'auth', 'do' => function() {
		$view = View::of_layout();
		$view->bind('content', View::make('admin::admin'));
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
			return Redirect::to_adminindex(); 
		else 
			return Redirect::to_login()->with('error', 'Username or password is incorrect');
	},
	
	'GET /admin/posts' => array('name' => 'adminposts', 'before' => 'auth', 'do' => function() {
		$view = View::of_layout();
		$view->bind('content', View::make('admin::posts'));
		$view->bind('nav', View::make('admin::layout.tabs'));
		$current_user = Auth::user();
		if($current_user->getClearance() === 1){
			$view->content->posts = Post::all();
		}
		else {
			$view->content->posts = Post::where_user_id($current_user->id);
		}
		$model = $view->content->view;
		$view->header->topnav->active = $model;
		$view->nav->model = $model;
		$view->nav->active = 'manage';
		return $view;
	}),
	
	'POST /admin/posts' => array('before' => 'auth', 'do' => function() {
		echo "<pre>";
		
		$delete_posts = Input::get('delete') ? Input::get('delete') : array();
		foreach($delete_posts as $id){
			$post = Post::find($id);
			$post->delete();
		}
		$current_user = Auth::user();
		if($current_user->getClearance() === 1){
			$posts = Post::all();
		}
		else {
			$posts = Post::where_user_id($current_user->id);
		}
		$publish_posts = Input::get('publish') ? Input::get('publish') : array();
		foreach($posts as $post){
			$post->active = in_array($post->id, $publish_posts);
			$post->save();
		}
	}),
	
	'GET /admin/posts/create' => array('name' => 'adminpostscreate', 'before' => 'auth', 'do' => function() {
		$view = View::of_layout();
		$view->bind('content', View::make('admin::posts'));
		$view->bind('nav', View::make('admin::layout.tabs'));
		$current_user = Auth::user();
		if($current_user->getClearance() === 1){
			$view->content->posts = Post::all();
		}
		else {
			$view->content->posts = Post::where_user_id($current_user->id);
		}
		$model = $view->content->view;
		$view->header->topnav->active = $model;
		$view->nav->model = $model;
		$view->nav->active = 'manage';
		return $view;
	}),

	'GET /admin/users' => array('name' => 'adminusers', function() {
		$view = View::of_layout();
		$view->bind('content', View::make('admin::admin'));
		$view->bind('nav', View::make('admin::nav.users'));
		$view->header->topnav->active = substr($view->content->view, 0, 5);
		$view->nav->active = 'manage';
		return $view;
	}),
	
	'GET /admin/users/create' => array('name' => 'adminuserscreate', function() {
		$view = View::of_layout();
		$view->bind('content', View::make('admin::userscreate'));
		$view->bind('nav', View::make('admin::nav.users'));
		$view->header->topnav->active = substr($view->content->view, 0, 5);
		$view->nav->active = 'create';
		return $view;
	}),
	
	'POST /admin/users/create' => array('name' => 'adminuserscreatepost', function() {
		$view = View::of_layout();
		$view->bind('content', View::make('admin::userscreate'));
		$view->bind('nav', View::make('admin::nav.users'));
		$view->header->topnav->active = substr($view->content->view, 0, 5);
		$view->nav->active = 'create';
		
		$rules = array(
		    'first_name'  => array('required', 'max:50'),
		    'last_name'  => array('required', 'max:50'),
		    'email' => array('required', 'email', 'unique:users'),
		);
		
		$input = Input::all();
		$input['email'] = $input['utcsid']."@cs.utexas.edu";
		
		$validator = Validator::make($input, $rules);

		if ( ! $validator->valid())
		{
		    return $validator->errors;
		}
		
		$user = new Admin/User($input);
		if($user->validate()){
			$user->save();
		}
		else {
			
		}
		
		return $view;
	}),
	
	'GET /admin/roles' => array('name' => 'adminroles', function() {
		
	}),
	
	'GET /admin/events' => array('name' => 'adminevents', function() {
		
	}),
);