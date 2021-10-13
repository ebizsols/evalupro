@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">

        <!-- .page title -->
        <div class="col-lg-8 col-md-5 col-sm-6 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> {{ __($pageTitle) }}
                <span class="text-info b-l p-l-10 m-l-5">{{ $propertiesCount }}</span> <span
                        class="font-12 text-muted m-l-5"> @lang('valuation::valuation.property.total')</span>
            </h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-4 col-sm-6 col-md-7 col-xs-12 text-right">
            <a href="{{ route('valuation.admin.property') }}" class="btn btn-outline btn-danger btn-sm">@lang('valuation::valuation.property.propertyBackBtn') <i class="fa fa-plus" aria-hidden="true"></i></a>

            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li class="active">{{ __($pageTitle) }}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('plugins/property-detail-template/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/property-detail-template/css/all-themes.css') }}">

@endpush

@section('content')
<style>
    .label-danger
    {
        color: #fff !important;
    }
</style>
    <div class="row">

        <div class="col-md-12">
            <div class="white-box">
                <section class="content profile-page">
                    <div class="container-fluid">
                        <div class="block-header">
                            <h2>Property Detail</h2>
                            <small class="text-muted">Welcome to Swift application</small>
                        </div>        
                        <div class="row clearfix">
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="body property">
                                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
                                            <!-- Indicators -->
                                            <ol class="carousel-indicators">
                                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                            </ol>

                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner" role="listbox">
                                                <div class="item active"> <img src="{{ asset('plugins/property-detail-template/img/puppy-1.jpg') }}" alt=""/> </div>
                                                <div class="item"> <img src="{{ asset('plugins/property-detail-template/img/puppy-2.jpg') }}" alt="" /> </div>
                                                <div class="item"> <img src="{{ asset('plugins/property-detail-template/img/puppy-3.jpg') }}" alt="" /> </div>
                                            </div>

                                            <!-- Controls --> 
                                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                        <div class="property-card">
                                            <div class="property-content">
                                                <div class="listingInfo">
                                                    <div class="">
                                                        <h4 class="text-success m-t-15">$390,000 - $430,000</h4>
                                                        <h4 class="m-t-0"><a href="#" class="col-blue-grey">4BHK Alexander Court,New York</a></h4>
                                                    </div>
                                                    <div class="detail">                                           
                                                        <p class="text-muted"><i class="zmdi zmdi-pin m-r-5"></i>245 E 20th St, New York, NY 201609</p>
                                                        <p class="m-b-0">Quisque non dictum eros. Praesent porta vehicula arcu eu ornare. Donec id egestas arcu. Suspendisse auctor condimentum ligula ultricies cursus. Vestibulum vel orci vel lacus rhoncus sagittis sed vitae mi. Pellentesque molestie elit bibendum tincidunt semper. Aliquam ac volutpat risus. In felis felis, posuere commodo aliquet eget, sagittis sed turpis. Phasellus commodo turpis non nunc egestas, et egestas felis pretium. Pellentesque dignissim libero vitae tincidunt semper. Nam id ante nisi. Nam sollicitudin, dolor non suscipit feugiat, nibh lacus commodo metus, nec tempus dui velit sagittis velit. Pellentesque elementum risus rhoncus justo porta, at varius odio consequat. Duis non augue adipiscing, posuere quam non, tempus urna. </p>
                                                    </div>
                                                </div>
                                                <div class="property-action m-t-15">
                                                    <a href="#" title="Square Feet"><i class="zmdi zmdi-view-dashboard"></i><span>280</span></a>
                                                    <a href="#" title="Bedroom"><i class="zmdi zmdi-hotel"></i><span>4</span></a>
                                                    <a href="#" title="Parking space"><i class="zmdi zmdi-car-taxi"></i><span>2</span></a>
                                                    <a href="#" title="Garages"><i class="zmdi zmdi-home"></i><span> 24H</span></a>
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                                <div class="card">
                                                        <div class="header">
                                                                <h2>General Amenities<small>Description text here...</small> </h2>
                                                        </div>
                                                        <div class="body">
                                        <div class="row clearfix">
                                            <div class="col-sm-4">
                                                <ul class="list-unstyled proprerty-features">
                                                <li>
                                                    <i class="zmdi zmdi-check-circle text-success m-r-5"></i>
                                                    Swimming pool
                                                </li>
                                                <li>
                                                    <i class="zmdi zmdi-check-circle text-success m-r-5"></i>
                                                    Air conditioning
                                                </li>
                                                <li>
                                                    <i class="zmdi zmdi-check-circle text-success m-r-5"></i>
                                                    Internet
                                                </li>
                                                <li>
                                                    <i class="zmdi zmdi-check-circle text-success m-r-5"></i>
                                                    Radio
                                                </li>
                                                <li>
                                                    <i class="zmdi zmdi-check-circle text-success m-r-5"></i>
                                                    Balcony
                                                </li>
                                                <li>
                                                    <i class="zmdi zmdi-check-circle text-success m-r-5"></i>
                                                    Roof terrace
                                                </li>
                                                <li>
                                                    <i class="zmdi zmdi-check-circle text-success m-r-5"></i>
                                                    Cable TV
                                                </li>
                                                <li>
                                                    <i class="zmdi zmdi-check-circle text-success m-r-5"></i>
                                                    Electricity
                                                </li>
                                            </ul>
                                            </div>
                                            <div class="col-sm-4">
                                                <ul class="list-unstyled proprerty-features">
                                                    <li>
                                                        <i class="zmdi zmdi-star text-warning m-r-5"></i>
                                                        Terrace
                                                    </li>
                                                    <li>
                                                        <i class="zmdi zmdi-star text-warning m-r-5"></i>
                                                         Cofee pot
                                                    </li>
                                                    <li>
                                                        <i class="zmdi zmdi-star text-warning m-r-5"></i>
                                                        Oven
                                                    </li>
                                                    <li>
                                                        <i class="zmdi zmdi-star text-warning m-r-5"></i>
                                                        Towelwes
                                                    </li>
                                                    <li>
                                                        <i class="zmdi zmdi-star text-warning m-r-5"></i>
                                                        Computer
                                                    </li>
                                                    <li>
                                                        <i class="zmdi zmdi-star text-warning m-r-5"></i>
                                                        Grill
                                                    </li>
                                                    <li>
                                                        <i class="zmdi zmdi-star text-warning m-r-5"></i>
                                                        Parquet
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4">
                                                <ul class="list-unstyled proprerty-features">

                                                    <li>
                                                        <i class="zmdi zmdi-check-circle text-info m-r-5"></i>
                                                        Dishwasher
                                                    </li>
                                                    <li>
                                                        <i class="zmdi zmdi-check-circle text-info m-r-5"></i>
                                                        Near Green Zone
                                                    </li>
                                                    <li>
                                                        <i class="zmdi zmdi-check-circle text-info m-r-5"></i>
                                                        Near Church
                                                    </li>
                                                    <li>
                                                        <i class="zmdi zmdi-check-circle text-info m-r-5"></i>
                                                        Near Hospital
                                                    </li>
                                                    <li>
                                                        <i class="zmdi zmdi-check-circle text-info m-r-5"></i>
                                                        Near School
                                                    </li>
                                                    <li>
                                                        <i class="zmdi zmdi-check-circle text-info m-r-5"></i>
                                                        Near Shop
                                                    </li>
                                                    <li>
                                                        <i class="zmdi zmdi-check-circle text-info m-r-5"></i>
                                                        Natural Gas
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                                </div>
                                <div class="card">
                                                        <div class="header">
                                                                <h2>Location<small>Description text here...</small> </h2>
                                                        </div>
                                                        <div class="body">
                                        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=svdezAlqZP2WIeKGiLW4EUnoJvnxVP7i&amp;width=100%&amp;height=400&amp;lang=tr_TR&amp;sourceType=constructor&amp;scroll=true"></script>
                                    </div>
                                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="body">
                                        <div class="member-card verified">
                                            <ul class="header-dropdown">
                                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="zmdi zmdi-more-vert"></i></a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Edit</a></li>
                                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Delete</a></li>
                                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Block</a></li>
                                                    </ul>
                                                </li>
                                                                    </ul>
                                            <div class="thumb-xl member-thumb">
                                                <img src="{{ asset('plugins/property-detail-template/img/random-avatar3.jpg') }}" class="img-circle" alt="profile-image">
                                                <i class="zmdi zmdi-info" title="verified user"></i>
                                            </div>

                                            <div class="">
                                                <h4 class="m-b-5">John</h4>
                                                <p class="text-muted">Brokker<span> <a href="#" class="text-pink">websitename.com</a> </span></p>
                                            </div>

                                            <p class="text-muted">795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>                           
                                            <a href="agent-profile.html" class="btn btn-raised btn-sm">View Profile</a>
                                            <ul class="social-links list-inline m-t-10">
                                                <li><a title="facebook" href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                                <li><a title="twitter" href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                                <li><a title="instagram" href="3"><i class="zmdi zmdi-instagram"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-12">
                                            <h2 class="card-inside-title">Request Inquiry</h2>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control">
                                                    <label class="form-label">Username</label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control">
                                                    <label class="form-label">Phone</label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control">
                                                    <label class="form-label">Your E-mail</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea rows="4" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <button type="button" class="btn btn-raised g-bg-blue waves-effect m-b-15">Send</button>
                                        </div>
                                    </div>
                                </div>                
                                <div class="card">
                                                        <div class="header">
                                                                <h2>Location<small>Description text here...</small> </h2>
                                                        </div>
                                                        <div class="body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered m-b-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Price:</th>
                                                        <td>$390,000</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Contract type: </th>
                                                        <td><span class="label label-danger">For Sale</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Bathrooms:</th>
                                                        <td>1.5</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Square ft:</th>
                                                        <td>468</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Garage Spaces:</th>
                                                        <td>2</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Land Size:</th>
                                                        <td>721 m²</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Floors:</th>
                                                        <td>2</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Listed for:</th>
                                                        <td>15 days</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Available:</th>
                                                        <td>Immediately</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Pets:</th>
                                                        <td>Pets Allowed</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Bedrooms:</th>
                                                        <td>3</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- .row -->

@endsection

@push('footer-script')
   

    
@endpush