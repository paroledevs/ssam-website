@extends('admin.dashboard')

@section('title', 'Admin |'. auth('admin')->user()->hasRole('regular') ? 'Profile' : 'Users')

@section('bar_title', auth('admin')->user()->hasRole('regular') ? 'Profile' : 'Users')

{{-- Seccion de items --}}
@section('items')

@if (auth('admin')->user()->hasAdminRoleLevel())
<a href="{{ route('users.create') }}">

    <div class="item user_item new">
        <label>Click para registrar usuario</label>
    </div>

</a>
@endif

@foreach ($users as $user)

<a href="{{ route('users.edit', compact('user')) }}">

    <div class="item user_item">
        <div class="avatar" :style="imgBackground('{{ $user->avatar }}')"></div>
        <strong>{{ $user->name }}</strong>
    </div>

</a>

@endforeach

{{ $users->links() }}

<panel-config :actions="['hideFilters', 'hideSearch']"></panel-config>

@endsection


{{-- Seccion de items --}}
