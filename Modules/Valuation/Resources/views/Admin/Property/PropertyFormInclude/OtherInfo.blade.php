@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/datatables-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/prismjs-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/style-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/plugins-bundle.css') }}">
@endpush
<div class="tab-pane fade" id="OtherInfo">
    <div class="inner-panel-Main-div">
        <div class="panel panel-inverse">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body inner-panel-padding">
                    <div class="tabbable">
                        <ul class="nav nav-tabs wizard">
                            <li class="active"><a class="nav-link nav-item"
                                                  href="#OtherInfoRelationships"
                                                  data-toggle="tab"
                                                  aria-controls="OtherInfoRelationships"
                                                  aria-expanded="false">Relationships</a>
                            </li>
                            <li><a href="#OtherInfoOwnership"
                                   class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="OtherInfoOwnership"
                                   aria-expanded="false">Ownership</a></li>
                            <li><a href="#OtherInfoHistory"
                                   class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="OtherInfoHistory"
                                   aria-expanded="false">History</a></li>
                        </ul>

                    </div>


                    <div class="tab-content" id="myTabContent31">
                        <!---OtherInfoRelationships -->
                        <div class="tab-pane fade in active " id="OtherInfoRelationships" role="tabpanel">

                        </div>
                        <!---OtherInfoRelationships -->

                        <!---OtherInfoOwnership -->
                        <div class="tab-pane fade" id="OtherInfoOwnership">
                            <div class="form-body">
                                <div class="row">
                                    <div class="pb-10">
                                        <button type="button" class="btn btn-primary" id="OtherInfoOwnershipAddBtn">Add New Row</button>
                                    </div>
                                     <table id="OtherInfoOwnershipTable" class="table table-striped table-row-bordered gy-5 gs-7">
                                        <thead>
                                            <tr class="fw-bold fs-6 text-gray-800">
                                                    <th>CPR No#</th>
                                                    <th>Passport No.</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Sale Agreement #</th>
                                                    <th>Date Of Purchase</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            @if(isset($OwnerShip) && !empty($OwnerShip))
                                            @foreach($OwnerShip as $OwnerObj)
                                            <tr>
                                                <th><input type="hidden" name="onwership_cpr_no[]" value="{{$OwnerObj['cprNo']}}">{{$OwnerObj['cprNo']}}</th>
                                                <th><input type="hidden" name="onwership_passport_no[]" value="{{$OwnerObj['passportNo']}}">{{$OwnerObj['passportNo']}}</th>
                                                <th><input type="hidden" name="onwership_first_name[]" value="{{$OwnerObj['firstName']}}">{{$OwnerObj['firstName']}}</th>
                                                <th><input type="hidden" name="onwership_last_name[]" value="{{$OwnerObj['lastName']}}" >{{$OwnerObj['lastName']}}</th>
                                                <th><input type="hidden" name="onwership_email[]" value="{{$OwnerObj['email']}}" >{{$OwnerObj['email']}}</th>
                                                <th><input type="hidden" name="onwership_phone[]" value="{{$OwnerObj['phone']}}" >{{$OwnerObj['phone']}}</th>
                                                <th><input type="hidden" name="onwership_sale_agreement[]" value="{{$OwnerObj['saleAgrement']}}" >{{$OwnerObj['saleAgrement']}}</th>
                                                <th><input type="hidden" name="onwership_date_of_purchase[]" value="{{$OwnerObj['dateOfpurchase']}}" >{{$OwnerObj['dateOfpurchase']}}</th>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tfoot>
                                     </table>
<!--                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Current owner</label>
                                            <input type="text" name="currentOwner" id="currentOwner" value="{{isset($currentOwner)?$currentOwner:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Previous owner</label>
                                            <input type="text" name="previousOwner" id="previousOwner" value="{{isset($previousOwner)?$previousOwner:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>-->
                                </div>
<!--                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Title deed #</label>
                                            <input type="text" name="titleDeedNum" id="titleDeedNum" value="{{isset($titleDeedNum)?$titleDeedNum:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Sale Agreement #</label>
                                            <input type="text" name="saleAgreementNum" id="saleAgreementNum" value="{{isset($saleAgreementNum)?$saleAgreementNum:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                        <!---OtherInfoOwnership -->

                        <!---OtherInfoHistory -->
                        <div class="tab-pane fade" id="OtherInfoHistory">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Sale/purchase history</label>
                                            <input type="text" name="salePurchaseHistory" id="salePurchaseHistory" value="{{isset($SalePurchaseHistoryMeta)?$SalePurchaseHistoryMeta[0]:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Rental income history</label>
                                            <input type="text" name="rentalIncomeHistory" id="rentalIncomeHistory" value="{{isset($RentalIncomeHistoryMeta)?$RentalIncomeHistoryMeta[0]:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Valuations</label>
                                            <input type="text" name="valuations" id="valuations" value="{{isset($ValuationsMeta)?$ValuationsMeta[0]:''}}"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---OtherInfoHistory -->
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
//AddOn cost
var OtherInfoOwnershipTable = $("#OtherInfoOwnershipTable").DataTable();
var ownerShipCounter = 1;
$("#OtherInfoOwnershipAddBtn").on("click", function() {
    OtherInfoOwnershipTable.row.add([
        '<input type="text" name="onwership_cpr_no[]" class="form-control">',
        '<input type="text" name="onwership_passport_no[]" class="form-control">',
        '<input type="text" name="onwership_first_name[]" class="form-control">',
        '<input type="text" name="onwership_last_name[]" class="form-control"  >',
        '<input type="text" name="onwership_email[]" class="form-control" >',
        '<input type="text" name="onwership_phone[]" class="form-control" >',
        '<input type="text" name="onwership_sale_agreement[]" class="form-control" >',
        '<input type="date" name="onwership_date_of_purchase[]" class="form-control" >'
    ]).draw(false);
    ownerShipCounter++;
});

// Automatically add a first row of data
$("#OtherInfoOwnershipAddBtn").click();
</script>
@endpush