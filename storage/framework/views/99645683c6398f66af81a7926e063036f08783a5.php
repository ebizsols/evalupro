<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/metronic_plugin/css/datatables-bundle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/metronic_plugin/css/prismjs-bundle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/metronic_plugin/css/style-bundle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/metronic_plugin/css/plugins-bundle.css')); ?>">
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
<?php $__env->stopPush(); ?>
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
                                            <input type="text" name="buildupSizes" id="buildupSizes" value="<?php echo e(isset($buildupSizes)?$buildupSizes:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Front elivation</label>
                                            <input type="text" name="frontElivation" id="frontElivation" value="<?php echo e(isset($frontElivation)?$frontElivation:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Depth</label>
                                            <input type="text" name="depth" id="depth" value="<?php echo e(isset($depth)?$depth:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Common area</label>
                                            <input type="text" name="commonArea" id="commonArea" value="<?php echo e(isset($commonArea)?$commonArea:''); ?>"
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
                                                    <input type="text" name="entranceNum" id="entranceNum" value="<?php echo e(isset($entranceNum)?$entranceNum:''); ?>"
                                                           class="form-control"
                                                           autocomplete="nope">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">BLDG #</label>
                                                    <input type="text" name="BLDGNum" id="BLDGNum" value="<?php echo e(isset($BLDGNum)?$BLDGNum:''); ?>"
                                                           class="form-control"
                                                           autocomplete="nope">
                                                </div>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Unit #</label>
                                                    <input type="text" name="unitNum" id="unitNum" value="<?php echo e(isset($unitNum)?$unitNum:''); ?>"
                                                           class="form-control"
                                                           autocomplete="nope">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Name</label>
                                                    <input type="text" name="name" id="name" value="<?php echo e(isset($name)?$name:''); ?>"
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
                                                   <input type="text" name="use" id="use" value="<?php echo e(isset($use)?$use:''); ?>"
                                                          class="form-control"
                                                          autocomplete="nope">
                                               </div>
                                            </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="control-label">Age</label>
                                                   <input type="text" name="age" id="age" value="<?php echo e(isset($age)?$age:''); ?>"
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
                                            <input type="text" name="status" id="status" value="<?php echo e(isset($status)?$status:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Role</label>
                                            <input type="text" name="role" id="role" value="<?php echo e(isset($role)?$role:''); ?>"
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
                                            <input type="text" name="outdoor" id="outdoor" value="<?php echo e(isset($outdoor)?$outdoor:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Indoor</label>
                                            <input type="text" name="indoor" id="indoor" value="<?php echo e(isset($indoor)?$indoor:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Interior</label>
                                            <input type="text" name="interior" id="interior" value="<?php echo e(isset($interior)?$interior:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Exterior</label>
                                            <input type="text" name="exterior" id="exterior" value="<?php echo e(isset($exterior)?$exterior:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Design type</label>
                                            <input type="text" name="designType" id="designType" value="<?php echo e(isset($designType)?$designType:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Woodwork</label>
                                            <input type="text" name="woodwork" id="woodwork" value="<?php echo e(isset($woodwork)?$woodwork:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Missionary</label>
                                            <input type="text" name="missionary" id="missionary" value="<?php echo e(isset($missionary)?$missionary:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Fittings</label>
                                            <input type="text" name="fittings" id="fittings" value="<?php echo e(isset($fittings)?$fittings:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Fixtures</label>
                                            <input type="text" name="fixtures" id="fixtures" value="<?php echo e(isset($fixtures)?$fixtures:''); ?>"
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
                                <?php if(isset($Amenities[0]) && !empty($Amenities[0])): ?>
                                <fieldset>
                                    <legend><?php echo e($Amenities[0]->title); ?></legend>
                                <div class="row">
                                    <?php $__currentLoopData = $Amenities[0]->weightageCategoryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenitiesObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-info">
                                            <input type="checkbox" <?php if(isset($AmenitiesMeta) && !empty($AmenitiesMeta) && in_array($amenitiesObj->id,$AmenitiesMeta[0])): ?> checked="checked" <?php endif; ?> name="aminatie[]" value="<?php echo e($amenitiesObj->id); ?>">
                                            <label for="check-view"><?php echo e($amenitiesObj->title); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   
                                </div>
                                 </fieldset>
                                 <?php endif; ?>
                                <?php
                                $featureCount= 0;
                                ?>
                                <?php $__currentLoopData = $featureCategorList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featureCategorListIn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row">
                                            <fieldset>
                                                <legend><?php echo e($featureCategorListIn->category_name); ?></legend>
                                                <div class="row">
                                                    <?php $__currentLoopData = $featureCategorListIn->featureItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featureKey => $featureItemsIn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                   
                                                    <?php if(!empty($PropertyFeatureMeta)): ?>
                                                        <?php if(array_key_exists($featureItemsIn->id,$PropertyFeatureMeta)): ?>
                                                        <?php
                                                            $featureUpdate=$PropertyFeatureMeta[$featureItemsIn->id];
                                                            $fectureId=$featureUpdate['id'];
                                                             ?>
                                                            
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                                <div class="checkbox checkbox-info  col-md-10">
                                                                    <input id="<?php echo e($featureItemsIn->id); ?>"  <?php if(isset($featureUpdate) && isset($fectureId) && $fectureId==$featureItemsIn->id): ?> ) checked="checked"  <?php endif; ?>
                                                                           onchange="checkFeature(<?php echo e($featureItemsIn->id); ?>)"
                                                                           name="feature[<?php echo e($featureCount); ?>][id]" value="<?php echo e($featureItemsIn->id); ?>"
                                                                           type="checkbox">
                                                                    <label for="client_view_task"><?php echo e($featureItemsIn->feature_name); ?></label>
                                                                    <span id="feature-<?php echo e($featureItemsIn->id); ?>" <?php if(isset($featureUpdate) && isset($fectureId) && $fectureId==$featureItemsIn->id): ?> ) <?php else: ?> style="display:none;" <?php endif; ?>  class="ml-20">
                                                                       <?php if(isset($featureItemsIn->field_type) && $featureItemsIn->field_type=="select" ): ?>
                                                                            <select name="feature[<?php echo e($featureCount); ?>][value]" class="form-control">

                                                                           <?php
                                                                            $arr = json_decode($featureItemsIn->sub_fields,true);
                                                                            ?>
                                                                            <?php $__currentLoopData = $arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option <?php if(isset($featureUpdate) && isset($fectureId) && $fectureId==$featureItemsIn->id && $featureUpdate['field_type']=="select" && $featureUpdate['value']==$field['name']): ?> selected="selected" <?php endif; ?> value="<?php echo e($field['name']); ?>"><?php echo e($field['name']); ?></option>
                                                                            
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </select>
                                                                        <?php elseif(isset($featureItemsIn->field_type) && $featureItemsIn->field_type=="textarea" ): ?>
                                                                            <textarea name=feature[<?php echo e($featureCount); ?>][value]" class="form-control" <?php if(isset($featureUpdate) && isset($fectureId) && $fectureId==$featureItemsIn->id && $featureUpdate['field_type']=='textarea'): ?> value="<?php echo e($featureUpdate['value']); ?>" <?php endif; ?>><?php if(isset($featureUpdate) && isset($fectureId) && $fectureId==$featureItemsIn->id && $featureUpdate['field_type']=='textarea'): ?> <?php echo e($featureUpdate['value']); ?> <?php endif; ?></textarea>
                                                                           <?php else: ?>
                                                                            <input type="text" name="feature[<?php echo e($featureCount); ?>][value]" <?php if(isset($featureUpdate) && isset($fectureId) && $fectureId==$featureItemsIn->id && $featureUpdate['field_type']=='text'): ?> value="<?php echo e($featureUpdate['value']); ?>" <?php endif; ?> class="form-control">
                                                                           <?php endif; ?>
                                                                    </span>
                                                                </div>
                                                        </div>
                                                    </div>
                                                        <?php
                                                            $featureCount++;
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                            <input type="text" name="addOnFittings" id="addOnFittings" value="<?php echo e(isset($addOnFittings)?$addOnFittings:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Fixtures</label>
                                            <input type="text" name="addOnFixtures" id="addOnFixtures" value="<?php echo e(isset($addOnFixtures)?$addOnFixtures:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Furniture</label>
                                            <input type="text" name="addOnFurniture" id="addOnFurniture" value="<?php echo e(isset($addOnFurniture)?$addOnFurniture:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Appliances</label>
                                            <input type="text" name="addOnAppliances" id="addOnAppliances" value="<?php echo e(isset($addOnAppliances)?$addOnAppliances:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Washing machines</label>
                                            <input type="text" name="washingMachines" id="washingMachines" value="<?php echo e(isset($washingMachines)?$washingMachines:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Air conditioning</label>
                                            <input type="text" name="airConditioning" id="airConditioning" value="<?php echo e(isset($airConditioning)?$airConditioning:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Heating</label>
                                            <input type="text" name="heating" id="heating" value="<?php echo e(isset($heating)?$heating:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Kitchen appliances</label>
                                            <input type="text" name="kitchenAppliances" id="kitchenAppliances" value="<?php echo e(isset($kitchenAppliances)?$kitchenAppliances:''); ?>"
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
                                            <input type="text" name="description" id="description" value="<?php echo e(isset($description)?$description:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">maintenance</label>
                                            <input type="text" name="maintenance" id="maintenance" value="<?php echo e(isset($maintenance)?$maintenance:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">No. units</label>
                                            <input type="text" name="noOfUnits" id="noOfUnits" value="<?php echo e(isset($noOfUnits)?$noOfUnits:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">No. of rooms</label>
                                            <input type="text" name="noOfRooms" id="noOfRooms" value="<?php echo e(isset($noOfRooms)?$noOfRooms:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">No. of roads</label>
                                            <input type="text" name="noOfRoads" id="noOfRoads" value="<?php echo e(isset($noOfRoads)?$noOfRoads:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Property info</label>
                                            <input type="text" name="propertyInfo" id="propertyInfo" value="<?php echo e(isset($propertyInfo)?$propertyInfo:''); ?>"
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
                                            <?php if(isset($StructureUnit) && !empty($StructureUnit)): ?>
                                         <?php $__currentLoopData = $StructureUnit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $StructureUnitObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <tr>
                                             <th><input type="hidden" name="structureUnitType[]" value="<?php echo e($StructureUnitObj['unitType']); ?>"><?php echo e($StructureUnitObj['unitType']); ?></th>
                                             <th><input type="hidden" name="structureUnitId[]" value="<?php echo e($StructureUnitObj['unitId']); ?>"><?php echo e($StructureUnitObj['unitId']); ?></th>
                                             <th><input type="hidden" name="structureUnitDescription[]" value="<?php echo e($StructureUnitObj['unitDescription']); ?>"><?php echo e($StructureUnitObj['unitDescription']); ?></th>
                                         </tr>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                         <?php endif; ?>
                                          </tfoot>
                                       </table>
                                    <button onclick="saveUnit()" type="button" class="btn btn-primary">Save Units</button>
                                </div>
                            </div>
                        </div>
                        <!-- StructureInfoPropertyUnitList end -->
                        
                        <!-- StructureInfoFincialInfoTab -->
<!--                        <div class="tab-pane fade" id="StructureInfoFincialInfoTab">-->
                        <?php echo $__env->make('valuation::Admin.Property.PropertyFormInclude.StructureFincialInfo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--                        </div>-->
                        <!-- StructureInfoFincialInfoTab -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startPush('footer-script'); ?>
<script src="<?php echo e(asset('plugins/metronic_plugin/js/datatables-bundle.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/metronic_plugin/js/prismjs-bundle.js')); ?>"></script>
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
                url: '<?php echo e(route($saveUnitRoute, $id)); ?>',
                type: "POST",
                redirect: true,
                file: false,
                data: {_token: token,unitStructureType:unitStructureType,unitStructureUnitId:unitStructureUnitId,structureUnitDescription:structureUnitDescription,propertyIdOld:<?php echo e($id); ?>}
            })
     }
     else
     {
         alert("Please fill the Fields ");
     }
}
</script>
<?php $__env->stopPush(); ?><?php /**PATH /home/evalupro/public_html/Modules/Valuation/Resources/views/Admin/Property/PropertyFormInclude/StructureInfo.blade.php ENDPATH**/ ?>