@extends('layouts.dashboard')
@section('page_heading','Having Characters')
@section('section')
    <div class="row">
        <div class="col-sm-12">
            @section ('cotable_panel_title','Having Characters')
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" method="GET" action="{{route('admin.having_character.list')}}">
                            <div class="row">
                                <div class="col-xs-6 col-md-4">
                                    <div class="form-group">
                                        <label>Account ID</label>
                                        <input name="game_user_id" type="text" class="form-control"
                                               value="@if($gameUserID) {{$gameUserID}}@endif" required/>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-md-4" style="margin-top: 3%;">
                                    <input type="submit" class="btn btn-primary" value="Search"/>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if($gameUserID)
                    <div class="col-lg-6">
                        <form role="form" method="POST" action="{{route('admin.having_character.add')}}">
                            <input name="game_user_id" type="hidden" class="form-control"
                                   value="@if($gameUserID) {{$gameUserID}}@endif" required/>
                            <div class="row">
                                <div class="col-xs-6 col-md-4">
                                    <div class="form-group">
                                        <label>Character ID</label>
                                        <input name="character_id" type="text" class="form-control"
                                               value="" required/>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-md-4" style="margin-top: 3%;">
                                    <input type="submit" class="btn btn-primary" value="Add"/>
                                </div>
                            </div>
                        </form>
                    </div>
                        @endif


                </div>
            </div>
            @section ('cotable_panel_body')
                @if($gameUserID)
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($characters as $character)
                            <tr>
                                <td>{{$character->getCharacter()->getId()->getValue()}}</td>
                                <td>{{$character->getCharacter()->getName()->getValue()}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
        </div>
    </div>
@stop