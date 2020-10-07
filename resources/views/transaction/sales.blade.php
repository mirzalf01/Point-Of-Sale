@extends('layouts.app2')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Sales</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/transaction/sales">Sales</a></li>
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
            <div class="col-md-4">
                <div class="card card-info">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal">
                      <div class="card-body">
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-4 col-form-label">Date</label>
                          <div class="col-sm-8">
                          <input type="email" class="form-control" disabled id="inputEmail3" value="{{ date('d/m/Y') }}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-4 col-form-label">Seller</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" disabled value="{{ Auth::user()->name }}">
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputCustomer" class="col-sm-4 col-form-label">Customer</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="customer" id="inputCustomer">
                                    <option  value="Umum">Umum</option>
                                    @foreach ($customers as $c)
                                        <option  value="{{ $c->name }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                      </div>
                      <!-- /.card-body -->
                      <!-- /.card-footer -->
                    </form>
                  </div>
              <!-- /.card -->
            </div>
            <div class="col-md-4">
                <div class="card card-info">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" role="form" action="/transaction/cart" method="post">
                      {{ csrf_field() }}
                      <div class="card-body">
                        <div class="form-group row">
                          <label for="exampleInputItem" class="col-sm-2 col-form-label">Item</label>
                          <div class="col-sm-10">
                            <select class="form-control" name="id" id="exampleInputItem">
                                <option value="">- Select Item -</option>
                                @foreach ($items as $c)
                                    <option  value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('id'))
                              <div class="text-danger">
                                  {{ $errors->first('id')}}
                              </div>
                            @endif
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group row">
                              <label for="inputQty" class="col-sm-4 col-form-label">Qty</label>
                              <div class="col-sm-8">
                                <input type="number" name="qty" class="form-control" id="inputQty">
                              </div>
                              
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group row">
                              <label for="maxQty" class="col-sm-4 col-form-label">Max</label>
                              <div class="col-sm-8">
                                <input type="number" name="qty" class="form-control" id="maxQty" disabled>
                              </div>
                            </div>
                          </div>
                        </div>
                        @if($errors->has('qty'))
                                    <div class="text-danger">
                                        {{ $errors->first('qty')}}
                                    </div>
                              @endif
                        <div class="form-group row">
                            <label for="inputCustomer" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-info"><span class="fa fa-shopping-cart" aria-hidden="true"></span> Add</button>
                            </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                      
                      <!-- /.card-footer -->
                    </form>
                  </div>
              <!-- /.card -->
            </div>
            <div class="col-md-4">
                <div class="card card-info">
                    <!-- /.card-header -->
                    <!-- form start -->
                      <div class="card-body">
                        <h3>Total</h3>
                        <h1 style="text-align: right">{{ number_format($total, 0, ".", ".") }} IDR</h1>
                        <input type="hidden"  id="totalPrice" value="{{ $total }}">
                      </div>
                      <!-- /.card-body -->
                      <!-- /.card-footer -->
                  </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header border-transparent">
                  <a href="/cart/clearcart" class="btn btn-sm btn-danger float-right"><span class="far fa-trash-alt" aria-hidden="true"></span> Clear Cart</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table m-0 table-hover">
                      <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Discount</th>
                        <th>Total</th>
                        <th>Option</th>
                      </tr>
                      </thead>
                      <tbody id="tbody">
                        @if ($cart->count() == 0)
                            <tr><td colspan="7" style="text-align: center">No Items</td></tr>
                        @else
                          @foreach ($cart as $key=>$s)
                          <tr>
                            <td>{{ 1+$key}}</td>
                            <td>{{ $s->name }}</td>
                            <td>{{ number_format($s->price, 0, ".", ".") }}</td>
                            <td>{{ $s->qty }}</td>
                            <td>{{ number_format($s->discount, 0, ".", ".") }}</td>
                            <td>{{ number_format($s->total, 0, ".", ".") }}</td>
                            <td style="text-align: center">
                              <button type="button" value="{{ $s->id }}" class="btn btn-info btn-sm modBut" data-toggle="modal" data-target="#exampleModal">
                                <span class="fas fa-edit" aria-hidden="true"></span></a>
                              </button>
                              <a href="/cart/hapus/{{ $s->id }}" class="btn btn-danger btn-sm"><span class="far fa-trash-alt" aria-hidden="true"></a>  
                            </td>
                          </tr>
                          @endforeach
                        @endif
                        
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-8">
                <div class="card card-info">
                    <!-- /.card-header -->
                      <div class="card-body">
                        <div class="form-group row">
                          <label for="inputCash" class="col-sm-4 col-form-label">Cash</label>
                          <div class="col-sm-8">
                          <input type="number" class="form-control"  id="inputCash">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputChange" class="col-sm-4 col-form-label">Change</label>
                          <div class="col-sm-8">
                            <input type="text" value="0" class="form-control" id="inputChange" disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Detail</label>
                          <div class="col-sm-8">
                            <textarea id="detail" class="form-control" rows="4" placeholder="Enter detail"></textarea>
                          </div>
                        </div>
                          <!-- /.card-body -->
                          
                      </div>
                      <!-- /.card-body -->
                      <!-- /.card-footer -->
                    
                  </div>
              <!-- /.card -->
            </div>
            <div class="col-md-4" style="padding-bottom: 0">
              <div  class="row">
                <form method="POST" style="width: 100%" action="/transaction/process">
                  {{ csrf_field() }}
                  <input type="hidden" id="pCus" name="customer" value="Umum">
                  <input type="hidden" id="pDetail" name="detail" value="">
                  <div style="width:100%;"><button type="submit" style="width: 100% !important" class="btn btn-success"><span class="fa fa-paper-plane" aria-hidden="true"></span> Process</button></div>
                </form>
                  <br>
              </div>
              
            </div>
            
            <!-- /.col -->
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- Modal Form -->
                <div class="modal-body">
                  <form role="form" action="/cart/editproses" method="post">
                    {{ csrf_field() }}
                    <div class="card-body">
                      <div class="form-group">
                        <label for="mName">Name</label>
                          <input type="text" disabled class="form-control" name="mname" id="mName">
                          @if($errors->has('mname'))
                              <div class="text-danger">
                                  {{ $errors->first('mname')}}
                              </div>
                          @endif
                      </div>
                      <input type="hidden" id="mid" name="mid">
                      <div class="form-group">
                        <label for="mPrice">Price</label>
                          <input type="number" disabled class="form-control" name="mprice" id="mPrice">
                          @if($errors->has('mprice'))
                              <div class="text-danger">
                                  {{ $errors->first('mprice')}}
                              </div>
                          @endif
                      </div>
                      <div class="form-group">
                        <label for="mQty">Qty</label>
                          <input type="number" class="form-control" name="mqty" id="mQty">
                          @if($errors->has('mqty'))
                              <div class="text-danger">
                                  {{ $errors->first('mqty')}}
                              </div>
                          @endif
                      </div>
                      <div class="form-group">
                        <label for="mDiscount">Discount</label>
                          <input type="number" class="form-control" name="mdiscount" id="mDiscount">
                          @if($errors->has('mdiscount'))
                              <div class="text-danger">
                                  {{ $errors->first('mdiscount')}}
                              </div>
                          @endif
                      </div>
                      <div class="form-group">
                        <label for="mTotal">Total</label>
                          <input type="number" disabled class="form-control" name="mtotal" id="mTotal">
                          @if($errors->has('mtotal'))
                              <div class="text-danger">
                                  {{ $errors->first('mtotal')}}
                              </div>
                          @endif
                      </div>
                      <button type="submit" class="btn btn-primary float-right">Save changes</button>
                    </div>
                    <!-- /.card-body -->
                    
                  </form>
                </div>
                <div class="modal-footer">
                </div>
              
            </div>
          </div>
        </div>
    </section>
