<table class="table compareResTable">
    <thead>
        <tr>
            <th colspan="2" width="10" class="bold cBlue">Residential Apartment Comparable Factors</th>
            <th width="10" class="bold cBlue">Weighted Factors</th>
            <th width="15" class="bold cBlue">Subject Property</th>
            <th width="15" class="bold cBlue">Comparable No.1</th>
            <th width="15" class="bold cBlue">Comparable No.2</th>
            <th width="15" class="bold cBlue">Comparable No.3</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="2">Property Price</td>
            <td>{{ $currency }}</td>
            <td>{{ $propertyBaseInfo->estimated_value }}</td>
            <td>{{ $propertyInfoOne->estimated_value }}</td>
            <td>{{ $propertyInfoTwo->estimated_value }}</td>
            <td>{{ $propertyInfoThree->estimated_value }}</td>
        </tr>

        @if ($apartmentSizeComparison == true)
            <tr>
                {{-- <td colspan="2">Apartment Size in SQM as per IPMS-1</td> --}}
                {{-- <td colspan="2">Apartment Size</td> --}}
                <td colspan="2">
                    <table class="table">
                        <tr rowspan="3">
                            <td>Apartment Size</td>
                        </tr>
                        {{-- <tr>
                <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr> --}}
                    </table>
                </td>
                <td> <input class="form-control weightage" type="text" name="apartmentWeightage" value="{{$sizeWeightagePerText}}"> </td>
                <td>
                    <table class="table">
                        <tr>
                            <td rowspan="3">{{ $propertyBaseInfo->aptSizeIPMS }}</td>
                        </tr>
                        {{-- <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr> --}}
                    </table>
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>{{ $propertyInfoOne->aptSizeIPMS }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoOne->aptSizeIPMSCal }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoOne->aptSizeIPMSComparison }}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>{{ $propertyInfoTwo->aptSizeIPMS }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoTwo->aptSizeIPMSCal }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoTwo->aptSizeIPMSComparison }}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>{{ $propertyInfoThree->aptSizeIPMS }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoThree->aptSizeIPMSCal }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoThree->aptSizeIPMSComparison }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        @endif

        @if ($noOfBedroomsComparison == true)
            <tr>
                {{-- <td colspan="2">No. of Bedrooms</td> --}}
                <td colspan="2">
                    <table class="table">
                        <tr rowspan="3">
                            <td>No. of Bedrooms</td>
                        </tr>
                        {{-- <tr>
                <td>Bedrooms Difference</td>
                </tr>
                <tr>
                    <td>Difference in %age</td>
                </tr> --}}
                    </table>
                </td>
                <td> <input class="form-control weightage" type="text" name="" value="{{ $bedroomsWeightagePerText }}"> </td>
                <td>
                    <table class="table">
                        <tr>
                            <td rowspan="3">{{ $propertyBaseInfo->bedrooms }}</td>
                        </tr>
                        {{-- <tr>
                    <td>Dummy</td>
                </tr>
                <tr>
                    <td>Dummy</td>
                </tr> --}}
                    </table>
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>{{ $propertyInfoOne->bedrooms }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoOne->baseBedroomsMinusProOne }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoOne->bedComparison }}%</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>{{ $propertyInfoTwo->bedrooms }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoTwo->baseBedroomsMinusProTwo }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoTwo->bedComparison }}%</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>{{ $propertyInfoThree->bedrooms }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoThree->baseBedroomsMinusProThree }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoThree->bedComparison }}%</td>
                        </tr>
                    </table>
                </td>
            </tr>
        @endif

        @if ($noOfBathroomsComparison == true)
            <tr>
                {{-- <td colspan="2">No. of Bathrooms</td> --}}
                <td colspan="2">
                    <table class="table">
                        <tr rowspan="3">
                            <td>No. of Bathrooms</td>
                        </tr>
                        {{-- <tr>
                <td>Bathrooms Difference</td>
                </tr>
                <tr>
                    <td>Difference in %age</td>
                </tr> --}}
                    </table>
                </td>
                <td> <input class="form-control weightage" type="text" name="" value="{{ $bathWeightagePerText }}"> </td>
                <td>
                    <table class="table">
                        <tr>
                            <td rowspan="3">{{ $propertyBaseInfo->bathrooms }}</td>
                        </tr>
                        {{-- <tr>
                    <td>Dummy</td>
                </tr>
                <tr>
                    <td>Dummy</td>
                </tr> --}}
                    </table>
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>{{ $propertyInfoOne->bathrooms }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoOne->bathBaseMinusProOne }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoOne->bathComparison }}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>{{ $propertyInfoTwo->bathrooms }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoTwo->bathBaseMinusProTwo }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoTwo->bathComparison }}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>{{ $propertyInfoThree->bathrooms }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoThree->bathBaseMinusProThree }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoThree->bathComparison }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        @endif

        @if ($finishingQualityComparison == true)
            <tr>
                {{-- <td colspan="2">Finishing Quality</td> --}}
                <td colspan="2">
                    <table class="table">
                        <tr rowspan="3">
                            <td>Finishing Quality</td>
                        </tr>
                        <tr>
                            <td>Maintenance</td>
                        </tr>
                        {{-- <tr>
                    <td>Difference</td>
                </tr>
                <tr>
                    <td>?</td>
                </tr> --}}
                    </table>
                </td>
                <td> <input class="form-control weightage" type="text" name="" value="{{ $finishingQualityWeightagePerText }}"> </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>{{ $propertyBaseInfo->finishingQualityTitle }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyBaseInfo->maintenanceTitle }}</td>
                        </tr>
                        <tr>
                            <td rowspan="2">{{ $propertyBaseInfo->finishingQualityCalBase }}</td>
                        </tr>
                        {{-- <tr>
                    <td>Dummy</td>
                </tr> --}}
                    </table>
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>{{ $propertyInfoOne->finishingQualityOneTitle }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoOne->maintenanceOneTitle }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoOne->finishingQualityCalOne }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoOne->finishingQualityComparison }}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>{{ $propertyInfoOne->finishingQualityTwoTitle }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoOne->maintenanceTwoTitle }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoTwo->finishingQualityCalTwo }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoTwo->finishingQualityComparison }}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>{{ $propertyInfoThree->finishingQualityThreeTitle }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoThree->maintenanceThreeTitle }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoThree->finishingQualityCalThree }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoThree->finishingQualityComparison }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        @endif

        @if ($buildingAmenitiesComparison == true)
            <tr>
                {{-- <td colspan="2">Building Amenities and Facilities</td> --}}
                <td colspan="2">
                    <table class="table">
                        <tr rowspan="3">
                            <td>Building Amenities and Facilities</td>
                        </tr>
                        {{-- <tr>
                    <td>Values</td>
                </tr>
                <tr>
                    <td>Difference</td>
                </tr> --}}
                    </table>
                </td>
                <td> <input class="form-control weightage" type="text" name="" value="{{ $amenitiesWeightagePerText }}"> </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>{{ $propertyBaseInfo->amenitiesTitle }}</td>
                        </tr>
                        <tr>
                            <td rowspan="2">{{ $propertyBaseInfo->amenitiesSlectionTitle }}</td>
                        </tr>

                        {{-- <tr>
                    <td>Dummy</td>
                </tr> --}}
                    </table>
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>{{ $propertyInfoOne->amenitiesOneTitle }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoOne->amenitiesSlectionTitle }}</td>
                        </tr>

                        <tr>
                            <td>{{ $propertyInfoOne->amenitiesComparison }}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>{{ $propertyInfoTwo->amenitiesTwoTitle }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoOne->amenitiesSlectionTitle }}</td>
                        </tr>

                        <tr>
                            <td>{{ $propertyInfoOne->amenitiesComparison }}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>{{ $propertyInfoThree->amenitiesThreeTitle }}</td>
                        </tr>
                        <tr>
                            <td>{{ $propertyInfoThree->amenitiesSlectionTitle }}</td>
                        </tr>

                        <tr>
                            <td>{{ $propertyInfoThree->amenitiesComparison }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        @endif

        <tr>
            <td colspan="2">Weighted Factor Adjustment</td>
            <td>%</td>
            <td></td>
            <td>{{ $propertyInfoOne->weightedFacAdj }}</td>
            <td>{{ $propertyInfoTwo->weightedFacAdj }}</td>
            <td>{{ $propertyInfoThree->weightedFacAdj }}</td>

        </tr>
        <tr>
            <td colspan="2">Amount Adjustment to Original Price</td>
            <td>{{ $currency }}</td>
            <td></td>
            <td>{{ $propertyInfoOne->amountAdjOriPrice }}</td>
            <td>{{ $propertyInfoTwo->amountAdjOriPrice }}</td>
            <td>{{ $propertyInfoThree->amountAdjOriPrice }}</td>

        </tr>

        <tr>
            <td colspan="2">Weighted Factor Average Price</td>
            <td>{{ $currency }}</td>
            <td></td>
            <td>{{ $propertyInfoOne->weightedFactAvgPrice }}</td>
            <td>{{ $propertyInfoTwo->weightedFactAvgPrice }}</td>
            <td>{{ $propertyInfoThree->weightedFactAvgPrice }}</td>

        </tr>

        <tr>
            <td colspan="2">Comparable Overall Weighted Adjustment </td>
            <td>100%</td>
            <td></td>
            <td>{{ $propertyInfoOne->comparableOverallWeightAdj }}</td>
            <td>{{ $propertyInfoTwo->comparableOverallWeightAdj }}</td>
            <td>{{ $propertyInfoThree->comparableOverallWeightAdj }}</td>

        </tr>
        <tr>
            <td colspan="2">Total Weighted Adjusted Price </td>
            <td></td>
            <td></td>
            <td>{{ $propertyInfoOne->totalWeightAdjPrice }}</td>
            <td>{{ $propertyInfoTwo->totalWeightAdjPrice }}</td>
            <td>{{ $propertyInfoThree->totalWeightAdjPrice }}</td>

        </tr>
        <tr>
            <td colspan="2">Subject Property Weighted Market Value</td>
            <td>{{ $currency }}</td>
            <td>{{ $propertyBaseInfo->weightedMrktValue }}</td>
        </tr>

    </tbody>
</table>

<style>
    .compareResTable .cBlack {
        color: #56AAF4;
    }

    .compareResTable .cBlue {
        color: #56AAF4;
    }

    .compareResTable .bold {
        font-weight: bold;
    }

    .compareResTable tbody tr td {
        font-size: 15px;
        font-weight: 400;
        text-align: center;
    }

    .saveButton {
        margin-bottom: 50px;
    }

    .compareResTable .weightage {
        text-align: center;
        border: 1px solid #f2f2f3;
    }

</style>

@if (!isset($hideContent))
    <div class="row saveButton">
        <div class="col-md-12">
            {!! Form::open(['id' => 'generateMethodologyComparison', 'class' => 'ajax-form', 'method' => 'POST']) !!}
            <input type="hidden" name="projectId" value="{{ $projectId }}">
            <input type="hidden" name="basePropertyId" value="{{ $basePropertyId }}">
            <input type="hidden" name="comparePropertyOne" value="{{ $comparePropertyOne }}">
            <input type="hidden" name="comparePropertyTwo" value="{{ $comparePropertyTwo }}">
            <input type="hidden" name="comparePropertyThree" value="{{ $comparePropertyThree }}">
            <input type="hidden" name="saveData" value="true">
            {!! Form::close() !!}
            <button id="save-comparison" class="btn btn-success btn-outline pull-right" type="submit"><i
                    class="fa fa-check"></i> Save
            </button>
        </div>
    </div>



    @push('footer-script')
        <script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
        <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('js/FormFieldsRepeater/repeater.js') }}"></script>
    @endpush

    <script>
        $('#save-comparison').click(function() {
            $.easyAjax({
                url: " {{ route('admin.valuation-method.processComparison') }} ",
                type: "POST",
                container: '#generateMethodologyComparison',
                redirect: true,
                file: true,
                data: $('#generateMethodologyComparison').serialize(),
            })
        });
    </script>

    {{-- <script>
        var addSerialNumber = function() {
            $('table tr').each(function(index) {
                $(this).find('th:nth-child(1)').html(index + 1);
            });
        };
        addSerialNumber();
    </script> --}}
@endif
