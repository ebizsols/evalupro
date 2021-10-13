<div class="tab-pane   " id="UnitInfo-<?php echo e($objRef->unit_id); ?>" role="tabpanel">
    <div class="inner-panel-Main-div">
        <div class="panel panel-inverse">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body inner-panel-padding">
                    <div class="tabbable">
                        <ul class="nav nav-tabs wizard">
                            <li class="active"><a href="#UnitInfoPrimaryInfo-<?php echo e($objRef->unit_id); ?>" class="nav-link nav-item"
                                   data-toggle="tab"
                                   aria-controls="UnitInfoPrimaryInfo-<?php echo e($objRef->unit_id); ?>"
                                   aria-expanded="false">Primary Info</a></li>
                            <li><a href="#UnitInfoFincialInfo-<?php echo e($objRef->unit_id); ?>" class="nav-link nav-item"
                                   data-toggle="tab"
                                   aria-controls="UnitInfoFincialInfo-<?php echo e($objRef->unit_id); ?>"
                                   aria-expanded="false">Financial Info</a></li>
                            <li><a href="#UnitInfoImages-<?php echo e($objRef->unit_id); ?>" class="nav-link nav-item"
                                   data-toggle="tab"
                                   aria-controls="UnitInfoImages-<?php echo e($objRef->unit_id); ?>"
                                   aria-expanded="false">Images</a></li>
                        </ul>

                    </div>
                    <div class="tab-content" id="myTabContentUnit-<?php echo e($objRef->unit_id); ?>">
                       <!---LandInfoAddress -->
                        <div class="tab-pane fade in active" id="UnitInfoPrimaryInfo-<?php echo e($objRef->unit_id); ?>" role="tabpanel">
                            <div class="form-body">
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                           
                                            ?>
                                            <label class="control-label">Unit Type</label>
                                            <select name="unitType-<?php echo e($objRef->unit_id); ?>" id="unitType-<?php echo e($objRef->unit_id); ?>" class="form-control">
                                                 <?php if(isset($types)): ?>
                                                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(isset($unitType) && !empty($unitType) &&  $unitType[0] ==$type->id): ?> selected="selected"
                                                                <?php endif; ?>  value="<?php echo e($type->id); ?>">
                                                            <?php echo e($type->title); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php if(isset($BedRooms) && !empty($BedRooms)): ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label"><?php echo e($BedRooms[0]->title); ?></label>
                                            <select name="bedRoomsUnitInfo-<?php echo e($objRef->unit_id); ?>" class="form-control">
                                                <option value="">--select One--</option>
                                                <?php $__currentLoopData = $BedRooms[0]->weightageCategoryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(isset($NoOfBedroomText) && !empty($NoOfBedroomText) && $NoOfBedroomText[0]==$roomObj->id): ?> selected="selected" <?php endif; ?> value="<?php echo e($roomObj->id); ?>"><?php echo e($roomObj->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(isset($BathRoom) && !empty($BathRoom)): ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label"><?php echo e($BathRoom[0]->title); ?></label>
                                            <select name="bathRoomUnitInfo-<?php echo e($objRef->unit_id); ?>" class="form-control">
                                                <option value="">--select One--</option>
                                                <?php $__currentLoopData = $BathRoom[0]->weightageCategoryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bathObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(isset($NoOfBathoomsText) && !empty($NoOfBathoomsText) && $NoOfBathoomsText[0]==$bathObj->id): ?> selected="selected" <?php endif; ?> value="<?php echo e($bathObj->id); ?>"><?php echo e($bathObj->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(isset($FinishingQuality) && !empty($FinishingQuality)): ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label"><?php echo e($FinishingQuality[0]->title); ?></label>
                                            <select name="finishingQualityUnitInfo-<?php echo e($objRef->unit_id); ?>" class="form-control">
                                                <option value="">--select One--</option>
                                                <?php $__currentLoopData = $FinishingQuality[0]->weightageCategoryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $finishingObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(isset($FinishingQualityText) && !empty($FinishingQualityText) && $FinishingQualityText[0]==$finishingObj->id): ?> selected="selected" <?php endif; ?> value="<?php echo e($finishingObj->id); ?>"><?php echo e($finishingObj->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(isset($Maintenance) && !empty($Maintenance)): ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label"><?php echo e($Maintenance[0]->title); ?></label>
                                            <select name="unitInfoMaintenance-<?php echo e($objRef->unit_id); ?>" class="form-control">
                                                <option value="">--select One--</option>
                                                <?php $__currentLoopData = $Maintenance[0]->weightageCategoryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $maintanceObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(isset($MaintenanceText) && !empty($MaintenanceText) && $MaintenanceText[0]==$maintanceObj->id): ?> selected="selected" <?php endif; ?> value="<?php echo e($maintanceObj->id); ?>"><?php echo e($maintanceObj->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(isset($Floorlevel) && !empty($Floorlevel)): ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label"><?php echo e($Floorlevel[0]->title); ?></label>
                                            <select name="unitInfoFloorLevel-<?php echo e($objRef->unit_id); ?>" class="form-control">
                                                <option value="">--select One--</option>
                                                <?php $__currentLoopData = $Floorlevel[0]->weightageCategoryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $floorObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(isset($FloorlevelText) && !empty($FloorlevelText) && $FloorlevelText[0]==$floorObj->id): ?> selected="selected" <?php endif; ?> value="<?php echo e($floorObj->id); ?>"><?php echo e($floorObj->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(isset($WeitageView) && !empty($WeitageView)): ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label"><?php echo e($WeitageView[0]->title); ?></label>
                                            <select name="unitInfoView-<?php echo e($objRef->unit_id); ?>" class="form-control">
                                                <option value="">--select One--</option>
                                                <?php $__currentLoopData = $WeitageView[0]->weightageCategoryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weightViewObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(isset($UnitInfoView) && !empty($UnitInfoView) && $UnitInfoView[0]==$weightViewObj->id): ?> selected="selected" <?php endif; ?> value="<?php echo e($weightViewObj->id); ?>"><?php echo e($weightViewObj->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                   
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Condition </label>
                                            <select name="unitInfoCondition-<?php echo e($objRef->unit_id); ?>" class="form-control">
                                                <option value="">--select One--</option>
                                                <option <?php if(isset($UnitInfoCondition) && !empty($UnitInfoCondition) && $UnitInfoCondition[0]=='Old'): ?> selected="selected" <?php endif; ?> value="Old">Old</option>
                                                <option <?php if(isset($UnitInfoCondition) && !empty($UnitInfoCondition) && $UnitInfoCondition[0]=='NewCondition'): ?> selected="selected" <?php endif; ?> value="NewCondition">New</option>
                                                <option <?php if(isset($UnitInfoCondition) && !empty($UnitInfoCondition) && $UnitInfoCondition[0]=='Renovated'): ?> selected="selected" <?php endif; ?> value="Renovated">Renovated</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Styling </label>
                                            <select name="unitInfoStyling-<?php echo e($objRef->unit_id); ?>" class="form-control">
                                                <option  value="">--select One--</option>
                                                <option <?php if(isset($UnitInfoStyling) && !empty($UnitInfoStyling) && $UnitInfoStyling[0]=='Modern'): ?> selected="selected" <?php endif; ?> value="Modern">Modern</option>
                                                <option <?php if(isset($UnitInfoStyling) && !empty($UnitInfoStyling) && $UnitInfoStyling[0]=='Antique'): ?> selected="selected" <?php endif; ?> value="Antique">Antique</option>
                                                <option <?php if(isset($UnitInfoStyling) && !empty($UnitInfoStyling) && $UnitInfoStyling[0]=='Classical'): ?> selected="selected" <?php endif; ?> value="Classical">Classical</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Unit Status</label>
                                            <select name="unitInfoStatus-<?php echo e($objRef->unit_id); ?>" class="form-control">
                                                <option value="">--select One--</option>
                                                <option <?php if(isset($UnitInfoStatus) && !empty($UnitInfoStatus) && $UnitInfoStatus[0]=='Vacant'): ?> selected="selected" <?php endif; ?> value="Vacant">Vacant</option>
                                                <option <?php if(isset($UnitInfoStatus) && !empty($UnitInfoStatus) && $UnitInfoStatus[0]=='Rented'): ?> selected="selected" <?php endif; ?> value="Rented">Rented</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Interior Status</label>
                                            <select name="unitInfoInteriorStatus-<?php echo e($objRef->unit_id); ?>" class="form-control">
                                                <option value="">--select One--</option>
                                                <option <?php if(isset($UnitInfoInteriorStatus)&& !empty($UnitInfoInteriorStatus) && $UnitInfoInteriorStatus[0]=='Furnished'): ?> selected="selected" <?php endif; ?> value="Furnished">Furnished</option>
                                                <option <?php if(isset($UnitInfoInteriorStatus)&& !empty($UnitInfoInteriorStatus) && $UnitInfoInteriorStatus[0]=='Semi Furnished'): ?> selected="selected" <?php endif; ?> value="Semi Furnished">Semi Furnished</option>
                                                <option <?php if(isset($UnitInfoInteriorStatus)&& !empty($UnitInfoInteriorStatus) && $UnitInfoInteriorStatus[0]=='Unfurnished'): ?> selected="selected" <?php endif; ?> value="Unfurnished">Unfurnished</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Floor</label>
                                            <input type="text" name="unitInfofloor-<?php echo e($objRef->unit_id); ?>"  <?php if(isset($UnitInfoFloor) && !empty($UnitInfoFloor) && !empty($UnitInfoFloor[0])): ?> value="<?php echo e($UnitInfoFloor[0]); ?>" <?php endif; ?> class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>
                                 
                            </div>
                        </div>
<!--                        UnitInfoFinancialInfo -->
                        <?php echo $__env->make('valuation::Admin.Property.PropertyFormInclude.FinancialInfoForUnitInfo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--                        UnitInfoFinancialInfo -->
                        <div class="tab-pane fade" id="UnitInfoImages-<?php echo e($objRef->unit_id); ?>" role="tabpanel">
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/evalupro/public_html/Modules/Valuation/Resources/views/Admin/Property/PropertyFormInclude/UnitInfo.blade.php ENDPATH**/ ?>