@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/datatables-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/prismjs-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/style-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/plugins-bundle.css') }}">
<style>
    .currency
    {
        width: 20% !important;
        display: inherit !important;
        position: relative !important;
    }
    .price
    {
        display: inline !important;
        position: absolute !important;
        width: 14% !important;
    }
</style>
@endpush
<div class="tab-pane fade" id="UnitInfoFincialInfo-{{$objRef->unit_id}}">
    <div class="inner-panel-Main-div">
        <div class="panel panel-inverse">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body inner-panel-padding">
                    <div class="tabbable">
                        <ul class="nav nav-tabs wizard">
                            <li class="active"><a class="nav-link nav-item"
                                                  href="#FinancialInfoAcquisitionCostUnitInfo-{{$objRef->unit_id}}"
                                                  data-toggle="tab"
                                                  aria-controls="FinancialInfoAcquisitionCostUnitInfo-{{$objRef->unit_id}}"
                                                  aria-expanded="false">Acquisition Cost</a>
                            </li>
                            <li><a href="#FinancialInfoAddOnCostsUnitInfo-{{$objRef->unit_id}}"
                                   class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="FinancialInfoAddOnCostsUnitInfo-{{$objRef->unit_id}}"
                                   aria-expanded="false">Add-on costs</a></li>
                            <li><a href="#FinancialInfoIncomeUnitInfo-{{$objRef->unit_id}}"
                                   class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="FinancialInfoIncomeUnitInfo-{{$objRef->unit_id}}"
                                   aria-expanded="false">Income</a></li>
                            <li><a href="#FinancialInfoValueUnitInfo-{{$objRef->unit_id}}"
                                   class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="FinancialInfoValueUnitInfo-{{$objRef->unit_id}}"
                                   aria-expanded="false">Value</a></li>
                        </ul>

                    </div>


                    <div class="tab-content" id="myTabContentForUnitInfoFincialInfo-{{$objRef->unit_id}}">
                        <!---FinancialInfoAcquisitionCostUnitInfo -->
                        <div class="tab-pane fade in active " id="FinancialInfoAcquisitionCostUnitInfo-{{$objRef->unit_id}}"
                             role="tabpanel">
                            <div class="form-body">
                                <div class="row">
                                    <div class="pb-10">
                                        <button type="button" class="btn btn-primary" id="kt_datatable_example_1_addrowUnitInfo-{{$objRef->unit_id}}">Add New Row</button>
                                    </div>
                                    <table id="kt_datatable_example_1UnitInfo-{{$objRef->unit_id}}" class="table table-striped table-row-bordered gy-5 gs-7">
                                        <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                        <th>Date</th>
                                                        <th>Transaction Type</th>
                                                        <th>Details/Ref</th>
                                                        <th>Price/Cost</th>
                                                </tr>
                                        </thead>
                                        <tfoot>
                                            @if(isset($financialAcquisitionCost) && !empty($financialAcquisitionCost))
                                             @foreach($financialAcquisitionCost as $acquisitionCost)
                                                <tr>
                                                    <th><input type="hidden" name="aqu_Date_unit_info-{{$objRef->unit_id}}[]" value="{{$acquisitionCost['date']}}"> {{$acquisitionCost['date']}}</th>
                                                    <th><input type="hidden" name="aqu_transection_type_unit_info-{{$objRef->unit_id}}[]" value="{{$acquisitionCost['trnsectionType']}}">{{$acquisitionCost['trnsectionType']}}</th>
                                                    <th><input type="hidden" name="aqu_description_unit_info-{{$objRef->unit_id}}[]" value="{{$acquisitionCost['description']}}">{{$acquisitionCost['description']}}</th>
                                                    <th><input type="hidden" name="currencyCode_unit_info-{{$objRef->unit_id}}[]" value="{{$acquisitionCost['currencyCode']}}"><input type="hidden" name="acqlandPrice_unit_info-{{$objRef->unit_id}}[]" value="{{$acquisitionCost['price']}}">{{$acquisitionCost['currencyCode'].' '.$acquisitionCost['price']}}</th>
                                                </tr>
                                                @endforeach
                                                @endif
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!---FinancialInfoAcquisitionCostUnitInfo -->


                        <!---FinancialInfoAddOnCostsUnitInfo -->
                        <div class="tab-pane fade" id="FinancialInfoAddOnCostsUnitInfo-{{$objRef->unit_id}}">
                            <div class="form-body">
                                <div class="row">
                                    <div class="pb-10">
                                        <button  type="button" class="btn btn-primary" id="FinancialInfoAddOnCostAddBtnUnitInfo-{{$objRef->unit_id}}">Add New Row</button>
                                    </div>
                                    <table id="AddOnCostTableUnitInfo-{{$objRef->unit_id}}" class="table table-striped table-row-bordered gy-5 gs-7">
                                        <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                        <th>Date</th>
                                                        <th>Transaction Type</th>
                                                        <th>Details/Ref</th>
                                                        <th>Price/Cost</th>
                                                </tr>
                                        </thead>
                                        <tfoot>
                                            @if(isset($financialAddonCost) && !empty($financialAddonCost))
                                            @php 
                                            $addonTotal=0;
                                            @endphp
                                             @foreach($financialAddonCost as $financialAddonCostObj)
                                            @php
                                            $addonTotal=$addonTotal+$financialAddonCostObj['price'];
                                            @endphp
                                                <tr>
                                                    <th><input type="hidden" name="addon_cost_Date_unit_info-{{$objRef->unit_id}}[]" value="{{$financialAddonCostObj['date']}}"> {{$financialAddonCostObj['date']}}</th>
                                                        <th> <input type="hidden" name="addon_transection_type_unit_info-{{$objRef->unit_id}}[]" value="{{$financialAddonCostObj['trnsectionType']}}">{{$financialAddonCostObj['trnsectionType']}}</th>
                                                        <th> <input type="hidden" name="addon_description_unit_info-{{$objRef->unit_id}}[]" value="{{$financialAddonCostObj['description']}}">{{$financialAddonCostObj['description']}}</th>
                                                        <th> <input type="hidden" name="addonCurrencyCode_unit_info-{{$objRef->unit_id}}[]" value="{{$financialAddonCostObj['currencyCode']}}"><input type="hidden" name="addonPrice_unit_info-{{$objRef->unit_id}}[]" value="{{$financialAddonCostObj['price']}}">{{$financialAddonCostObj['currencyCode'].' '.$financialAddonCostObj['price']}}</th>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <th colspan="3"><b>Total</b></th>
                                                    <th><b>{{$currencyCode.' '.$addonTotal}}</b></th>
                                                </tr>
                                                @endif
                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!---FinancialInfoAddOnCostsUnitInfo -->
                        
                        <!---FinancialInfoIncomeUnitInfo -->
                        <div class="tab-pane fade" id="FinancialInfoIncomeUnitInfo-{{$objRef->unit_id}}">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Rental income</label>
                                            <input type="number" name="rentalIncomeUnitInfo-{{$objRef->unit_id}}" id="rentalIncomeUnitInfo-{{$objRef->unit_id}}" value="{{isset($rentalIncome)?$rentalIncome:0.00}}"
                                                   class="form-control priceField"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="pb-10">
                                        <button type="button" class="btn btn-primary" id="FinancialInfoIncomeAddBtnUnitInfo-{{$objRef->unit_id}}">Add New Row</button>
                                    </div>
                                    <table id="IncomeTableUnitInfo-{{$objRef->unit_id}}" class="table table-striped table-row-bordered gy-5 gs-7">
                                        <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                        <th>Date</th>
                                                        <th>Transaction Type</th>
                                                        <th>Details/Ref</th>
                                                        <th>Price/Cost</th>
                                                </tr>
                                        </thead>
                                        <tfoot>
                                            @if(isset($StructureInfoIncome) && !empty($StructureInfoIncome))
                                             @foreach($StructureInfoIncome as $StructureInfoIncomeObj)
                                                <tr>
                                                    <th><input type="hidden" name="income_date_structure_info[]" value="{{$StructureInfoIncomeObj['date']}}"> {{$StructureInfoIncomeObj['date']}}</th>
                                                        <th> <input type="hidden" name="type_structure_info[]" value="{{$StructureInfoIncomeObj['trnsectionType']}}">{{$StructureInfoIncomeObj['trnsectionType']}}</th>
                                                        <th> <input type="hidden" name="income_description_structure_info[]" value="{{$StructureInfoIncomeObj['description']}}">{{$StructureInfoIncomeObj['description']}}</th>
                                                        <th> <input type="hidden" name="incomeCurrencyCode_structure_info[]" value="{{$StructureInfoIncomeObj['currencyCode']}}"><input type="hidden" name="incomePrice_structure_info[]" value="{{$StructureInfoIncomeObj['price']}}">{{$financialAddonCostObj['currencyCode'].' '.$financialAddonCostObj['price']}}</th>
                                                </tr>
                                                @endforeach
                                                @endif
                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!---FinancialInfoIncomePropertyInfo -->

                        <!---FinancialInfoValuePropertyInfo -->
                        <div class="tab-pane fade" id="FinancialInfoValueUnitInfo-{{$objRef->unit_id}}">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Estimated value</label>
                                            <input type="number" name="estimatedValueUnitInfo-{{$objRef->unit_id}}" id="estimatedValueUnitInfo-{{$objRef->unit_id}}" value="{{isset($estimatedValue)?$estimatedValue:0.00}}"
                                                   class="form-control priceField"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                         <div class="form-group">
                                            <label class="control-label">Residual Value</label>
                                            <input type="text" name="residual_value_for_UnitInfo-{{$objRef->unit_id}}" class="form-control priceField" value="">
                                         </div>
                                    </div>
                                     <div class="col-md-4">
                                         <div class="form-group">
                                            <label class="control-label">Depicted Value</label>
                                            <input type="text" name="depicted_value_for_UnitInfo-{{$objRef->unit_id}}" class="form-control priceField" value="">
                                         </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                         <div class="form-group">
                                            <label class="control-label">Cost Of Construction</label>
                                            <input type="text" name="cost_construction_for_UnitInfo-{{$objRef->unit_id}}" class="form-control priceField" value="">
                                         </div>
                                    </div>
                                    <div class="col-md-4">
                                         <div class="form-group">
                                            <label class="control-label">Income Base Value</label>
                                            <input type="text" name="incomebasevalue_for_UnitInfo-{{$objRef->unit_id}}" class="form-control priceField" value="">
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---FinancialInfoValueUnitInfo -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@push('footer-script')
<script src="{{ asset('plugins/metronic_plugin/js/datatables-bundle.js') }}"></script>
<script src="{{ asset('plugins/metronic_plugin/js/prismjs-bundle.js') }}"></script>

