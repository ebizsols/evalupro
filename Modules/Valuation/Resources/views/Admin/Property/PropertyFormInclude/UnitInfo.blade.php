<div class="tab-pane   " id="UnitInfo-{{$objRef->unit_id}}" role="tabpanel">
    <div class="inner-panel-Main-div">
        <div class="panel panel-inverse">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body inner-panel-padding">
                    <div class="tabbable">
                        <ul class="nav nav-tabs wizard">
                            <li class="active"><a href="#UnitInfoPrimaryInfo-{{$objRef->unit_id}}" class="nav-link nav-item"
                                   data-toggle="tab"
                                   aria-controls="UnitInfoPrimaryInfo-{{$objRef->unit_id}}"
                                   aria-expanded="false">Primary Info</a></li>
                            <li><a href="#UnitInfoFincialInfo-{{$objRef->unit_id}}" class="nav-link nav-item"
                                   data-toggle="tab"
                                   aria-controls="UnitInfoFincialInfo-{{$objRef->unit_id}}"
                                   aria-expanded="false">Financial Info</a></li>
                            <li><a href="#UnitInfoImages-{{$objRef->unit_id}}" class="nav-link nav-item"
                                   data-toggle="tab"
                                   aria-controls="UnitInfoImages-{{$objRef->unit_id}}"
                                   aria-expanded="false">Images</a></li>
                        </ul>

                    </div>
                    <div class="tab-content" id="myTabContentUnit-{{$objRef->unit_id}}">
                       <!---LandInfoAddress -->
                        <div class="tab-pane fade in active" id="UnitInfoPrimaryInfo-{{$objRef->unit_id}}" role="tabpanel">
                            <div class="form-body">
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            @php
                                           
                                            @endphp
                                            <label class="control-label">Unit Type</label>
                                            <select name="unitType-{{$objRef->unit_id}}" id="unitType-{{$objRef->unit_id}}" class="form-control">
                                                 @if(isset($types))
                                                    @foreach($types as $type)
                                                        <option @if(isset($unitType) && !empty($unitType) &&  $unitType[0] ==$type->id) selected="selected"
                                                                @endif  value="{{ $type->id }}">
                                                            {{ $type->title }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    @if(isset($BedRooms) && !empty($BedRooms))
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{$BedRooms[0]->title}}</label>
                                            <select name="bedRoomsUnitInfo-{{$objRef->unit_id}}" class="form-control">
                                                <option value="">--select One--</option>
                                                @foreach($BedRooms[0]->weightageCategoryItems as $roomObj)
                                                <option @if(isset($NoOfBedroomText) && !empty($NoOfBedroomText) && $NoOfBedroomText[0]==$roomObj->id) selected="selected" @endif value="{{$roomObj->id}}">{{$roomObj->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    @if(isset($BathRoom) && !empty($BathRoom))
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{$BathRoom[0]->title}}</label>
                                            <select name="bathRoomUnitInfo-{{$objRef->unit_id}}" class="form-control">
                                                <option value="">--select One--</option>
                                                @foreach($BathRoom[0]->weightageCategoryItems as $bathObj)
                                                <option @if(isset($NoOfBathoomsText) && !empty($NoOfBathoomsText) && $NoOfBathoomsText[0]==$bathObj->id) selected="selected" @endif value="{{$bathObj->id}}">{{$bathObj->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    @if(isset($FinishingQuality) && !empty($FinishingQuality))
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{$FinishingQuality[0]->title}}</label>
                                            <select name="finishingQualityUnitInfo-{{$objRef->unit_id}}" class="form-control">
                                                <option value="">--select One--</option>
                                                @foreach($FinishingQuality[0]->weightageCategoryItems as $finishingObj)
                                                <option @if(isset($FinishingQualityText) && !empty($FinishingQualityText) && $FinishingQualityText[0]==$finishingObj->id) selected="selected" @endif value="{{$finishingObj->id}}">{{$finishingObj->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    @if(isset($Maintenance) && !empty($Maintenance))
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{$Maintenance[0]->title}}</label>
                                            <select name="unitInfoMaintenance-{{$objRef->unit_id}}" class="form-control">
                                                <option value="">--select One--</option>
                                                @foreach($Maintenance[0]->weightageCategoryItems as $maintanceObj)
                                                <option @if(isset($MaintenanceText) && !empty($MaintenanceText) && $MaintenanceText[0]==$maintanceObj->id) selected="selected" @endif value="{{$maintanceObj->id}}">{{$maintanceObj->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    @if(isset($Floorlevel) && !empty($Floorlevel))
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{$Floorlevel[0]->title}}</label>
                                            <select name="unitInfoFloorLevel-{{$objRef->unit_id}}" class="form-control">
                                                <option value="">--select One--</option>
                                                @foreach($Floorlevel[0]->weightageCategoryItems as $floorObj)
                                                <option @if(isset($FloorlevelText) && !empty($FloorlevelText) && $FloorlevelText[0]==$floorObj->id) selected="selected" @endif value="{{$floorObj->id}}">{{$floorObj->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    @if(isset($WeitageView) && !empty($WeitageView))
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{$WeitageView[0]->title}}</label>
                                            <select name="unitInfoView-{{$objRef->unit_id}}" class="form-control">
                                                <option value="">--select One--</option>
                                                @foreach($WeitageView[0]->weightageCategoryItems as $weightViewObj)
                                                <option @if(isset($UnitInfoView) && !empty($UnitInfoView) && $UnitInfoView[0]==$weightViewObj->id) selected="selected" @endif value="{{$weightViewObj->id}}">{{$weightViewObj->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                   
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Condition </label>
                                            <select name="unitInfoCondition-{{$objRef->unit_id}}" class="form-control">
                                                <option value="">--select One--</option>
                                                <option @if(isset($UnitInfoCondition) && !empty($UnitInfoCondition) && $UnitInfoCondition[0]=='Old') selected="selected" @endif value="Old">Old</option>
                                                <option @if(isset($UnitInfoCondition) && !empty($UnitInfoCondition) && $UnitInfoCondition[0]=='NewCondition') selected="selected" @endif value="NewCondition">New</option>
                                                <option @if(isset($UnitInfoCondition) && !empty($UnitInfoCondition) && $UnitInfoCondition[0]=='Renovated') selected="selected" @endif value="Renovated">Renovated</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Styling </label>
                                            <select name="unitInfoStyling-{{$objRef->unit_id}}" class="form-control">
                                                <option  value="">--select One--</option>
                                                <option @if(isset($UnitInfoStyling) && !empty($UnitInfoStyling) && $UnitInfoStyling[0]=='Modern') selected="selected" @endif value="Modern">Modern</option>
                                                <option @if(isset($UnitInfoStyling) && !empty($UnitInfoStyling) && $UnitInfoStyling[0]=='Antique') selected="selected" @endif value="Antique">Antique</option>
                                                <option @if(isset($UnitInfoStyling) && !empty($UnitInfoStyling) && $UnitInfoStyling[0]=='Classical') selected="selected" @endif value="Classical">Classical</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Unit Status</label>
                                            <select name="unitInfoStatus-{{$objRef->unit_id}}" class="form-control">
                                                <option value="">--select One--</option>
                                                <option @if(isset($UnitInfoStatus) && !empty($UnitInfoStatus) && $UnitInfoStatus[0]=='Vacant') selected="selected" @endif value="Vacant">Vacant</option>
                                                <option @if(isset($UnitInfoStatus) && !empty($UnitInfoStatus) && $UnitInfoStatus[0]=='Rented') selected="selected" @endif value="Rented">Rented</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Interior Status</label>
                                            <select name="unitInfoInteriorStatus-{{$objRef->unit_id}}" class="form-control">
                                                <option value="">--select One--</option>
                                                <option @if(isset($UnitInfoInteriorStatus)&& !empty($UnitInfoInteriorStatus) && $UnitInfoInteriorStatus[0]=='Furnished') selected="selected" @endif value="Furnished">Furnished</option>
                                                <option @if(isset($UnitInfoInteriorStatus)&& !empty($UnitInfoInteriorStatus) && $UnitInfoInteriorStatus[0]=='Semi Furnished') selected="selected" @endif value="Semi Furnished">Semi Furnished</option>
                                                <option @if(isset($UnitInfoInteriorStatus)&& !empty($UnitInfoInteriorStatus) && $UnitInfoInteriorStatus[0]=='Unfurnished') selected="selected" @endif value="Unfurnished">Unfurnished</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Floor</label>
                                            <input type="text" name="unitInfofloor-{{$objRef->unit_id}}"  @if(isset($UnitInfoFloor) && !empty($UnitInfoFloor) && !empty($UnitInfoFloor[0])) value="{{$UnitInfoFloor[0]}}" @endif class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>
                                 
                            </div>
                        </div>
<!--                        UnitInfoFinancialInfo -->
                        @include('valuation::Admin.Property.PropertyFormInclude.FinancialInfoForUnitInfo')
<!--                        UnitInfoFinancialInfo -->
                        <div class="tab-pane fade" id="UnitInfoImages-{{$objRef->unit_id}}" role="tabpanel">
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>