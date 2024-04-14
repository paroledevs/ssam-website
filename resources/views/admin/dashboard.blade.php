@extends('layouts.default')

@section('content')
    <div id="dashboard">

        {{-- SIDE MENU --}}
        <aside id="dashboardAside">
            @include('components.admin.menu')
        </aside>


        <main>

            {{-- CONTENT --}}


            <section id="content">


                <search-and-filters title="@yield('bar_title')" search-route="@yield('search_route')" init-search-text="{{ request()->query('q') }}" :on-spa-mode="{{ Request::is('admin/spa/*') ? 'true' : 'false' }}"></search-and-filters>


                @if (Request::is('admin/spa/*'))
                    @yield('items')
                @else
                    <div class="content" id="contentItems">

                        @yield('items')

                    </div>
                @endif


            </section>



            {{-- DETAILS --}}

            <section id="details">



                {{-- BARRA DE VISTAS --}}

                @if (count(explode('/', Request::path())) > 2)
                    <views-bar @if (Request::is('admin/spa/*')) :on-spa-mode="true" @endif v-slot="slotProps">

                        {{-- TIPOS DE VISTAS --}}
                        <switch-view></switch-view>

                        {{-- ACTIONS --}}
                        <view-actions :on-spa-mode="slotProps.onSpaMode"></view-actions>

                    </views-bar>
                @endif

                {{-- VISTAS --}}
                <div class="view" id="edit_view">

                    {{-- Componentes de form --}}
                    @yield('form')

                </div>

                <div class="view" id="preview">

                    {{-- Componenes de vista --}}
                    @yield('preview')

                </div>


                <spinner></spinner>


                @include('components.notifications')



            </section>

        </main>

        <rx :path="{{ count(explode('/', Request::path())) }}" @if (Request::is('admin/spa/*')) :on-spa-mode="true" @endif></rx>

    </div>
@endsection
