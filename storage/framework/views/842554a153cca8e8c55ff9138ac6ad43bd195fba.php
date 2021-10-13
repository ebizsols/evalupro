<div class="row">
    <?php
        // check valuator
           $isValuator = false;
           foreach ($project->members as $employeesIn){
               $roles = !empty($employeesIn->user->roles)?$employeesIn->user->roles:array();
               foreach ($roles as $role){
                   $roleName = $role->name ?? '';
                   if($roleName == 'Valuator'){
                       $isValuator = true;
                       break;
                   }
               }
           }
           if($isValuator == false){
          echo '<div class="alert alert-danger">Kindly select valuator!</div>';
           }
    ?>
</div>
<div class="white-box">
    <div class="row">
        <div class="col-md-11 p-r-0">
            <nav>
                <ul class="showProjectTabs">
                    <li class="projects">
                        <a href="<?php echo e(route('admin.projects.show', $project->id)); ?>"><i class="icon-grid"></i> <span><?php echo app('translator')->get('modules.projects.overview'); ?></span></a>
                    </li>
                    <li class="valuationMethodology">
                        <a href="<?php echo e(route('admin.valuation-method.show', $project->id)); ?>"><i class="icon-grid"></i> <span>Methodology</span></a>
                    </li>
                    <?php if(in_array('employees',$modules)): ?>
                        <li class="projectMembers">
                            <a href="<?php echo e(route('admin.project-members.show', $project->id)); ?>"><i class="icon-people"></i> <span><?php echo app('translator')->get('modules.projects.members'); ?></span></a>
                        </li>
                    <?php endif; ?>
                    <li class="projectMilestones">
                        <a href="<?php echo e(route('admin.milestones.show', $project->id)); ?>"><i class="icon-flag"></i> <span><?php echo app('translator')->get('modules.projects.milestones'); ?></span></a>
                    </li>
                    <?php if(in_array('tasks',$modules)): ?>
                        <li class="projectTasks">
                            <a href="<?php echo e(route('admin.tasks.show', $project->id)); ?>"><i class="ti-check-box"></i> <span><?php echo app('translator')->get('app.menu.tasks'); ?></span></a>
                        </li>
                        <li class="projectTaskBoard">
                            <a href="<?php echo e(route('admin.tasks.kanbanboard', $project->id)); ?>"><i class="ti-layout-column3"></i>
                                <span><?php echo app('translator')->get('modules.tasks.taskBoard'); ?></span></a>
                        </li>
                    <?php endif; ?>
                    <li class="projectReport">
                        <a href="<?php echo e(route('admin.report.show', $project->id)); ?>"><i class="ti-check-box"></i> <span>Report</span></a>
                    </li>
                    <li class="projectFiles">
                        <a href="<?php echo e(route('admin.files.show', $project->id)); ?>"><i class="ti-files"></i> <span><?php echo app('translator')->get('modules.projects.files'); ?></span></a>
                    </li>
                    <?php if(in_array('invoices',$modules)): ?>
                        <li class="projectInvoices">
                            <a href="<?php echo e(route('admin.invoices.show', $project->id)); ?>"><i class="ti-file"></i> <span><?php echo app('translator')->get('app.menu.invoices'); ?></span></a>
                        </li>
                    <?php endif; ?> <?php if(in_array('timelogs',$modules)): ?>
                        <li class="projectTimelogs">
                            <a href="<?php echo e(route('admin.time-logs.show', $project->id)); ?>"><i class="ti-alarm-clock"></i> <span><?php echo app('translator')->get('app.menu.timeLogs'); ?></span></a>
                        </li>
                    <?php endif; ?>
                    <li class="discussion">
                        <a href="<?php echo e(route('admin.projects.discussion', $project->id)); ?>"><i class="ti-comments"></i>
                            <span><?php echo app('translator')->get('modules.projects.discussion'); ?></span></a>
                    </li>

                </ul>
            </nav>
        </div>

        <div class="col-md-1 text-center tabs-more">
            <div class="btn-group dropdown m-r-10">
                 <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-gears "></i></button>
                <ul role="menu" class="dropdown-menu pull-right">
                <li><a href="<?php echo e(route('admin.projects.burndown-chart', $project->id)); ?>"><i class="icon-graph" aria-hidden="true"></i> <?php echo app('translator')->get('modules.projects.burndownChart'); ?></a>
                </li>
                <?php if(in_array('expenses',$modules)): ?>
                  <li><a href="<?php echo e(route('admin.project-expenses.show', $project->id)); ?>"><i class="ti-shopping-cart" aria-hidden="true"></i> <?php echo app('translator')->get('app.menu.expenses'); ?></a></li>
                <?php endif; ?>
    
                <?php if(in_array('payments',$modules)): ?>
                    <li><a href="<?php echo e(route('admin.project-payments.show', $project->id)); ?>"><i class="fa fa-money" aria-hidden="true"></i> <?php echo app('translator')->get('app.menu.payments'); ?></a></li>
                <?php endif; ?>

                <li class="gantt">
                    <a href="<?php echo e(route('admin.projects.gantt', $project->id)); ?>"><i class="fa fa-bar-chart"></i>
                        <span><?php echo app('translator')->get('modules.projects.viewGanttChart'); ?></span></a>
                </li>
                 <li class="projectRatings">
                     <a href="<?php echo e(route('admin.project-ratings.show', $project->id)); ?>">
                         <i class="fa fa-star" aria-hidden="true"></i> <span><?php echo app('translator')->get('app.rating'); ?></span>
                     </a>
                 </li>

                </ul>
            </div>
        </div>
    </div>
    
   
</div><?php /**PATH /home/evalupro/public_html/resources/views/admin/projects/show_project_menu.blade.php ENDPATH**/ ?>