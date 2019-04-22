@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('ivehicles::vehicles.title.edit vehicle') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i
                        class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.ivehicles.vehicle.index') }}">{{ trans('ivehicles::vehicles.title.vehicles') }}</a>
        </li>
        <li class="active">{{ trans('ivehicles::vehicles.title.edit vehicle') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        {!! Form::open(['route' => ['admin.ivehicles.vehicle.update', $vehicle->id], 'method' => 'put']) !!}
        <div class="col-xs-12 col-md-9">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                        <div class="nav-tabs-custom">
                            @include('partials.form-tab-headers')
                            <div class="tab-content">
                                <?php $i = 0; ?>
                                @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                                    <?php $i++; ?>
                                    <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                                        @include('ivehicles::admin.vehicles.partials.edit-fields', ['lang' => $locale])
                                    </div>
                                @endforeach

                            </div>
                        </div> {{-- end nav-tabs-custom --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box-primary"
                         style="background:#fff; margin-bottom: 20px; border-radius: 3px;border-top: 3px solid #d2d6de; width: 100%; box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);     border-top-color: #3c8dbc;">
                        <div class="box-header">
                            <label>{{trans('ivehicles::vehicles.form.options')}}</label>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-4 ">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                            class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <div class='form-group{{ $errors->has("year") ? ' has-error' : '' }}'>
                                                <label>{{trans('ivehicles::vehicles.form.year')}}</label>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class='form-group{{ $errors->has("mileage") ? ' has-error' : '' }}'>
                                                {!! Form::label("mileage", trans('ivehicles::vehicles.form.mileage')) !!}
                                                <?php $old = $vehicle->mileage ?? ''?>
                                                {!! Form::number("mileage", old("mileage", $old), ['class' => 'form-control', 'data-slug' => 'source', 'vehiclesholder' => trans('ivehicles::vehicles.form.mileage')]) !!}
                                                {!! $errors->first("mileage", '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4 ">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                            class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <div class='form-group{{ $errors->has("mileage") ? ' has-error' : '' }}'>
                                                <label>{{trans('ivehicles::vehicles.form.mileage')}}</label>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class='form-group{{ $errors->has("mileage") ? ' has-error' : '' }}'>
                                                {!! Form::label("mileage", trans('ivehicles::vehicles.form.mileage')) !!}
                                                <?php $old = $vehicle->mileage ?? ''?>
                                                {!! Form::number("mileage", old("mileage", $old), ['class' => 'form-control', 'data-slug' => 'source', 'vehiclesholder' => trans('ivehicles::vehicles.form.mileage')]) !!}
                                                {!! $errors->first("mileage", '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4 ">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                            class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <div class='form-group{{ $errors->has("engine") ? ' has-error' : '' }}'>
                                                <label>{{trans('ivehicles::vehicles.form.engine')}}</label>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class='form-group{{ $errors->has("engine") ? ' has-error' : '' }}'>
                                                <?php $old = $vehicle->engine ?? '' ?>
                                                {!! Form::text("engine", old("engine", $old), ['class' => 'form-control', 'data-slug' => 'source', 'vehiclesholder' => trans('ivehicles::vehicles.form.engine')]) !!}
                                                {!! $errors->first("engine", '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4 ">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                            class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <div class='form-group{{ $errors->has("price") ? ' has-error' : '' }}'>
                                                <label>{{trans('ivehicles::vehicles.form.price')}}</label>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class='form-group{{ $errors->has("price") ? ' has-error' : '' }}'>
                                                <?php $old = $vehicle->price ?? '' ?>
                                                {!! Form::number("price", old("price", $old), ['class' => 'form-control', 'data-slug' => 'source', 'vehiclesholder' => trans('ivehicles::vehicles.form.price')]) !!}
                                                {!! $errors->first("price", '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool"
                                                        data-widget="collapse"><i
                                                            class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <label>{{trans('ivehicles::vehicles.form.owner')}}</label>
                                        </div>
                                        <div class="box-body">
                                            <select name="owner_id" id="owner" class="form-control">
                                                @foreach ($owners as $owner)
                                                    <option value="{{$owner->id }}" {{$owner->id == old('owner_id', $vehicle->owner_id) ? 'selected' : ''}}>{{$owner->present()->fullname()}}
                                                        - ({{$owner->email}})
                                                    </option>
                                                @endforeach
                                            </select><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <label>{{trans('ivehicles::fuels.title.fuel')}}</label>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool"
                                                        data-widget="collapse"><i
                                                            class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="box-body ">
                                            <div class='form-group{{ $errors->has("fuel") ? ' has-error' : '' }}'>
                                                @foreach($fuel as $index=>$item)
                                                    <label class="radio" for="{{$item}}">
                                                        <input type="radio" id="fuel" name="fuel"
                                                               value="{{$index}}" {{ old('fuel',$vehicle->fuel) == $index ? 'checked' : '' }}>
                                                        {{$item}}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <label>{{trans('ivehicles::transmissions.title.transmission')}}</label>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool"
                                                        data-widget="collapse"><i
                                                            class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="box-body ">
                                            <div class='form-group{{ $errors->has("transmission") ? ' has-error' : '' }}'>
                                                @foreach($transmission as $index=>$item)
                                                    <label class="radio" for="{{$item}}">
                                                        <input type="radio" id="transmission" name="transmission"
                                                               value="{{$index}}" {{ old('transmission',$vehicle->transmission) == $index ? 'checked' : '' }}>
                                                        {{$item}}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                            <div class="form-group">
                                <label>{{trans('ivehicles::vehicles.form.gallery')}}</label>
                            </div>
                        </div>
                        <div class="box-body ">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <label for="options[videos]"><strong>{{trans('ivehicles::vehicles.form.gallery')}}</strong></label>
                                    <button type="button" data-toggle="modal" data-target="#modalGallery" class="form-control btn btn-primary btn-flat">{{ trans('ivehicles::vehicles.form.View Gallery') }}</button>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <label for="options[videos]"><strong>{{trans('ivehicles::vehicles.form.videos')}}</strong></label>
                                    <textarea id="options" class="form-control" name="options[videos]" rows="3">{{$vehicles->options->videos ?? ''}}</textarea>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                        </div>
                        <div class="box-body ">
                            <div class="box-footer">
                                <button type="submit"
                                        class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                                <a class="btn btn-danger pull-right btn-flat"
                                   href="{{ route('admin.ivehicles.vehicle.index')}}"><i
                                            class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-xs-12 col-md-3">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                            <div class="form-group">
                                <label>{{trans('ivehicles::features.title.features')}}</label>
                            </div>
                        </div>
                        <div class="box-body">
                            @include('ivehicles::admin.fields.checklist.features.parent')
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool"
                                        data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                            <label>{{trans('ivehicles::brands.title.brands')}}</label>
                        </div>
                        <div class="box-body">
                            <select name="brand_id" id="brand" class="form-control">
                                <option>Selecionar</option>
                                @foreach ($brands as $brand)
                                    <option value="{{$brand->id }}" {{$brand->id == old('brand_id', $vehicle->brand_id) ? 'selected' : ''}}>{{$brand->name}}
                                    </option>
                                @endforeach
                            </select><br>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool"
                                        data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                            <label>{{trans('ivehicles::models.title.models')}}</label>
                        </div>
                        <div class="box-body">
                            <select name="model_id" id="model_id" class="form-control">
                                @foreach ($models as $model)
                                    <option value="{{$model->id}}" {{$model->id == old('model_id', $vehicle->model_id) ? 'selected' : ''}}>{{$model->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 ">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                            </div>
                            <div class="box-body">
                                @include('ivehicles::admin.fields.image', ['entity'=>$vehicle])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                            <div class="form-group">
                                <label>{{trans('ivehicles::vehicles.form.address')}}</label>
                            </div>
                            <div class="box-body">
                                @include('ivehicles::admin.fields.maps',['field'=>['name'=>'address', 'label'=>trans('ivehicles::vehicles.form.address'),'value'=>$vehicle->address]])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <label>{{trans('ivehicles::status.title')}}</label>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool"
                                        data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body ">
                            <div class='form-group{{ $errors->has("status") ? ' has-error' : '' }}'>
                                @foreach($status as $index=>$item)
                                    <label class="radio" for="{{$item}}">
                                        <input type="radio" id="status" name="status"
                                               value="{{$index}}" {{ old('status',$vehicle->status) == $index ? 'checked' : '' }}>
                                        {{$item}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <label>{{trans('ivehicles::status.title')}}</label>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool"
                                        data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body ">
                            <div class='form-group{{ $errors->has("featured") ? ' has-error' : '' }}'>
                                <label class="checkbox" for="featured">
                                    <input type="checkbox" id="featured" name="featured"
                                           value="1" {{old('featured',$vehicle->featured) == 1 ? 'checked' : '' }}>
                                    {{trans('ivehicles::vehicles.form.featured')}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

        @include('ivehicles::admin.fields.gallery',['rand'=>$vehicle->id??'','field'=>['name'=>'gallery', 'label'=>trans('ivehicles::vehicles.form.gallery'),'route_upload'=>route('ivehicles.vehicles.gallery.store'),'route_delete'=>route('ivehicles.vehicles.gallery.delete'),'folder'=>'assets/ivehicles/vehicles/gallery/','label_drag'=>trans('ivehicles::vehicles.form.drag')]])
    </div>
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).keypressAction({
                actions: [
                    {key: 'b', route: "<?= route('admin.ivehicles.vehicle.index') ?>"}
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('input[type="checkbox"], input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
            $('.btn-box-tool').click(function (e) {
                e.preventDefault();
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#brand').change(function () {
                var brand = '{"brand":' + $("#brand").val() + '}';
                $.ajax({
                    type: "GET",
                    url: "{{URL::route('api.module.get.items.by')}}",
                    dataType: 'json',
                    data: {'take': null, 'filter': brand, 'token': $('meta[name="token"]').attr('value')},
                    beforeSend: function () {
                        $('#model_id').prop('disabled', true)

                    },
                    success: function (data) {
                        $('#model_id').prop('disabled', false)
                        $('#model_id').html('');
                        $.each(data.data, function (i, item) {

                            $('#model_id').append("<option value=" + item.id + ">" + item.name + "</option>")
                        });
                        {{--   {
                                $('#tab_logic').append(tr);

                                $('#tab_logic tbody tr').find("td button.row-remove").on("click", function () {
                                    $(this).closest("tr").remove();
                                });
                                var value=$('#providerautocomple').val();
                                $('input[id=provider'+newid+']').val(value);
                                $("tr#trProvider"+newid+" td #id-provider").val($('#data-holder').val());
                                $.each(data, function( index, value ) {
                                    $('select[id=product'+newid+']').append($('<option>', {
                                        value: value["id"],
                                        text : value["name"]
                                    }));
                                });
                                newid+=1;


                        }--}}

                        $('#providerautocomple').val("");
                        $('#data-holder').val("");
                    }
                });

            })

        });
    </script>
@endpush
