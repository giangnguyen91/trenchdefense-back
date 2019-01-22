@extends('layouts.dashboard')
@section('page_heading','Reset Master data')

@section('section')
    <div class="row">
        <div class="col-sm-12">
            @section ('cotable_panel_title','Note')

            @section ('cotable_panel_body')
                <span style="color:red;">The master data will be cleared and re-imported:</span><br/>
                Zombie, Character, Wave, Zombies in wave, Loots in wave, Weapons...etc<br/>

                User's data will be kept intact.<br/>

                <form role="form" method="POST" action="{{route('admin.reset.masterdata')}}">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="submit" class="btn btn-primary" value="Reset"/>
                        </div>
                    </div>
                </form>
            @endsection

            @include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
        </div>
    </div>
@stop