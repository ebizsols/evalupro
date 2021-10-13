<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/metronic_plugin/css/datatables-bundle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/metronic_plugin/css/prismjs-bundle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/metronic_plugin/css/style-bundle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/metronic_plugin/css/plugins-bundle.css')); ?>">
<?php $__env->stopPush(); ?>
<div class="tab-pane fade" id="ObservationInfo">
    <div class="inner-panel-Main-div">
        <div class="panel panel-inverse">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body inner-panel-padding">
                    <div class="tabbable">
                        <ul class="nav nav-tabs wizard">
                            <li class="active"><a class="nav-link nav-item"
                                                  href="#EnvironmentalMattersTab"
                                                  data-toggle="tab"
                                                  aria-controls="EnvironmentalMattersTab"
                                                  aria-expanded="false">Environmental Matters</a>
                            </li>
                            <li><a href="#AssumptionsTab"
                                   class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="AssumptionsTab"
                                   aria-expanded="false">Assumptions</a></li>
                            <li><a href="#RelevantInformationTab"
                                   class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="RelevantInformationTab"
                                   aria-expanded="false">Relevant Information</a></li>
                            <li>
                                <a href="#PlanningPotentialTab"
                                   class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="PlanningPotentialTab"
                                   aria-expanded="false">Planning Potential</a>
                            </li>
                        </ul>

                    </div>


                    <div class="tab-content" id="myTabContent4">
                        <!---EnvironmentalMattersTab -->
                        <div class="tab-pane fade in active " id="EnvironmentalMattersTab"
                             role="tabpanel">
                            <div class="form-body">
                                <div class="row">
                                    <div class="pb-10">
                                        <button type="button" class="btn btn-primary" id="AddNewEnvirement">Add New Row</button>
                                    </div>
                                    <table id="enviromentTable" class="table table-striped table-row-bordered gy-5 gs-7">
                                        <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                        <th>Date</th>
                                                        <th>Type</th>
                                                        <th>Description</th>
                                                        <th>Staff</th>
                                                </tr>
                                        </thead>
                                        <tfoot>
                                            <?php if(isset($PropertyEnvirementalMatters) && !empty($PropertyEnvirementalMatters)): ?>
                                            
                                            <?php $__currentLoopData = $PropertyEnvirementalMatters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propertyEnvObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <th><input type="hidden" name="env_date[]" value="<?php echo e($propertyEnvObj['date']); ?>" ><?php echo e($propertyEnvObj['date']); ?></th>
                                                <th><input type="hidden" name="env_type[]" value="<?php echo e($propertyEnvObj['type']); ?>" ><?php echo e($propertyEnvObj['type']); ?></th>
                                                <th><input type="hidden" name="env_description[]" value="<?php echo e($propertyEnvObj['description']); ?>" ><?php echo e($propertyEnvObj['description']); ?></th>
                                                <th><input type="hidden" name="env_staff[]" value="<?php echo e($propertyEnvObj['staff']); ?>" ><?php echo e($propertyEnvObj['staff']); ?></th>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </tfoot>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                        <!---EnvironmentalMattersTab -->

                        <!---AssumptionsTab -->
                        <div class="tab-pane fade" id="AssumptionsTab">
                            <div class="form-body">
                                <div class="row">
                                   <div class="pb-10">
                                        <button  type="button" class="btn btn-primary" id="AddNewAssumptionBtn">Add New Row</button>
                                    </div>
                                    <table id="assumptionTable" class="table table-striped table-row-bordered gy-5 gs-7">
                                        <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                        <th>Date</th>
                                                        <th>Type</th>
                                                        <th>Assumption</th>
                                                        <th>Staff</th>
                                                </tr>
                                        </thead>
                                        <tfoot>
                                            <?php if(isset($PropertyAssumption) && !empty($PropertyAssumption)): ?>
                                            <?php $__currentLoopData = $PropertyAssumption; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assumpObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            
                                            <tr>
                                                <th><input type="hidden" name="ass_date[]" value="<?php echo e($assumpObj['date']); ?>"><?php echo e($assumpObj['date']); ?></th>
                                                <th><input type="hidden" name="assumption_type[]" value="<?php echo e($assumpObj['type']); ?>"><?php echo e($assumpObj['type']); ?></th>
                                                <th><input type="hidden" name="assumption_description[]" value="<?php echo e($assumpObj['description']); ?>"><?php echo e($assumpObj['description']); ?></th>
                                                <th><input type="hidden" name="assumption_staff[]" value="<?php echo e($assumpObj['staff']); ?>"><?php echo e($assumpObj['staff']); ?></th>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!---AssumptionsTab -->

                        <!---RelevantInformationTab -->
                        <div class="tab-pane fade" id="RelevantInformationTab">
                            <div class="form-body">
                                <div class="row">
                                    <div class="pb-10">
                                        <button type="button" class="btn btn-primary" id="AddNewRelventBtn">Add New Row</button>
                                    </div>
                                    <table id="relventTable" class="table table-striped table-row-bordered gy-5 gs-7">
                                        <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                        <th>Date</th>
                                                        <th>Type</th>
                                                        <th>Information</th>
                                                        <th>Staff</th>
                                                </tr>
                                        </thead>
                                        <tfoot>
                                            <?php if(isset($PropertyRelventInformation) && !empty($PropertyRelventInformation)): ?>
                                                <?php $__currentLoopData = $PropertyRelventInformation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relventObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <th><input type="hidden" name="relvent_date[]" value="<?php echo e($relventObj['date']); ?>"><?php echo e($relventObj['date']); ?></th>
                                                    <th><input type="hidden" name="relvent_type[]" value="<?php echo e($relventObj['type']); ?>"><?php echo e($relventObj['type']); ?></th>
                                                    <th><input type="hidden" name="relvent_description[]" value="<?php echo e($relventObj['description']); ?>"><?php echo e($relventObj['description']); ?></th>
                                                    <th><input type="hidden" name="relvent_staff[]" value="<?php echo e($relventObj['staff']); ?>"><?php echo e($relventObj['staff']); ?></th>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!---RelevantInformationTab -->
                        
                        <!--PlanningPotentialTab-->
                        <div class="tab-pane fade" id="PlanningPotentialTab">
                            <div class="form-body">
                                 <div class="pb-10">
                                        <button type="button" class="btn btn-primary" id="AddNewPlanningBtn">Add New Row</button>
                                    </div>
                                    <table id="planningTable" class="table table-striped table-row-bordered gy-5 gs-7">
                                        <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                        <th>Date</th>
                                                        <th>Category</th>
                                                        <th>Description</th>
                                                        <th>Staff</th>
                                                </tr>
                                        </thead>
                                        <tfoot>
                                            <?php if(isset($PropertyPlanningPotential) && !empty($PropertyPlanningPotential)): ?>
                                                <?php $__currentLoopData = $PropertyPlanningPotential; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planningObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <th><input type="hidden" name="planning_date[]" value="<?php echo e($planningObj['date']); ?>"><?php echo e($planningObj['date']); ?></th>
                                                    <th><input type="hidden" name="planning_type[]" value="<?php echo e($planningObj['type']); ?>"><?php echo e($planningObj['type']); ?></th>
                                                    <th><input type="hidden" name="planning_description[]" value="<?php echo e($planningObj['description']); ?>"><?php echo e($planningObj['description']); ?></th>
                                                    <th><input type="hidden" name="planning_staff[]" value="<?php echo e($planningObj['staff']); ?>"><?php echo e($planningObj['staff']); ?></th>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </tfoot>
                                    </table>
                            </div>
                        </div>
                        <!--PlanningPotentialTab-->
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
//AddOn cost
var enviromentTable = $("#enviromentTable").DataTable();
var enviromentCounter = 1;
var staffOption = '<?php echo json_encode($staffData, JSON_UNESCAPED_UNICODE );?>';
var staffOptionHtml=[];

