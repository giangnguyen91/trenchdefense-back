@extends('layouts.dashboard')
@section('page_heading','Weapons')

@section('section')
    <div class="row">
        <div class="col-sm-12">
            @section ('cotable_panel_title','Weapons')
            <a href="{{route('admin.weapon.create')}}" class="btn btn-primary">Create</a>
            @section ('cotable_panel_body')
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Group</th>
                        <th>Damage</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($weapons as $weapon)
                        <tr>
                            <td>{{$weapon->getId()->getValue()}}</td>
                            <td>{{$weapon->getWeaponName()->getValue()}}</td>
                            <td>{{$weapon->getWeaponGroup()->getName()->getValue()}}</td>
                            <td>{{$weapon->getDamage()->getValue()}}</td>
                            <td><a href="{{ route('admin.weapon.get.update', ['weaponID' => $weapon->getId()->getValue()]) }}"
                                   class="btn btn-primary btn-sm">Update</a>
                                <a href="{{ route('admin.weapon.delete', ['weaponID' => $weapon->getId()->getValue()]) }}"
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