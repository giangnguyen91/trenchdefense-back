@extends('layouts.dashboard')
@section('page_heading','Administration')

@section('section')
    <div class="row">
        <div class="col-sm-12">
            @section ('cotable_panel_title','Note')

            @section ('cotable_panel_body')
                Note for admin.
            @endsection

            @include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
        </div>
    </div>
@stop