jQuery.each(JSON.parse(staffOption), function(index,vaule) {
 staffOptionHtml.push('<option value="'+vaule.id+'">'+vaule.name+'</option>');
});
//var StaffOptionHtmlData=staffOptionHtml.join('');

$("#AddNewEnvirement").on("click", function() {
    enviromentTable.row.add([
        '<input type="date" name="env_date[]" class="form-control">',
        '<select name="env_type[]" class="form-control select2"><option value="Hazardous Materials">Hazardous Materials</option><option value="Natural Environmental">Natural Environmental</option><option value="Non-natural Constraints">Non-natural Constraints</option></select>',
        '<textarea name="env_description[]" class="form-control"></textarea>',
        '<select  class="form-control select2 " name="env_staff[]">'+staffOptionHtml+'</select>'
    ]).draw(false);
    enviromentCounter++;
});

var assumptionCounter=1;
var assumptionTable = $("#assumptionTable").DataTable();
$("#AddNewAssumptionBtn").on("click", function() {
    assumptionTable.row.add([
        '<input type="date" name="ass_date[]" class="form-control">',
        '<select name="assumption_type[]" class="form-control select2"><option value="option1">option1</option></select>',
        '<textarea name="assumption_description[]" class="form-control"></textarea>',
        '<select  class="form-control select2 " name="assumption_staff[]">'+staffOptionHtml+'</select>'
    ]).draw(false);
    assumptionCounter++;
});

var revelentCounter=1;
var relventTable = $("#relventTable").DataTable();
$("#AddNewRelventBtn").on("click", function() {
    relventTable.row.add([
        '<input type="date" name="relvent_date[]" class="form-control">',
        '<select name="relvent_type[]" class="form-control select2"><option value="option1">option1</option></select>',
        '<textarea name="relvent_description[]" class="form-control"></textarea>',
        '<select  class="form-control select2 " name="relvent_staff[]">'+staffOptionHtml+'</select>'
    ]).draw(false);
    revelentCounter++;
});

var planningCounter=1;
var planningTable = $("#planningTable").DataTable();
$("#AddNewPlanningBtn").on("click", function() {
    planningTable.row.add([
        '<input type="date" name="planning_date[]" class="form-control">',
        '<select name="planning_type[]" class="form-control select2"><option value="option1">option1</option></select>',
        '<textarea name="planning_description[]" class="form-control"></textarea>',
        '<select  class="form-control select2 " name="planning_staff[]">'+staffOptionHtml+'</select>'
    ]).draw(false);
    planningCounter++;
});

// Automatically add a first row of data
$("#AddNewEnvirement").click();
$("#AddNewAssumptionBtn").click();
$("#AddNewRelventBtn").click();
$("#AddNewPlanningBtn").click();
$(".select2").select2({
    formatNoMatches: function () {
        return "<?php echo e(__('messages.noRecordFound')); ?>";
    }
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH /home/evalupro/public_html/Modules/Valuation/Resources/views/Admin/Property/PropertyFormInclude/ObservationInfo.blade.php ENDPATH**/ ?>