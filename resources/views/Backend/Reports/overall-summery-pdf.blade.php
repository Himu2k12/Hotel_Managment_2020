<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <title>
        Overall Report
    </title>
    <style>
        address{
            font-size: 13px;
        }
        table {

            border-collapse: collapse
        }
        th {
            text-align: inherit
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent
        }

        .table td,
        .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6
        }

        .table tbody + tbody {
            border-top: 2px solid #dee2e6
        }

        .table .table {
            background-color: #fff
        }

        .table-sm td,
        .table-sm th {
            padding: .3rem
        }

        .table-bordered {
            border: 1px solid #dee2e6
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6
        }

        .table-bordered thead td,
        .table-bordered thead th {
            border-bottom-width: 2px
        }

        .table-borderless tbody + tbody,
        .table-borderless td,
        .table-borderless th,
        .table-borderless thead th {
            border: 0
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, .05)
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, .075)
        }

        .table-primary,
        .table-primary > td,
        .table-primary > th {
            background-color: #b8daff
        }

        .table-primary tbody + tbody,
        .table-primary td,
        .table-primary th,
        .table-primary thead th {
            border-color: #7abaff
        }

        .table-hover .table-primary:hover {
            background-color: #9fcdff
        }

        .table-hover .table-primary:hover > td,
        .table-hover .table-primary:hover > th {
            background-color: #9fcdff
        }

        .table-secondary,
        .table-secondary > td,
        .table-secondary > th {
            background-color: #d6d8db
        }

        .table-secondary tbody + tbody,
        .table-secondary td,
        .table-secondary th,
        .table-secondary thead th {
            border-color: #b3b7bb
        }

        .table-hover .table-secondary:hover {
            background-color: #c8cbcf
        }

        .table-hover .table-secondary:hover > td,
        .table-hover .table-secondary:hover > th {
            background-color: #c8cbcf
        }

        .table-success,
        .table-success > td,
        .table-success > th {
            background-color: #c3e6cb
        }

        .table-success tbody + tbody,
        .table-success td,
        .table-success th,
        .table-success thead th {
            border-color: #8fd19e
        }

        .table-hover .table-success:hover {
            background-color: #b1dfbb
        }

        .table-hover .table-success:hover > td,
        .table-hover .table-success:hover > th {
            background-color: #b1dfbb
        }

        .table-info,
        .table-info > td,
        .table-info > th {
            background-color: #bee5eb
        }

        .table-info tbody + tbody,
        .table-info td,
        .table-info th,
        .table-info thead th {
            border-color: #86cfda
        }

        .table-hover .table-info:hover {
            background-color: #abdde5
        }

        .table-hover .table-info:hover > td,
        .table-hover .table-info:hover > th {
            background-color: #abdde5
        }

        .table-warning,
        .table-warning > td,
        .table-warning > th {
            background-color: #ffeeba
        }

        .table-warning tbody + tbody,
        .table-warning td,
        .table-warning th,
        .table-warning thead th {
            border-color: #ffdf7e
        }

        .table-hover .table-warning:hover {
            background-color: #ffe8a1
        }

        .table-hover .table-warning:hover > td,
        .table-hover .table-warning:hover > th {
            background-color: #ffe8a1
        }

        .table-danger,
        .table-danger > td,
        .table-danger > th {
            background-color: #f5c6cb
        }

        .table-danger tbody + tbody,
        .table-danger td,
        .table-danger th,
        .table-danger thead th {
            border-color: #ed969e
        }

        .table-hover .table-danger:hover {
            background-color: #f1b0b7
        }

        .table-hover .table-danger:hover > td,
        .table-hover .table-danger:hover > th {
            background-color: #f1b0b7
        }

        .table-light,
        .table-light > td,
        .table-light > th {
            background-color: #fdfdfe
        }

        .table-light tbody + tbody,
        .table-light td,
        .table-light th,
        .table-light thead th {
            border-color: #fbfcfc
        }

        .table-hover .table-light:hover {
            background-color: #ececf6
        }

        .table-hover .table-light:hover > td,
        .table-hover .table-light:hover > th {
            background-color: #ececf6
        }

        .table-dark,
        .table-dark > td,
        .table-dark > th {
            background-color: #c6c8ca
        }

        .table-dark tbody + tbody,
        .table-dark td,
        .table-dark th,
        .table-dark thead th {
            border-color: #95999c
        }

        .table-hover .table-dark:hover {
            background-color: #b9bbbe
        }

        .table-hover .table-dark:hover > td,
        .table-hover .table-dark:hover > th {
            background-color: #b9bbbe
        }

        .table-active,
        .table-active > td,
        .table-active > th {
            background-color: rgba(0, 0, 0, .075)
        }

        .table-hover .table-active:hover {
            background-color: rgba(0, 0, 0, .075)
        }

        .table-hover .table-active:hover > td,
        .table-hover .table-active:hover > th {
            background-color: rgba(0, 0, 0, .075)
        }

        .table .thead-dark th {
            color: #fff;
            background-color: #212529;
            border-color: #32383e
        }

        .table .thead-light th {
            color: #495057;
            background-color: #e9ecef;
            border-color: #dee2e6
        }

        .table-dark {
            color: #fff;
            background-color: #212529
        }

        .table-dark td,
        .table-dark th,
        .table-dark thead th {
            border-color: #32383e
        }

        .table-dark.table-bordered {
            border: 0
        }

        .table-dark.table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, .05)
        }

        .table-dark.table-hover tbody tr:hover {
            background-color: rgba(255, 255, 255, .075)
        }

        @media (max-width:575.98px) {
            .table-responsive-sm {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: -ms-autohiding-scrollbar
            }

            .table-responsive-sm > .table-bordered {
                border: 0
            }
        }

        @media (max-width:767.98px) {
            .table-responsive-md {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: -ms-autohiding-scrollbar
            }

            .table-responsive-md > .table-bordered {
                border: 0
            }
        }

        @media (max-width:991.98px) {
            .table-responsive-lg {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: -ms-autohiding-scrollbar
            }

            .table-responsive-lg > .table-bordered {
                border: 0
            }
        }

        @media (max-width:1199.98px) {
            .table-responsive-xl {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: -ms-autohiding-scrollbar
            }

            .table-responsive-xl > .table-bordered {
                border: 0
            }
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar
        }

        .table-responsive > .table-bordered {
            border: 0
        }
        @media print {
            .table {
                border-collapse: collapse !important
            }

            .table td,
            .table th {
                background-color: #fff !important
            }

            .table-bordered td,
            .table-bordered th {
                border: 1px solid #dee2e6 !important
            }

            .table-dark {
                color: inherit
            }

            .table-dark tbody + tbody,
            .table-dark td,
            .table-dark th,
            .table-dark thead th {
                border-color: #dee2e6
            }

            .table .thead-dark th {
                color: inherit;
                border-color: #dee2e6
            }

        }
        .textAlign{
            text-align: center;
        }
    </style>
