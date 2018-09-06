@extends('layouts.dashboard')
@section('page_heading','Zombies')

@section('section')
    <div class="row">
        <div class="col-sm-12">
            @section ('cotable_panel_title','Zombies')
            <a href="{{route('admin.zombie.create')}}" class="btn btn-primary">Create</a>
            @section ('cotable_panel_body')
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Damage</th>
                        <th>HP</th>
                        <th>Speed</th>
                        <th>Attack</th>
                        <th>Drop Gold</th>
                        <th>Resource ID</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($zombies as $zombie)
                        <tr>
                            <td>{{$zombie->getName()->getValue()}}</td>
                            <td>{{$zombie->getDamage()->getValue()}}</td>
                            <td>{{$zombie->getHp()->getValue()}}</td>
                            <td>{{$zombie->getSpeed()->getValue()}}</td>
                            <td>{{$zombie->getAttack()->getValue()}}</td>
                            <td>{{$zombie->getDropGold()->getValue()}}</td>
                            <td>{{$zombie->getResourceID()->getValue()}}</td>
                            <td><a href="{{ route('admin.zombie.get.update', ['zombieID' => $zombie->getID()->getValue()]) }}"
                                   class="btn btn-primary btn-sm">Update</a>
                                <a href="{{ route('admin.zombie.delete', ['zombieID' => $zombie->getID()->getValue()]) }}"
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