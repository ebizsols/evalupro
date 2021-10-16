<?php

namespace App\Http\Controllers\Admin;

use App\Project;
use App\ValuationInspection;
use App\ValuationInspectionField;


class ManageProjectValuationInspectionController extends AdminBaseController
{

    private $dataRoute = 'admin.valuation-inspection.data';

    public function __construct()
    {
        parent::__construct();
        $this->pageIcon = 'icon-layers';
        $this->pageTitle = 'app.menu.projects';
    }

    public function __customConstruct(&$data)
    {
        //assign routes for views
        $data['dataRoute'] = $this->dataRoute;
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->__customConstruct($this->data);
        $this->projectId = $id;
        $project = Project::findOrFail($id);
        $this->project = $project;

        $valuationInspectionFields = array();

        $valuationInspectionModel = new ValuationInspection();
        $valuationInspectionData = $valuationInspectionModel->where('project_id', $id)->orderBy('id', 'desc')->first();

        if (isset($valuationInspectionData->id) && $valuationInspectionData->id > 0) {

            $valuationInspectionModel = new ValuationInspectionField();
            $valuationInspectionFields = $valuationInspectionModel->where('valuation_inspection_id', $valuationInspectionData->id)->orderBy('id', 'desc')->get()->toArray();
            
            if (!empty($valuationInspectionFields)) {
                foreach ($valuationInspectionFields as $key => $valuationInspectionField) {

                    // Replacing value with option title
                    $value = $valuationInspectionField['field_value'];
                    if (isset($valuationInspectionField['field_data']) && $valuationInspectionField['field_data'] != '') {
                        $fieldData = json_decode($valuationInspectionField['field_data'], true);

                        if (isset($fieldData['fieldProperties']['option']) && !empty($fieldData['fieldProperties']['option'])) {
                            $fieldOptions = $fieldData['fieldProperties']['option'];
                            foreach ($fieldOptions as $fieldOption) {

                                if (isset($fieldOption['value']) && $fieldOption['value'] == $value) {

                                    $valuationInspectionFields[$key]['field_value'] = $fieldOption['title'];
                                }
                            }
                        }
                    }
                }

            }


        }

        $this->valuationInspectionFields = $valuationInspectionFields;

        return view('admin.projects.ValuationInspection.show', $this->data);
    }

}
