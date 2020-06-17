@extends('Backend.master')

@section('title')
    Services
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <h4 style="text-align: center">Hotel New York Booking</h4>
                    <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
                </div>
            </div>
        </div>
        <form method="post" action="{{route('StoreBookingAdditional')}}">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-success">Service Materials</h6>
                        </div>
                        <div class="card-body multiple-field">
                            <div class="form-group row">
                                <label for="BookingID" class="col-md-2 col-form-label text-md-right">{{ __('Product Name') }}<span style="color: red">*</span></label>
                                <div class="col-md-2">
                                    <input id="ProductName" type="text" class="form-control" name="product_name[]" value="">
                                    <input type="hidden" name="booking_id" value="{{$id}}">
                                </div>
                                <label for="Partial_payment" class="col-md-1 col-form-label text-md-right">{{ __('Price') }}<span style="color: red">*</span></label>
                                <div class="col-md-2">
                                    <input id="price" min="0"  type="number" class="form-control" name="price[]"  >
                                </div>
                                <label for="Partial_payment" class="col-md-2 col-form-label text-md-right">{{ __('Quantity') }}<span style="color: red">*</span></label>
                                <div class="col-md-2">
                                    <input id="quantity" min="0"  type="number" class="form-control" name="quantity[]"  >
                                </div>

                            </div>

                        </div>
                        <div class="offset-1 col-md-1" style="padding-bottom: 5px;">
                            <input id="add-field"  type="button" class="btn btn-info form-control" value="Add" >
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                </div>
                <div class="col-md-12">
                    <div class="form-group row mb-0">

                        <div class="col-md-5 offset-md-5">
                            <button  type="submit" class="btn btn-primary col-sm-4">
                                {{ __('Confirm') }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- DataTales Example -->
            </div>
        </form>
        <div class="col-lg-12" style="margin-top: 3%">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info" style="text-align: center">Service History</h6>
                </div>
                <div class="card-body">
                    <table class="table table-dark">
                        <thead>
                        <tr>
                            <th>SL.</th>
                            <th style="text-align: center">Product Name</th>
                            <th style="text-align: center">Price</th>
                            <th style="text-align: center">Quantity</th>
                            <th style="text-align: center">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($service as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td style="text-align: center">{{$item->product_name}}</td>
                                <td style="text-align: center">{{$item->price}}</td>
                                <td style="text-align: center">{{$item->quantity}}</td>
                                <td style="text-align: center">{{$item->total_price}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-5">
                        <a href="{{url('view-bookings-by-id/'.$id)}}" >  <button  type="button" class="btn btn-warning col-sm-4">
                                {{ __('Back') }}
                            </button></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.container-fluid -->
<script>
    var total = 1;
    var addBlockId;
$(document).on('click','#add-field',function () {
     addBlockId = total = total + 1;
     if(addBlockId>5){
         alert('You can not add More than 5 at once!');
         total = total - 1;
         return false;
     }

    var addBlock = document.createElement('div');
    $(addBlock).addClass('form-group row');
    $(addBlock).attr('id','repeatField-' + addBlockId);

    var ProductLabel = document.createElement('label');
    $(ProductLabel).attr('class','col-md-2 col-form-label text-md-right');
    $(ProductLabel).text("Product Name*");
    $(ProductLabel).appendTo($(addBlock));

    var inputDiv = document.createElement('div');
    $(inputDiv).addClass('col-md-2');
    $(inputDiv).attr('id','repeatField-' + addBlockId);
    $(inputDiv).appendTo($(addBlock));

    var inputProductName = document.createElement('input');
    $(inputProductName).attr('type','text');
    $(inputProductName).attr('class','form-control');
    $(inputProductName).attr('name','product_name[]');
    $(inputProductName).attr('id','name-' + addBlockId);
    $(inputProductName).appendTo($(inputDiv));

    var PriceLabel = document.createElement('label');
    $(PriceLabel).attr('class','col-md-1 col-form-label text-md-right');
    $(PriceLabel).text("Price*");
    $(PriceLabel).appendTo($(addBlock));

    var inputDiv2 = document.createElement('div');
    $(inputDiv2).addClass('col-md-2');
    $(inputDiv2).attr('id','repeatField-' + addBlockId);
    $(inputDiv2).appendTo($(addBlock));

    var inputPrice = document.createElement('input');
    $(inputPrice).attr('type','number');
    $(inputPrice).attr('class','form-control');
    $(inputPrice).attr('name','price[]');
    $(inputPrice).attr('id','price-' + addBlockId);
    $(inputPrice).appendTo($(inputDiv2));

    var quantityLabel = document.createElement('label');
    $(quantityLabel).attr('class','col-md-2 col-form-label text-md-right');
    $(quantityLabel).text("Quantity*");
    $(quantityLabel).appendTo($(addBlock));

    var inputDiv3 = document.createElement('div');
    $(inputDiv3).addClass('col-md-2');
    $(inputDiv3).attr('id','repeatField-' + addBlockId);
    $(inputDiv3).appendTo($(addBlock));

    var inputQuantity = document.createElement('input');
    $(inputQuantity).attr('type','number');
    $(inputQuantity).attr('class','form-control');
    $(inputQuantity).attr('name','quantity[]');
    $(inputQuantity).attr('id','quantity-' + addBlockId);
    $(inputQuantity).appendTo($(inputDiv3));

    var button = document.createElement('button');
    $(button).attr('class','col-md-1 btn btn-danger form-control');
    $(button).attr('id','remove');
    $(button).attr('type','button');
    $(button).attr('onclick','remove('+addBlockId+')');
    $(button).text('X');
    $(button).appendTo($(addBlock));

    $(addBlock).appendTo($('.multiple-field'));

})
    function remove(id){

        $("#repeatField-" + id).remove();
        total = total - 1;
    }

</script>

@endsection

