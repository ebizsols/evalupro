<table class="table table-striped compareResTable">
    <thead>
    <tr>
        <th width="5" class="bold cBlack">No</th>
        <th width="25" class="bold cBlue">Residential Apartment Comparable Factors</th>
        <th width="10" class="bold cBlue">Weighted Factors</th>
        <th width="15" class="bold cBlue">Subject Property</th>
        <th width="15" class="bold cBlue">Comparable No.1</th>
        <th width="15" class="bold cBlue">Comparable No.2</th>
        <th width="15" class="bold cBlue">Comparable No.3</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>1</td>
        <td>Property Price</td>
        <td>{{$currency}}</td>
        <td></td>
        <td>{{$propertyInfoOne->estimated_value}}</td>
        <td>{{$propertyInfoTwo->estimated_value}}</td>
        <td>{{$propertyInfoThree->estimated_value}}</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Apartment Size in SQM as per IPMS-1</td>
        <td>{{$sizeWeightagePerText}}</td>
        <td>
            <table class="table table-striped ">
                <tr>
                    <td>{{$propertyBaseInfo->aptSizeIPMS}}</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
            </table>
        </td>
        <td>
            <table class="table table-striped">
                <tr>
                    <td>{{$propertyInfoOne->aptSizeIPMS}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoOne->aptSizeIPMSCal}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoOne->aptSizeIPMSComparison}}</td>
                </tr>
            </table>
        </td>
        <td>
            <table class="table table-striped">
                <tr>
                    <td>{{$propertyInfoTwo->aptSizeIPMS}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoTwo->aptSizeIPMSCal}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoTwo->aptSizeIPMSComparison}}</td>
                </tr>
            </table>
        </td>
        <td>
            <table class="table table-striped">
                <tr>
                    <td>{{$propertyInfoThree->aptSizeIPMS}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoThree->aptSizeIPMSCal}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoThree->aptSizeIPMSComparison}}</td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td></td>
        <td>No. of Bedrooms</td>
        <td>{{$bedroomsWeightagePerText}}</td>
        <td>
            <table class="table table-striped ">
                <tr>
                    <td>{{$propertyBaseInfo->bedrooms}}</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
            </table>
        </td>
        <td>
            <table class="table table-striped">
                <tr>
                    <td>{{$propertyInfoOne->bedrooms}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoOne->baseBedroomsMinusProOne}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoOne->bedComparison}}%</td>
                </tr>
            </table>
        </td>
        <td>
            <table class="table table-striped">
                <tr>
                    <td>{{$propertyInfoTwo->bedrooms}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoTwo->baseBedroomsMinusProTwo}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoTwo->bedComparison}}%</td>
                </tr>
            </table>
        </td>
        <td>
            <table class="table table-striped">
                <tr>
                    <td>{{$propertyInfoThree->bedrooms}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoThree->baseBedroomsMinusProThree}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoThree->bedComparison}}%</td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td>4</td>
        <td>No. of Bathrooms</td>
        <td>{{$bathWeightagePerText}}</td>
        <td>
            <table class="table table-striped ">
                <tr>
                    <td>{{$propertyBaseInfo->bathrooms}}</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
            </table>
        </td>
        <td>
            <table class="table table-striped">
                <tr>
                    <td>{{$propertyInfoOne->bathrooms}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoOne->bathBaseMinusProOne}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoOne->bathComparison}}</td>
                </tr>
            </table>
        </td>
        <td>
            <table class="table table-striped">
                <tr>
                    <td>{{$propertyInfoTwo->bathrooms}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoTwo->bathBaseMinusProOne}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoTwo->bathComparison}}</td>
                </tr>
            </table>
        </td>
        <td>
            <table class="table table-striped">
                <tr>
                    <td>{{$propertyInfoThree->bathrooms}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoThree->bathBaseMinusProOne}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoThree->bathComparison}}</td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td>5</td>
        <td>Finishing Quality</td>
        <td>{{$finishingQualityWeightagePerText}}</td>
        <td>
            <table class="table table-striped ">
                <tr>
                    <td>{{$propertyBaseInfo->finishingQualitySelectionTitle}}</td>
                </tr>
                <tr>
                    <td>{{$propertyBaseInfo->maintenanceSelectionTitle}}</td>
                </tr>
                <tr>
                    <td>{{$propertyBaseInfo->finishingQualityCalBase}}</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
            </table>
        </td>
        <td>
            <table class="table table-striped ">
                <tr>
                    <td>{{$propertyInfoOne->finishingQualitySelectionTitle}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoOne->maintenanceSelectionTitle}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoOne->finishingQualityCalBase}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoOne->finishingQualityComparison}}</td>
                </tr>
            </table>
        </td>
        <td>
            <table class="table table-striped ">
                <tr>
                    <td>{{$propertyInfoTwo->finishingQualitySelectionTitle}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoTwo->maintenanceSelectionTitle}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoTwo->finishingQualityCalBase}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoTwo->finishingQualityComparison}}</td>
                </tr>
            </table>
        </td>
        <td>
            <table class="table table-striped ">
                <tr>
                    <td>{{$propertyInfoThree->finishingQualitySelectionTitle}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoThree->maintenanceSelectionTitle}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoThree->finishingQualityCalBase}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoThree->finishingQualityComparison}}</td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td>6</td>
        <td>Building Amenities and Facilities</td>
        <td>{{$amenitiesWeightagePerText}}</td>
        <td>
            <table class="table table-striped ">
                <tr>
                    <td>{{$propertyBaseInfo->amenitiesSlectionTitle}}</td>
                </tr>
                <tr>
                    <td>{{$propertyBaseInfo->amenities}}</td>
                </tr>

                <tr>
                    <td></td>
                </tr>
            </table>
        </td>
        <td>
            <table class="table table-striped ">
                <tr>
                    <td>{{$propertyInfoOne->amenitiesSlectionTitle}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoOne->amenities}}</td>
                </tr>

                <tr>
                    <td>{{$propertyInfoOne->amenitiesComparison}}</td>
                </tr>
            </table>
        </td>
        <td>
            <table class="table table-striped ">
                <tr>
                    <td>{{$propertyInfoOne->amenitiesSlectionTitle}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoOne->amenities}}</td>
                </tr>

                <tr>
                    <td>{{$propertyInfoOne->amenitiesComparison}}</td>
                </tr>
            </table>
        </td>
        <td>
            <table class="table table-striped ">
                <tr>
                    <td>{{$propertyInfoThree->amenitiesSlectionTitle}}</td>
                </tr>
                <tr>
                    <td>{{$propertyInfoThree->amenities}}</td>
                </tr>

                <tr>
                    <td>{{$propertyInfoThree->amenitiesComparison}}</td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td>7</td>
        <td>Weighted Factor Adjustment</td>
        <td>%</td>
        <td></td>
        <td>{{$propertyInfoOne->weightedFacAdj}}</td>
        <td>{{$propertyInfoTwo->weightedFacAdj}}</td>
        <td>{{$propertyInfoThree->weightedFacAdj}}</td>

    </tr>
    <tr>
        <td>8</td>
        <td>Amount Adjustment to Original Price</td>
        <td>{{$currency}}</td>
        <td></td>
        <td>{{$propertyInfoOne->amountAdjOriPrice}}</td>
        <td>{{$propertyInfoTwo->amountAdjOriPrice}}</td>
        <td>{{$propertyInfoThree->amountAdjOriPrice}}</td>

    </tr>

    <tr>
        <td>9</td>
        <td>Weighted Factor Average Price</td>
        <td>{{$currency}}</td>
        <td></td>
        <td>{{$propertyInfoOne->weightedFactAvgPrice}}</td>
        <td>{{$propertyInfoTwo->weightedFactAvgPrice}}</td>
        <td>{{$propertyInfoThree->weightedFactAvgPrice}}</td>

    </tr>

    <tr>
        <td>10</td>
        <td>Comparable Overall Weighted Adjustment </td>
        <td>100%</td>
        <td></td>
        <td>{{$propertyInfoOne->comparableOverallWeightAdj}}</td>
        <td>{{$propertyInfoTwo->comparableOverallWeightAdj}}</td>
        <td>{{$propertyInfoThree->comparableOverallWeightAdj}}</td>

    </tr>
    <tr>
        <td>11</td>
        <td>Total Weighted Adjusted Price </td>
        <td></td>
        <td></td>
        <td>{{$propertyInfoOne->totalWeightAdjPrice}}</td>
        <td>{{$propertyInfoTwo->totalWeightAdjPrice}}</td>
        <td>{{$propertyInfoThree->totalWeightAdjPrice}}</td>

    </tr>
    <tr>
        <td>12</td>
        <td>Subject Property Weighted Market Value</td>
        <td>{{$currency}}</td>
        <td colspan="4">{{$propertyBaseInfo->weightedMrktValue}}</td>
    </tr>

    </tbody>
</table>

<style>
    .compareResTable .cBlack {
        color: black;
    }

    .compareResTable .cBlue {
        color: blue;
    }

    .compareResTable .bold {
        font-weight: bold;
    }
    .compareResTable tbody tr td
    {
        font-size: 15px;
        font-weight: 400;
    }
</style>