@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> {{ __($pageTitle) }} #{{ $project->id }} - <span
                        class="font-bold">{{ ucwords($project->project_name) }}</span></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-6 col-sm-8 col-md-8 col-xs-12 text-right">
            <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-sm btn-success btn-outline"><i
                        class="icon-note"></i> @lang('app.edit')</a>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li><a href="{{ route('admin.projects.index') }}">{{ __($pageTitle) }}</a></li>
                <li class="active">@lang('modules.projects.members')</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/icheck/skins/all.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/multiselect/css/multi-select.css') }}">
    <link rel="stylesheet"
          href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')

    <div class="row">
        <div class="col-xs-12">

            <section>
                <div class="sttabs tabs-style-line">

                    @include('admin.projects.show_project_menu')
                    @if(empty($baseProperty))
                        <div class="content-wrap">
                            <section id="section-line-2" class="show">
                                <div class="white-box">
                                    <div class="row">
                                        {!! Form::open(['id'=>'saveProjectBaseProperty','class'=>'ajax-form','method'=>'POST']) !!}
                                        <input type="hidden" name="projectId" value="{{$projectId}}">
                                        <div class="col-md-12 b-l">
                                            <div class="panel panel-inverse">

                                                <div class="panel-heading">Project base property not selected </div>

                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Select Base Property</label>
                                                                <select name="projectBaseProperty"
                                                                        id="projectBaseProperty"
                                                                        class="form-control projectBaseProperty"
                                                                        required>
                                                                    <option value="0">--</option>
                                                                    @if(isset($properties))
                                                                        @foreach($properties as $property)
                                                                            <option value="{{ isset($property->id)?$property->id:'' }}">
                                                                                {{ isset($property->title)?$property->title: '--' }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-actions">
                                                                <button type="submit" id="assignProperty"
                                                                        class="btn btn-success"><i
                                                                            class="fa fa-check"></i> Assign to Project
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>

                            </section>

                        </div><!-- /content -->

                    @else
                        <input type="hidden" name="projectId" value="{{$projectId}}">
                        <div class="content-wrap">
                            <section id="section-line-2" class="show">
                                <div class="white-box">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="panel panel-inverse">
                                                <div class="panel-heading">Base Property</div>

                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body">
                                                        <div class="form-group">
                                                            @if(!empty($baseProperty))
                                                                {{ isset($baseProperty->title)?$baseProperty->title : 'Title not set' }}
                                                            @else
                                                                <label>Base property not selected</label>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        {!! Form::open(['id'=>'createMembers','class'=>'ajax-form','method'=>'POST']) !!}
                                        <input type="hidden" name="basePropertyId" value="{{$basePropertyId}}">
                                        <div class="col-md-9 b-l">
                                            <div class="panel panel-inverse">

                                                <div class="panel-heading">Properties Compare With</div>

                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Select Property 1</label>
                                                                <select name="comparePropertyOne"
                                                                        id="comparePropertyOne"
                                                                        class="form-control comparePropertyOne"
                                                                        required>
                                                                    <option value="">--</option>
                                                                    @if(isset($properties))
                                                                        @foreach($properties as $property)
                                                                            <option value="{{ isset($property->id)?$property->id:'' }}">
                                                                                {{ isset($property->title)?$property->title: '--' }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Select Property 2</label>
                                                                <select name="comparePropertyTwo"
                                                                        id="comparePropertyTwo"
                                                                        class="form-control comparePropertyTwo"
                                                                        required>
                                                                    <option value="">--</option>
                                                                    @if(isset($properties))
                                                                        @foreach($properties as $property)
                                                                            <option value="{{ isset($property->id)?$property->id:'' }}">
                                                                                {{ isset($property->title)?$property->title: '--' }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Select Property 3</label>
                                                                <select name="comparePropertyThree"
                                                                        id="comparePropertyThree"
                                                                        class="form-control comparePropertyThree"
                                                                        required>
                                                                    <option value="">--</option>
                                                                    @if(isset($properties))
                                                                        @foreach($properties as $property)
                                                                            <option value="{{ isset($property->id)?$property->id:'' }}">
                                                                                {{ isset($property->title)?$property->title: '--' }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-actions">
                                                                <button type="submit" id="compare"
                                                                        class="btn btn-success"><i
                                                                            class="fa fa-check"></i> Compare
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>

                            </section>
                            <hr/>
                            <section id="section-line-2" class="show">
                                <div class="white-box">
                                    <div class="row" id="comparisionResponse">
                                    </div>
                                </div>
                            </section>
                        </div><!-- /content -->
                    @endif

                </div><!-- /tabs -->
            </section>


        </div>


    </div>
    <!-- .row -->

@endsection

@push('footer-script')
    <script src="{{ asset('js/cbpFWTabs.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">

        $('ul.showProjectTabs .valuationMethodology').addClass('tab-current');

        /*var $baseProperty = $(".baseProperty");
        $baseProperty.select2({
            formatNoMatches: function () {
                return "{{ __('messages.noRecordFound') }}";
            }
        });
        $baseProperty.on("change", function (e) {

        });*/

        var $comparePropertyOne = $(".comparePropertyOne");
        $comparePropertyOne.select2({
            formatNoMatches: function () {
                return "{{ __('messages.noRecordFound') }}";
            }
        });
        $comparePropertyOne.on("change", function (e, item) {
            /*$(".comparePropertyTwo option[value='" +e.val+ "']").prop('disabled', true);*/
            //disableSel2Group(e,$comparePropertyTwo,'disabled');
        });

        /*function disableSel2Group(evt, target, disabled) {

            var id = evt.val;
            var aaList = $("option", target);
            $.each(aaList, function(idx, item) {
                let itemValue = $(item).val();
                if{}
                console.log(itemValue);
                $(item).prop('disabled', true);
            })
        }*/


        var $comparePropertyTwo = $(".comparePropertyTwo");
        $comparePropertyTwo.select2({
            formatNoMatches: function () {
                return "{{ __('messages.noRecordFound') }}";
            }
        });
        $comparePropertyTwo.on("change", function (e) {

        });

        var $comparePropertyThree = $(".comparePropertyThree");
        $comparePropertyThree.select2({
            formatNoMatches: function () {
                return "{{ __('messages.noRecordFound') }}";
            }
        });
        $comparePropertyThree.on("change", function (e) {

        });

        $('#assignProperty').click(function () {

            let projectBaseProperty = $('#projectBaseProperty').val();
            if(projectBaseProperty <= 0 ){
                alert('Please Select Property');
                return false;
            }

            $.easyAjax({
                url: '{{route('admin.valuation-method.saveProjectBaseProperty')}}',
                container: '#saveProjectBaseProperty',
                type: "POST",
                data: $('#saveProjectBaseProperty').serialize(),
                success: function (response) {
                    if (response.status == "success") {
                        $.unblockUI();
                        console.log(response)
                    }
                }
            })
        });

        //    save project members
        $('#compare').click(function () {
            $.easyAjax({
                url: '{{route('admin.valuation-method.processComparison')}}',
                container: '#createMembers',
                type: "POST",
                data: $('#createMembers').serialize(),
                success: function (response) {
                    if (response.status == "success") {
                        $.unblockUI();
                        let comparisionResponseHtml = response.comparisionResponseHtml;
                        $('#comparisionResponse').html(comparisionResponseHtml);
                        console.log(response);
                    }
                }
            })
        });


    </script>
@endpush
