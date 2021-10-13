<?php


namespace App\Http\Controllers\Admin;

use App\Product;
use App\ProductCategory;
use App\ProductSubCategory;
use App\ProjectTemplate;
use App\ProjectTemplateProductRef;
use App\Helper\Reply;
use Illuminate\Http\Request;
use App\Currency;

class ProjectTemplateProductController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'app.menu.projects';
        $this->pageIcon = 'icon-layers';
        $this->middleware(function ($request, $next) {
            if (!in_array('projects', $this->user->modules)) {
                abort(403);
            }
            return $next($request);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->products = Product::all();
        $this->categories = ProductCategory::all();
        $this->subCategories = ProductSubCategory::all();
        $this->project = ProjectTemplate::findorFail($id);

        $projectTemplateProductRefObj = new ProjectTemplateProductRef();
        $projectTemplateProductRefData = $projectTemplateProductRefObj->where('project_template_id', '=', $id)->first();

        $selectedProductData = isset($projectTemplateProductRefData->projectTemplateProduct)?$projectTemplateProductRefData->projectTemplateProduct:null;
        $selectedPropertyTypeObj = isset($selectedProductData->getPropertyType)?$selectedProductData->getPropertyType:null;
        $selectedPropertyType = isset($selectedPropertyTypeObj->title)?$selectedPropertyTypeObj->title:'Property type not selected';
        $this->productId = isset($selectedProductData->id)?$selectedProductData->id:0;
        $this->price = isset($selectedProductData->price)?$selectedProductData->price:0;

        $selectedProductDataCategory = isset($selectedProductData->category)?$selectedProductData->category:null;
        $selectedProductDataSubCategory = isset($selectedProductData->subcategory)?$selectedProductData->subcategory:null;
        $this->category = isset($selectedProductDataCategory->category_name)?$selectedProductDataCategory->category_name:'';
        $this->subCategory = isset($selectedProductDataSubCategory->category_name)?$selectedProductDataSubCategory->category_name:'';;
        $this->selectedPropertyType = $selectedPropertyType;

        $this->projectTemplateProductRefData = $projectTemplateProductRefData;

        $this->project = ProjectTemplate::findorFail($id);
        $this->currencies = Currency::all();
        return view('admin.project-template.products.show', $this->data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $propertyId = $request->product_id;
        $propertyProjectTemplateId = $request->project_template_id;

        //check and delete if exist
        $projectTemplateProductRefObj = new ProjectTemplateProductRef();
        $projectTemplateProductRefObj->where('project_template_id', '=',  $id)->delete();

        $projectTemplateProductRef = new ProjectTemplateProductRef();
        $projectTemplateProductRef->project_template_id = $propertyProjectTemplateId;
        $projectTemplateProductRef->product_id = $propertyId;
        $projectTemplateProductRef->save();

        return Reply::redirect(route('admin.project-template-product.show', $propertyProjectTemplateId), __('Save Successfully') );
    }

}