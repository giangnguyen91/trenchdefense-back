@extends('layouts.dashboard')
@section('page_heading','Weapon groups')

@section('section')
    <div class="row">
        <div class="col-sm-12">
            @section ('cotable_panel_title','Weapon groups')
            <a href="{{route('admin.weapon.group.create')}}" class="btn btn-primary">Create</a>
            @section ('cotable_panel_body')
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Ammo type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groups as $group)
                        <tr>
                            <td>{{$group->getID()->getValue()}}</td>
                            <td>{{$group->getName()->getValue()}}</td>
                            <td>{{$group->getAmmoType()->getValue()}}</td>
                            <td><a href="{{ route('admin.weapon.group.get.update', ['weaponGroupID' => $group->getID()->getValue()]) }}"
                                   class="btn btn-primary btn-sm">Update</a>
                                <a href="{{ route('admin.weapon.group.delete', ['weaponGroupID' => $group->getID()->getValue()]) }}"
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