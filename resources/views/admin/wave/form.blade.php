@extends ('layouts.dashboard')
@section('page_heading','Wave')

@section('section')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-6">
                <form role="form" method="POST"
                      @if(!isset($mode)) action="{{route('admin.wave.post.create')}}" @endif>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name"
                               value="@if(isset($default['name'])){{$default['name']}}@endif" required/>
                    </div>
                    <div class="form-group">
                        <label>Resource ID</label>
                        <input type="text" class="form-control" name="resource_id"
                               value="@if(isset($default['resource_id'])){{$default['resource_id']}}@endif" required/>
                    </div>

                    <div id="wave_zombie">
                        @if(isset($waveZombies))
                            @foreach($waveZombies as $waveZombie)
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>Zombie</label>
                                        <select name="wave_zombie[zombie_id][]" class="form-control">
                                            @foreach($zombies as $zombie)
                                                <option @if($zombie->getId()->getValue() == $waveZombie->getZombie()->getId()->getValue()) {{'selected'}}@endif value="{{$zombie->getId()->getValue()}}">{{$zombie->getName()->getValue()}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-md-4">
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input name="wave_zombie[quantity][]" type="text" class="form-control"
                                               value="{{$waveZombie->getQuantity()->getValue()}}" required/>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-md-4" style="margin-top: 3%;">
                                    <input type="button" class="btn btn-danger remove" value="Remove"/>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>

                    <input type="button" id="add_zombie" class="btn btn-primary" value="Add zombie"/>
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

    <div id="clone" style="display: none;">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="form-group">
                    <label>Zombie</label>
                    <select name="wave_zombie[zombie_id][]" class="form-control">
                        @foreach($zombies as $zombie)
                            <option value="{{$zombie->getId()->getValue()}}">{{$zombie->getName()->getValue()}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Quantity</label>
                    <input name="wave_zombie[quantity][]" type="text" class="form-control"
                           value="" required/>
                </div>
            </div>
            <div class="col-xs-6 col-md-4" style="margin-top: 3%;">
                <input type="button" class="btn btn-danger remove" value="Remove"/>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }

        jQuery(document).ready(function () {
            jQuery('#add_zombie').click(function () {
                var content = jQuery('#clone').html();
                jQuery('#wave_zombie').append(content);
            });

            jQuery(document).on('click', '.remove', function () {
                jQuery(this).parent().parent().remove();
            });
        });
    </script>
@stop