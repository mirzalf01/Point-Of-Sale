@extends('layouts.app2')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">New Stock Out</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/transaction/stockout">Stock Out</a></li>
                <li class="breadcrumb-item active">Transaction </li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- form -->
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Data Stock Out</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="/purchases/stockouttambahproses" method="post">
                  {{ csrf_field() }}
                  <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName1">Product Item</label>
                        <select class="form-control" name="id" id="exampleInputName1">
                          <option  value="">-- Select Product Item --</option>
                            @foreach ($items as $u)
                                <option  value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('id'))
                                    <div class="text-danger">
                                        {{ $errors->first('id')}}
                                    </div>
                        @endif
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="exampleInputStock3">Unit</label>
                          <input type="text" disabled class="form-control" name="unit" id="exampleInputStock3">
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="exampleInputStock4">Initial Stock</label>
                          <input type="number" disabled class="form-control" name="initialstock" id="exampleInputStock4">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDetail1">Detail</label>
                        <input type="text" class="form-control" name="detail" id="exampleInputDetail1" placeholder="Exp / Missing / Damaged / Etc" value="{{ old('detail') }}">
                          @if($errors->has('detail'))
                              <div class="text-danger">
                                  {{ $errors->first('detail')}}
                              </div>
                          @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputStock1">Qty</label>
                        <input type="number" class="form-control" name="stock" id="exampleInputStock1" placeholder="Enter stock" value="{{ old('stock') }}">
                          @if($errors->has('stock'))
                              <div class="text-danger">
                                  {{ $errors->first('stock')}}
                              </div>
                          @endif
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </section>
@endsection

@section('javascripts')
<script>
  $('#exampleInputName1').change(function() {
      var id = $(this).val();
      if(id == ""){
        $('#exampleInputStock3').val("");
        $('#exampleInputStock4').val("");
      }
      else{
        var url = '{{ route("getDetails", ":id") }}';
        url = url.replace(':id', id);

        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                if (response != null) {
                    $('#exampleInputStock3').val(response.unit);
                    $('#exampleInputStock4').val(response.stock);
                }
            }
        });
      }
      
  });
</script>
@endsection