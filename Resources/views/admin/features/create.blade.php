@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('ivehicles::features.title.create feature') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i
                        class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.ivehicles.feature.index') }}">{{ trans('ivehicles::features.title.features') }}</a>
        </li>
        <li class="active">{{ trans('ivehicles::features.title.create feature') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        {!! Form::open(['route' => ['admin.ivehicles.feature.store'], 'method' => 'post']) !!}
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
                                        @include('ivehicles::admin.features.partials.create-fields', ['lang' => $locale])
                                    </div>
                                @endforeach
                            </div>
                        </div> {{-- end nav-tabs-custom --}}
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
                                        class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                                <a class="btn btn-danger pull-right btn-flat"
                                   href="{{ route('admin.ivehicles.feature.index')}}"><i
                                            class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    <div class="col-xs-12 col-md-3">
        <div class="col-xs-12 ">
            <div class="box box-primary">
                <div class="box-header">
                    <label>{{trans('ivehicles::type_features.title.type features')}}</label>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body ">
                    <div class='form-group{{ $errors->has("type") ? ' has-error' : '' }}'>
                        <label class="radio" for="{{trans('ivehicles::type_features.inside')}}">
                            <input type="radio" id="type" name="type"
                                   value="0" {{ old('type',0) == 0? 'checked' : '' }}>
                            {{trans('ivehicles::type_features.inside')}}
                        </label>
                        <label class="radio" for="{{trans('ivehicles::type_features.equipment')}}">
                            <input type="radio" id="type" name="type"
                                   value="1" {{ old('type', 0) == 1? 'checked' : '' }}>
                            {{trans('ivehicles::type_features.equipment')}}
                        </label>
                        <label class="radio" for="{{trans('ivehicles::type_features.outside')}}">
                            <input type="radio" id="type" name="type"
                                   value="2" {{ old('type', 0) == 2? 'checked' : '' }}>
                            {{trans('ivehicles::type_features.outside')}}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    {!! Form::close() !!}
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
                    {key: 'b', route: "<?= route('admin.ivehicles.feature.index') ?>"}
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
@endpush
