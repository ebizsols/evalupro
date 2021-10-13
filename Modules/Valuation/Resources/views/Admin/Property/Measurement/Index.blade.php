@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> {{ __($pageTitle) }}</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li class="active">@lang('app.addNew')</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection
@section('content')
<div class="row">
        <div class="col-md-12">

            <div class="panel panel-inverse">
                <div class="panel-heading">{{ __($title) }}</div>

                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="vtabs customvtab m-t-10">
                            @include('sections.valuation_sub_setting_menu')
                            <div class="tab-content">
                                <div id="vhome3" class="tab-pane active">
                                    {!! Form::open(['id'=>'saveUpdateMeasurement','class'=>'ajax-form','method'=>'POST']) !!}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                    <div class="m-b-10">
                                                        <label class="control-label">Measurement Unit</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <input type="radio" name="land_measurement_unit" @if(isset($measure_unit) && $measure_unit == 'meter') checked="checked" @endif id="land_measurement_unit1" value="meter">
                                                        <label for="email_notifications1" class="">Meter sq</label>

                                                    </div>
                                                    <div class="radio radio-inline ">
                                                        <input type="radio" name="land_measurement_unit" @if(isset($measure_unit) && $measure_unit == 'feet') checked="checked" @endif id="land_measurement_unit2" value="feet">
                                                        <label for="email_notifications2" class="">Sq feet</label>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" id="saveMeasurementForm" class="btn btn-success"><i
                                                class="fa fa-check"></i> @lang('app.save')</button>

                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- .row -->
@endsection
@push('footer-script')
 <script>

        $('#saveMeasurementForm').click(function () {

            $.easyAjax({
                url: '{{route($saveUpdateDataRoute, isset($id)?$id:0)}}',
               container: '#saveUpdateMeasurement',
                type: "POST",
                redirect: true,
                data: $('#saveUpdateMeasurement').serialize(),
                
            })
        });

    </script>
    @endpush