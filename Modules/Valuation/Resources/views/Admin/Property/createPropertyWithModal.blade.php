<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Add Property</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">
        <div class="table-responsive">
        </div>

        <hr>
        {!! Form::open(['id'=>'createProperty','class'=>'ajax-form','method'=>'POST']) !!}
        <div class="form-body">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label>Property Title</label>
                        <input type="text" name="propertyTitle" id="propertyTitle" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" id="saveProperty" class="btn btn-success"> <i class="fa fa-check"></i> @lang('app.save')</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<script>

    $('#saveProperty').click(function () {
        $.easyAjax({
            url: '{{route('valuation.admin.property.savePropertyWithModal')}}',
            container: '#createProperty',
            type: "POST",
            data: $('#createProperty').serialize(),
            success: function (response) {
                if(response.status == 'success'){
                    let propertyId = response.id;
                    let propertyTitle = response.title;
                    $('#projectPropertyId').append('<option value="'+propertyId+'">'+propertyTitle+'</option>');
                    $('#addPropertyModal').modal('hide');
                    /*var options = [];

                    var rData = [];
                    rData = response.data;

                    $.each(rData, function( index, value ) {
                        var selectData = '';
                        selectData = '<option value="'+value.id+'">'+value.category_name+'</option>';
                        options.push(selectData);
                    });

                    options.splice(0, 0, '<option value="">Select Category...</option>');
                    $('#category_id').html(options);
                    $('#category_id').selectpicker('refresh');
                    $('#taxModal').modal('hide');*/
                }
            }
        })
    });
</script>