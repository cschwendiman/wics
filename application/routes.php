<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Application Routes
	|--------------------------------------------------------------------------
	|
	| Here is the public API of your application. To add functionality to your
	| application, you just add to the array located in this file.
	|
	| Simply tell Laravel the HTTP verbs and request URIs it should respond to.
	| You may respond to the GET, POST, PUT, or DELETE verbs. Enjoy the simplicity
	| and elegance of RESTful routing.
	|
	| Here is how to respond to a simple GET request to http://example.com/hello:
	|
	|		'GET /hello' => function()
	|		{
	|			return 'Hello World!';
	|		}
	|
	| You can even respond to more than one URI:
	|
	|		'GET /hello, GET /world' => function()
	|		{
	|			return 'Hello World!';
	|		}
	|
	| It's easy to allow URI wildcards using the (:num) or (:any) place-holders:
	|
	|		'GET /hello/(:any)' => function($name)
	|		{
	|			return "Welcome, $name.";
	|		}
	|
	*/

	'GET /' => array('name' => 'index', function()
	{
		$view = View::of_layout();
		$view->bind('content', View::make('core.index'));
		$view->bind('nav', View::make('core.nav.index'));
		$view->header->topnav->selected = substr($view->content->view, 5);
		return $view;
	}),
	
	'GET /about' => array('name' => 'about', function()
	{
		$view = View::of_layout();
		$view->bind('content', View::make('core.about'));
		$view->bind('nav', View::make('core.nav.index'));
		$view->header->topnav->selected = substr($view->content->view, 5);
		return $view;
	}),
	
	'GET /contact' => array('name' => 'contact', function()
	{
		$view = View::of_layout();
		$view->bind('content', View::make('core.contact'));
		$view->bind('nav', View::make('core.nav.index'));
		$view->header->topnav->selected = substr($view->content->view, 5);
		return $view;
	}),
	
	'GET /photos' => array('name' => 'photos', function()
	{
		$view = View::of_layout();
		$view->bind('content', View::make('core.photos'));
		$view->bind('nav', View::make('core.nav.index'));
		$view->header->topnav->selected = substr($view->content->view, 5);
		return $view;
	}),
	
	'GET /events' => array('name' => 'events', function()
	{
		$view = View::of_layout();
		$view->bind('content', View::make('core.events'));
		$view->bind('nav', View::make('core.nav.index'));
		$view->header->topnav->selected = substr($view->content->view, 5);
		return $view;
	}),
	
	'GET /test' => array('name' => 'test', function()
	{
		$user = new User();
		$user->email = "cassie@cs.utexas.edu";
		$user->first_name = "Cassie";
		$user->last_name = "Schwendiman";
		$user->password = Hash::make('0853');
		$user->active = 1;
		$user->save();
		
		return $view;
	})
);