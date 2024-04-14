@extends('layouts.default')

@section('content')

<div id="login">


    {{-- COVER --}}
    <section id="cover">

        <div class="slogan">
            <img src="/images/ssam.svg">
        </div>

    </section>


    <section id="form">


        <div class="login">

            <h3>LOG IN</h3>

            <form action="{{ route('admin.login.make') }}" method="POST">

                @csrf

                <div class="input" id="input_email">
                    <input type="text" placeholder="EMAIL" name="email" value="{{ old('email') }}">
                </div>

                <div class="input" id="input_pass">
                    <input type="password" placeholder="PASSWORD" name="password">
                </div>

                <button type="submit">ENTER</button>

            </form>

        </div>


		@if ($errors->any())
	        <show-notifications :errors="{{ json_encode($errors->all()) }}"></show-notifications>
	    @endif


    </section>




</div>


@endsection
