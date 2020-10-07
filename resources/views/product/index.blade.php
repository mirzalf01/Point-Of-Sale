@extends('layouts.app2')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard V2</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                <li class="breadcrumb-item active">Products </li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- info box -->
          <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-bag"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Item</span>
                  <span class="info-box-number">
                    {{ $item }}
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-truck"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Suppliers</span>
                  <span class="info-box-number">{{ $supplier }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
  
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
  
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Sales</span>
                  <span class="info-box-number">{{ $sale }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Customers</span>
                  <span class="info-box-number">{{ $customer }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>

          <!-- Monthly Recap -->
          

          <!-- Latest Order -->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Latest Orders</h3>
  
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table m-0 table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Discount</th>
                        <th>Grand Total</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $key => $s)
                        <tr>
                            <td>{{ 1+$key }}</td>
                            <td>{{ $s->invoice }}</td>
                            <td>{{ $s->created_at }}</td>
                            <td>{{ $s->customer }}</td>
                            <td style="text-align: right">{{ number_format(($s->total+$s->discount), 0, ".", ".") }}</td>
                            <td style="text-align: right">{{ number_format($s->discount, 0, ".", ".") }}</td>
                            <td style="text-align: right">{{ number_format($s->total, 0, ".", ".") }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  <a href="/transaction/sales" class="btn btn-sm btn-info float-left">Place New Order</a>
                  <a href="/report/sales" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
        </div>
    </section>
@endsection