<?php 

function myCustomHelper()
{
    return 'Hey, it\'s working!';
}

function my_asset($path, $secure = null)
{
    //return asset('/public/' . trim($path, '/'), $secure);
    return app('url')->asset('public/'.$path, $secure);
}

function my_asset_storage($path, $secure = null)
{	
    //return asset('/public/' . trim($path, '/'), $secure);
    return app('url')->asset('public/storage/'.$path, $secure);
}

function setActiveRoute($name)
{
	return request()->routeIs($name) ? 'active' : '';
}
    	
?>