@endsection

@section('javascripts')
<script>
  $('#exampleInputItem').change(function() {
        var id = $(this).val();
        if(id == ""){
            $('#maxQty').val("");
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
                        $('#maxQty').val(response.stock);
                    }
                }
            });
        }
  });
  $('.modBut').click(function(){
    var id = $(this).val();
    var url = '{{ route("getDetailsCart", ":id") }}';
    url = url.replace(':id', id);

    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        success: function(response) {
            if (response != null) {
                $('#mid').val(response.id);
                $('#mName').val(response.name);
                $('#mPrice').val(response.price);
                $('#mQty').val(response.qty);
                $('#mDiscount').val(response.discount);
                $('#mTotal').val(response.total);
            }
        }
    });
  });
  $('#mQty').change(function(){
    $('#mTotal').val(($('#mPrice').val() - $('#mDiscount').val())*$('#mQty').val());
  });
  $('#mDiscount').change(function(){
    $('#mTotal').val(($('#mPrice').val() - $('#mDiscount').val())*$('#mQty').val());
  });
  $('#inputCustomer').change(function(){
    $('#pCus').val($('#inputCustomer').val());
  });
  $('#detail').change(function(){
    $('#pDetail').val($('#detail').val());
  });
  $('#inputCash').change(function(){
    $('#inputChange').val($('#inputCash').val() - $('#totalPrice').val());
    if($('#inputChange').val() < 0){
      $('#inputChange').val("0");
    }
    else{
      $('#inputChange').val($('#inputCash').val() - $('#totalPrice').val());
    }
  });
</script>
@endsection