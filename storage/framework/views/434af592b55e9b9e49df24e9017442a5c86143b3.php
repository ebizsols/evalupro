<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/metronic_plugin/css/datatables-bundle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/metronic_plugin/css/prismjs-bundle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/metronic_plugin/css/style-bundle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/metronic_plugin/css/plugins-bundle.css')); ?>">
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
<?php $__env->stopPush(); ?>
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
                                                <?php if(isset($types)): ?>
                                                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(isset($typeId) && $type->id == $typeId): ?> selected="selected"
                                                                <?php endif; ?>  value="<?php echo e($type->id); ?>">
                                                            <?php echo e($type->title); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
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
                                                <?php if(isset($classes)): ?>
                                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(isset($classId) && $class->id == $classId): ?> selected="selected"
                                                                <?php endif; ?> value="<?php echo e($class->id); ?>">
                                                            <?php echo e($class->title); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
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
                                                <?php if(isset($categorizations)): ?>
                                                    <?php $__currentLoopData = $categorizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(isset($categorizationId) && $categorization->id == $categorizationId): ?> selected="selected"
                                                                <?php endif; ?>  value="<?php echo e($categorization->id); ?>">
                                                            <?php echo e($categorization->title); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php if(isset($LandClassification[0]) && !empty($LandClassification[0])): ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><?php echo e($LandClassification[0]->title); ?></label>
                                                <!--                                            <small class="pull-right cursor-pointer openModal addPropertyClassification"
                                                                                                   data-toggle="modal" data-target="#addPropertyClassification"
                                                                                                   data-whatever="Add Property Class">Add</small>-->
                                                <select name="LandClassification"
                                                        id="propertyClassification"
                                                        class="form-control"
                                                        required>
                                                    <option value="">--</option>
                                                    <?php $__currentLoopData = $LandClassification[0]->weightageCategoryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $landClass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(isset($landClassficationMeta) && !empty($landClassficationMeta) && $landClassficationMeta[0]==$landClass->id): ?> selected="selected"
                                                                <?php endif; ?> value="<?php echo e($landClass->id); ?>"><?php echo e($landClass->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <!--                                                <?php if(isset($classifications)): ?>
                                                    <?php $__currentLoopData = $classifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(isset($classificationId) && $classification->id == $classificationId): ?> selected="selected"
                                                                <?php endif; ?>  value="<?php echo e($classification->id); ?>">
                                                            <?php echo e($classification->title); ?>

                                                                </option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>-->
                                                </select>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="row">
                                    <?php if(isset($Accessibility[0]) && !empty($Accessibility[0])): ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><?php echo e($Accessibility[0]->title); ?></label>
                                                <select class="form-control" name="landInfoAccessibility">
                                                    <option value="">--select One--</option>
                                                    <?php $__currentLoopData = $Accessibility[0]->weightageCategoryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(isset($AccessibilityMeta) && !empty($AccessibilityMeta) && $AccessibilityMeta[0]==$subCate->id): ?> selected="selected"
                                                                <?php endif; ?> value="<?php echo e($subCate->id); ?>"><?php echo e($subCate->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    <?php if(isset($AccessibilityType[0]) && !empty($AccessibilityType[0])): ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><?php echo e($AccessibilityType[0]->title); ?></label>
                                                <select class="form-control" name="landInfoAccessibilityType">
                                                    <option value="">--select One--</option>
                                                    <?php $__currentLoopData = $AccessibilityType[0]->weightageCategoryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assciblityTypeObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(isset($AccessibilityTypeMeta) && !empty($AccessibilityTypeMeta) && $AccessibilityTypeMeta[0]==$assciblityTypeObj->id): ?> selected="selected"
                                                                <?php endif; ?> value="<?php echo e($assciblityTypeObj->id); ?>"><?php echo e($assciblityTypeObj->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                    <?php endif; ?>
                                    <?php if(isset($RoadAccessNo[0]) && !empty($RoadAccessNo[0])): ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><?php echo e($RoadAccessNo[0]->title); ?></label>
                                                <select name="landInfoRoadAccess" class="form-control">
                                                    <option value="">--select One--</option>
                                                    <?php $__currentLoopData = $RoadAccessNo[0]->weightageCategoryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roadNo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(isset($NoOfAccessRoadMeta) && !empty($NoOfAccessRoadMeta) && $NoOfAccessRoadMeta[0]==$roadNo->id): ?> selected="selected"
                                                                <?php endif; ?> value="<?php echo e($roadNo->id); ?>"><?php echo e($roadNo->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                </div>
                                <div class="row">
                                    <?php if(isset($RoadAccessType[0]) && !empty($RoadAccessType[0])): ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><?php echo e($RoadAccessType[0]->title); ?></label>
                                                <select name="landRoadAccessType" class="form-control">
                                                    <option value="">--select One--</option>
                                                    <?php $__currentLoopData = $RoadAccessType[0]->weightageCategoryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roadType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(isset($AccessRoadTypeMeta) && !empty($AccessRoadTypeMeta) && $AccessRoadTypeMeta[0]==$roadType->id): ?> selected="selected"
                                                                <?php endif; ?> value="<?php echo e($roadType->id); ?>"><?php echo e($roadType->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    <?php if(isset($RecencyTransection[0]) && !empty($RecencyTransection[0])): ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><?php echo e($RecencyTransection[0]->title); ?></label>
                                                <select name="landInfoRecency" class="form-control">
                                                    <option value="">--select One--</option>
                                                    <?php $__currentLoopData = $RecencyTransection[0]->weightageCategoryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rencecyTran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(isset($RecencyTransectionMeta) && !empty($RecencyTransectionMeta) && $RecencyTransectionMeta[0]==$rencecyTran->id): ?> selected="selected"
                                                                <?php endif; ?> value="<?php echo e($rencecyTran->id); ?>"><?php echo e($rencecyTran->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                    <?php endif; ?>
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
                                                       value="<?php echo e(isset($surroundingFront)?$surroundingFront:''); ?>"
                                                       class="form-control"
                                                       autocomplete="nope">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Back View</label>
                                                <input type="text" name="back" id="back"
                                                       value="<?php echo e(isset($surroundingBack)?$surroundingBack:''); ?>"
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
                                                       value="<?php echo e(isset($surroundingLeft)?$surroundingLeft:''); ?>"
                                                       class="form-control"
                                                       autocomplete="nope">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Right side View</label>
                                                <input type="text" name="rightSide" id="rightSide"
                                                       value="<?php echo e(isset($surroundingRight)?$surroundingRight:''); ?>"
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
                                                       value="<?php echo e(isset($surroundingAdjacent)?$surroundingAdjacent:''); ?>"
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
                                                <?php if(isset($countries)): ?>
                                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(isset($adminCountryId) &&  !empty($adminCountryId) && $adminCountryId == $country->id): ?> selected="selected"
                                                                <?php endif; ?> value="<?php echo e($country->id); ?>">
                                                            <?php echo e($country->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Governorate</label>
                                            <select name="governorate" id="governorate" class="form-control" required>
                                                <option value="">--</option>
                                                <?php if(isset($governorates)): ?>
                                                    <?php $__currentLoopData = $governorates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $governorate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(isset($governorateId) && !empty($governorateId) && $governorate->id == $governorateId): ?> selected="selected"
                                                                <?php endif; ?> value="<?php echo e($governorate->id); ?>">
                                                            <?php echo e($governorate->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
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
                                                <?php if($cities): ?>
                                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(isset($cityId) && $city->id == $cityId): ?> selected="selected"
                                                                <?php endif; ?> value="<?php echo e($city->id); ?>">
                                                            <?php echo e($city->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
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
                                                <?php if(isset($blocks)): ?>
                                                    <?php $__currentLoopData = $blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(isset($blockId) && $block->id == $blockId): ?> selected="selected"
                                                                <?php endif; ?> value="<?php echo e($block->id); ?>">
                                                            <?php echo e($block->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Locality </label>
                                            <input type="text" name="locality" id="locality"
                                                   value="<?php echo e(isset($locality)?$locality:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Road</label>
                                            <input type="text" name="address_road" id="road"
                                                   value="<?php echo e(isset($road)?$road:''); ?>"
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
                                                           value="<?php echo e(isset($latitude)?$latitude:''); ?>"
                                                           class="form-control" autocomplete="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Longitude</label>
                                                    <input type="text" name="longitude" id="longitude"
                                                           value="<?php echo e(isset($longitude)?$longitude:''); ?>"
                                                           class="form-control" autocomplete="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Plot #</label>
                                            <input type="text" name="plotNum" id="plotNum"
                                                   value="<?php echo e(isset($plotNum)?$plotNum:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <?php if(isset($LocationClassification[0]) && !empty($LocationClassification[0])): ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label"><?php echo e($LocationClassification[0]->title); ?></label>
                                                <select name="addressLocationClassification" class="form-control">
                                                    <option value="">--select One--</option>
                                                    <?php $__currentLoopData = $LocationClassification[0]->weightageCategoryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locClassficationObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(isset($LocationClassificationMeta) && !empty($LocationClassificationMeta) && $LocationClassificationMeta[0]==$locClassficationObj->id): ?> selected="selected"
                                                                <?php endif; ?> value="<?php echo e($locClassficationObj->id); ?>"><?php echo e($locClassficationObj->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                    <?php endif; ?>
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
                                                    <label><?php echo app('translator')->get('valuation::valuation.property.media.image'); ?></label>
                                                    <div class="form-group">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail"
                                                                 style="width: 200px; height: 150px;">
                                                                <img src="https://via.placeholder.com/200x150.png?text=<?php echo e(str_replace(' ', '+', __('modules.profile.uploadPicture'))); ?>"
                                                                     alt=""/>
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail"
                                                                 style="max-width: 200px; max-height: 150px;"></div>
                                                            <div>
                                                    <span class="btn btn-info btn-file">
                                                        <span class="fileinput-new"> <?php echo app('translator')->get('app.selectImage'); ?> </span>
                                                        <span class="fileinput-exists"> <?php echo app('translator')->get('app.change'); ?> </span>
                                                        <input type="file" id="image" name="image" data-img-data="true"> </span>
                                                                <a href="javascript:;"
                                                                   class="btn btn-danger fileinput-exists"
                                                                   data-dismiss="fileinput"> <?php echo app('translator')->get('app.remove'); ?> </a>
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


                        <?php echo $__env->make('valuation::Admin.Property.PropertyFormInclude.FincialInfoForPropertyInfo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('valuation::Admin.Property.PropertyFormInclude.LandInfo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/metronic_plugin/js/datatables-bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/metronic_plugin/js/prismjs-bundle.js')); ?>"></script>

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
<?php $__env->stopPush(); ?><?php /**PATH /home/evalupro/public_html/Modules/Valuation/Resources/views/Admin/Property/PropertyFormInclude/PropertyInfo.blade.php ENDPATH**/ ?>