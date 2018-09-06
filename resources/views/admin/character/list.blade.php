@extends('layouts.dashboard')
@section('page_heading','Characters')

@section('section')
    <div class="row">
        <div class="col-sm-12">
            @section ('cotable_panel_title','Characters')
            <a href="{{route('admin.character.create')}}" class="btn btn-primary">Create</a>
            @section ('cotable_panel_body')
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>HP</th>
                        <th>Speed</th>
                        <th>Attack</th>
                        <th>Resource ID</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($characters as $character)
                        <tr>
                            <td>{{$character->getName()->getValue()}}</td>
                            <td>{{$character->getHp()->getValue()}}</td>
                            <td>{{$character->getSpeed()->getValue()}}</td>
                            <td>{{$character->getAttack()->getValue()}}</td>
                            <td>{{$character->getResourceID()->getValue()}}</td>
                            <td><a href="{{ route('admin.character.get.update', ['characterID' => $character->getID()->getValue()]) }}"
                                   class="btn btn-primary btn-sm">Update</a>
                                <a href="{{ route('admin.character.delete', ['characterID' => $character->getID()->getValue()]) }}"
                                   class="btn btn-danger btn-sm">Delete</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
        </div>
    </div>
@stop