@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> {{ __($pageTitle) }} #{{ $project->id }} -
                <span class="font-bold">{{ ucwords($project->project_name) }}</span>
            </h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-6 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li><a href="{{ route('admin.projects.index') }}">{{ __($pageTitle) }}</a></li>
                <li class="active">@lang('modules.projects.milestones')</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
@endpush

@section('content')
    {{-- Table --}}
    <style>
        .tCenter {
            display: flex;
            justify-content: center;
            /* align-items: center; */
            padding: 10px;
        }

        .compareResTable .cBlack {
            color: black;
        }

        .compareResTable .cBlue {
            color: #56AAF4;
        }

        .compareResTable .bold {
            font-weight: bold;
        }

        .compareResTable tbody tr td {
            font-size: 14px;
            font-weight: 400;
            text-align: center;
            /* vertical-align: middle; */
        }

        .heading {
            font-size: 30px;
        }

        .main_pic img {
            width: 100%;
        }

        .basic {
            color: #56AAF4;
            font-weight: 600;
        }

       .pics {
           display: flex;
           align-items: center;
       }

       .conclusion {
           display : flex;
           justify-content: center;
       }
    </style>

    {{-- Table --}}
    <div class="row">
        <div class="col-xs-12">
            <section>
                <div class="sttabs tabs-style-line">
                    @include('admin.projects.show_project_menu')
                    {{-- Main Heading --}}
                    <div class="row mt-2 d-flex flex-row heading">
                        <div class="col-lg-12 text-info fw-bold text-center">{{ $propertyType }}</div>
                        <div class="col-lg-12 fw-bold text-center">VALUATION REPORT</div>
                    </div>
                    {{-- Property Pic --}}
                    <div class="row tCenter main_pic m-auto">
                        {{-- Table1 --}}
                        <div class="col-md-6 table1">
                            <h3 class="basic text-center">Basic Info</h3>
                            <table
                                class="table table-bordered table-hover table-striped table-responsive table-md text-center compareResTable">
                                <tbody>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Client's Name</td>
                                        <td>{{ $clientName }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Instruction Date</td>
                                        <td>{{ $InstructionDate }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Subject Property</td>
                                        <td>{{ $propertyType }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Inspection Date</td>
                                        <td>{{ $inspectionDate }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Valuation Date</td>
                                        <td>-----</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Report Date</td>
                                        <td>{{ $date }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Valuator Name</td>
                                        <td>{{ $roleName }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Purpose of Valutation</td>
                                        <td>{{ ucfirst($purposeOfValuation) }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Basis of Valuation</td>
                                        <td>{{ $basisOfValuation }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Report Currency</td>
                                        <td>{{ $currency }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Valuation Approach</td>
                                        <td>{{ $approachInfo }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Valuation Method</td>
                                        <td>{{ $valuationMethod }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class=" pics col-md-6 d-flex justify-content-center align-items-center">
                            <img src=" {{ asset('user-uploads/property-img') . '/' . $propertyMedia }} " alt="Property" />
                        </div>
                        
                    </div>
                    <div class="row tCenter">
                        <div class="col-md-6">
                            <h3 class="basic text-center">Title Deed Details</h3>
                            {{-- Table2 --}}
                            <table
                                class="table table-bordered table-hover table-striped table-responsive table-md text-center compareResTable">
                                <tbody>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Land Size (IPMS-1)</td>
                                        <td>{{ $landSizeMeterSquare }} m2 {{ $landSizeSquareFeet }} sq.ft</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Title Deed No.</td>
                                        <td>{{$titleDeedNo}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Case No.</td>
                                        <td>{{$caseNo}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Plot No.</td>
                                        <td>{{ $plotNumber }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>No. of Access Roads</td>
                                        <td>{{ $noOfRoads }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Land Shape</td>
                                        <td>{{ $landShape }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Land Category</td>
                                        <td>{{ $landCategory }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Land Classification</td>
                                        <td>{{ $landClassification }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Area Name</td>
                                        <td>{{ $cityName }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Tenure & Legal Property Status</td>
                                        <td>{{$legalPropertyStatus}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h3 class="basic text-center">Property Description</h3>
                            <table
                                class="table table-bordered table-hover table-striped table-responsive table-md text-center compareResTable">
                                <tbody>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Property Location</td>
                                        <td>{{$locality}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Current Occupation & Tenancies</td>
                                        <td>-----</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Assumptions</td>
                                        <td>-----</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Special Assumptions</td>
                                        <td>-----</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row tCenter">
                        <div class="col-md-12">
                            <h3 class="basic text-center">Property Valuation</h3>
                            @include('admin.projects.ValuationMethodology.ComparisionApartmentRes', $comparisonContent)
                        </div>
                    </div>
                    <div class="row tCenter">
                        <div class="col-md-6 last">
                            <table
                            class="table table-bordered table-hover table-striped table-responsive table-md text-center compareResTable">
                            <tbody>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Subject Property Market Value</td>
                                    <td>-----</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>About the Comparable</td>
                                    <td>-----</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Reliance on the Report</td>
                                    <td>-----</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Optinion of Value</td>
                                    <td>-----</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Services & Utilities</td>
                                    <td>-----</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Planning Permission & Consents</td>
                                    <td>-----</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Site & Ground Conditions</td>
                                    <td>-----</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Environmental Issues</td>
                                    <td>-----</td>
                                </tr>
                            </tbody>
                        </table>    
                        </div>
                        <div class="col-md-6 last">
                            <table
                            class="table table-bordered table-hover table-striped table-responsive table-md text-center compareResTable">
                            <tbody>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Compliance with Standards</td>
                                    <td>-----</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Capacity of Valuator</td>
                                    <td>-----</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Conflicts of Interest</td>
                                    <td>-----</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Limitation of Liability</td>
                                    <td>-----</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Confidentiality & Publication</td>
                                    <td>-----</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Monitoring & Reliance</td>
                                    <td>-----</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Property Market Movements</td>
                                    <td>-----</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Disclosure</td>
                                    <td>-----</td>
                                </tr>
                                {{-- <tr>
                                    <th scope="row"></th>
                                    <td>Valuator Declaration & Signature</td>
                                    <td>-----</td>
                                </tr> --}}
                            </tbody>
                            </table>    
                        </div>
                    </div>
                    {{-- Last --}}
                    <div class="row tCenter">
                        <div class="col-md-10 conclusion">
                            <table
                            class="table table-bordered table-hover table-striped table-responsive table-md text-center compareResTable">
                            <tbody>
                                <tr>
                                    {{-- <th scope="row"></th> --}}
                                    <td>
                                        We trust that this valuation report fulfils the requirement of
                                        the client instruction.
                                    </td>
                                    <td></td>
                                </tr>
                    
                                <tr>
                                    {{-- <th scope="row"></th> --}}
                                    <td>Yours faithfully,</td>
                                    <td></td>
                                </tr>
                    
                                <tr>
                                    {{-- <th scope="row"></th> --}}
                                    <td>
                                        {{ $roleName }} (Valuator)
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                    
                                <tr>
                                    {{-- <th scope="row"></th> --}}
                                    <td>Attachments</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    {{-- <th scope="row"></th> --}}
                                    <td>Appendix No.1</td>
                                    <td>
                                        <ul>
                                            <li>Copy of the Title Deed</li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                         </table>    
                        </div>
                    </div>
                    </div>
                    
                    <div class="content-wrap col-xs-12">
                        <section id="section-line-3" class="show">
                            <div class="row">
                                <div class="col-xs-12" id="issues-list-panel">
                                    <div class="white-box">

                                        <!-- .row -->
                                        {!! Form::open(['id' => 'generateProjectReport', 'class' => 'ajax-form', 'method' => 'POST']) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{-- Project Report Commented --}}
                                                {{-- <div class="row">
                                                    <div class="col-md-12">
                                                        <h2>Project Report Fields</h2>
                                                    </div>
                                                </div> --}}
                                                {{-- Title & Value Commented --}}
                                                {{-- <div class="row">
                                                    <div class="col-md-12">
                                                        <table class="table table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>Title</th>
                                                                <th>Value</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <input id="" name="test2" type="text"
                                                                           class="form-control" >
                                                                </td>
                                                                <td>
                                                                    <input id="" name="test1" type="text"
                                                                           class="form-control" >
                                                                </td>
                                                            </tr>



                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div> --}}
                                                {{-- Report Button Commented --}}
                                                {{-- <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-actions">
                                                            <button type="submit" id="save-form" class="btn btn-success pull-right"><i
                                                                        class="fa fa-check"></i> Generate Report</button>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                        {!! Form::close() !!}

                                        <section id="section-line-3" class="show">
                                            <div class="row">
                                                <div class="col-xs-12" id="issues-list-panel">
                                                    <div class="white-box">

                                                        <div class="row m-b-10">
                                                            <div class="col-xs-12">

                                                                <button class="btn btn-success btn-outline pull-right "
                                                                    type="button" data-toggle="modal"
                                                                    data-target="#addRuleModel"><i
                                                                        class="fa fa-check"></i> Generate Report
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <hr>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>

                                            </div>
                                        </section>

                                    </div>
                                </div>

                            </div>
                        </section>

                    </div><!-- /content -->

                </div><!-- /tabs -->
            </section>
        </div>


    </div>
    <!-- .row -->
    <div class="modal fade openModal" id="addRuleModel" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Report Model</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id' => 'generateReport', 'url' => route('admin.report.tempGenerate'), 'method' => 'POST']) !!}
                    {!! Form::hidden('project_id', $project->id) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Title">Title</label>
                                <select class="select2 m-b-10 select2-multiple form-control" multiple="multiple"
                                    data-placeholder="@lang('modules.messages.chooseMember')" name="reportText[]">
                                    @foreach ($reportConditionalText as $rct)
                                        <option value="{{ $rct->id }}">{{ ucwords($rct->title) }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" id="generateReport" class="btn btn-success"><i class="fa fa-check"></i>
                            @lang('app.save')</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('footer-script')
    <script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/FormFieldsRepeater/repeater.js') }}"></script>

    <script data-name="basic">
        (function() {

        })()
    </script>
    <script>
        $('#save-form').click(function() {

            $.easyAjax({
                url: '{{ route($generateProjectReportRoute, $id) }}',
                container: '#generateProjectReport',
                type: "POST",
                redirect: true,
                file: true,
                data: $('#generateProjectReport').serialize()
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
@endpush
