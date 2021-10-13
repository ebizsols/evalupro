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
                <li><a href="{{ route($listingPageRoute) }}">{{ __($pageTitle) }}</a></li>
                <li class="active">@lang('app.addNew')</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection
@push('head-script')
    <link rel="stylesheet"
          href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
@endpush
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
                        {!! Form::open(['id'=>'saveUpdateMenu','class'=>'ajax-form','method'=>'POST']) !!}
                        <div class="form-body">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="required">Name</label>
                                        <input type="text" name="name" id="name" value="{{$name}}"
                                               class="form-control"
                                               autocomplete="nope">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="">@lang('valuation::valuation.menu.validationName')</label>
                                        <input type="text" name="validation_name" id="validationName"
                                               value="{{$validationName}}"
                                               class="form-control"
                                               autocomplete="nope">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="">@lang('valuation::valuation.menu.route')</label>
                                        <input type="text" name="route" id="route" value="{{$route}}"
                                               class="form-control"
                                               autocomplete="nope">
                                    </div>
                                </div>

                                @if(isset($isHide) && $isHide == false)
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="">@lang('valuation::valuation.menu.menuParent')</label>
                                            <select name="parentMenuId" id="parentMenuId" class="form-control" required>
                                                <option value="">--</option>
                                                @foreach($menus as $menuIn)
                                                    <option value="{{ $menuIn->id }}"
                                                            @if($menuIn->id == $parent) selected="selected" @endif>
                                                        {{ $menuIn->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!--/row-->

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="required">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="Active" @if($status == 'Active') selected="selected" @endif >
                                                Active
                                            </option>
                                            <option value="Inactive"
                                                    @if($status == 'Inactive') selected="selected" @endif >
                                                Inactive
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
    <script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script data-name="basic">
        (function () {
            $("#parentMenuId").select2({
                formatNoMatches: function () {
                    return "{{ __('messages.noRecordFound') }}";
                }
            });

        })()
    </script>

    <script>

        $('#save-form').click(function () {

            let name = $("#name");

            if (name.val() == '') {
                alert('Please enter name');
                return false;
            }

            $.easyAjax({
                url: '{{route($saveUpdateDataRoute, $id)}}',
                container: '#saveUpdateMenu',
                type: "POST",
                redirect: true,
                data: $('#saveUpdateMenu').serialize()
            })
        });

    </script>
@endpush

