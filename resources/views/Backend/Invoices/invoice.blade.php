<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
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
    </style>
</head>
<div>
<div class="row">
    <div >
        <div style="float: left; padding-top: 0px">
            <img src="{{asset('/Images/')}}/logo.JPG"  height="100px" width="100px" />
        </div>

        <div style="width: 450px; float: left" >
            <h2 style="padding-left: 150px; margin-bottom: 0px; color:#354356"><strong>Hotel New York</strong></h2>
            <h6 style="padding-left: 150px; margin-top: 0px; color:#354356"><strong>31/B, Topkhana Road, Dhaka-1000</strong></h6>
        </div>
        <div style="width:200px; float: left;padding-top: 25px ">
            <h6 style="margin: 0; padding: 0"> Call Us: +8801729-256171</h6>
            <h6 style="margin: 0; padding: 0">hotelnewyorkbd2020@gmail.com</h6>
        </div>
        <div style="clear: both"></div>
        <div class="invoice-title col-sm-2" style="float: left">
            <h4 style="">Invoice</h4>
        </div>
        <div class="invoice-title col-sm-2" style="float: left; padding-left: 235px;">
            <h4 style="color: #D36E79">Guest Copy</h4>
        </div>
        <div class="col-sm-10" style="text-align: right">
            <h5 >Invoice No # {{$booking->id}}</h5>
        </div>
        <hr>
        <div class="row" style="clear: both">
            <div style="float: right">
                <h4 style="color: #1C744B; margin-top: 2px; margin-bottom: 5px;">GUEST</h4>
                <address>
                    {{$customers->full_name}}<br>
                    Guest ID #{{$customers->id}} <br>
                    {{$customers->mobile_no}}<br>
                </address>
            </div>

            <div style="float: left">
                <h4 style="color: #1C744B;margin-top: 2px; margin-bottom: 5px;">ADDRESS</h4>
                <address>
                    {{$customers->address}}<br>
                    {{$customers->city}}<br>
                    {{$customers->country}}<br>
                    {{$customers->email_address}}<br>
                </address>
            </div>
        </div>
        <div style="clear: both"></div>
    </div>
</div>

