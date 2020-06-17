@extends('Backend.master')

@section('title')
    Daily Transactions
@endsection

@section('style')
    <link href="{{asset('/Assets/')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">Daily Transactions</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Amount</th>
                            <th>Received By</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <?php
                            $total=0;
                        foreach($dailyTransaction as $item){

                            $total+=$item->paid_amount;
                                }
                            ?>
                        <tr>
                            <th>Total</th>
                            <th>{{$total}}</th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($dailyTransaction as $data)
                            <tr>
                                <td>{{$data->booking_id}}</td>
                                <td>{{$data->paid_amount}}</td>
                                <td>{{$data->name}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->



@endsection
@section('additionalScript')
    <!-- Page level plugins -->

@endsection
