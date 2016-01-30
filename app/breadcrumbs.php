<?php

Breadcrumbs::register('dashboard', function($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('dashboard'));
});

Breadcrumbs::register('denied', function($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push( 'Permission Denied', route('denied'));
});

Breadcrumbs::register('url', function($breadcrumbs, $page) {
    $breadcrumbs->parent('dashboard');
    if($page == 'groups' || $page == 'user' || $page == 'permission'){
    	$breadcrumbs->push( ucfirst($page), route('settings.'.$page));
    }else{
    	$breadcrumbs->push( ucfirst($page), route($page. '.index'));
	}
});

Breadcrumbs::register('page', function($breadcrumbs, $page) {
    $explode = explode('.', $page);
    $breadcrumbs->parent('url',$explode[0]);
    $breadcrumbs->push( ucfirst($explode[1]), route($page));
});