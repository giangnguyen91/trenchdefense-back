@extends ('layouts.dashboard')
@section('page_heading','Create Weapon')

@section('section')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-6">
                <form role="form" method="POST"
                      @if(!isset($mode)) action="{{route('admin.weapon.post.create')}}" @endif>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name"
                               value="@if(isset($default['name'])){{$default['name']}}@endif" required/>
                    </div>

                    <div class="form-group">
                        <label>Group</label>
                        <select class="form-control" id="weapon_group_id" name="weapon_group_id">
                            <?php
                            $selectedGroup = "";
                            if(isset($default['weapon_group_id']))
                                $selectedGroup = $default['weapon_group_id'];
                            ?>
                            @foreach($weaponGroups as $weaponGroup)
                                <?php
                                    $selected = "";
                                    if(strcmp($weaponGroup->getID()->getValue(), $selectedGroup) == 0)
                                        $selected = "selected";
                                ?>
                                <option {{$selected}} value="{{$weaponGroup->getID()->getValue()}}">{{$weaponGroup->getName()->getValue()}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Damage</label>
                        <input type="number" class="form-control" name="damage"
                               value="@if(isset($default['damage'])){{$default['damage']}}@endif" required/>
                    </div>

                    <div class="form-group">
                        <label>Mag Capacity</label>
                        <input type="number" class="form-control" name="mag_capacity"
                               value="@if(isset($default['mag_capacity'])){{$default['mag_capacity']}}@endif" required/>
                    </div>

                    <div class="form-group">
                        <label>Fire speed</label>
                        <input type="number" class="form-control" name="fire_speed"
                               value="@if(isset($default['fire_speed'])){{$default['fire_speed']}}@endif" required/>
                    </div>

                    <div class="form-group">
                        <label>Explosion range</label>
                        <input type="number" class="form-control" name="range"
                               value="@if(isset($default['range'])){{$default['range']}}@endif" required/>
                    </div>

                    <div class="form-group">
                        <label>Is throwable weapon</label>
                        <select class="form-control" name="throwable">
                            <option @if(isset($default['throwable']) && !boolval($default['throwable']))"selected"@endif value="0">Normal weapon</option>
                            <option @if(isset($default['throwable']) && boolval($default['throwable']))selected="selected"@endif value="1">Throwable weapon</option>
                        </select>
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