</head>
<!------ Include the above in your HEAD tag ---------->
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div style="float: left">
                <img src="{{asset('/Images/')}}/logo.jpg"  alt="New York Logo" height="100px" width="100px" />

            </div>
            <div style="width: 450px; float: left" >
                <h2 style="padding-left: 155px; margin-bottom: 0px; color:#354356"><strong>Hotel New York</strong></h2>
                <h6 style="padding-left: 155px; margin-top: 0px; color:#354356"><strong>31/B, Topkhana Road, Dhaka-1000</strong></h6>
            </div>
            <div style="width:150px; float: left;padding-top: 25px ">
                <h6 style="margin: 0; padding: 0"> Call Us: +8801729-256171</h6>
                <h6 style="margin: 0; padding: 0">hotelnewyorkbd2020@gmail.com</h6>
                <p style="font-size: 10px">Printed By: <span style="color: #2fa360;"> {{Auth::user()->name}}</span> | {{date("h:i:sa")}} | {{Date('Y-m-d')}}</p>
            </div>
            <div style="clear: both"></div>
            <div style="float: left">
                <h3 style="color: #0b2e13; margin-bottom: 0px; margin-top: 0px">Report</h3>
            </div>

            <div style="text-align: right; margin-bottom: 0px; margin-top: 0px">
                <h5 style="margin-bottom: 0; margin-top: 0px; padding: 0"> From :<span>{{$from}}</span></h5>
                <h5 style="margin-bottom: 0;margin-top: 0px; padding: 0">To :<span>{{$to}}</span></h5>
            </div>
            <div style="clear: both"></div>
            <hr>
        </div>
    </div>
    <div style="margin-top: 0px">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 style="text-align: center"><strong>Overall View</strong></h3>
                </div>
                <div style="text-align: center; margin-left: auto; margin-right: auto">
                    <div class="table-responsive" >
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <?php $i=1; ?>
                            <tr style="background: #214b80; color: #ffffff; text-align: center">
                                <th style="width: 50%">Category</th>
                                <th>Amount(TK)</th>

                            </tr>
                            <tr>
                                <th>Room Rent</th>
                                <td class="textAlign" style="color: #2fa360">{{$totalRent}}</td>
                            </tr>
                            <tr>
                                <th>Booking Service</th>
                                <td class="textAlign">{{$totalservice}}</td>
                            </tr>
                            <tr>
                                <th>Total VAT</th>
                                <td class="textAlign">{{$totalTax}}</td>

                            </tr>
                            <tr>
                                <th>Additional Expenses</th>
                                <td class="textAlign" style="color: red">{{$totalExpense}}</td>

                            </tr>
                            <tr>
                                <th>Staff Salary</th>
                                <td class="textAlign" style="color: red">{{$totalSalary}}</td>

                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <th>Net Profit</th>
                                <td class="textAlign" style="color: #1b4b72"><b>{{$totalRent-($totalExpense+$totalSalary)}}</b></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
