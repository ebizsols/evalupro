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
    <style>
        .dataTables_filter label, .pagination {
            float: right !important;
        }
    </style>
@endpush

@section('content')

    <div class="row">
        <div class="col-xs-12">

            <section>
                <div class="sttabs tabs-style-line">

                    @include('admin.projects.show_project_menu')

                    <div class="content-wrap">
                        <section id="section-line-2" class="show">
                            <div class="white-box">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h2>Create Appointment</h2>
                                        {!! Form::open(['id'=>'createAppointment','class'=>'ajax-form','method'=>'POST']) !!}

                                        {!! Form::hidden('projectId', $projectId) !!}

                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label class="control-label required">Appointment Date</label>
                                                        <input type="datetime-local" name="appointment_date_time" id="appointment_date_time"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label class="control-label required">Note</label>
                                                        <input type="text" id="heading" name="description"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <div class="checkbox checkbox-info">
                                                            <input id="is_notification_send" name="is_notification_send" value="true"
                                                                   type="checkbox">
                                                            <label for="is_notification_send">Send Notification <a
                                                                        class="mytooltip font-12" href="javascript:void(0)"> <i
                                                                            class="fa fa-info-circle"></i><span
                                                                            class="tooltip-content5"><span
                                                                                class="tooltip-text3"><span
                                                                                    class="tooltip-inner2">Notification will be send to Valuator</span></span></span></a></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/row-->

                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" id="save-task" class="btn btn-success"><i
                                                        class="fa fa-check"></i> @lang('app.save')
                                            </button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-xs-12">
                                        <h2>Appointments</h2>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover toggle-circle default footable-loaded footable"
                                                   id="appointmentList">
                                                <thead>
                                                <tr>
                                                   
                                                    <th>Sr.</th>
                                                    <th>DateTime</th>
                                                    <th>@lang('valuation::app.action')</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
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

@endsection

@push('footer-script')
    <script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('js/datatables/buttons.server-side.js') }}"></script>

    <script type="text/javascript">

        $('ul.showProjectTabs .valuationAppointment').addClass('tab-current');
        var table;

        $('#createAppointment').on('submit', function () {
            $.easyAjax({
                url: "{{route('admin.valuation-appointment.store')}}",
                container: '#createAppointment',
                type: "POST",
                redirect: true,
                data: $('#createAppointment').serialize(),
            })
        });

        $(function () {
            loadTable();


        });

        function changeAppointmentStatus(appointmentId, selectObj) {
            swal({
                title: "@lang('messages.sweetAlertTitle')",
                text: "All other active appointment will be inactive",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                cancelButtonText: "@lang('messages.confirmNoArchive')",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm){
                if (isConfirm) {

                    var url = "{{ route('admin.valuation-appointment.updateStatus')}}";

                    var token = "{{ csrf_token() }}";

                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        redirect: true,
                        data: {'_token': token, appointmentId: appointmentId, status: $(selectObj).val()},
                        success: function (response) {
                        }
                    });

                }
                else{
                    location.reload();
                }
            });

        }

        function loadTable() {
            var startDate = $('#start-date').val();

            if (startDate == '') {
                startDate = null;
            }

            var endDate = $('#end-date').val();

            if (endDate == '') {
                endDate = null;
            }
            var status = $('#status').val();
            var client = $('#client').val();

            table = $('#appointmentList').dataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                destroy: true,
                stateSave: true,
                ajax: '{!! route($dataRoute) !!}?startDate=' + startDate + '&endDate=' + endDate + '&client=' + client + '&status=' + status,
                language: {
                    "url": "<?php echo __("app.datatable") ?>"
                },
                "fnDrawCallback": function (oSettings) {
                    $("body").tooltip({
                        selector: '[data-toggle="tooltip"]'
                    });
                },
                columns: [

                    {data: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'dateTime', name: 'dateTime'},
                    {data: 'action', name: 'action'}
                ]
            })
        }

    </script>
@endpush
