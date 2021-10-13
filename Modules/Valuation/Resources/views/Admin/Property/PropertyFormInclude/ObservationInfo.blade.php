@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/datatables-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/prismjs-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/style-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/metronic_plugin/css/plugins-bundle.css') }}">
@endpush
<div class="tab-pane fade" id="ObservationInfo">
    <div class="inner-panel-Main-div">
        <div class="panel panel-inverse">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body inner-panel-padding">
                    <div class="tabbable">
                        <ul class="nav nav-tabs wizard">
                            <li class="active"><a class="nav-link nav-item"
                                                  href="#EnvironmentalMattersTab"
                                                  data-toggle="tab"
                                                  aria-controls="EnvironmentalMattersTab"
                                                  aria-expanded="false">Environmental Matters</a>
                            </li>
                            <li><a href="#AssumptionsTab"
                                   class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="AssumptionsTab"
                                   aria-expanded="false">Assumptions</a></li>
                            <li><a href="#RelevantInformationTab"
                                   class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="RelevantInformationTab"
                                   aria-expanded="false">Relevant Information</a></li>
                            <li>
                                <a href="#PlanningPotentialTab"
                                   class="nav-link nav-item" data-toggle="tab"
                                   aria-controls="PlanningPotentialTab"
                                   aria-expanded="false">Planning Potential</a>
                            </li>
                        </ul>

                    </div>


                    <div class="tab-content" id="myTabContent4">
                        <!---EnvironmentalMattersTab -->
                        <div class="tab-pane fade in active " id="EnvironmentalMattersTab"
                             role="tabpanel">
                            <div class="form-body">
                                <div class="row">
                                    <div class="pb-10">
                                        <button type="button" class="btn btn-primary" id="AddNewEnvirement">Add New Row</button>
                                    </div>
                                    <table id="enviromentTable" class="table table-striped table-row-bordered gy-5 gs-7">
                                        <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                        <th>Date</th>
                                                        <th>Type</th>
                                                        <th>Description</th>
                                                        <th>Staff</th>
                                                </tr>
                                        </thead>
                                        <tfoot>
                                            @if(isset($PropertyEnvirementalMatters) && !empty($PropertyEnvirementalMatters))
                                            
                                            @foreach($PropertyEnvirementalMatters as $propertyEnvObj)
                                            <tr>
                                                <th><input type="hidden" name="env_date[]" value="{{$propertyEnvObj['date']}}" >{{$propertyEnvObj['date']}}</th>
                                                <th><input type="hidden" name="env_type[]" value="{{$propertyEnvObj['type']}}" >{{$propertyEnvObj['type']}}</th>
                                                <th><input type="hidden" name="env_description[]" value="{{$propertyEnvObj['description']}}" >{{$propertyEnvObj['description']}}</th>
                                                <th><input type="hidden" name="env_staff[]" value="{{$propertyEnvObj['staff']}}" >{{$propertyEnvObj['staff']}}</th>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tfoot>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                        <!---EnvironmentalMattersTab -->

                        <!---AssumptionsTab -->
                        <div class="tab-pane fade" id="AssumptionsTab">
                            <div class="form-body">
                                <div class="row">
                                   <div class="pb-10">
                                        <button  type="button" class="btn btn-primary" id="AddNewAssumptionBtn">Add New Row</button>
                                    </div>
                                    <table id="assumptionTable" class="table table-striped table-row-bordered gy-5 gs-7">
                                        <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                        <th>Date</th>
                                                        <th>Type</th>
                                                        <th>Assumption</th>
                                                        <th>Staff</th>
                                                </tr>
                                        </thead>
                                        <tfoot>
                                            @if(isset($PropertyAssumption) && !empty($PropertyAssumption))
                                            @foreach($PropertyAssumption as $assumpObj)
                                            
                                            <tr>
                                                <th><input type="hidden" name="ass_date[]" value="{{$assumpObj['date']}}">{{$assumpObj['date']}}</th>
                                                <th><input type="hidden" name="assumption_type[]" value="{{$assumpObj['type']}}">{{$assumpObj['type']}}</th>
                                                <th><input type="hidden" name="assumption_description[]" value="{{$assumpObj['description']}}">{{$assumpObj['description']}}</th>
                                                <th><input type="hidden" name="assumption_staff[]" value="{{$assumpObj['staff']}}">{{$assumpObj['staff']}}</th>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!---AssumptionsTab -->

                        <!---RelevantInformationTab -->
                        <div class="tab-pane fade" id="RelevantInformationTab">
                            <div class="form-body">
                                <div class="row">
                                    <div class="pb-10">
                                        <button type="button" class="btn btn-primary" id="AddNewRelventBtn">Add New Row</button>
                                    </div>
                                    <table id="relventTable" class="table table-striped table-row-bordered gy-5 gs-7">
                                        <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                        <th>Date</th>
                                                        <th>Type</th>
                                                        <th>Information</th>
                                                        <th>Staff</th>
                                                </tr>
                                        </thead>
                                        <tfoot>
                                            @if(isset($PropertyRelventInformation) && !empty($PropertyRelventInformation))
                                                @foreach($PropertyRelventInformation as $relventObj)
                                                <tr>
                                                    <th><input type="hidden" name="relvent_date[]" value="{{$relventObj['date']}}">{{$relventObj['date']}}</th>
                                                    <th><input type="hidden" name="relvent_type[]" value="{{$relventObj['type']}}">{{$relventObj['type']}}</th>
                                                    <th><input type="hidden" name="relvent_description[]" value="{{$relventObj['description']}}">{{$relventObj['description']}}</th>
                                                    <th><input type="hidden" name="relvent_staff[]" value="{{$relventObj['staff']}}">{{$relventObj['staff']}}</th>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!---RelevantInformationTab -->
                        
                        <!--PlanningPotentialTab-->
                        <div class="tab-pane fade" id="PlanningPotentialTab">
                            <div class="form-body">
                                 <div class="pb-10">
                                        <button type="button" class="btn btn-primary" id="AddNewPlanningBtn">Add New Row</button>
                                    </div>
                                    <table id="planningTable" class="table table-striped table-row-bordered gy-5 gs-7">
                                        <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                        <th>Date</th>
                                                        <th>Category</th>
                                                        <th>Description</th>
                                                        <th>Staff</th>
                                                </tr>
                                        </thead>
                                        <tfoot>
                                            @if(isset($PropertyPlanningPotential) && !empty($PropertyPlanningPotential))
                                                @foreach($PropertyPlanningPotential as $planningObj)
                                                <tr>
                                                    <th><input type="hidden" name="planning_date[]" value="{{$planningObj['date']}}">{{$planningObj['date']}}</th>
                                                    <th><input type="hidden" name="planning_type[]" value="{{$planningObj['type']}}">{{$planningObj['type']}}</th>
                                                    <th><input type="hidden" name="planning_description[]" value="{{$planningObj['description']}}">{{$planningObj['description']}}</th>
                                                    <th><input type="hidden" name="planning_staff[]" value="{{$planningObj['staff']}}">{{$planningObj['staff']}}</th>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </tfoot>
                                    </table>
                            </div>
                        </div>
                        <!--PlanningPotentialTab-->
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
var enviromentTable = $("#enviromentTable").DataTable();
var enviromentCounter = 1;
var staffOption = '<?php echo json_encode($staffData, JSON_UNESCAPED_UNICODE );?>';
var staffOptionHtml=[];

