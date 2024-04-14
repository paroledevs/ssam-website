@extends('admin.dashboard')

@section('title', 'Admin | Monitor')

@section('bar_title', 'Monitor')

{{-- Seccion de items --}}
@section('items')


@foreach ($activities as $activity)

<a href="{{ route('monitor.show', compact('activity')) }}">
    <div class="item monitor_item">

        <div class="texto">
            <strong>{{ $activity->causedBy ? $activity->causedBy->name : $activity->description }}</strong>
            <span>{{ $activity->created_at->format('d/m/Y - h:m a') }}</span>
        </div>

    </div>
</a>

@endforeach

{{ $activities->links() }}

<panel-config :actions="['hideFilters', 'hideSearch', 'hideActions']"></panel-config>

@endsection

{{-- Seccion de items --}}