<script>
    $(function() {
    let tUnitInfo = $("#kt_datatable_example_1UnitInfo-{{$objRef->unit_id}}").DataTable();
let counterUnitInfo = 1;

$("#kt_datatable_example_1_addrowUnitInfo-{{$objRef->unit_id}}").on("click", function() {
    tUnitInfo.row.add([
        '<input type="date" name="aqu_Date_unit_info-{{$objRef->unit_id}}[]" class="form-control">',
        '<select name="aqu_transection_type_unit_info-{{$objRef->unit_id}}[]" class="form-control transectionType"><option value="land">Land</option></select>',
        '<textarea name="aqu_description_unit_info-{{$objRef->unit_id}}[]" class="form-control"></textarea>',
        '<input type="text" readonly="" class="form-control currency" name="currencyCode_unit_info-{{$objRef->unit_id}}[]" value="{{$currencyCode}}"><input type="number" name="acqlandPrice_unit_info-{{$objRef->unit_id}}[]" class="price form-control">'
    ]).draw(false);

    counterUnitInfo++;
});


//AddOn cost
let AddOnCostTableUnitInfo = $("#AddOnCostTableUnitInfo-{{$objRef->unit_id}}").DataTable();
let AddOnCounterUnitInfo = 1;
$("#FinancialInfoAddOnCostAddBtnUnitInfo-{{$objRef->unit_id}}").on("click", function() {
    AddOnCostTableUnitInfo.row.add([
        '<input type="date" name="addon_cost_Date_unit_info-{{$objRef->unit_id}}[]" class="form-control">',
        '<select name="addon_transection_type_unit_info-{{$objRef->unit_id}}[]" class="form-control transectionType"><option value="land">Land</option></select>',
        '<textarea name="addon_description_unit_info-{{$objRef->unit_id}}[]" class="form-control"></textarea>',
        '<input type="text" readonly="" class="form-control currency" name="addonCurrencyCode_unit_info-{{$objRef->unit_id}}[]" value="{{$currencyCode}}"><input type="number" name="addonPrice_unit_info-{{$objRef->unit_id}}[]" class="price form-control">'
    ]).draw(false);
    AddOnCounterUnitInfo++;
});

//Income
let IncomeTableUnitInfo = $("#IncomeTableUnitInfo-{{$objRef->unit_id}}").DataTable();
let IncomeCounterUnitInfo = 1;
$("#FinancialInfoIncomeAddBtnUnitInfo-{{$objRef->unit_id}}").on("click", function() {
    IncomeTableUnitInfo.row.add([
        '<input type="date" name="income_date_structure_info-{{$objRef->unit_id}}[]" class="form-control">',
        '<select name="type_structure_info-{{$objRef->unit_id}}[]" class="form-control transectionType"><option value="land">Land</option></select>',
        '<textarea name="income_description_structure_info-{{$objRef->unit_id}}[]" class="form-control"></textarea>',
        '<input type="text" readonly="" class="form-control currency" name="incomeCurrencyCode_structure_info-{{$objRef->unit_id}}[]" value="{{$currencyCode}}"><input type="number" name="incomePrice_structure_info-{{$objRef->unit_id}}[]" class="price form-control">'
    ]).draw(false);
    IncomeCounterUnitInfo++;
});

});

// Automatically add a first row of data
$("#kt_datatable_example_1_addrowUnitInfo-{{$objRef->unit_id}}").click();
$("#FinancialInfoAddOnCostAddBtnUnitInfo-{{$objRef->unit_id}}").click();
$("#FinancialInfoIncomeAddBtnUnitInfo-{{$objRef->unit_id}}").click();
/*$(".transectionType").select2({
    formatNoMatches: function () {
        return "{{ __('messages.noRecordFound') }}";
    }
    });*/
</script>
@endpush

