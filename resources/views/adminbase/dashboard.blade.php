@extends('adminbase.base')
@section('content')
    <div class="wrapper">
        <div class="body-overlay"></div>
      @if(auth()->check())
        <!-- Sidebar -->
        <div id="sidebar">
            <div class="sidebar-header">
                <h3><img src="{{ asset('img/Logo-site-SONABEL-def.png') }}" class="img-fluid"/><span>{{config('app.name')}}</span></h3>
            </div>
            <ul class="list-unstyled component m-0" >


                <li class="dropdown {{Route::is('admin.index')? 'active' : ''}}" style="text-decoration: none">
                    <a href="{{route('admin.index')}}" class="dashboard" style="text-decoration: none"><i class="material-icons">dashboard</i>Dashboard </a>
                </li>

                @if((strtolower(auth()->user()->role->name)==="administrateur") || (strtolower(auth()->user()->role->name)==="chef") )
                <li class="dropdown {{Route::is('listUser')? 'active' : ''}}">
                    <a href="{{route('listUser')}}" class="dashboard" style="text-decoration: none"><i class="material-icons">group</i>Utilisateur </a>
                </li>

                    <li class="dropdown">
                    <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false"
                       class="dropdown-toggle" style="text-decoration: none">
                        <i class="material-icons">assignment</i> Affectations
                    </a>
                    <ul class="collapse list-unstyled menu" id="homeSubmenu1" style="text-decoration: none">
                        <li class="dropdown {{Route::is('usercentre.index')? 'active' : ''}}"> <a href="{{route('usercentre.index')}}" style="text-decoration: none">Zone & utilisateur</a></li>
                        <li class="dropdown {{Route::is('userservice.index')? 'active' : ''}}"><a href="{{route('userservice.index')}}" style="text-decoration: none">Service & utilisateur</a></li>
                    </ul>
                </li>
                    @endif


                    @if((strtolower(auth()->user()->role->name)==="administrateur"))

                    <li class="dropdown">
                    <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false"
                       class="dropdown-toggle" style="text-decoration: none">
                        <i class="material-icons">aspect_ratio</i>Permissions
                    </a>
                    <ul class="collapse list-unstyled menu" id="homeSubmenu2" style="text-decoration: none">
                        <li class="dropdown {{Route::is('roles.index')? 'active' : ''}}"><a href="{{ route('roles.index') }}" style="text-decoration: none">Roles</a></li>
                        <li class="dropdown {{Route::is('permissions.index')? 'active' : ''}}"><a href="{{ route('permissions.index') }}" style="text-decoration: none">Permissions</a></li>
                        <li class="dropdown {{Route::is('rolelier.index')? 'active' : ''}}"><a href="{{route('rolelier.index')}}" style="text-decoration: none">Roles & Permissions</a></li>
                        <li class="dropdown {{Route::is('services.index')? 'active' : ''}}"><a href="{{route('services.index')}}" style="text-decoration: none">Services</a></li>
                    </ul>
                </li>

                    @endif



                @if((strtolower(auth()->user()->role->name)==="administrateur") ||(strtolower(auth()->user()->role->name)==="agent")|| (strtolower(auth()->user()->role->name)==="superviseur") ||(strtolower(auth()->user()->role->name)==="chef"))

                <li class="dropdown">
                    <a href="#homeSubmenu3" data-toggle="collapse" aria-expanded="false"
                       class="dropdown-toggle" style="text-decoration: none">
                        <i class="material-icons" >description</i> Tickets
                    </a>
                    <ul class="collapse list-unstyled menu" id="homeSubmenu3" style="text-decoration: none">

                        @if((strtolower(auth()->user()->role->name)==="administrateur") ||(strtolower(auth()->user()->role->name)==="agent") ||(strtolower(auth()->user()->role->name)==="superviseur") ||(strtolower(auth()->user()->role->name)==="chef"))
                        <li class="dropdown {{Route::is('traiterticket.index')? 'active' : ''}}"><a href="{{route('traiterticket.index')}} " style="text-decoration: none">En attente d'intervention</a></li>
                        {{--<li class="dropdown {{Route::is('ticketouvert.index')? 'active' : ''}}"><a href="{{route('ticketouvert.index')}} " style="text-decoration: none">En cours d'intervention</a></li>--}}
                        <li class="dropdown {{Route::is('attenteclient.index')? 'active' : ''}}"><a href="{{route('attenteclient.index')}} " style="text-decoration: none">En attente du client</a></li>
                        <li class="dropdown {{Route::is('ticketterminer.index')? 'active' : ''}}"><a href="{{route('ticketterminer.index')}} " style="text-decoration: none">intervention terminé </a></li>
                        <li class="dropdown {{Route::is('ticketcloturer.index')? 'active' : ''}}"><a href="{{route('ticketcloturer.index')}} " style="text-decoration: none">Cloturé</a></li>
                        {{--<li><a href="#" style="text-decoration: none">Mes ticket Traité</a></li>--}}
                        @endif

                        @if((strtolower(auth()->user()->role->name)==="administrateur") ||(strtolower(auth()->user()->role->name)==="superviseur") ||(strtolower(auth()->user()->role->name)==="chef"))
                        <li class="dropdown {{Route::is('transferticket.index')? 'active' : ''}}"><a href="{{route('transferticket.index')}}" style="text-decoration: none">Transferts</a></li>
                        @endif
                    </ul>
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar End -->

        <!-- Page Content -->
        <div id="content">
            <!-- Top Navbar -->
            <div class="top-navbar">
                <div class="xd-topbar">
                    <div class="row">
                        <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
                            <div class="xp-menubar">
                                <span class="material-icons text-white">signal_cellular_alt</span>
                            </div>
                        </div>
                        <div class="col-md-5 col-lg-3 order-3 order-md-2">
                            <div class="xp-searchbar">
                                <form id="searchForm" onsubmit="return performSearch(event);">
                                    <div class="input-group">
                                        <input type="search" class="form-control" name="searchTerm" placeholder="Rechercher un ticket" value="{{ request('searchTerm') }}" id="searchTerm">
                                        <div class="input-group-append">
                                            <button class="btn" type="submit" id="button-addon2">Go</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="results"></div>





                        <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
                            <div class="xp-profilebar text-right">
                                <nav class="navbar p-0">
                                    <ul class="nav navbar-nav flex-row ml-auto">
                                        @if((strtolower(auth()->user()->role->name)==="administrateur") ||(strtolower(auth()->user()->role->name)==="agent") )
                                        <li class="dropdown nav-item active">
                                            <a class="nav-link" href="#" data-toggle="dropdown" style="text-decoration: none">
                                                <span class="material-icons" >notifications</span>
                                                <span class="notification">{{isset($matchingTickets)? $matchingTickets->count() :0 }}</span>
                                            </a>
                                            {{--<ul class="dropdown-menu">
                                                <li><a href="#" style="text-decoration: none">You Have 4 New Messages</a></li>
                                                <li><a href="#" style="text-decoration: none">You Have 4 New Messages</a></li>
                                                <li><a href="#" style="text-decoration: none">You Have 4 New Messages</a></li>
                                                <li><a href="#" style="text-decoration: none">You Have 4 New Messages</a></li>
                                            </ul>--}}
                                        </li>
                                        @endif



                                        <li class="dropdown nav-item">
                                            <a class="nav-link" href="#" data-toggle="dropdown">
                                                <img src="{{asset('img/user.jpg')}}" style="width:40px; border-radius:50%;"/>
                                                <span class="xp-user-live"></span>
                                            </a>
                                            <ul class="dropdown-menu small-menu">
                                                <li><a style="text-decoration: none " >
                                                        <span class="material-icons" >person_outline</span>

                                                        {{auth()->user()->username}}
                                                       <br>{{auth()->user()->role->name}}
                                                    </a></li>
                                                {{--<li><a href="#" style="text-decoration: none">
                                                        <span class="material-icons" >settings</span>
                                                        Paramettre
                                                    </a></li>--}}
                                                <li>
                                                    <a href="{{route('auth.logout')}}" style="text-decoration: none">
                                                        <span class="material-icons">logout</span>
                                                        Deconnexion
                                                    </a></li>

                                            </ul>
                                        </li>


                                    </ul>
                                </nav>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- Top Navbar End -->

            <!-- Main Content -->
           @yield('tableview')
            <!-- Main Content End -->

            <!-- Modals -->
            @yield('modal')
            <!-- Modals End -->
            @endif
        </div>
        <!-- Page Content End -->
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
@endsection

