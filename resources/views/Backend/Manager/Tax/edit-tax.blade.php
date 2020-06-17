@extends('Backend.master')

@section('title')
   Edit VAT
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 style="text-align: center" class="m-0 font-weight-bold text-primary">Edit VAT Amount</h4>
                <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
            </div>
            <div class="card mb-4 py-3 border-left-success">
                <div class="card-body">

                    <form class="form-inline" name="editVATForm" action="{{url('/update-tax')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group" style="width: 100%">
                            <label class="col-sm-3" style="text-align: center">VAT Percentage<span style="color: red">*</span></label>

                                <input type="hidden" value="{{$editById->id}}" name="id"/>
                                <input required type="number" min="0"  value="{{$editById->tax_percent}}" name="taxPercent" class="col-sm-2 form-control"/>
                                <span  style="color: red;">{{ $errors->has('tax_percent') ? $errors->first('tax_percent') : ' ' }}</span>
                                <label class="col-sm-2" style="text-align: center">Vat Status</label>
                                <select name="status" class="col-sm-2 form-control" style="margin-right: 20px">
                                    <option value="1">Activate</option>
                                    <option value="0">Deactivate</option>
                                </select>
                                <span  style="color: red;">{{ $errors->has('status') ? $errors->first('status') : ' ' }}</span>
                                <input type="submit" name="btn" class=" col-sm-1 btn btn-success btn-block" value="Update"/>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.forms['editVATForm'].elements['status'].value = '{{$editById->status }}';
    </script>
@endsection









