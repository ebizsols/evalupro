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
<div class="tab-pane fade" id="FincialInfoForPropertyInfoTab">
    <div class="inner-panel-Main-div">
        <div class="panel panel-inverse">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body inner-panel-padding">
                    <div class="tabbable">
                        <ul class="nav nav-tabs wizard">
                            <li class="active"><a class="nav-link nav-item"
                                                  href="#FinancialInfoAcquisitionCostPropertyInfo"
                                                  data-toggle="tab"
                                                  aria-controls="FinancialInfoAcquisitionCostPropertyInfo"
                                                  aria-expanded="false">Acquisition Cost</a>
                            </li>
                            <li><a href="#FinancialInfoAddOnCostsPropertyInfo"
                                   class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="FinancialInfoAddOnCostsPropertyInfo"
                                   aria-expanded="false">Add-on costs</a></li>
                            <li><a href="#FinancialInfoIncomePropertyInfo"
                                   class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="FinancialInfoIncomePropertyInfo"
                                   aria-expanded="false">Income</a></li>
                            <li><a href="#FinancialInfoValuePropertyInfo"
                                   class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="FinancialInfoValuePropertyInfo"
                                   aria-expanded="false">Value</a></li>
                        </ul>

                    </div>


                    <div class="tab-content" id="myTabContentForPropertyInfo">
                        <!---FinancialInfoAcquisitionCostPropertyInfo -->
                        <div class="tab-pane fade in active " id="FinancialInfoAcquisitionCostPropertyInfo"
                             role="tabpanel">
                            <div class="form-body">
                                <div class="row">
                                    <div class="pb-10">
                                        <button type="button" class="btn btn-primary" id="kt_datatable_example_1_addrowPropertyInfo">Add New Row</button>
                                    </div>
                                    <table id="kt_datatable_example_1PropertyInfo" class="table table-striped table-row-bordered gy-5 gs-7">
                                        <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                        <th>Date</th>
                                                        <th>Transaction Type</th>
                                                        <th>Details/Ref</th>
                                                        <th>Price/Cost</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($AcquisitionCostPropertyInfo) && !empty($AcquisitionCostPropertyInfo))
                                             @foreach($AcquisitionCostPropertyInfo as $acquisitionCostPropertyInfoObj)
                                                <tr>
                                                    <th><input type="hidden" name="aqu_Date_properyInfoTab[]" value="{{$acquisitionCostPropertyInfoObj['date']}}"> {{$acquisitionCostPropertyInfoObj['date']}}</th>
                                                    <th><input type="hidden" name="aqu_transection_type_properyInfoTab[]" value="{{$acquisitionCostPropertyInfoObj['trnsectionType']}}">{{$acquisitionCostPropertyInfoObj['trnsectionType']}}</th>
                                                    <th><input type="hidden" name="aqu_description_properyInfoTab[]" value="{{$acquisitionCostPropertyInfoObj['description']}}">{{$acquisitionCostPropertyInfoObj['description']}}</th>
                                                    <th><input type="hidden" name="currencyCode_properyInfoTab[]" value="{{$acquisitionCostPropertyInfoObj['currencyCode']}}"><input type="hidden" name="acqlandPrice_properyInfoTab[]" value="{{$acquisitionCostPropertyInfoObj['price']}}">{{$acquisitionCostPropertyInfoObj['currencyCode'].' '.$acquisitionCostPropertyInfoObj['price']}}</th>
                                                </tr>
                                                @endforeach
                                                @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!---FinancialInfoAcquisitionCostPropertyInfo -->


                        <!---FinancialInfoAddOnCostsPropertyInfo -->
                        <div class="tab-pane fade" id="FinancialInfoAddOnCostsPropertyInfo">
                            <div class="form-body">
                                <div class="row">
                                    <div class="pb-10">
                                        <button type="button" class="btn btn-primary" id="FinancialInfoAddOnCostAddBtnPropertyInfo">Add New Row</button>
                                    </div>
                                    <table id="AddOnCostTablePropertyInfo" class="table table-striped table-row-bordered gy-5 gs-7">
                                        <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                        <th>Date</th>
                                                        <th>Transaction Type</th>
                                                        <th>Details/Ref</th>
                                                        <th>Price/Cost</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($PropertyInfoAddOnCost) && !empty($PropertyInfoAddOnCost))
                                             @foreach($PropertyInfoAddOnCost as $PropertyInfoAddOnCostObj)
                                                <tr>
                                                    <th><input type="hidden" name="addon_cost_Date_property_info[]" value="{{$PropertyInfoAddOnCostObj['date']}}"> {{$PropertyInfoAddOnCostObj['date']}}</th>
                                                        <th> <input type="hidden" name="addon_transection_type_property_info[]" value="{{$PropertyInfoAddOnCostObj['trnsectionType']}}">{{$PropertyInfoAddOnCostObj['trnsectionType']}}</th>
                                                        <th> <input type="hidden" name="addon_description_property_info[]" value="{{$PropertyInfoAddOnCostObj['description']}}">{{$PropertyInfoAddOnCostObj['description']}}</th>
                                                        <th> <input type="hidden" name="addonCurrencyCode_property_info[]" value="{{$PropertyInfoAddOnCostObj['currencyCode']}}"><input type="hidden" name="addonPrice_property_info[]" value="{{$PropertyInfoAddOnCostObj['price']}}">{{$PropertyInfoAddOnCostObj['currencyCode'].' '.$PropertyInfoAddOnCostObj['price']}}</th>
                                                </tr>
                                                @endforeach
                                                @endif
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!---FinancialInfoAddOnCostsPropertyInfo -->
                        
                       
                        
                        <!---FinancialInfoIncomePropertyInfo -->
                        <div class="tab-pane fade" id="FinancialInfoIncomePropertyInfo">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Rental income</label>
                                            <input type="number" name="rentalIncomePropertyInfo" id="rentalIncomePropertyInfo" value="{{isset($RentalIncomePropertyInfoMeta)?$RentalIncomePropertyInfoMeta[0]:'0'}}"
                                                   class="form-control priceField"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="pb-10">
                                        <button type="button" class="btn btn-primary" id="FinancialInfoIncomeAddBtnPropertyInfo">Add New Row</button>
                                    </div>
                                    <table id="IncomeTablePropertyInfo" class="table table-striped table-row-bordered gy-5 gs-7">
                                        <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                        <th>Date</th>
                                                        <th>Transaction Type</th>
                                                        <th>Details/Ref</th>
                                                        <th>Price/Cost</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($PropertyInfoIncome) && !empty($PropertyInfoIncome))
                                             @foreach($PropertyInfoIncome as $PropertyInfoIncomeObj)
                                                <tr>
                                                    <th><input type="hidden" name="income_date_property_info[]" value="{{$PropertyInfoIncomeObj['date']}}"> {{$PropertyInfoIncomeObj['date']}}</th>
                                                        <th> <input type="hidden" name="type_property_info[]" value="{{$PropertyInfoIncomeObj['trnsectionType']}}">{{$PropertyInfoIncomeObj['trnsectionType']}}</th>
                                                        <th> <input type="hidden" name="income_description_property_info[]" value="{{$PropertyInfoIncomeObj['description']}}">{{$PropertyInfoIncomeObj['description']}}</th>
                                                        <th> <input type="hidden" name="incomeCurrencyCode_property_info[]" value="{{$PropertyInfoIncomeObj['currencyCode']}}"><input type="hidden" name="incomePrice_property_info[]" value="{{$PropertyInfoIncomeObj['price']}}">{{$PropertyInfoIncomeObj['currencyCode'].' '.$PropertyInfoIncomeObj['price']}}</th>
                                                </tr>
                                                @endforeach
                                                @endif
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!---FinancialInfoIncomePropertyInfo -->

                        <!---FinancialInfoValuePropertyInfo -->
                        <div class="tab-pane fade" id="FinancialInfoValuePropertyInfo">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Estimated value</label>
                                            <input type="number" name="estimatedValuePropertyInfo" id="estimatedValuePropertyInfo" value="{{isset($EstimatedValuePropertyInfoMeta)?$EstimatedValuePropertyInfoMeta[0]:'0'}}"
                                                   class="form-control priceField"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                         <div class="form-group">
                                            <label class="control-label">Residual Value</label>
                                            <input type="text" name="residual_value_for_property_info" class="form-control priceField" value="{{isset($ResidualValueForPropertyInfoMeta)?$ResidualValueForPropertyInfoMeta[0]:'0'}}">
                                         </div>
                                    </div>
                                     <div class="col-md-4">
                                         <div class="form-group">
                                            <label class="control-label">Depicted Value</label>
                                            <input type="text" name="depicted_value_for_property_info" class="form-control priceField" value="{{isset($DepictedValueForPropertyInfoMeta)?$DepictedValueForPropertyInfoMeta[0]:'0'}}">
                                         </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                         <div class="form-group">
                                            <label class="control-label">Cost Of Construction</label>
                                            <input type="text" name="cost_construction_for_property_info" class="form-control priceField" value="{{isset($CostOfConstructionValueForPropertyInfoMeta)?$CostOfConstructionValueForPropertyInfoMeta[0]:'0'}}">
                                         </div>
                                    </div>
                                    <div class="col-md-4">
                                         <div class="form-group">
                                            <label class="control-label">Income Base Value</label>
                                            <input type="text" name="incomebasevalue_for_property_info" class="form-control priceField" value="{{isset($IncomeBaseValueForPropertyInfoMeta)?$IncomeBaseValueForPropertyInfoMeta[0]:'0'}}">
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---FinancialInfoValuePropertyInfo -->
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
var tPropertyInfo = $("#kt_datatable_example_1PropertyInfo").DataTable();
var counterPropertyInfo = 1;

