@extends('admin.users.items')

{{-- Seccion View --}}
@section('preview')

<div id="user_preview">


</div>

@endsection
{{-- Seccion View --}}

{{-- Seccion de Form --}}
@section('form')

<div class="formularios white" id="user_form">

	<form @submit.prevent="saveWithSpinner" action="{{ route('users.update', compact('user')) }}" method="POST" enctype="multipart/form-data" ref="updateForm">
		@csrf
		@method('PUT')

		<div class="fotos avatar">
			<div class="foto" :style="imgBackground('{{ $user->avatar }}')">
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
				<option value="regular" @if($user->role == 'regular') selected @endif>Editor</option>
				<option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
				@if (auth('admin')->user()->hasRole('super_admin'))
				<option value="super_admin" @if($user->role == 'super_admin') selected @endif>Super Admin</option>
				@endif
			</select>
			<div class="focus"></div>
		</div>
		@endif

		<div class="input">
			<label>Name</label>
			<input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Name">
			<div class="focus"></div>
		</div>

		<div class="input">
			<label>Email</label>
			<input type="text" name="email" value="{{ old('email', $user->email) }}" placeholder="Email">
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
			<input type="hidden" name="receive_notifications" :value="0">
			<input type="checkbox" name="receive_notifications" :value="1" @if($user->receive_notifications) checked
			@endif>
			<div class="checkbox">
				<i class="fa fa-check" aria-hidden="true"></i>
			</div>
			<label>Receive notifications</label>
		</div>
		@endif

		<button type="button" @click="saveWithSpinner($refs.updateForm)">Done</button>

	</form>


</div>

<panel-change-view view="edit_view"></panel-change-view>

<panel-config :actions="['hideActionShow', 'hidePreview']"></panel-config>

<panel-delete-item message="Delete this user? ({{ $user->name }})" delete-route="{{ route('users.destroy', compact('user')) }}"></panel-delete-item>


@endsection
{{-- Seccion de Form --}}

