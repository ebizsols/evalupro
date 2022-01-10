@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> {{ __($pageTitle) }}
                <span class="text-info b-l p-l-10 m-l-5">{{ $templateCount }}</span> <span class="font-12 text-muted m-l-5">
                    @lang('valuation::valuation.methodologySettings.totalTemplates')</span>
            </h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-6 col-sm-8 col-md-8 col-xs-12 text-right">
            {{-- Button --}}
            <a href="{{ route($addEditViewRoute) }}"
                class="btn btn-outline btn-success btn-sm">@lang('valuation::valuation.methodologySettings.createTemplate')
                <i class="fa fa-plus" aria-hidden="true"></i></a>
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

    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/datatables-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/prismjs-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/style-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/plugins-bundle.css') }}">

@endpush
@section('content')
    <style>
        .select2 {
            height: 92px !important;
        }

    </style>
    <div class="row">

        <div class="col-md-12">
            <div class="vtabs customvtab m-t-10">
                @include('sections.valuation_sub_setting_menu')
                <div class="tab-content">
                    <div id="vhome3" class="tab-pane active">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover toggle-circle default footable-loaded footable"
                                id="users-table">
                                <thead>
                                    <tr>
                                        <th>@lang('valuation::app.id')</th>
                                        <th>@lang('valuation::valuation.methodologySettings.templateTitle')</th>
                                        <th>@lang('valuation::valuation.methodologySettings.propertyType')</th>
                                        <th>@lang('valuation::valuation.methodologySettings.templateCategory')</th>
                                        <th>@lang('valuation::app.action')</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Ajax Modal --}}

@endsection


@push('footer-script')
    <script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>

    <script>
        $(".select2").select2({
            formatNoMatches: function() {
                return "{{ __('messages.noRecordFound') }}";
            }
        });

        var table;
        $(function() {
            loadTable();
            //$(".data-section").removeClass('col-md-9');
            //$(".data-section").addClass('col-md-12');

            $('body').on('click', '.sa-params', function() {
                var id = $(this).attr('id');
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover the deleted Data!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel please!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function(isConfirm) {
                    if (isConfirm) {

                        var url = "{{ route($destroyRoute, ':id') }}";
                        url = url.replace(':id', id);

                        var token = "{{ csrf_token() }}";

                        $.easyAjax({
                            type: 'POST',
                            url: url,
                            data: {
                                '_token': token,
                                '_method': 'DELETE'
                            },
                            success: function(response) {
                                if (response.status == "success") {
                                    $.unblockUI();
                                    //                                    swal("Deleted!", response.message, "success");
                                    table._fnDraw();
                                }
                            }
                        });
                    }
                });
            });

        });

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

            table = $('#users-table').dataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                destroy: true,
                stateSave: true,
                ajax: '{!! route($dataRoute) !!}?startDate=' + startDate + '&endDate=' + endDate + '&client=' +
                    client + '&status=' + status,
                language: {
                    "url": "<?php echo __('app.datatable'); ?>"
                },
                "fnDrawCallback": function(oSettings) {
                    $("body").tooltip({
                        selector: '[data-toggle="tooltip"]'
                    });
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'template_name',
                        name: 'template_name'
                    },
                    {
                        data: 'type_id',
                        name: 'type_id'
                    },
                    {
                        data: 'template_category',
                        name: 'template_category'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            })
        }
    </script>
@endpush
