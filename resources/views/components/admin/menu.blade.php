<dashboard-menu :items="{{
	json_encode(array_merge([

	[
		'active' => Str::contains(Request::path(), 'users'),
		'link' => route('users.index'),
		'icon' => 'icon-user',
		'title' => auth('admin')->user()->hasRole('regular') ? 'PROFILE' : 'USERS'
	],

	[
		'active' => Str::contains(Request::path(), 'promos'),
		'link' => route('promos.index'),
		'icon' => 'icon-star',
		'title' => 'PROMOS'
	],
	
	[
		'active' => Str::contains(Request::path(), 'menu'),
		'link' => route('menu.index'),
		'icon' => 'icon-food',
		'title' => 'MENU'
	],
	
	[
		'active' => Str::contains(Request::path(), 'locations'),
		'link' => route('locations.index'),
		'icon' => 'icon-location',
		'title' => 'UBICACIONES'
	],
	
	[
		'active' => Str::contains(Request::path(), 'recipes'),
		'link' => route('posts.index'),
		'icon' => 'icon-note',
		'title' => 'RECETAS'
	],

	[
		'active' => Str::contains(Request::path(), 'site'),
		'link' => route('website.index'),
		'icon' => 'icon-desktop',
		'title' => 'WEBSITE'
	],

	], auth('admin')->user()->hasAdminRoleLevel() ? [
		//[
		//	'active' => Str::contains(Request::path(), 'settings'),
		//	'link' => route('settings.index'),
		//	'icon' => 'icon-params',
		//	'title' => 'AJUSTES'
		//],
	] : []
	, auth('admin')->user()->hasRole('super_admin') ? [[
		'active' => Str::contains(Request::path(), 'monitor'),
		'link' => route('monitor.index'),
		'icon' => 'icon-eye',
		'title' => 'MONITOR'
	]] : [])) }}">

	<template v-slot:csrf>
		<form action="{{ route('admin.logout') }}" id="logout-form-component" method="POST">
			@csrf
		</form>
	</template>

</dashboard-menu>
