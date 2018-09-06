@extends ('layouts.dashboard')
@section('page_heading','Create Character')

@section('section')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-6">
                <form role="form" method="POST"
                      @if(!isset($mode)) action="{{route('admin.character.post.create')}}" @endif>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name"
                               value="@if(isset($default['name'])){{$default['name']}}@endif" required/>
                    </div>

                    <div class="form-group">
                        <label>HP</label>
                        <input type="number" class="form-control" name="hp"
                               value="@if(isset($default['hp'])){{$default['hp']}}@endif" required/>
                    </div>

                    <div class="form-group">
                        <label>Speed</label>
                        <input type="number" class="form-control" name="speed"
                               value="@if(isset($default['speed'])){{$default['speed']}}@endif" required/>
                    </div>

                    <div class="form-group">
                        <label>Attack</label>
                        <input type="number" class="form-control" name="attack"
                               value="@if(isset($default['attack'])){{$default['attack']}}@endif" required/>
                    </div>

                    <div class="form-group">
                        <label>Resource ID</label>
                        <input type="text" class="form-control" name="resource_id"
                               value="@if(isset($default['resource_id'])){{$default['resource_id']}}@endif" required/>
                    </div>


                    @if($mode == 'create')
                        <button type="submit" class="btn btn-primary">Create</button>
                    @else
                        <button type="submit" class="btn btn-primary">Update</button>
                    @endif
                    <button onclick="goBack()" type="button" class="btn btn-danger">Cancel</button>
                </form>
            </div>

        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@stop