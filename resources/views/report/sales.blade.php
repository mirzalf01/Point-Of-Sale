@extends('layouts.app2')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Sales Report</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/report/sales">Sales</a></li>
                  <li class="breadcrumb-item active">Report</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
      </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-transparent">
                        <h1 class="lead float-left col-md-8">Sales Data</h1>
                        <form class="float-right col-md-4" action="/report/filter" method="GET">
                            {{ csrf_field() }}
                            <div class="input-group input-group-md">
                                <input type="text" name="customer" class="form-control" id="fcustomer" placeholder="Invoice . . .">
                                <span class="input-group-append">
                                    <button type="submit" class="float-right btn btn-info"><span class="fa fa-search" aria-hidden="true"></span></button>
                                </span>
                            </div>
                        </form>
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
                            <th style="text-align: center">Option</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $key => $s)
                            <tr>
                                <td>{{ $sales->firstItem()+$key }}</td>
                                <td>{{ $s->invoice }}</td>
                                <td>{{ $s->created_at }}</td>
                                <td>{{ $s->customer }}</td>
                                <td style="text-align: right">{{ number_format(($s->total+$s->discount), 0, ".", ".") }}</td>
                                <td style="text-align: right">{{ number_format($s->discount, 0, ".", ".") }}</td>
                                <td style="text-align: right">{{ number_format($s->total, 0, ".", ".") }}</td>
                                <td style="text-align: center">
                                    <a href="{{ url('/invoice/TI_'.$s->invoice.'.pdf') }}" target="_blank" class="btn btn-success btn-sm"><span class="fa fa-download" aria-hidden="true"></span></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        
                    </div>
                    <!-- /.table-responsive -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $sales->links() }}
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