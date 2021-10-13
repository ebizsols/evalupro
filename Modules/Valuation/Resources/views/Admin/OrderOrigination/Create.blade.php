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
                <li><a href="{{ route('member.dashboard') }}">@lang('app.menu.home')</a></li>
                <li class="active">{{ __($pageTitle) }}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
    <link href="{{ Module::asset('valuation:css/FormTab.css') }}" rel="stylesheet">
    <link rel="stylesheet"
          href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
@endpush

@section('content')

    <!-- .row -->

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-inverse">
                <div class="panel-heading"> @lang('valuation::valuation.orderOrigination')</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="tabbable">
                            <ul class="nav nav-tabs wizard">
                                <li class="active"><a class="nav-link nav-item" href="#Process1" data-toggle="tab"
                                                      aria-controls="pills-Process1" aria-expanded="false">Client</a>
                                </li>
                                <li><a href="#Process2" class="nav-link nav-item" data-toggle="tab"
                                       aria-controls="tab-Process2" aria-expanded="false">Valuation method</a></li>
                                <li><a href="#process3" class="nav-link nav-item" data-toggle="tab"
                                       aria-controls="tab-Process3" aria-expanded="false">Property</a></li>
                                <li><a href="#process4" class="nav-link nav-item" data-toggle="tab"
                                       aria-controls="tab-Process4" aria-expanded="false">Step 04</a></li>
                                <li><a href="#process5" class="nav-link nav-item" data-toggle="tab"
                                       aria-controls="tab-Process5" aria-expanded="true">Step 05</a></li>

                            </ul>

                        </div>

                        {!! Form::open(['id'=>'saveOrderOrigination','class'=>'ajax-form','method'=>'POST']) !!}

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade in active " id="Process1" role="tabpanel">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">First Name</label>
                                                <input type="text" id="FirstName" name="firstName" value=""
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Last Name</label>
                                                <input type="text" id="lastName" name="lastName" value=""
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>CRP Number</label>
                                                <input type="text" name="CRPNumber" id="CRPNumber" value=""
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label class="required">Gender</label>
                                                <select name="gender" id="gender" class="form-control">
                                                    <option value="male"
                                                            @if($gender == 'male') selected="selected" @endif >
                                                        Male
                                                    </option>
                                                    <option value="male"
                                                            @if($gender == 'female') selected="selected" @endif >
                                                        Female
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label class="required">Client Type</label>
                                                <select name="clientType" id="clientType" class="form-control">
                                                    <option value="male">
                                                        type one
                                                    </option>
                                                    <option value="male">
                                                        type two
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Company Name</label>
                                                <input type="text" name="companyName" id="companyName" value=""
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Process2">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label class="required">Valuation method</label>
                                                <select name="valuationMethod" id="valuationMethod" class="form-control"
                                                        required>
                                                    <option value="">--</option>
                                                    @foreach($valuationMethods as $valuationMethod)
                                                        <option value="{{ $valuationMethod }}"
                                                                @if($valuationMethod == $selectedValuationMethod) selected="selected" @endif>
                                                            {{ $valuationMethod }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="process3">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label class="required">Category</label>
                                                <select name="propertyCategory" id="propertyCategory"
                                                        class="form-control" required>
                                                    <option value="">--</option>
                                                    @foreach($propertyCategories as $propertyCategory)
                                                        <option value="{{ $propertyCategory }}"
                                                                @if($propertyCategory == $selectedPropertyCategory) selected="selected" @endif>
                                                            {{ $propertyCategory }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="process4">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <textarea name="description" id="description" rows="5" value=""
                                                      class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="process5">
                                <div class="form-actions">
                                    <button type="submit" id="save-form" class="btn btn-success"><i
                                                class="fa fa-check"></i> Save
                                    </button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('footer-script')
    <script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script data-name="basic">
        (function () {
            $("#valuationMethod").select2({
                formatNoMatches: function () {
                    return "{{ __('messages.noRecordFound') }}";
                }
            });
            $("#propertyCategory").select2({
                formatNoMatches: function () {
                    return "{{ __('messages.noRecordFound') }}";
                }
            });
        })()
    </script>
    <script>
        $('#save-form').click(function () {
            $.easyAjax({
                url: '{{route('valuation.admin.orderOrigination.store')}}',
                container: '#saveOrderOrigination',
                type: "POST",
                redirect: true,
                data: $('#saveOrderOrigination').serialize()
            })
        });
    </script>
@endpush
