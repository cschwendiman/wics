<?
return array(
	'GET /admin/events' => array('name' => 'eventsmanage', 'before' => 'auth', 'do' => function() {
		Asset::add('jquery', 'js/jquery.js');
		Asset::add('bootstrapalerts', 'bootstrap/js/bootstrap-alerts.js', 'jquery');
		Asset::add('jquerytablesort', 'js/jquery.tablesorter.min.js', 'jquery');
		
		$view = View::of_layout();
		$view->bind('content', '<h1>Coming Soon</h1>');
		$view->bind('nav', View::make('admin::layout.tabs'));

		$view->header->topnav->active = 'events';
		$view->nav->model = 'events';
		$view->nav->active = 'manage';
		return $view;
	}),
	
	'GET /admin/events/create' => array('name' => 'eventscreate', 'before' => 'auth', 'do' => function() {
		$view = View::of_layout();
		$view->bind('content', '<h1>Coming Soon</h1>');
		$view->bind('nav', View::make('admin::layout.tabs'));

		$view->header->topnav->active = 'events';
		$view->nav->model = 'events';
		$view->nav->active = 'create';
		return $view;
	}),
);