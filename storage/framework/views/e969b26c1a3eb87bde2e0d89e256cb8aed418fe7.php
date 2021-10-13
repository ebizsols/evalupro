<div class="tab-pane fade" id="UnitInfo" role="tabpanel">
<div class="row">
        <table id="" class="table table-striped table-row-bordered gy-5 gs-7">
            <thead>
                    <tr class="fw-bold fs-6 text-gray-800">
                            <th>Title</th>
                            <th>Action</th>
                    </tr>
            </thead>
            <tbody>
               
                
                <?php if(isset($unitRefToProperty) && !empty($unitRefToProperty)): ?>
                <?php $__currentLoopData = $unitRefToProperty; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $objRef): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                 <?php
                   
                 $PropertyUnitObj=$objRef->getUnit;

                
            $unitType=($PropertyUnitObj != null)?optional($PropertyUnitObj->getMeta($PropertyUnitObj::UnitType.'-'.$objRef->unit_id , array()))->toArray():array();
            $NoOfBedroomText=($PropertyUnitObj != null)?optional($PropertyUnitObj->getMeta($PropertyUnitObj::NoOfBedroomText.'-'.$objRef->unit_id , array()))->toArray():array();
            $NoOfBathoomsText=($PropertyUnitObj != null)?optional($PropertyUnitObj->getMeta($PropertyUnitObj::NoOfBathoomsText.'-'.$objRef->unit_id , array()))->toArray():array();
            $FinishingQualityText=($PropertyUnitObj != null)?optional($PropertyUnitObj->getMeta($PropertyUnitObj::FinishingQualityText.'-'.$objRef->unit_id , array()))->toArray():array();
            $MaintenanceText=($PropertyUnitObj != null)?optional($PropertyUnitObj->getMeta($PropertyUnitObj::MaintenanceText.'-'.$objRef->unit_id , array()))->toArray():array();
            $FloorlevelText=($PropertyUnitObj != null)?optional($PropertyUnitObj->getMeta($PropertyUnitObj::FloorlevelText.'-'.$objRef->unit_id , array()))->toArray():array();
            $UnitInfoView=($PropertyUnitObj != null)?optional($PropertyUnitObj->getMeta($PropertyUnitObj::UnitInfoView.'-'.$objRef->unit_id , array()))->toArray():array();
            $UnitInfoCondition=($PropertyUnitObj != null)?optional($PropertyUnitObj->getMeta($PropertyUnitObj::UnitInfoCondition.'-'.$objRef->unit_id , array()))->toArray():array();
            $UnitInfoStyling=($PropertyUnitObj != null)?optional($PropertyUnitObj->getMeta($PropertyUnitObj::UnitInfoStyling.'-'.$objRef->unit_id , array()))->toArray():array();
            $UnitInfoStatus=($PropertyUnitObj != null)?optional($PropertyUnitObj->getMeta($PropertyUnitObj::UnitInfoStatus.'-'.$objRef->unit_id , array()))->toArray():array();
            $UnitInfoInteriorStatus=($PropertyUnitObj != null)?optional($PropertyUnitObj->getMeta($PropertyUnitObj::UnitInfoInteriorStatus.'-'.$objRef->unit_id , array()))->toArray():array();
            $UnitInfoFloor=($PropertyUnitObj != null)?optional($PropertyUnitObj->getMeta($PropertyUnitObj::UnitInfoFloor.'-'.$objRef->unit_id , array()))->toArray():array();
                
                
                ?>
                <tr>
                    <td><?php echo e($objRef->getUnit->title); ?></td>
                    <td><a onclick="loadTabSub('unitInfotr-<?php echo e($objRef->unit_id); ?>')" class="btn btn-primary" href="javascript:void(0)" >Add Info</a></td>
                     
                </tr>
                <tr id="unitInfotr-<?php echo e($objRef->unit_id); ?>" >
                    <td colspan="2" >
                        <?php echo $__env->make('valuation::Admin.Property.PropertyFormInclude.UnitInfo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>
</div>
</div>
<script>
function loadTabSub(trId)
{
    $('#'+trId).toggle();
}
</script><?php /**PATH /home/evalupro/public_html/Modules/Valuation/Resources/views/Admin/Property/PropertyFormInclude/UnitRefInfo.blade.php ENDPATH**/ ?>