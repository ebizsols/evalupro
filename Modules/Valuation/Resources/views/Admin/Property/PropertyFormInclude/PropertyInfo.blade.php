@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/datatables-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/prismjs-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/style-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/plugins-bundle.css') }}">
    <style>
        legend {
            width: initial !important;
            border-bottom: none !important;
        }

        fieldset {
            padding: .35em .625em .75em !important;
            margin: 0 2px !important;
            border: 1px solid silver !important;
        }
    </style>
@endpush
<div class="tab-pane fade in active " id="PropertyInfo" role="tabpanel">
    <div class="inner-panel-Main-div">
        <div class="panel panel-inverse">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body inner-panel-padding">
                    <div class="tabbable">
                        <ul class="nav nav-tabs wizard">

                            <li class="active">
                                <a href="#PropertyTypeInfo" data-toggle="tab" aria-expanded="false"
                                   aria-controls="PropertyTypeInfo">Property Type</a>
                            </li>
                            <li>
                                <a href="#PropertyPrimaryInfo" class="nav-link nav-item"
                                   data-toggle="tab"
                                   aria-controls="PropertyPrimaryInfo"
                                   aria-expanded="false">Primary Info</a>
                            </li>
                            <!--                            <li ><a href="#PropertyInfoClassCategory" class="nav-link nav-item"
                                                               data-toggle="tab"
                                                               aria-controls="PropertyInfoClassCategory"
                                                               aria-expanded="false">Class & Category</a></li>-->
                            <!--                            <li><a href="#PropertyInfoMeasurements" class="nav-link nav-item"
                                                               data-toggle="tab"
                                                               aria-controls="PropertyInfoMeasurements"
                                                               aria-expanded="false">Measurements</a></li>-->
                            <!--                            <li><a href="#PropertyInfoFeatures" class="nav-link nav-item"
                                                               data-toggle="tab"
                                                               aria-controls="PropertyInfoFeatures"
                                                               aria-expanded="false">Features</a></li>-->
                            <li><a href="#PropertyInfoNeighbourhood" class="nav-link nav-item"
                                   data-toggle="tab"
                                   aria-controls="PropertyInfoNeighbourhood"
                                   aria-expanded="false">Neighbourhood</a></li>
                            <li>
                                <a class="nav-link nav-item" href="#LandInfoAddress" data-toggle="tab"
                                   aria-controls="LandInfoAddress" aria-expanded="false">Address</a>
                            </li>
                            <li>
                                <a href="#UploadTab" class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="UploadTab" aria-expanded="false">Uploads</a>
                            </li>
                            <li><a href="#FincialInfoForPropertyInfoTab" class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="FincialInfoForPropertyInfoTab" aria-expanded="false">Financial
                                    Info</a></li>
                            <li><a class="nav-link nav-item" href="#LandInfo" data-toggle="tab"
                                   aria-controls="LandInfo" aria-expanded="false">Land info</a>
                            </li>

                        </ul>

                    </div>


                    <div class="tab-content" id="myTabContent2">
                        <!-- PropertyTypeInfo -->
                        <div class="tab-pane fade in active" id="PropertyTypeInfo">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Type</label>
                                            <small class="pull-right cursor-pointer openModal addPropertyType"
                                                   data-toggle="modal" data-target="#addPropertyType"
                                                   data-whatever="Add Property Class">Add</small>
                                            <select name="propertyType"
                                                    id="propertyType"
                                                    class="form-control propertyType"
                                                    required>
                                                <option value="">--</option>
                                                @if(isset($types))
                                                    @foreach($types as $type)
                                                        <option @if(isset($typeId) && $type->id == $typeId) selected="selected"
                                                                @endif  value="{{ $type->id }}">
                                                            {{ $type->title }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- PropertyTypeInfo -->
                        <!--PropertyPrimaryInfo -->
                        <div class="tab-pane fade  " id="PropertyPrimaryInfo">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Class</label>
                                            <small class="pull-right cursor-pointer openModal addPropertyClass"
                                                   data-toggle="modal" data-target="#addPropertyClass"
                                                   data-whatever="Add Property Class">Add</small>
                                            <select name="propertyClass"
                                                    id="propertyClass"
                                                    class="form-control propertyClass"
                                                    required>
                                                <option value="">--</option>
                                                @if(isset($classes))
                                                    @foreach($classes as $class)
                                                        <option @if(isset($classId) && $class->id == $classId) selected="selected"
                                                                @endif value="{{ $class->id }}">
                                                            {{ $class->title }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Category</label>
                                            <small class="pull-right cursor-pointer openModal addPropertyCategorization"
                                                   data-toggle="modal" data-target="#addPropertyCategorization"
                                                   data-whatever="Add Property Class">Add</small>
                                            <select name="propertyCategorization"
                                                    id="propertyCategorization"
                                                    class="form-control"
                                                    required>
                                                <option value="">--</option>
                                                @if(isset($categorizations))
                                                    @foreach($categorizations as $categorization)
                                                        <option @if(isset($categorizationId) && $categorization->id == $categorizationId) selected="selected"
                                                                @endif  value="{{ $categorization->id }}">
                                                            {{ $categorization->title }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    @if(isset($LandClassification[0]) && !empty($LandClassification[0]))
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">{{$LandClassification[0]->title}}</label>
                                                <!--                                            <small class="pull-right cursor-pointer openModal addPropertyClassification"
                                                                                                   data-toggle="modal" data-target="#addPropertyClassification"
                                                                                                   data-whatever="Add Property Class">Add</small>-->
                                                <select name="LandClassification"
                                                        id="propertyClassification"
                                                        class="form-control"
                                                        required>
                                                    <option value="">--</option>
                                                    @foreach($LandClassification[0]->weightageCategoryItems as $landClass)
                                                        <option @if (isset($landClassficationMeta) && !empty($landClassficationMeta) && $landClassficationMeta[0]==$landClass->id) selected="selected"
                                                                @endif value="{{$landClass->id}}">{{$landClass->title}}</option>
                                                @endforeach
                                                <!--                                                @if(isset($classifications))
                                                    @foreach($classifications as $classification)
                                                        <option @if(isset($classificationId) && $classification->id == $classificationId) selected="selected"
                                                                @endif  value="{{ $classification->id }}">
                                                            {{ $classification->title }}
                                                                </option>
@endforeach
                                                            @endif-->
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if(isset($Accessibility[0]) && !empty($Accessibility[0]))
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">{{$Accessibility[0]->title}}</label>
                                                <select class="form-control" name="landInfoAccessibility">
                                                    <option value="">--select One--</option>
                                                    @foreach($Accessibility[0]->weightageCategoryItems as $subCate)
                                                        <option @if(isset($AccessibilityMeta) && !empty($AccessibilityMeta) && $AccessibilityMeta[0]==$subCate->id) selected="selected"
                                                                @endif value="{{$subCate->id}}">{{$subCate->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    @endif

                                    @if(isset($AccessibilityType[0]) && !empty($AccessibilityType[0]))
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">{{$AccessibilityType[0]->title}}</label>
                                                <select class="form-control" name="landInfoAccessibilityType">
                                                    <option value="">--select One--</option>
                                                    @foreach($AccessibilityType[0]->weightageCategoryItems as $assciblityTypeObj)
                                                        <option @if(isset($AccessibilityTypeMeta) && !empty($AccessibilityTypeMeta) && $AccessibilityTypeMeta[0]==$assciblityTypeObj->id) selected="selected"
                                                                @endif value="{{$assciblityTypeObj->id}}">{{$assciblityTypeObj->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    @endif
                                    @if(isset($RoadAccessNo[0]) && !empty($RoadAccessNo[0]))
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">{{$RoadAccessNo[0]->title}}</label>
                                                <select name="landInfoRoadAccess" class="form-control">
                                                    <option value="">--select One--</option>
                                                    @foreach($RoadAccessNo[0]->weightageCategoryItems as $roadNo)
                                                        <option @if(isset($NoOfAccessRoadMeta) && !empty($NoOfAccessRoadMeta) && $NoOfAccessRoadMeta[0]==$roadNo->id) selected="selected"
                                                                @endif value="{{$roadNo->id}}">{{$roadNo->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    @endif

                                </div>
                                <div class="row">
                                    @if(isset($RoadAccessType[0]) && !empty($RoadAccessType[0]))
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">{{$RoadAccessType[0]->title}}</label>
                                                <select name="landRoadAccessType" class="form-control">
                                                    <option value="">--select One--</option>
                                                    @foreach($RoadAccessType[0]->weightageCategoryItems as $roadType)
                                                        <option @if(isset($AccessRoadTypeMeta) && !empty($AccessRoadTypeMeta) && $AccessRoadTypeMeta[0]==$roadType->id) selected="selected"
                                                                @endif value="{{$roadType->id}}">{{$roadType->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    @endif

                                    @if(isset($RecencyTransection[0]) && !empty($RecencyTransection[0]))
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">{{$RecencyTransection[0]->title}}</label>
                                                <select name="landInfoRecency" class="form-control">
                                                    <option value="">--select One--</option>
                                                    @foreach($RecencyTransection[0]->weightageCategoryItems as $rencecyTran)
                                                        <option @if(isset($RecencyTransectionMeta) && !empty($RecencyTransectionMeta) && $RecencyTransectionMeta[0]==$rencecyTran->id) selected="selected"
                                                                @endif value="{{$rencecyTran->id}}">{{$rencecyTran->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--PropertyPrimaryInfo -->


                        <!---LandInfoNeighbourhood -->
                        <div class="tab-pane fade" id="PropertyInfoNeighbourhood">
                            <div class="form-body">
                                <fieldset>
                                    <legend>Surroundings</legend>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Front View</label>
                                                <input type="text" name="front" id="front"
                                                       value="{{isset($surroundingFront)?$surroundingFront:''}}"
                                                       class="form-control"
                                                       autocomplete="nope">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Back View</label>
                                                <input type="text" name="back" id="back"
                                                       value="{{isset($surroundingBack)?$surroundingBack:''}}"
                                                       class="form-control"
                                                       autocomplete="nope">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Left side View</label>
                                                <input type="text" name="leftSide" id="leftSide"
                                                       value="{{isset($surroundingLeft)?$surroundingLeft:''}}"
                                                       class="form-control"
                                                       autocomplete="nope">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Right side View</label>
                                                <input type="text" name="rightSide" id="rightSide"
                                                       value="{{isset($surroundingRight)?$surroundingRight:''}}"
                                                       class="form-control"
                                                       autocomplete="nope">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Adjacent</label>
                                                <input type="text" name="adjacent" id="adjacent"
                                                       value="{{isset($surroundingAdjacent)?$surroundingAdjacent:''}}"
                                                       class="form-control"
                                                       autocomplete="nope">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                            </div>
                        </div>
                        <!---LandInfoNeighbourhood -->

                        <!---LandInfoAddress -->
                        <div class="tab-pane fade" id="LandInfoAddress"
                             role="tabpanel">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Country </label>
                                            <select name="country" id="country" class="form-control" required>
                                                <option value="">--</option>
                                                @if(isset($countries))
                                                    @foreach($countries as $country)
                                                        <option @if(isset($adminCountryId) &&  !empty($adminCountryId) && $adminCountryId == $country->id) selected="selected"
                                                                @endif value="{{ $country->id }}">
                                                            {{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Governorate</label>
                                            <select name="governorate" id="governorate" class="form-control" required>
                                                <option value="">--</option>
                                                @if(isset($governorates))
                                                    @foreach($governorates as $governorate)
                                                        <option @if(isset($governorateId) && !empty($governorateId) && $governorate->id == $governorateId) selected="selected"
                                                                @endif value="{{ $governorate->id }}">
                                                            {{ $governorate->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">City</label>
                                            <small class="pull-right cursor-pointer openModal addCity"
                                                   data-toggle="modal" data-target="#addCity" data-whatever="Add City">Add</small>
                                            <select name="city"
                                                    id="propertyCity"
                                                    class="form-control propertyCity"
                                                    required>
                                                <option value="">--</option>
                                                @if($cities)
                                                    @foreach($cities as $city)
                                                        <option @if(isset($cityId) && $city->id == $cityId) selected="selected"
                                                                @endif value="{{ $city->id }}">
                                                            {{ $city->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Block</label>
                                            <small class="pull-right cursor-pointer openModal addBlock"
                                                   data-toggle="modal" data-target="#addBlock"
                                                   data-whatever="Add Block">Add</small>
                                            <select name="block"
                                                    id="propertyBlock"
                                                    class="form-control propertyBlock"
                                                    required>
                                                <option value="">--</option>
                                                @if(isset($blocks))
                                                    @foreach($blocks as $block)
                                                        <option @if(isset($blockId) && $block->id == $blockId) selected="selected"
                                                                @endif value="{{ $block->id }}">
                                                            {{ $block->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Locality </label>
                                            <input type="text" name="locality" id="locality"
                                                   value="{{isset($locality)?$locality:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Road</label>
                                            <input type="text" name="address_road" id="road"
                                                   value="{{isset($road)?$road:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Latitude</label>
                                                    <input type="text" name="latitude" id="latitude"
                                                           value="{{isset($latitude)?$latitude:''}}"
                                                           class="form-control" autocomplete="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Longitude</label>
                                                    <input type="text" name="longitude" id="longitude"
                                                           value="{{isset($longitude)?$longitude:''}}"
                                                           class="form-control" autocomplete="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Plot #</label>
                                            <input type="text" name="plotNum" id="plotNum"
                                                   value="{{isset($plotNum)?$plotNum:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    @if(isset($LocationClassification[0]) && !empty($LocationClassification[0]))
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">{{$LocationClassification[0]->title}}</label>
                                                <select name="addressLocationClassification" class="form-control">
                                                    <option value="">--select One--</option>
                                                    @foreach($LocationClassification[0]->weightageCategoryItems as $locClassficationObj)
                                                        <option @if(isset($LocationClassificationMeta) && !empty($LocationClassificationMeta) && $LocationClassificationMeta[0]==$locClassficationObj->id) selected="selected"
                                                                @endif value="{{$locClassficationObj->id}}">{{$locClassficationObj->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="map_canvas" style="width: auto; height: 400px;"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!---LandInfoAddress -->
                        <!-- Upload Tab start -->
                        <div class="tab-pane fade" id="UploadTab">
                            <div class="form-body">
                                <div class="row">
                                    <label class="control-label">Uploads</label>
                                    <div id="repeaterUpload" class="">
                                        <!-- Repeater Heading -->
                                        <div class="repeater-heading">
                                            <button type="button"
                                                    class="btn btn-primary pt-5 pull-right repeater-add-btn">
                                                Add More Image
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="items" data-group="image">
                                            <!-- Repeater Content -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>@lang('valuation::valuation.property.media.image')</label>
                                                    <div class="form-group">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail"
                                                                 style="width: 200px; height: 150px;">
                                                                <img src="https://via.placeholder.com/200x150.png?text={{ str_replace(' ', '+', __('modules.profile.uploadPicture')) }}"
                                                                     alt=""/>
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail"
                                                                 style="max-width: 200px; max-height: 150px;"></div>
                                                            <div>
                                                    <span class="btn btn-info btn-file">
                                                        <span class="fileinput-new"> @lang('app.selectImage') </span>
                                                        <span class="fileinput-exists"> @lang('app.change') </span>
                                                        <input type="file" id="image" name="image" data-img-data="true"> </span>
                                                                <a href="javascript:;"
                                                                   class="btn btn-danger fileinput-exists"
                                                                   data-dismiss="fileinput"> @lang('app.remove') </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                            <!-- Repeater Remove Btn -->
                                            <div class="pull-right repeater-remove-btn">
                                                <button type="button" class="btn btn-danger remove-btn">
                                                    Remove
                                                </button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Upload tab end -->


                        @include('valuation::Admin.Property.PropertyFormInclude.FincialInfoForPropertyInfo')
                        @include('valuation::Admin.Property.PropertyFormInclude.LandInfo')
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .cursor-pointer {
        cursor: pointer;
    }
</style>
@push('footer-script')
    <script src="{{ asset('plugins/metronic_plugin/js/datatables-bundle.js') }}"></script>
    <script src="{{ asset('plugins/metronic_plugin/js/prismjs-bundle.js') }}"></script>

    <script !src="">

        $('.openModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var recipient = button.data('whatever');
            var modal = $(this);
            modal.find('.modal-title').text(recipient);
        })
    </script>
    <script type="text/javascript">
        function checkFeature(i) {
            if ($('#' + i).is(":checked")) {
                $("#feature-" + i).show();
            } else {
                $("#feature-" + i).hide();
            }
        }

        function initialize() {
            // Creating map object
            var latitude = $("#latitude").val();
            var longitude = $("#longitude").val();
            if (latitude != '' && latitude > 0 && longitude != '' && longitude > 0) {
                var map = new google.maps.Map(document.getElementById('map_canvas'), {
                    zoom: 12,
                    center: new google.maps.LatLng(latitude, longitude),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                // creates a draggable marker to the given coords
                var vMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(latitude, longitude),
                    draggable: true
                });
            } else {
                var map = new google.maps.Map(document.getElementById('map_canvas'), {
                    zoom: 12,
                    center: new google.maps.LatLng(31.4832209, 74.0541922),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                // creates a draggable marker to the given coords
                var vMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(31.4832209, 74.0541922),
                    draggable: true
                });
            }


            google.maps.event.addListener(vMarker, 'dragend', function (evt) {
                $("#latitude").val(evt.latLng.lat().toFixed(6));
                $("#longitude").val(evt.latLng.lng().toFixed(6));
                map.panTo(evt.latLng);
            });
            map.setCenter(vMarker.position);
            vMarker.setMap(map);
        }

        //LandInfoDimension
        var LandInfoDimensionTable = $("#LandInfoDimensionTable").DataTable();
        var LandInfoDimensionCounter = 1;
        $("#LandInfoDimensionAddBtn").on("click", function () {
            LandInfoDimensionTable.row.add([
                '<input type="text" class="form-control" placeholder="Label" name="label[]" >',
                '<input type="text" class="form-control" placeholder="Value" name="value[]">'

            ]).draw(false);
            LandInfoDimensionCounter++;
        });
        $("#LandInfoDimensionAddBtn").click();
    </script>
@endpush