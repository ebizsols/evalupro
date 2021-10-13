<div class="white-box">
    <nav>
        <ul class="showProjectTemplateTabs">
            <li class="projectTemplate"><a
                        href="{{ route('admin.project-template.show', $project->id) }}"><span>@lang('modules.projects.overview')</span></a>
            </li>
            @if(in_array('employees',$modules))
                <li class="projectTemplateMember">
                    <a href="{{ route('admin.project-template-member.show', $project->id) }}"><span>@lang('modules.projects.members')</span></a>
                </li>
            @endif
            <li class="projectTemplateMilestone">
                <a href="{{ route('admin.project-template-milestone.show', $project->id) }}"><span>@lang('modules.projects.milestones')</span></a>
            </li>

            @if(in_array('tasks',$modules))
                <li class="projectTemplateTask">
                    <a href="{{ route('admin.project-template-task.show', $project->id) }}"><span>@lang('app.menu.tasks')</span></a>
                </li>
            @endif


            <li class="projectTemplateProduct">
                <a href="{{ route('admin.project-template-product.show', $project->id) }}"><span>@lang('app.menu.products')</span></a>
            </li>

        </ul>
    </nav>
</div>