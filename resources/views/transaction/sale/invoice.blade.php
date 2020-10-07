@extends('layouts.app2')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Stock In</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/transaction/purchases">Stock In</a></li>
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
                <div class="col-12">
                  <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                      <div class="col-12">
                        <h4>
                          <i class="fas fa-globe"></i> {{ "Company" }}.
                          <small class="float-right">Date: {{ date('d/m/Y') }}</small>
                        </h4>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                      <div class="col-sm-4 invoice-col">
                        From
                        <address>
                          <strong>{{ Auth::user()->name }}.</strong><br>
                          795 Folsom Ave, Suite 600<br>
                          San Francisco, CA 94107<br>
                          Phone: (804) 123-5432<br>
                          Email: info@almasaeedstudio.com
                        </address>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4 invoice-col">
                        To
                        <address>
                          <strong>{{ $sales->customer }}</strong><br>
                          <p>
                              Note : <br>
                              {{ $sales->detail }}
                          </p>
                        </address>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4 invoice-col">
                        Invoice : <br><b>{{ $sales->invoice }}</b><br>
                          <br>
                        </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
      
                    <!-- Table row -->
                    <div class="row">
                      <div class="col-12 table-responsive">
                        <table class="table table-striped">
                          <thead>
                          <tr>
                            <th>Qty</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Total</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach ($cart as $c)
                              <tr>
                                <td>{{ $c->qty }}</td>
                                <td>{{ $c->name }}</td>
                                <td>{{ number_format($c->price, 0, ".", ".") }}</td>
                                <td>{{ number_format($c->discount, 0, ".", ".") }}</td>
                                <td>{{ number_format($c->total, 0, ".", ".") }}</td>
                              </tr>
                          @endforeach
                          </tbody>
                        </table>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
      
                    <div class="row">
                      <!-- accepted payments column -->
                      <div class="col-6">
                        <p class="lead">Payment Methods: <br>Cash</p>
                      </div>
                      <!-- /.col -->
                      <div class="col-6">
                        <div class="table-responsive">
                          <p class="lead">Payment Detail</p>
                          <table class="table">
                            <tr>
                              <th style="width:50%">Subtotal</th>
                            <td>{{ number_format($sales->total + $sales->discount, 0, ".", ".")}} IDR</td>
                            </tr>
                            <tr>
                              <th>Discount</th>
                            <td>{{ number_format($sales->discount, 0, ".", ".")}} IDR</td>
                            </tr>
                            <tr>
                              <th>Total:</th>
                              <td>{{ number_format($sales->total, 0, ".", ".")}} IDR</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
      
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                      <div class="col-12">
                      <a href="/invoice/print/{{ $sales->id }}" target="_blank" id="save" class="btn btn-default"><i class="fas fa-download"></i> Download</a>
                      <a href="{{ url('/invoice/TI_'.$sales->invoice.'.pdf') }}" target="_blank" id="print" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                      <a href="/invoice/process" style="display: none" id="submit" class="btn btn-success float-right">Process Payment</a>
                        </div>
                    </div>
                  <!-- /.invoice -->
                </div><!-- /.col -->
              </div>
        </div>
    </section>
@endsection
@section('javascripts')
    <script>
      $('#print').click(function(){
        $('#submit').attr("style", "display: block");
      });
    </script>
@endsection