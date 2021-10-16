<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>New</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />

    <style>
        .container .main_pic img {
            width: 100%;
        }


        .container .list {
            list-style: none;
            text-align: left;
        }

        table,
        tr,
        th,
        td {
            border: 1px solid black;
        }

        table th {
            color: rgb(60, 146, 175);
        }

        .heading {
            font-size: 30px;
        }

        .heading2 {
            font-size: 20px;
        }

        /* Today's CSS  */
        .container .pictures img {
            width: 50%;
            /* object-fit: contain; */
            margin: 20px 20px;
        }

        .imagee .mini_img {
            width: 25%;
            border: none;
            margin-top: 20px;
            margin-left: 20px;
        }

        .imagee {
            border: none;
        }

        .med-imagee .medium_img {
            width: 40%;
            border: none;
            margin-top: 28px;
        }

        .big-image .large_image {
            width: 70%;
            border: none;
            margin-top: 20px;
        }

    </style>
</head>

<body>
<main>
    <!-- Heading -->
    <div class="container">
        <div class="row mt-2 d-flex flex-row heading">
            <div class="col-lg-12 fw-bold text-center">VALUATION REPORT</div>
            <div class="col-lg-12 text-info fw-bold text-center">LAND</div>
        </div>
    </div>

    <!-- Main Image -->
    <div class="container">
        <div class="row main_pic">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <img src="https://ms.ilaan.com/mediaresources/propertyimage/162561/366x240/975f9d47-a711-4eb2-9bc3-497c03099e65_366_240.jpg"
                     alt="Property" />
            </div>
        </div>
    </div>

    <!-- Collection Of Table -->
    <div class="container">
        <div class="row mt-0 mb-1">
            <div class="col-lg-12 mx-auto">
                {{-- Table 1 Basic Data --}}
                <table class="table table-bordered text-left">
                    <thead></thead>
                    <tbody>
                    <tr>
                        <th scope="row">Client's Name</th>
                        <td>
                            {{ $clientName }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Instruction Date</th>
                        <td>
                            10th February 2021 (Instructed By: Mr. Ebrahim Mohammed)
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Subject Property</th>
                        <td>Vacant Land</td>
                    </tr>
                    <tr>
                        <th scope="row">Inspection Date</th>
                        <td>10th February 2021</td>
                    </tr>
                    <tr>
                        <th scope="row">Valuation Date</th>
                        <td>11th February 2021</td>
                    </tr>
                    <tr>
                        <th scope="row">Report Date</th>
                        <td>{{ $date }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Valuer Name & Details</th>
                        <td>
                            Ali Adnan Hasan Mahmood <br />
                            Corporate Valuation Officer <br />
                            RERA Certified Valuer <br />
                            License No. V202011/0079
                        </td>
                    </tr>
                    </tbody>
                </table>

                <!-- Table 2 Purpose Of Valuation -->
                <table class="table table-bordered text-left imagee">
                    <thead></thead>
                    <tbody>
                    <tr>
                        <th scope="row">Purpose of Valutation</th>
                        <td>{{ $purposeOfValuation }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Basis of Valuation</th>
                        <td>{{ $basisOfValuation }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Valuation Approach</th>
                        <td>{{ $approachInfo }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Inspection Date</th>
                        <td>10th February 2021</td>
                    </tr>
                    <tr>
                        <th scope="row">Valuation Method</th>
                        <td>Comparable Approach</td>
                    </tr>
                    <tr>
                        <th scope="row">Report Currency</th>
                        <td>Bahraini Dinars (BHD)</td>
                    </tr>
                    <tr>
                        <th scope="row">Sources of Information</th>
                        <td>
                            1. Copy of Title Deed No. 216760 included in Appendix No.
                            1
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Title Deed Details</th>
                        <td></td>
                    </tr>

                    <tr>
                        <th>
                            <ul class="fw-light text-justify">
                                <li>Land Size (IPMS-1)</li>
                                <li>Title Deed No.</li>
                                <li>Case No.</li>
                                <li>Plot No.</li>
                                <li>No. of Access Roads</li>
                                <li>Land Shape</li>
                                <li>Land Category</li>
                                <li>Land Classification</li>
                                <li>Area Name</li>
                            </ul>
                        </th>
                        <td>
                            <ul class="list">
                                <li>2,330.40 m2 (25’084.40 sq. ft)</li>
                                <li>216760</li>
                                <li>2020/17630</li>
                                <li>07030845</li>
                                <li>1 access roads</li>
                                <li>Rectangle</li>
                                <li>Investment</li>
                                <li>Special Project - SP</li>
                                <li>Janabiya - Bahrain</li>
                            </ul>
                        </td>
                    </tr>
                    <!-- {{-- Today's Code --}} -->
                    <tr>
                        <th scope="row">Tenure & Property Legal Status</th>
                        <td>
                            As per the title deed attached issued by SLRB, this Freehold
                            property is registered under the name Nabeel Nooraddin
                        </td>
                    </tr>
                    </tbody>
                </table>

                {{-- Table 3 Images --}}
                <table class="table imagee table-borderless">
                    <tbody>
                    <tr>
                        <td>
                            <img class="mini_img"
                                 src="https://cdn.education.com/files/490001_491000/490405/file_490405.JPG"
                                 alt="pic_1" />
                        </td>
                        <td>
                            <img class="mini_img"
                                 src="https://cdn.education.com/files/490001_491000/490405/file_490405.JPG"
                                 alt="pic_1" />
                        </td>
                        <td>
                            <img class="mini_img"
                                 src="https://cdn.education.com/files/490001_491000/490405/file_490405.JPG"
                                 alt="pic_1" />
                        </td>
                    </tr>
                    </tbody>
                </table>

                {{-- Table 4 Empty Tables --}}
                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title Deed First Page</th>
                        <th scope="col">Actual Land Map</th>
                        <th scope="col">Actual Land Aerial Map</th>
                        <th scope="col">Property Ownership Page</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>

                {{-- Table 5 Property Description --}}
                <div class="row">
                    <div class="col-lg-12 fw-bold text-center heading">Property Description</div>
                </div>
                <table class="table table-bordered text-center med-imagee">
                    <tbody>
                    <tr>
                        <th scope="row">Property Location</th>
                        <td>
                            This Vacant land is located in the west of Janabiya, North
                            of District One, along Sh. Isa bin Salman highway, south
                            of Kingdom mall.
                        </td>
                    </tr>
                    {{-- Resolve This --}}
                    <tr>
                        <th scope="row">
                            <img class="medium_img"
                                 src="https://cdn.education.com/files/490001_491000/490405/file_490405.JPG"
                                 alt="" />
                        </th>
                        <td>
                            <img class="medium_img"
                                 src="https://www.researchgate.net/profile/Abdullah-Akay-3/publication/289127694/figure/fig5/AS:668709601439757@1536444201342/The-map-of-land-use-types-The-land-capability-classification-of-the-study-area-was.png"
                                 alt="" />
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Current Occupation & Tenancies</th>
                        <td>
                            At the date of inspection, the property was vacant with no
                            construction of any kind.
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Assumptions</th>
                        <td>
                            <ol>
                                <li>
                                    We have assumed that the property has a good and
                                    marketable title with no restrictions or limitations.
                                </li>
                                <li>
                                    We have assumed that there are no outstanding taxes,
                                    rates, community, or property management service
                                    charges associated with the property.
                                </li>
                                <li>
                                    We have assumed that IPMS-1 is the basis of
                                    measurements of property in the Kingdom of Bahrain.
                                </li>
                                <li>
                                    If any of the information or assumptions on which this
                                    valuation is based area subsequently found to be
                                    incorrect, or any additional information is provided
                                    differently than that stated in this report, we then
                                    reserve the right to amend the report including our
                                    opinion of value.
                                </li>
                            </ol>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Special Assumptions</th>
                        <td>None</td>
                    </tr>
                    </tbody>
                </table>

                {{-- Table 6 Propery Valuation --}}
                <div class="row">
                    <div class="col-lg-12 fw-bold text-center heading">Property Valuation</div>
                </div>
                <div class="row">
                    <div class="col-lg-12 fw-bold text-center heading2">Table of Comparables</div>
                </div>
                <table class="table table-bordered text-center big-image">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Matrix</th>
                        <th scope="col">Subject Property</th>
                        <th scope="col">Comparable No.1</th>
                        <th scope="col">Comparable No.2</th>
                        <th scope="col">Comparable No.3</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Property Type</td>
                        <td>Investment Land</td>
                        <td>Investment Land</td>
                        <td>Investment Land</td>
                        <td>Investment Land</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Property Description</td>
                        <td>Vacant Land</td>
                        <td>Vacant Land</td>
                        <td>Vacant Land</td>
                        <td>Vacant Land</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Area Name</td>
                        <td>Janabiya</td>
                        <td>Janabiya</td>
                        <td>Janabiya</td>
                        <td>Janabiya</td>
                    </tr>

                    <tr>
                        <th scope="row">4</th>
                        <td>Land Size (IPMS-1) m2</td>
                        <td>2330</td>
                        <td>2330</td>
                        <td>2330</td>
                        <td>2330</td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>No of Access Road</td>
                        <td>1 (Asphalted)</td>
                        <td>1 (Asphalted)</td>
                        <td>1 (Asphalted)</td>
                        <td>1 (Asphalted)</td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>Land Shape & Structure</td>
                        <td>Rectanglular</td>
                        <td>Rectanglular</td>
                        <td>Rectanglular</td>
                        <td>Rectanglular</td>
                    </tr>
                    <tr>
                        <th scope="row">7</th>
                        <td>Classification</td>
                        <td>Special Project - SP</td>
                        <td>Special Project - SP</td>
                        <td>Special Project - SP</td>
                        <td>Special Project - SP</td>
                    </tr>
                    <tr>
                        <th scope="row">8</th>
                        <td>Location</td>
                        <td>Good</td>
                        <td>Good</td>
                        <td>Good</td>
                        <td>Good</td>
                    </tr>

                    <tr>
                        <th scope="row">9</th>
                        <td>Accessibility</td>
                        <td>Easy</td>
                        <td>Easy</td>
                        <td>Easy</td>
                        <td>Easy</td>
                    </tr>

                    <tr>
                        <th scope="row">10</th>
                        <td>Property Lump Sum in BD</td>
                        <td></td>
                        <td>961,010.00</td>
                        <td>961,010.00</td>
                        <td>961,010.00</td>
                    </tr>

                    <tr>
                        <th scope="row">11</th>
                        <td>Source of Comparable</td>
                        <td></td>
                        <td>Estate Agent</td>
                        <td>Estate Agent</td>
                        <td>Estate Agent</td>
                    </tr>

                    <tr>
                        <th scope="row">12</th>
                        <td>Status of Comparable</td>
                        <td></td>
                        <td>On the Market, for sale</td>
                        <td>On the Market, for sale</td>
                        <td>On the Market, for sale</td>
                    </tr>

                    <tr>
                        <th scope="row">13</th>
                        <td>Date of Comparable</td>
                        <td></td>
                        <td>Somewhat Recent</td>
                        <td>Somewhat Recent</td>
                        <td>Somewhat Recent</td>
                    </tr>

                    <tr>
                        <th scope="row"></th>
                        <td colspan="5">
                            <img class="large_image"
                                 src="https://cdn.corporatefinanceinstitute.com/assets/00120-DCF-Model.png"
                                 alt="Property">
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">14</th>
                        <td colspan="2">Subject Property Market Value</td>
                        <td colspan="3">
                            Eight Hundred Fifty-Four Thousand Bahraini Dinars (Rounded to
                            nearest Thousand)
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">15</th>
                        <td colspan="2">About the Comparable</td>
                        <td colspan="3">...</td>
                    </tr>
                    <tr>
                        <th scope="row">16</th>
                        <td colspan="2">Reliance on the Report</td>
                        <td colspan="3">...</td>
                    </tr>

                    <tr>
                        <th scope="row">17</th>
                        <td colspan="2">Optinion of Value</td>
                        <td colspan="3">...</td>
                    </tr>

                    <tr>
                        <th scope="row">18</th>
                        <td colspan="2">Services & Utilities</td>
                        <td colspan="3">...</td>
                    </tr>

                    <tr>
                        <th scope="row">19</th>
                        <td colspan="2">Planning Permission & Consents</td>
                        <td colspan="3">...</td>
                    </tr>

                    @foreach ($selectedReportData as $key => $selectedReportDataIn)

                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td colspan="2">{{$selectedReportDataIn['title']}}</td>
                        <td colspan="3">{{$selectedReportDataIn['content']}}</td>
                    </tr>

                    @endforeach




                    <tr>
                        <th scope="row"></th>
                        <td colspan="4">
                            We trust that this valuation report fulfils the requirement of
                            the client instruction.
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <th></th>
                        <td colspan="4">Yours faithfully,</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2">
                            Ali Adnan Mahmood <br />
                            Corporate Valuation Officer <br />
                            RERA Certified Valuer
                        </td>
                        <td colspan="2">
                            Ali Adnan Mahmood <br />
                            Corporate Valuation Officer <br />
                            RERA Certified Valuer
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td colspan="4">Attachments</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td colspan="3">Appendix No.1</td>
                        <td colspan="2">
                            <ol>
                                <li>Copy of the Title Deed</li>
                            </ol>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>
</body>

</html>
