@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> {{ __($pageTitle) }} #{{ $project->id }} - <span
                        class="font-bold">{{ ucwords($project->project_name) }}</span></h4>
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

    <div class="row">
        <div class="col-xs-12">

            <section>
                <div class="sttabs tabs-style-line">
                    @include('admin.project-template.show_project_template_menu')
                    <div class="content-wrap">
                        <section id="section-line-3" class="show">
                            <div class="row">
                                <div class="col-xs-12" id="issues-list-panel">
                                    <div class="white-box">

                                        <div class="row">
                                            <div class="col-xs-12">
                                                {!! Form::open(['id'=>'projectTemplateProduct','class'=>'ajax-form','method'=>'PUT']) !!}
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-xs-12">

                                                            {!! Form::hidden('project_template_id', $project->id) !!}
                                                            <input type="hidden" name="currency_id" id="currency_id" value="{{ $project->currency_id }}">

                                                            <div class="form-body">
                                                                @if(empty($projectTemplateProductRefData))
                                                                    <div class="row">
                                                                    <div class="col-md-6 ">
                                                                        <div class="form-group">
                                                                            <label>@lang('app.menu.products')</label>
                                                                            <select class="form-control" name="product_id" id="product_id">
                                                                                @forelse($products as $product)
                                                                                    <option value="{{ $product->id }}"
                                                                                            @if($productId == $product->id)
                                                                                            selected
                                                                                            @endif
                                                                                    >{{ ucwords($product->name) }}</option>
                                                                                @empty
                                                                                    <option value="">No Product Added</option>
                                                                                @endforelse
                                                                            </select>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                                @else
                                                                    <div class="row">
                                                                        <div class="col-md-6 ">
                                                                            <div class="form-group">
                                                                                <label>@lang('app.menu.products')</label>
                                                                                <select class="form-control" name="product_id" id="product_id">
                                                                                    @forelse($products as $product)
                                                                                        <option value="{{ $product->id }}"
                                                                                                @if($productId == $product->id)
                                                                                                selected
                                                                                                @endif
                                                                                        >{{ ucwords($product->name) }}</option>
                                                                                    @empty
                                                                                        <option value="">No Product Added</option>
                                                                                    @endforelse
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 ">
                                                                            <div class="form-group">
                                                                                <label>Price</label>
                                                                                <input type="text" class="form-control" value="{{$price}}" disabled="disabled">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 ">
                                                                            <div class="form-group">
                                                                                <label>Category</label>
                                                                                <input type="text" class="form-control" value="{{$category}}" disabled="disabled">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 ">
                                                                            <div class="form-group">
                                                                                <label>Sub Category</label>
                                                                                <input type="text" class="form-control" value="{{$subCategory}}" disabled="disabled">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 ">
                                                                            <div class="form-group">
                                                                                <label>Property Type</label>
                                                                                <input type="text" class="form-control" value="{{$selectedPropertyType}}" disabled="disabled">
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                @endif

                                                            </div>


                                                            <hr>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions m-t-30">
                                                    <button type="button" id="update-form" class="btn btn-success"><i class="fa fa-check"></i> Save
                                                    </button>
                                                </div>
                                                {!! Form::close() !!}

                                            </div>
                                        </div>


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


@endsection

@push('footer-script')

    <script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>

    <script>
        $('ul.showProjectTemplateTabs .projectTemplateProduct').addClass('tab-current');

        $('#update-form').click(function () {
            $.easyAjax({
                url: '{{route('admin.project-template-product.update', $project->id)}}',
                container: '#projectTemplateProduct',
                type: "POST",
                data: $('#projectTemplateProduct').serialize(),
                success: function (data) {
                    if (data.status == 'success') {
                        $('#logTime').trigger("reset");
                        $('#logTime').toggleClass('hide', 'show');
                        table._fnDraw();
                    }
                }
            })
        });

    </script>
@endpush
