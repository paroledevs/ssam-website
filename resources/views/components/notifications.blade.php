<show-notifications 
	@if ($errors->any()) :errors="{{ json_encode($errors->all()) }}" @endif
    @if (session('reset_status')) notification="Password restored successfully, please login" @endif
    @if (session('status-reset-fails')) :errors="['{{ session('status-reset-fails') }}']" @endif
	@if (session('notification')) notification="{{ session('notification') }}" @endif
    @if (session('status')) notification="An email has been sent with instructions to continue" @endif>
</show-notifications>
