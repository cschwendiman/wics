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
		Asset::add('jquery', 'js/jquery.js');
		Asset::add('bootstrapalerts', 'bootstrap/js/bootstrap-alerts.js', 'jquery');
		Asset::add('jquerytablesort', 'js/jquery.tablesorter.min.js', 'jquery');
		
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
			if((bool)$post->active != in_array($post->id, $publish_posts)){
				$post->active = (int)!$post->active;
				$post->save();
			}
		}
		return Redirect::to_adminposts()->with('success', 'Changes made successfully');
	}),
	
	'GET /admin/posts/create' => array('name' => 'adminpostscreate', 'before' => 'auth', 'do' => function() {
		$view = View::of_layout();
		$view->bind('content', View::make('admin::postscreate'));
		$view->bind('nav', View::make('admin::layout.tabs'));
		$current_user = Auth::user();
		$view->content->current_user = $current_user;
		$view->content->users = User::all();
		$model = substr($view->content->view, 0, 5);
		$view->header->topnav->active = $model;
		$view->nav->model = $model;
		$view->nav->active = 'create';
		return $view;
	}),
	
	'POST /admin/posts/create' => array('needs' => 'markdown', 'before' => 'auth', 'do' => function() {
		$input = Input::all();
		$rules = array(
		    'name'  => array('required', 'max:50'),
		    'markdown' => array('required'),
		);
		$messages = array(
			'required' => 'Required',
			'max' => 'Must be less than :max characters'
		);
		$validator = Validator::make($input, $rules, $messages);
		if ( ! $validator->valid())
		{
		    return Redirect::to_adminpostscreate()->with('errors', $validator->errors);
		}
		
		if(Input::has('preview')){
			$description = MarkdownText(Input::get('markdown'));
			return Redirect::to_adminpostscreate()->with('preview', $description);
		} else {
			$post = new Post;
			$post->name = $input['name'];
			$post->markdown = $input['markdown'];
			$post->description = MarkdownText($post->markdown);
			$post->user_id = $input['user_id'];
			$post->active = (int)isset($input['publish']);
			$post->save();
			return Redirect::to_adminpostscreate()->with('success', 'Post successfully created'.($post->active?' and published':''));
		}
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