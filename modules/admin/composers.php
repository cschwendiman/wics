<?php

return array(

	'layout/layout' => array('name' => 'layout', function($view)
	{
		Asset::add('bootstrap', 'bootstrap/bootstrap.css');
		
		$view->header = View::make('admin::layout/header');
		$view->header->topnav = View::make('admin::layout/topnav');
     	$view->footer = View::make('admin::layout/footer');
		
		return $view;
	}),

);