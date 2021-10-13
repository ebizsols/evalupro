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
               {{-- <li><a href="{{ route('admin.employees.index') }}">{{ __($pageTitle) }}</a></li>--}}
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
                <div class="panel-heading"> Edit Country</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="vtabs customvtab m-t-10">
                        @include('sections.valuation_sub_setting_menu')
                        <div class="tab-content">
                            <div id="vhome3" class="tab-pane active">
                            {!! Form::open(['id'=>'saveUpdateCountry','class'=>'ajax-form','method'=>'POST']) !!}
                            <div class="form-body">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="required">Country Name</label>
                                            <input type="text" name="countryName" id="countryName" value="{{$countryName}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="required">ISO Alpha 2</label>
                                            <input type="text" name="isoAlpha2" id="isoAlpha2" value="{{$isoAlpha2}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="required">ISO Alpha 3</label>
                                            <input type="text" name="isoAlpha3" id="isoAlpha3" value="{{$isoAlpha3}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="required">ISO Numeric</label>
                                            <input type="text" name="isoNumeric" id="isoNumeric" value="{{$isoNumeric}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="required">Currency Name</label>
                                            <input type="text" name="currencyName" id="currencyName"
                                                   value="{{$currencyName}}" class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="required">Currency Code</label>
                                            <input type="text" name="currencyCode" id="currencyCode"
                                                   value="{{$currencyCode}}" class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="required">Currency Symbol</label>
                                            <input type="text" name="currencySymbol" id="currencySymbol"
                                                   value="{{$currencySymbol}}"
                                                   class="form-control" autocomplete="nope">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="required">flag</label>
                                            <input type="text" name="flag" id="flag" class="form-control" value="{{$flag}}"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="required">Is visible</label>
                                            <select name="isVisible" id="isVisible" class="form-control">
                                                <option value="1" @if($isVisible == 1) selected="selected" @endif >Yes
                                                </option>
                                                <option value="0" @if($isVisible == 0) selected="selected" @endif >No
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->

                            </div>
                            <div class="form-actions">
                                <button type="submit" id="save-form" class="btn btn-success"><i
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
    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="departmentModel" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{--Ajax Modal Ends--}}
@endsection

@push('footer-script')
    <script data-name="basic">
        (function () {

        })()
    </script>

    <script>

        $('#save-form').click(function () {
            $.easyAjax({
                url: '{{route($saveUpdateDataRoute, $id)}}',
                container: '#saveUpdateCountry',
                type: "POST",
                redirect: true,
                data: $('#saveUpdateCountry').serialize()
            })
        });

    </script>
@endpush

