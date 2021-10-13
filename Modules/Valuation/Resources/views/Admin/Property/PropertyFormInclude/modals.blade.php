<div class="modal fade openModal addCity" id="addCity" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                @php
                    $tempSaveUpdateDataRoute = isset($saveUpdateDataRoute)?$saveUpdateDataRoute:'';
                    $saveUpdateDataRoute = isset($citySaveUpdateDataRoute)?$citySaveUpdateDataRoute:'';
                    $tempId = isset($id)?$id:0;
                    $id = '';
                    $isRedirectTrue = false;
                @endphp
                @include($cityViewFolderPath.'Form')
                @php
                    $saveUpdateDataRoute = $tempSaveUpdateDataRoute;
                    $id = $tempId;
                @endphp
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade openModal addBlock" id="addBlock" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                @php
                    $tempSaveUpdateDataRoute = isset($saveUpdateDataRoute)?$saveUpdateDataRoute:'';
                    $saveUpdateDataRoute = isset($blockSaveUpdateDataRoute)?$blockSaveUpdateDataRoute:'';
                    $tempId = isset($id)?$id:0;
                    $id = '';
                    $isRedirectTrue = false;
                @endphp
                @include($blockViewFolderPath.'Form')
                @php
                    $saveUpdateDataRoute = $tempSaveUpdateDataRoute;
                    $id = $tempId;
                @endphp
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade openModal addPropertyClass" id="addPropertyClass" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                @php
                    $tempSaveUpdateDataRoute = isset($saveUpdateDataRoute)?$saveUpdateDataRoute:'';
                    $saveUpdateDataRoute = isset($propertyClassSaveUpdateDataRoute)?$propertyClassSaveUpdateDataRoute:'';
                    $tempId = isset($id)?$id:0;
                    $id = '';
                    $isRedirectTrue = false;
                @endphp
                @include($propertyClassViewFolderPath.'Form')
                @php
                    $saveUpdateDataRoute = $tempSaveUpdateDataRoute;
                    $id = $tempId;
                @endphp
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade openModal addPropertyCategorization" id="addPropertyCategorization" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                @php
                    $tempSaveUpdateDataRoute = isset($saveUpdateDataRoute)?$saveUpdateDataRoute:'';
                    $saveUpdateDataRoute = isset($propertyCategorizationSaveUpdateDataRoute)?$propertyCategorizationSaveUpdateDataRoute:'';
                    $tempId = isset($id)?$id:0;
                    $id = '';
                    $isRedirectTrue = false;
                @endphp
                @include($propertyCategorizationViewFolderPath.'Form')
                @php
                    $saveUpdateDataRoute = $tempSaveUpdateDataRoute;
                    $id = $tempId;
                @endphp
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade openModal addPropertyClassification" id="addPropertyClassification" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                @php
                    $tempSaveUpdateDataRoute = isset($saveUpdateDataRoute)?$saveUpdateDataRoute:'';
                    $saveUpdateDataRoute = isset($propertyClassificationSaveUpdateDataRoute)?$propertyClassificationSaveUpdateDataRoute:'';
                    $tempId = isset($id)?$id:0;
                    $id = '';
                    $isRedirectTrue = false;
                @endphp
                @include($propertyClassificationViewFolderPath.'Form')
                @php
                    $saveUpdateDataRoute = $tempSaveUpdateDataRoute;
                    $id = $tempId;
                @endphp
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade openModal addPropertyType" id="addPropertyType" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                @php
                    $tempSaveUpdateDataRoute = isset($saveUpdateDataRoute)?$saveUpdateDataRoute:'';
                    $saveUpdateDataRoute = isset($propertyTypeSaveUpdateDataRoute)?$propertyTypeSaveUpdateDataRoute:'';
                    $tempId = isset($id)?$id:0;
                    $id = '';
                    $isRedirectTrue = false;
                @endphp
                @include($propertyTypeViewFolderPath.'Form')
                @php
                    $saveUpdateDataRoute = $tempSaveUpdateDataRoute;
                    $id = $tempId;
                @endphp
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@push('footer-script')

    <script !src="">
        var afterSaveCity = function (res) {
            fetch('{{route($getAjaxCityDataRoute)}}')
                .then((resp) => resp.json())
                .then(function (data) {
                    var newCityHTMLArray = [];

                    newCityHTMLArray.push('<option value="">--</option>');

                    jQuery.each(data, function (i, val) {
                        console.log(val);
                        newCityHTMLArray.push('<option value="' + val.id + '">' + val.name + '</option>');
                    });

                    $('.propertyCity').html('');
                    $('.propertyCity').html(newCityHTMLArray.join(''));

                    $("#propertyCity").select2({
                        formatNoMatches: function () {
                            return "{{ __('messages.noRecordFound') }}";
                        }
                    });
                    $('#addCity').modal('hide');
                })
                .catch(function (error) {
                    console.log(error)
                });
        }

        var afterSaveBlock = function (res) {
            fetch('{{route($getAjaxBlockDataRoute)}}')
                .then((resp) => resp.json())
                .then(function (data) {
                    var newBlockHTMLArray = [];

                    newBlockHTMLArray.push('<option value="">--</option>');

                    jQuery.each(data, function (i, val) {
                        console.log(val);
                        newBlockHTMLArray.push('<option value="' + val.id + '">' + val.name + '</option>');
                    });

                    $('.propertyBlock').html('');
                    $('.propertyBlock').html(newBlockHTMLArray.join(''));

                    $("#propertyBlock").select2({
                        formatNoMatches: function () {
                            return "{{ __('messages.noRecordFound') }}";
                        }
                    });
                    $('#addBlock').modal('hide');
                })
                .catch(function (error) {
                    console.log(error)
                });
        }

        var afterPropertyClass = function (res) {
            fetch('{{route($getAjaxPropertyClassDataRoute)}}')
                .then((resp) => resp.json())
                .then(function (data) {
                    var newPropertyClassHTMLArray = [];

                    newPropertyClassHTMLArray.push('<option value="">--</option>');

                    jQuery.each(data, function (i, val) {
                        console.log(val);
                        newPropertyClassHTMLArray.push('<option value="' + val.id + '">' + val.title + '</option>');
                    });

                    $('.propertyClass').html('');
                    $('.propertyClass').html(newPropertyClassHTMLArray.join(''));

                    $("#propertyClass").select2({
                        formatNoMatches: function () {
                            return "{{ __('messages.noRecordFound') }}";
                        }
                    });
                    $('#addPropertyClass').modal('hide');
                })
                .catch(function (error) {
                    console.log(error)
                });
        }

        var afterSavePropertyCategorization = function (res) {
            fetch('{{route($getAjaxPropertyCategorizationDataRoute)}}')
                .then((resp) => resp.json())
                .then(function (data) {
                    var newPropertyCategorizationHTMLArray = [];

                    newPropertyCategorizationHTMLArray.push('<option value="">--</option>');

                    jQuery.each(data, function (i, val) {
                        console.log(val);
                        newPropertyCategorizationHTMLArray.push('<option value="' + val.id + '">' + val.title + '</option>');
                    });

                    $('.propertyCategorization').html('');
                    $('.propertyCategorization').html(newPropertyCategorizationHTMLArray.join(''));

                    $("#propertyCategorization").select2({
                        formatNoMatches: function () {
                            return "{{ __('messages.noRecordFound') }}";
                        }
                    });
                    $('#addPropertyCategorization').modal('hide');
                })
                .catch(function (error) {
                    console.log(error)
                });
        }

        var afterSavePropertyClassification = function (res) {
            fetch('{{route($getAjaxPropertyClassificationDataRoute)}}')
                .then((resp) => resp.json())
                .then(function (data) {
                    var newPropertyClassificationHTMLArray = [];

                    newPropertyClassificationHTMLArray.push('<option value="">--</option>');

                    jQuery.each(data, function (i, val) {
                        console.log(val);
                        newPropertyClassificationHTMLArray.push('<option value="' + val.id + '">' + val.title + '</option>');
                    });

                    $('.propertyClassification').html('');
                    $('.propertyClassification').html(newPropertyClassificationHTMLArray.join(''));

                    $("#PropertyClassification").select2({
                        formatNoMatches: function () {
                            return "{{ __('messages.noRecordFound') }}";
                        }
                    });
                    $('#addPropertyClassification').modal('hide');
                })
                .catch(function (error) {
                    console.log(error)
                });
        }

        var afterSavePropertyType = function (res) {
            fetch('{{route($getAjaxPropertyTypeDataRoute)}}')
                .then((resp) => resp.json())
                .then(function (data) {
                    var newPropertyTypeHTMLArray = [];

                    newPropertyTypeHTMLArray.push('<option value="">--</option>');

                    jQuery.each(data, function (i, val) {
                        console.log(val);
                        newPropertyTypeHTMLArray.push('<option value="' + val.id + '">' + val.title + '</option>');
                    });

                    $('.propertyType').html('');
                    $('.propertyType').html(newPropertyTypeHTMLArray.join(''));

                    $("#propertyType").select2({
                        formatNoMatches: function () {
                            return "{{ __('messages.noRecordFound') }}";
                        }
                    });
                    $('#addPropertyType').modal('hide');
                })
                .catch(function (error) {
                    console.log(error)
                });
        }
    </script>
@endpush