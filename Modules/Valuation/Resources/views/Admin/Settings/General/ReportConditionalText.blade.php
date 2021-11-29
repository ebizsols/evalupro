{{-- @push('head-script')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
@endpush
<fieldset>
    <legend>Report Conditional Text</legend>
<div class="row">
    <div class="col-md-12">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addReportModel">Add New</button>
    </div>
</div>
<!-- start Table data -->
<div class="table-responsive">
    <table class="table table-bordered table-hover toggle-circle default footable-loaded footable"
               id="user-table">
        <thead>
            <tr>
                <th>@lang('app.id')</th>
                <th>Type</th>
                <th>@lang('app.action')</th>
            </tr>
        </thead>
    </table>
</div>
<!-- Modal Start -->
<div class="modal fade openModal" id="addReportModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(['id'=>'saveUpdateReportForm','class'=>'ajax-form','method'=>'POST']) !!}
            <div class="row">
                <input type="hidden" id="idreportEdit" name="id">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required">Select Rule Type</label>
                        <select name="ruleType" id="ruleType" class="form-control " required="required">
                            <option value="">--Select Type--</option>
                            <option value="Report 1">Report 1</option>
                            <option value="Report 2">Report 2</option>
                            <option value="Report 3">Report 3</option>
                            <option value="Report 4">Report 4</option>
                            <option value="Report 1">Report 5</option>
                        </select>
                    </div>
                </div>
            </div>  
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="" class="required">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="required">Content</label>
                        <textarea class="form-control" required name="ruleText" id="textarea"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" id="saveTextReport" class="btn btn-success"><i
                class="fa fa-check"></i> @lang('app.save')</button>
            </div>
            {!! Form::close() !!}
        </div>  
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<!-- End Modal -->
</fieldset>
@push('footer-script')
    <script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script>
            $('#saveUpdateReportForm').on('submit',function(){
                $.easyAjax({
                    url: "{{ route('Successfullysavedata') }}",
                    container: '#saveUpdateReportForm',
                    type: "POST",
                    redirect: '{{isset($isRedirectTrue)?$isRedirectTrue:true}}',
                    data: $('#saveUpdateReportForm').serialize()

                });
            });
    </script>
    <script>

        // $(".select2").select2({
        //     formatNoMatches: function () {
        //         return "{{ __('messages.noRecordFound') }}";
        //     }
        // });

        var table;
        var table4 = $('#user-Table');
        $(function () {
            loadreportTable();
            //$(".data-section").removeClass('col-md-9');
            //$(".data-section").addClass('col-md-12');
            $('body').on('click', '.sa-params-report', function () {
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
                }, function (isConfirm) {
                    if (isConfirm) {

                        var url = "{{ route('destroyreportRule',':id') }}";
                        url = url.replace(':id', id);

                        var token = "{{ csrf_token() }}";

                        $.easyAjax({
                            type: 'POST',
                            url: url,
                            data: {'_token': token, '_method': 'DELETE'},
                            success: function (response) {
                                if (response.status == "success") {
                                    $.unpropertyUI();
                                    swal("Deleted!", response.message, "success");
                                    table4._fnDraw();
                                }
                            }
                        });
                    }
                });
            });

        });

         function loadreportTable() {
            table = $('#user-table').dataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                destroy: true,
                stateSave: true,
                ajax: '{!! route($getdataRoute) !!}',
                language: {
                    "url": ""
                },
                "fnDrawCallback": function (oSettings) {
                    $("body").tooltip({
                        selector: '[data-toggle="tooltip"]'
                    });
                },
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: true},
                    {data: 'type', name: 'type'},
                    {data: 'action', name: 'action'}
                ]
            })
        }

        function loadEditReportData(EditreportId) {
            if (EditreportId != '' && EditreportId > 0) {
                $.ajax({
                    type: 'get',
                    url: "{{ route('valuation.admin.settings.general.editreportData') }}/" + EditreportId,
                    cache: false,
                    success: function (response) {

                        if (response.data) {
                            $('#addReportModel #idreportEdit').val(response.data.id);
                            $("#addReportModel  #ruleType option[value=" + response.data.rule_type + "]").attr('selected');
                            $('#addReportModel #title').val(response.data.title);
                            $('#addReportModel #textarea').val(response.data.content);
                            $('#addReportModel').modal('show');
                        }
                    }
                });
            }
        }

    </script>
    @endpush --}}
