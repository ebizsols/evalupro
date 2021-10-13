@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/datatables-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/prismjs-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/style-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/plugins-bundle.css') }}">
    <style>
        legend
        {
            width: initial !important;
            border-bottom: none !important;
        }
        fieldset
        {
            padding: .35em .625em .75em !important;
            margin: 0 2px !important;
            border: 1px solid silver !important;
        }
    </style>
@endpush
<div class="tab-pane fade" id="StructureInfo">
    <div class="inner-panel-Main-div">
        <div class="panel panel-inverse">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body inner-panel-padding">
                    <div class="tabbable">
                        <ul class="nav nav-tabs wizard">
                            <li class="active"><a class="nav-link nav-item"
                                                  href="#StructureInfoPrimaryInfo"
                                                  data-toggle="tab"
                                                  aria-controls="StructureInfoPrimaryInfo"
                                                  aria-expanded="false">Primary info</a>
                            </li>
                            <li><a href="#PropertyInfoFeatures"
                                   class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="PropertyInfoFeatures"
                                   aria-expanded="false">Features</a></li>
<!--                            <li><a href="#StructureInfoFeatures"
                                   class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="StructureInfoFeatures"
                                   aria-expanded="false">Features</a></li>-->
<!--                            <li><a href="#StructureInfoAddOns"
                                   class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="StructureInfoAddOns"
                                   aria-expanded="false">Addons</a></li>-->
                            <li><a href="#StructureInfoPropertyCharacteristics"
                                   class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="StructureInfoPropertyCharacteristics"
                                   aria-expanded="false">Property Characteristics</a></li>
                                   <li>
                                       <a href="#StructureInfoUnitListTab" class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="StructureInfoUnitListTab"
                                   aria-expanded="false">
                                           Unit List
                                       </a>
                                   </li>
                                   <li>
                                       <a href="#StructureInfoFincialInfoTab" class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="StructureInfoFincialInfoTab"
                                   aria-expanded="false">
                                          Financial Info
                                       </a>
                                   </li>
                        </ul>

                    </div>


                    <div class="tab-content" id="myTabContent3">
                        <!---StructureInfoPrimaryInfo -->
                        <div class="tab-pane fade in active " id="StructureInfoPrimaryInfo"
                             role="tabpanel">
                            <div class="form-body">
                                <div class="row">
                                    <fieldset>
                                        <legend>Measurements</legend>
                                        <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Buildup sizes</label>
                                            <input type="text" name="buildupSizes" id="buildupSizes" value="{{isset($buildupSizes)?$buildupSizes:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Front elivation</label>
                                            <input type="text" name="frontElivation" id="frontElivation" value="{{isset($frontElivation)?$frontElivation:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Depth</label>
                                            <input type="text" name="depth" id="depth" value="{{isset($depth)?$depth:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Common area</label>
                                            <input type="text" name="commonArea" id="commonArea" value="{{isset($commonArea)?$commonArea:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                    </fieldset>
                                </div>
                                <div class="row">
                                    <fieldset>
                                        <legend>Address</legend>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Entrance #</label>
                                                    <input type="text" name="entranceNum" id="entranceNum" value="{{isset($entranceNum)?$entranceNum:''}}"
                                                           class="form-control"
                                                           autocomplete="nope">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">BLDG #</label>
                                                    <input type="text" name="BLDGNum" id="BLDGNum" value="{{isset($BLDGNum)?$BLDGNum:''}}"
                                                           class="form-control"
                                                           autocomplete="nope">
                                                </div>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Unit #</label>
                                                    <input type="text" name="unitNum" id="unitNum" value="{{isset($unitNum)?$unitNum:''}}"
                                                           class="form-control"
                                                           autocomplete="nope">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Name</label>
                                                    <input type="text" name="name" id="name" value="{{isset($name)?$name:''}}"
                                                           class="form-control"
                                                           autocomplete="nope">
                                                </div>
                                            </div>

                                        </div>
                                    </fieldset>
                                </div>
                                <div class="row">
                                    <fieldset>
                                        <legend>Usage</legend>
                                        <div class="row">
                                            <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="control-label">Use</label>
                                                   <input type="text" name="use" id="use" value="{{isset($use)?$use:''}}"
                                                          class="form-control"
                                                          autocomplete="nope">
                                               </div>
                                            </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="control-label">Age</label>
                                                   <input type="text" name="age" id="age" value="{{isset($age)?$age:''}}"
                                                          class="form-control"
                                                          autocomplete="nope">
                                               </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                
