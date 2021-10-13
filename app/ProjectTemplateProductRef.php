<?php

namespace App;

class ProjectTemplateProductRef extends BaseModel
{
    public $timestamps = false;

    public function projectTemplate()
    {
        return $this->belongsTo(ProjectTemplate::class, 'project_template_id');
    }

    public function projectTemplateProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
