<?php

namespace App\Observers;

use App\ProjectTemplateMilestone;

class ProjectTemplateMilestoneObserver
{

    public function saving(ProjectTemplateMilestone $milestone)
    {
        // Cannot put in creating, because saving is fired before creating. And we need company id for check bellow
        if (company()) {
            $milestone->company_id = company()->id;
        }
    }

}