jQuery.each(JSON.parse(staffOption), function(index,vaule) {
 staffOptionHtml.push('<option value="'+vaule.id+'">'+vaule.name+'</option>');
});
//var StaffOptionHtmlData=staffOptionHtml.join('');

$("#AddNewEnvirement").on("click", function() {
    enviromentTable.row.add([
        '<input type="date" name="env_date[]" class="form-control">',
        '<select name="env_type[]" class="form-control select2"><option value="Hazardous Materials">Hazardous Materials</option><option value="Natural Environmental">Natural Environmental</option><option value="Non-natural Constraints">Non-natural Constraints</option></select>',
        '<textarea name="env_description[]" class="form-control"></textarea>',
        '<select  class="form-control select2 " name="env_staff[]">'+staffOptionHtml+'</select>'
    ]).draw(false);
    enviromentCounter++;
});

var assumptionCounter=1;
var assumptionTable = $("#assumptionTable").DataTable();
$("#AddNewAssumptionBtn").on("click", function() {
    assumptionTable.row.add([
        '<input type="date" name="ass_date[]" class="form-control">',
        '<select name="assumption_type[]" class="form-control select2"><option value="option1">option1</option></select>',
        '<textarea name="assumption_description[]" class="form-control"></textarea>',
        '<select  class="form-control select2 " name="assumption_staff[]">'+staffOptionHtml+'</select>'
    ]).draw(false);
    assumptionCounter++;
});

var revelentCounter=1;
var relventTable = $("#relventTable").DataTable();
$("#AddNewRelventBtn").on("click", function() {
    relventTable.row.add([
        '<input type="date" name="relvent_date[]" class="form-control">',
        '<select name="relvent_type[]" class="form-control select2"><option value="option1">option1</option></select>',
        '<textarea name="relvent_description[]" class="form-control"></textarea>',
        '<select  class="form-control select2 " name="relvent_staff[]">'+staffOptionHtml+'</select>'
    ]).draw(false);
    revelentCounter++;
});

var planningCounter=1;
var planningTable = $("#planningTable").DataTable();
$("#AddNewPlanningBtn").on("click", function() {
    planningTable.row.add([
        '<input type="date" name="planning_date[]" class="form-control">',
        '<select name="planning_type[]" class="form-control select2"><option value="option1">option1</option></select>',
        '<textarea name="planning_description[]" class="form-control"></textarea>',
        '<select  class="form-control select2 " name="planning_staff[]">'+staffOptionHtml+'</select>'
    ]).draw(false);
    planningCounter++;
});

// Automatically add a first row of data
$("#AddNewEnvirement").click();
$("#AddNewAssumptionBtn").click();
$("#AddNewRelventBtn").click();
$("#AddNewPlanningBtn").click();
$(".select2").select2({
    formatNoMatches: function () {
        return "{{ __('messages.noRecordFound') }}";
    }
    });
</script>
@endpush