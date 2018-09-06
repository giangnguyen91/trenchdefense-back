@extends('layouts.dashboard')
@section('page_heading','Zombies')

@section('section')
    <div class="row">
        <div class="col-sm-12">
            @section ('cotable_panel_title','Zombies')
            <a href="{{route('admin.wave.create')}}" class="btn btn-primary">Create</a>
            @section ('cotable_panel_body')
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Resource ID</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($waves as $wave)
                        <tr>
                            <td>{{$wave->getID()->getValue()}}</td>
                            <td>{{$wave->getName()->getValue()}}</td>
                            <td>{{$wave->getResourceID()->getValue()}}</td>
                            <td><a href="{{ route('admin.wave.get.update', ['waveID' => $wave->getID()->getValue()]) }}"
                                   class="btn btn-primary btn-sm">Update</a>
                                <a href="{{ route('admin.wave.delete', ['waveID' => $wave->getID()->getValue()]) }}"
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