@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> {{ __($pageTitle) }} #{{ $project->id }} -
                <span class="font-bold">{{ ucwords($project->project_name) }}</span>
            </h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-6 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li><a href="{{ route('admin.projects.index') }}">{{ __($pageTitle) }}</a></li>
                <li class="active">@lang('modules.projects.milestones')</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
@endpush

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <section>
                <div class="sttabs tabs-style-line">
                    @include('admin.projects.show_project_menu')
                    <div class="content-wrap col-xs-12">
                        <section id="section-line-3" class="show">
                            <div class="row">
                                <div class="col-xs-12" id="issues-list-panel">
                                    <div class="white-box">

                                        <!-- .row -->
                                        {!! Form::open(['id' => 'generateProjectReport', 'class' => 'ajax-form', 'method' => 'POST']) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{-- Project Report Commented --}}
                                                {{-- <div class="row">
                                                    <div class="col-md-12">
                                                        <h2>Project Report Fields</h2>
                                                    </div>
                                                </div> --}}
                                                {{-- Title & Value Commented --}}
                                                {{-- <div class="row">
                                                    <div class="col-md-12">
                                                        <table class="table table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>Title</th>
                                                                <th>Value</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <input id="" name="test2" type="text"
                                                                           class="form-control" >
                                                                </td>
                                                                <td>
                                                                    <input id="" name="test1" type="text"
                                                                           class="form-control" >
                                                                </td>
                                                            </tr>



                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div> --}}
                                                {{-- Report Button Commented --}}
                                                {{-- <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-actions">
                                                            <button type="submit" id="save-form" class="btn btn-success pull-right"><i
                                                                        class="fa fa-check"></i> Generate Report</button>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                        {!! Form::close() !!}

                                        <section id="section-line-3" class="show">
                                            <div class="row">
                                                <div class="col-xs-12" id="issues-list-panel">
                                                    <div class="white-box">

                                                        <div class="row m-b-10">
                                                            <div class="col-xs-12">

                                                                <button
                                                                        class="btn btn-success btn-outline Pull-left" type="button" data-toggle="modal" data-target="#addRuleModel"><i
                                                                            class="fa fa-check"></i> Generate Report
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <hr>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>

                                            </div>
                                        </section>

                                    </div>
                                </div>

                            </div>
                        </section>

                    </div><!-- /content -->

                </div><!-- /tabs -->
            </section>
        </div>


    </div>
    <!-- .row -->
    <div class="modal fade openModal" id="addRuleModel" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Report Model</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id'=>'generateReport', 'url' => route("admin.report.tempGenerate"),'method'=>'POST']) !!}
                    {!! Form::hidden('project_id', $project->id) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Title">Title</label>
                                <select class="select2 m-b-10 select2-multiple form-control" multiple="multiple"
                                        data-placeholder="@lang('modules.messages.chooseMember')" name="reportText[]">
                                    @foreach($reportConditionalText as $rct)
                                        <option value="{{ $rct->id }}">{{ ucwords($rct->title) }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" id="generateReport" class="btn btn-success"><i class="fa fa-check"></i> @lang('app.save')</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    <script src="{{ asset('js/FormFieldsRepeater/repeater.js') }}"></script>

    <script data-name="basic">
        (function() {

        })()
    </script>
    <script>
        $('#save-form').click(function() {

            $.easyAjax({
                url: '{{ route($generateProjectReportRoute, $id) }}',
                container: '#generateProjectReport',
                type: "POST",
                redirect: true,
                file: true,
                data: $('#generateProjectReport').serialize()
            })
        });
    </script>
@endpush
