@extends('layouts.plane')

@section('body')
 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url ('') }}">Trench Defence Management</a>
            </div>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li {{ (Request::is('*zombies') ? 'class="active"' : '') }}>
                            <a href="{{ url ('admin/zombies') }}"><i class="fa  fa-table fa-fw"></i> Zombies</a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li {{ (Request::is('*waves') ? 'class="active"' : '') }}>
                            <a href="{{ url ('admin/waves') }}"><i class="fa fa-table fa-fw"></i> Waves</a>
                        </li>
                        <li {{ (Request::is('*characters') ? 'class="active"' : '') }}>
                            <a href="{{ url ('admin/characters') }}"><i class="fa fa-table fa-fw"></i> Characters</a>
                        </li>

                        <li {{ (Request::is('*having_characters') ? 'class="active"' : '') }}>
                            <a href="{{ url ('admin/characters/having') }}"><i class="fa fa-table fa-fw"></i> Having Characters</a>
                        </li>

                        <li {{ (Request::is('*weapons') ? 'class="active"' : '') }}>
                            <a href="{{ url ('admin/weapons/group') }}"><i class="fa fa-table fa-fw"></i> Weapon Groups</a>
                        </li>

                        <li {{ (Request::is('*weapons') ? 'class="active"' : '') }}>
                            <a href="{{ url ('admin/weapons') }}"><i class="fa fa-table fa-fw"></i> Weapons</a>
                        </li>

                        <li {{ (Request::is('*weapons') ? 'class="active"' : '') }}>
                            <a href="{{ url ('admin/weapons') }}"><i class="fa fa-table fa-fw"></i> Weapons</a>
                        </li>

                        <li {{ (Request::is('*reset') ? 'class="active"' : '') }}>
                            <a href="{{ url ('admin/reset/masterdata') }}"><i class="fa fa-table fa-fw"></i> Reset master data</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
			 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page_heading')</h1>
                </div>
                <!-- /.col-lg-12 -->
           </div>
			<div class="row">  
				@yield('section')

            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@stop