<!--                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Status</label>
                                            <input type="text" name="status" id="status" value="{{isset($status)?$status:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Role</label>
                                            <input type="text" name="role" id="role" value="{{isset($role)?$role:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                   
                                </div>-->
                            </div>
                        </div>
                        <!---StructureInfoPrimaryInfo -->

<!--                        -StructureInfoFeatures 
                        <div class="tab-pane fade" id="StructureInfoFeatures">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Outdoor</label>
                                            <input type="text" name="outdoor" id="outdoor" value="{{isset($outdoor)?$outdoor:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Indoor</label>
                                            <input type="text" name="indoor" id="indoor" value="{{isset($indoor)?$indoor:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Interior</label>
                                            <input type="text" name="interior" id="interior" value="{{isset($interior)?$interior:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Exterior</label>
                                            <input type="text" name="exterior" id="exterior" value="{{isset($exterior)?$exterior:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Design type</label>
                                            <input type="text" name="designType" id="designType" value="{{isset($designType)?$designType:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Woodwork</label>
                                            <input type="text" name="woodwork" id="woodwork" value="{{isset($woodwork)?$woodwork:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Missionary</label>
                                            <input type="text" name="missionary" id="missionary" value="{{isset($missionary)?$missionary:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Fittings</label>
                                            <input type="text" name="fittings" id="fittings" value="{{isset($fittings)?$fittings:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Fixtures</label>
                                            <input type="text" name="fixtures" id="fixtures" value="{{isset($fixtures)?$fixtures:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        -StructureInfoFeatures -->
                         <!---PropertyInfoFeatures -->
                        <div class="tab-pane fade" id="PropertyInfoFeatures">
                            <div class="form-body">
                                @if(isset($Amenities[0]) && !empty($Amenities[0]))
                                <fieldset>
                                    <legend>{{$Amenities[0]->title}}</legend>
                                <div class="row">
                                    @foreach($Amenities[0]->weightageCategoryItems as $amenitiesObj)
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-info">
                                            <input type="checkbox" @if(isset($AmenitiesMeta) && !empty($AmenitiesMeta) && in_array($amenitiesObj->id,$AmenitiesMeta[0])) checked="checked" @endif name="aminatie[]" value="{{$amenitiesObj->id}}">
                                            <label for="check-view">{{$amenitiesObj->title}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                   
                                </div>
                                 </fieldset>
                                 @endif
                                @php
                                $featureCount= 0;
                                @endphp
                                @foreach ($featureCategorList as $featureCategorListIn)
                                <div class="row">
                                            <fieldset>
                                                <legend>{{$featureCategorListIn->category_name}}</legend>
                                                <div class="row">
                                                    @foreach ($featureCategorListIn->featureItems as $featureKey => $featureItemsIn)
                                                   
                                                    @if(!empty($PropertyFeatureMeta))
                                                        @if(array_key_exists($featureItemsIn->id,$PropertyFeatureMeta))
                                                        @php
                                                            $featureUpdate=$PropertyFeatureMeta[$featureItemsIn->id];
                                                            $fectureId=$featureUpdate['id'];
                                                             @endphp
                                                            
                                                        @endif
                                                    @endif
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                                <div class="checkbox checkbox-info  col-md-10">
                                                                    <input id="{{$featureItemsIn->id}}"  @if(isset($featureUpdate) && isset($fectureId) && $fectureId==$featureItemsIn->id) ) checked="checked"  @endif
                                                                           onchange="checkFeature({{$featureItemsIn->id}})"
                                                                           name="feature[{{$featureCount}}][id]" value="{{$featureItemsIn->id}}"
                                                                           type="checkbox">
                                                                    <label for="client_view_task">{{$featureItemsIn->feature_name}}</label>
                                                                    <span id="feature-{{$featureItemsIn->id}}" @if(isset($featureUpdate) && isset($fectureId) && $fectureId==$featureItemsIn->id) ) @else style="display:none;" @endif  class="ml-20">
                                                                       @if(isset($featureItemsIn->field_type) && $featureItemsIn->field_type=="select" )
                                                                            <select name="feature[{{$featureCount}}][value]" class="form-control">

                                                                           @php
                                                                            $arr = json_decode($featureItemsIn->sub_fields,true);
                                                                            @endphp
                                                                            @foreach($arr as $field)
                                                                                <option @if(isset($featureUpdate) && isset($fectureId) && $fectureId==$featureItemsIn->id && $featureUpdate['field_type']=="select" && $featureUpdate['value']==$field['name']) selected="selected" @endif value="{{$field['name']}}">{{$field['name']}}</option>
                                                                            
                                                                            @endforeach
                                                                                </select>
                                                                        @elseif(isset($featureItemsIn->field_type) && $featureItemsIn->field_type=="textarea" )
                                                                            <textarea name=feature[{{$featureCount}}][value]" class="form-control" @if(isset($featureUpdate) && isset($fectureId) && $fectureId==$featureItemsIn->id && $featureUpdate['field_type']=='textarea') value="{{$featureUpdate['value']}}" @endif>@if(isset($featureUpdate) && isset($fectureId) && $fectureId==$featureItemsIn->id && $featureUpdate['field_type']=='textarea') {{$featureUpdate['value']}} @endif</textarea>
                                                                           @else
                                                                            <input type="text" name="feature[{{$featureCount}}][value]" @if(isset($featureUpdate) && isset($fectureId) && $fectureId==$featureItemsIn->id && $featureUpdate['field_type']=='text') value="{{$featureUpdate['value']}}" @endif class="form-control">
                                                                           @endif
                                                                    </span>
                                                                </div>
                                                        </div>
                                                    </div>
                                                        @php
                                                            $featureCount++;
                                                        @endphp
                                                    @endforeach
                                                </div>
                                            </fieldset>
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                        <!---PropertyInfoFeatures -->
                        <!---StructureInfoAddOns -->
