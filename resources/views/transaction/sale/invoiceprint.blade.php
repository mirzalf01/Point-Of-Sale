<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>TI_{{ $sales->invoice }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url ('AdminLTE/dist/css/adminlte.min.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> {{ "Company" }}.
          <small class="float-right">Date: {{ date('d/m/Y') }}</small>
        </h2>
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
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>
</body>
</html>