<div class="row">
    <div class="col-md-12" style="clear: both">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title" style="text-align: center"><strong>Reservation Info</strong></h3>
            </div>
            <div class="panel-body" style="text-align: center; margin-left: auto; margin-right: auto">
                <div class="table-responsive" style="text-align: center">
                    <?php $subtotal=0; $i=1; ?>

                    <table align="center" class="table table-borderless table-hover table-striped table-light">
                        <thead style="background: #214b80; color: #ffffff;">
                        <tr>
                            <td><strong>Room Type</strong></td>
                            <td><strong>Adult</strong></td>
                            <td><strong>Check In</strong></td>
                            <td><strong>Check Out</strong></td>
                        </tr>
                        </thead>
                        <tbody style="font-size: .90rem">
                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                        <?php
                        $time = new DateTime($booking->check_in);
                        $checkIndate = $time->format('d-m-Y');

                        $time2 = new DateTime($booking->check_out);
                        $checkOutDate = $time2->format('d-m-Y');
                        ?>
                        <tr>
                            <td>{{$booking->room_type}}</td>
                            <td>{{$booking->adults}}</td>
                            <td>{{$checkIndate}}</td>
                            <td>{{$checkOutDate}}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <br>

                <h3 class="panel-title" style="text-align: center"><strong>Billing Summary</strong></h3>
                <table align="center" class="table table-borderless table-hover table-striped table-light">
                    <thead style="background: #214b80; color: #ffffff;">
                    <tr>
                        <td><strong>SL.</strong></td>
                        <td><strong>Category</strong></td>
                        <td><strong>Per Night</strong></td>
                        <td><strong>Quantity</strong></td>
                        <td><strong>Total</strong></td>
                    </tr>
                    </thead>
                    <tbody style="font-size: .90rem">
                        <tr>
                            <td>1.</td>
                            <td>{{"Room Rent"}}</td>
                            <td>{{$booking->basic_rent}}</td>
                            <td></td>
                            <td>{{$booking->total_rent}}</td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>VAT</td>
                            <td></td>
                            <td></td>
                            <td>{{$Tax->tax_amount}}</td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>{{"Service Charge"}}</td>
                            <td></td>
                            <td></td>
                            <td>{{$TotalServiceCharge}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td>{{"Grand Total"}}</td>
                            <td></td>
                            <td style="color: #2fa360"><b>{{$totalPayment}}</b></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div style="float:left; width:200px">
                  Payment Method:<span style="color: #2fa360;">{{$paymentMethod->payment_type}}</span>
                    <p style="font-size: 10px">Check-Out By:<span style="color: #2fa360;"> {{$checkOutBy->name}}</span> | Printed By: <span style="color: #2fa360;"> {{Auth::user()->name}} </span>|<span>{{$current_date_time}}</span></p>
                </div>
                <div style="float:right; border-top: 1px solid black; width:200px">
                    Authority Signature
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


<div>
    <div class="row">
        <div >
            <div style="float: left; padding-top: 0px">
                <img src="{{asset('/Images/')}}/logo.JPG"  height="100px" width="100px" />
            </div>

            <div style="width: 450px; float: left" >
                <h2 style="padding-left: 250px; margin-bottom:0px;  color:#354356"><strong>Hotel New York</strong></h2>
                <h6 style="padding-left: 250px; margin-top: 0px; color:#354356"><strong>31/B, Topkhana Road, Dhaka-1000</strong></h6>
            </div>
            <div style="width:160px; float: right;padding-top: 25px ">
                <h6 style="margin: 0; padding: 0"> Call Us: +8801729-256171</h6>
                <h6 style="margin: 0; padding: 0">hotelnewyorkbd2020@gmail.com</h6>
            </div>
            <div style="clear: both"></div>
            <div class="invoice-title col-sm-2" style="float: left">
                <h4 style="">Invoice</h4>
            </div>
            <div class="invoice-title col-sm-2" style="float: left; padding-left: 240px;">
                <h4 style="color: #D36E79">Hotel Copy</h4>
            </div>
            <div class="col-sm-10" style="text-align: right">
                <h5 >Invoice No # {{$booking->id}}</h5>
            </div>
            <hr>
            <div class="row" style="clear: both">
                <div style="float: right">
                    <h4 style="color: #1C744B;margin-top: 2px; margin-bottom: 5px;">GUEST</h4>
                    <address>
                        {{$customers->full_name}}<br>
                        Guest ID #{{$customers->id}} <br>
                        {{$customers->mobile_no}}<br>
                    </address>
                </div>

                <div style="float: left">
                    <h4 style="color: #1C744B;margin-top: 2px; margin-bottom: 5px;">ADDRESS</h4>
                    <address>
                        {{$customers->address}}<br>
                        {{$customers->city}}<br>
                        {{$customers->country}}<br>
                        {{$customers->email_address}}<br>
                    </address>
                </div>
            </div>
            <div style="clear: both"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12" style="clear: both">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title" style="text-align: center"><strong>Reservation Info</strong></h3>
                </div>
                <div class="panel-body" style="text-align: center; margin-left: auto; margin-right: auto">
                    <div class="table-responsive" style="text-align: center">
                        <?php $subtotal=0; $i=1; ?>

                        <table align="center" class="table table-borderless table-hover table-striped table-light">
                            <thead style="background: #214b80; color: #ffffff;">
                            <tr>
                                <td><strong>Room Type</strong></td>
                                <td><strong>Adult</strong></td>
                                <td><strong>Check In</strong></td>
                                <td><strong>Check Out</strong></td>
                            </tr>
                            </thead>
                            <tbody style="font-size: .90rem">
                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                            <?php
                            $time = new DateTime($booking->check_in);
                            $checkIndate = $time->format('d-m-Y');

                            $time2 = new DateTime($booking->check_out);
                            $checkOutDate = $time2->format('d-m-Y');
                            ?>
                            <tr>
                                <td>{{$booking->room_type}}</td>
                                <td>{{$booking->adults}}</td>
                                <td>{{$checkIndate}}</td>
                                <td>{{$checkOutDate}}</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <br>

                    <h3 class="panel-title" style="text-align: center"><strong>Billing Summary</strong></h3>
                    <table align="center" class="table table-borderless table-hover table-striped table-light">
                        <thead style="background: #214b80; color: #ffffff;">
                        <tr>
                            <td><strong>SL.</strong></td>
                            <td><strong>Category</strong></td>
                            <td><strong>Net Price</strong></td>
                            <td><strong>Quantity</strong></td>
                            <td><strong>Total</strong></td>
                        </tr>
                        </thead>
                        <tbody style="font-size: .90rem">
                        <tr>
                            <td>1.</td>
                            <td>{{"Room Rent"}}</td>
                            <td></td>
                            <td></td>
                            <td>{{$booking->total_rent}}</td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>{{"VAT"}}</td>
                            <td></td>
                            <td></td>
                            <td>{{$Tax->tax_amount}}</td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>{{"Service Charge"}}</td>
                            <td></td>
                            <td></td>
                            <td>{{$TotalServiceCharge}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td>{{"Grand Total"}}</td>
                            <td></td>
                            <td style="color: #2fa360"><b>{{$totalPayment}}</b></td>
                        </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div style="float:left; width:200px">
                        Payment Method:<span style="color: #2fa360;">{{$paymentMethod->payment_type}}</span>
                        <p style="font-size: 10px">Check-Out By:<span style="color: #2fa360;"> {{$checkOutBy->name}}</span> | Printed By: <span style="color: #2fa360;"> {{Auth::user()->name}} </span>|<span>{{$current_date_time}}</span></p>
                    </div>
                    <div style="float:right; border-top: 1px solid black; width:200px">
                        Guest Signature
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</html>
