@extends('admin.users.items')

{{-- Seccion de Form --}}
@section('form')

<div class="formularios white" id="user_form">

	<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" ref="createForm">
		@csrf

		<div class="fotos avatar">
			<div class="foto">
				<input type="file" name="avatar" @change="setImage" accept="image/*">
				<div class="type">
					<i class="fa fa-camera" aria-hidden="true"></i>
				</div>
			</div>
		</div>

		@if(auth('admin')->user()->hasAdminRoleLevel())
		<div class="input">
			<label class="stay">Roles</label>
			<select name="role">
				<option selected disabled>Choose role</option>
				<option value="regular">Editor</option>
				<option value="admin">Admin</option>
				@if (auth('admin')->user()->hasRole('super_admin'))
				<option value="super_admin">Super Admin</option>
				@endif
			</select>
			<div class="focus"></div>
		</div>
		@endif

		<div class="input">
			<label>Name</label>
			<input type="text" name="name" value="{{ old('name') }}" placeholder="Name">
			<div class="focus"></div>
		</div>

		<div class="input">
			<label>Email</label>
			<input type="text" name="email" value="{{ old('email') }}" placeholder="Email">
			<div class="focus"></div>
		</div>

		<div class="input">
			<label>Password</label>
			<input type="password" name="password" placeholder="Password">
			<div class="focus"></div>
		</div>

		<div class="input">
			<label>Confirm</label>
			<input type="password" name="password_confirmation" placeholder="Confirm">
			<div class="focus"></div>
		</div>

		@if(auth('admin')->user()->hasAdminRoleLevel())
		<div class="input check">
			<input type="hidden" name="receive_notifications" value="0">
			<input type="checkbox" name="receive_notifications" value="1">
			<div class="checkbox">
				<i class="fa fa-check" aria-hidden="true"></i>
			</div>
			<label>Receive notifications</label>
		</div>
		@endif

		<button type="button" @click="saveWithSpinner($refs.createForm)">Done</button>

	</form>

</div>

<panel-change-view view="edit_view"></panel-change-view>

<panel-config :actions="['hideActions', 'hidePreview']"></panel-config>

@endsection
{{-- Seccion de Form --}}