<!--                        <div class="tab-pane fade" id="StructureInfoAddOns">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Fittings</label>
                                            <input type="text" name="addOnFittings" id="addOnFittings" value="{{isset($addOnFittings)?$addOnFittings:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Fixtures</label>
                                            <input type="text" name="addOnFixtures" id="addOnFixtures" value="{{isset($addOnFixtures)?$addOnFixtures:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Furniture</label>
                                            <input type="text" name="addOnFurniture" id="addOnFurniture" value="{{isset($addOnFurniture)?$addOnFurniture:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Appliances</label>
                                            <input type="text" name="addOnAppliances" id="addOnAppliances" value="{{isset($addOnAppliances)?$addOnAppliances:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Washing machines</label>
                                            <input type="text" name="washingMachines" id="washingMachines" value="{{isset($washingMachines)?$washingMachines:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Air conditioning</label>
                                            <input type="text" name="airConditioning" id="airConditioning" value="{{isset($airConditioning)?$airConditioning:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Heating</label>
                                            <input type="text" name="heating" id="heating" value="{{isset($heating)?$heating:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Kitchen appliances</label>
                                            <input type="text" name="kitchenAppliances" id="kitchenAppliances" value="{{isset($kitchenAppliances)?$kitchenAppliances:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <!---StructureInfoAddOns -->

                        <!---StructureInfoPropertyCharacteristics -->
                        <div class="tab-pane fade" id="StructureInfoPropertyCharacteristics">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <input type="text" name="description" id="description" value="{{isset($description)?$description:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">maintenance</label>
                                            <input type="text" name="maintenance" id="maintenance" value="{{isset($maintenance)?$maintenance:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">No. units</label>
                                            <input type="text" name="noOfUnits" id="noOfUnits" value="{{isset($noOfUnits)?$noOfUnits:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">No. of rooms</label>
                                            <input type="text" name="noOfRooms" id="noOfRooms" value="{{isset($noOfRooms)?$noOfRooms:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">No. of roads</label>
                                            <input type="text" name="noOfRoads" id="noOfRoads" value="{{isset($noOfRoads)?$noOfRoads:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Property info</label>
                                            <input type="text" name="propertyInfo" id="propertyInfo" value="{{isset($propertyInfo)?$propertyInfo:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!---StructureInfoPropertyCharacteristics -->
                        
                        <!-- StructureInfoPropertyUnitList -->
                        <div class="tab-pane fade" id="StructureInfoUnitListTab">
                            <div class="form-body">
                                <div class="row">
                                    <div class="pb-10">
                                           <button type="button" class="btn btn-primary" id="StructureInfoUnitListAddBtn">Add New Row</button>
                                      </div>
                                   <table id="StructureInfoUnitListTable" class="table table-striped table-row-bordered gy-5 gs-7">
                                           <thead>
                                                   <tr class="fw-bold fs-6 text-gray-800">
                                                           <th>Unit Type</th>
                                                           <th>Unit Id</th>
                                                           <th>Description</th>
                                                   </tr>
                                           </thead>
                                            <tfoot>
                                            @if(isset($StructureUnit) && !empty($StructureUnit))
                                         @foreach($StructureUnit as $StructureUnitObj)
                                         <tr>
                                             <th><input type="hidden" name="structureUnitType[]" value="{{$StructureUnitObj['unitType']}}">{{$StructureUnitObj['unitType']}}</th>
                                             <th><input type="hidden" name="structureUnitId[]" value="{{$StructureUnitObj['unitId']}}">{{$StructureUnitObj['unitId']}}</th>
                                             <th><input type="hidden" name="structureUnitDescription[]" value="{{$StructureUnitObj['unitDescription']}}">{{$StructureUnitObj['unitDescription']}}</th>
                                         </tr>
                                         @endforeach
                                         @endif
                                          </tfoot>
                                       </table>
                                    <button onclick="saveUnit()" type="button" class="btn btn-primary">Save Units</button>
                                </div>
                            </div>
                        </div>
                        <!-- StructureInfoPropertyUnitList end -->
                        
                        <!-- StructureInfoFincialInfoTab -->
