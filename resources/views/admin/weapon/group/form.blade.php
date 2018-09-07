@extends ('layouts.dashboard')
@section('page_heading','Create Weapon Group')

@section('section')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-6">
                <form role="form" method="POST"
                      @if(!isset($mode)) action="{{route('admin.weapon.group.post.create')}}" @endif>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name"
                               value="@if(isset($default['name'])){{$default['name']}}@endif" required/>
                    </div>

                    <div class="form-group">
                        <label>Ammo type</label>
                        <select class="form-control" id="ammo_type" name="ammo_type">
                            <?php
                                $selectedAmmoType = "";
                                if(isset($default['ammo_type']))
                                    $selectedAmmoType = $default['ammo_type'];
                            ?>
                            @foreach($ammoTypes as $ammoType)
                                <?php
                                    $selected = "";
                                    if(strcmp($ammoType->getValue(), $selectedAmmoType) == 0)
                                        $selected = "selected";
                                ?>
                                <option {{$selected}} value="{{$ammoType->getValue()}}">{{$ammoType->getValue()}}</option>
                            @endforeach
                        </select>
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