$("#kt_datatable_example_1_addrowPropertyInfo").on("click", function() {
    tPropertyInfo.row.add([
        '<input type="date" name="aqu_Date_properyInfoTab[]" class="form-control">',
        '<select name="aqu_transection_type_properyInfoTab[]" class="form-control transectionType"><option value="land">Land</option></select>',
        '<textarea name="aqu_description_properyInfoTab[]" class="form-control"></textarea>',
        '<input type="text" readonly="" class="form-control currency" name="currencyCode_properyInfoTab[]" value="{{$currencyCode}}"><input type="number" name="acqlandPrice_properyInfoTab[]" class="price form-control">'
    ]).draw(false);

    counterPropertyInfo++;
});


//AddOn cost
var AddOnCostTablePropertyInfo = $("#AddOnCostTablePropertyInfo").DataTable();
var AddOnCounterPropertyInfo = 1;
$("#FinancialInfoAddOnCostAddBtnPropertyInfo").on("click", function() {
    AddOnCostTablePropertyInfo.row.add([
        '<input type="date" name="addon_cost_Date_property_info[]" class="form-control">',
        '<select name="addon_transection_type_property_info[]" class="form-control transectionType"><option value="land">Land</option></select>',
        '<textarea name="addon_description_property_info[]" class="form-control"></textarea>',
        '<input type="text" readonly="" class="form-control currency" name="addonCurrencyCode_property_info[]" value="{{$currencyCode}}"><input type="number" name="addonPrice_property_info[]" class="price form-control">'
    ]).draw(false);
    AddOnCounterPropertyInfo++;
});
//Income
var IncomeTablePropertyInfo = $("#IncomeTablePropertyInfo").DataTable();
var IncomeCounterPropertyInfo = 1;
$("#FinancialInfoIncomeAddBtnPropertyInfo").on("click", function() {
    IncomeTablePropertyInfo.row.add([
        '<input type="date" name="income_date_property_info[]" class="form-control">',
        '<select name="type_property_info[]" class="form-control transectionType"><option value="land">Land</option></select>',
        '<textarea name="income_description_property_info[]" class="form-control"></textarea>',
        '<input type="text" readonly="" class="form-control currency" name="incomeCurrencyCode_property_info[]" value="{{$currencyCode}}"><input type="number" name="incomePrice_property_info[]" class="price form-control">'
    ]).draw(false);
    IncomeCounterPropertyInfo++;
});

// Automatically add a first row of data
//$("#kt_datatable_example_1_addrowPropertyInfo").click();
//$("#FinancialInfoAddOnCostAddBtnPropertyInfo").click();
//$("#FinancialInfoIncomeAddBtnPropertyInfo").click();
/*$(".transectionType").select2({
    formatNoMatches: function () {
        return "{{ __('messages.noRecordFound') }}";
    }
    });*/
</script>
@endpush