<!--                        <div class="tab-pane fade" id="StructureInfoFincialInfoTab">-->
                        @include('valuation::Admin.Property.PropertyFormInclude.StructureFincialInfo')
<!--                        </div>-->
                        <!-- StructureInfoFincialInfoTab -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@push('footer-script')
<script src="{{ asset('plugins/metronic_plugin/js/datatables-bundle.js') }}"></script>
<script src="{{ asset('plugins/metronic_plugin/js/prismjs-bundle.js') }}"></script>
<script>
var StructureInfoUnitListTable =$("#StructureInfoUnitListTable").DataTable();
var unitListCounter=1;
var propertyTypeHtmlOption=[];
var propetyType='<?php echo json_encode($types, JSON_UNESCAPED_UNICODE );?>';

jQuery.each(JSON.parse(propetyType), function(index,vaule) {
 propertyTypeHtmlOption.push('<option value="'+vaule.id+'">'+vaule.title+'</option>');
});

$("#StructureInfoUnitListAddBtn").on("click", function() {
    StructureInfoUnitListTable.row.add([
        '<select  name="structureUnitType[]" class="form-control">'+propertyTypeHtmlOption+'</select>',
        '<input type="text" name="structureUnitId[]" class="form-control">',
        '<textarea name="structureUnitDescription[]" class="form-control"></textarea>'
        
    ]).draw(false);
    unitListCounter++;
});
// Automatically add a first row of data
$("#StructureInfoUnitListAddBtn").click();
function saveUnit()
{
     var unitStructureType=$("select[name='structureUnitType[]']").map(function(){return $(this).val();}).get();
     var unitStructureUnitId=$("input[name='structureUnitId[]']").map(function(){return $(this).val();}).get();
     var structureUnitDescription=$("input[name='structureUnitDescription[]']").map(function(){return $(this).val();}).get();
     var token=$('input[name="_token"]').val();
     if(unitStructureType!='' && unitStructureUnitId!='' )
     {
         $.easyAjax({
                url: '{{route($saveUnitRoute, $id)}}',
                type: "POST",
                redirect: true,
                file: false,
                data: {_token: token,unitStructureType:unitStructureType,unitStructureUnitId:unitStructureUnitId,structureUnitDescription:structureUnitDescription,propertyIdOld:{{$id}}}
            })
     }
     else
     {
         alert("Please fill the Fields ");
     }
}
</script>
@endpush