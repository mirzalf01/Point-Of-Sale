@extends('layouts.app2')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Stock Out</h1>
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
            <div class="col-md-12">
              <div class="card">
                <div class="card-header border-transparent">
                  <a href="/stockout/tambah" class="btn btn-sm btn-success float-left"><span class="fa fa-plus" aria-hidden="true"></span> Add Stock Out</a>
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
                        <th>Product Item</th>
                        <th>Qty</th>
                        <th>Detail</th>
                        <th>Date</th>
                        <th style="text-align: center">Option</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($stockout as $key=>$s)
                        <tr>
                          <td>{{ $stockout->firstItem()+$key }}</td>
                          <td>{{ $s->name }}</td>
                          <td>{{ $s->stock }}</td>
                          <td>{{ $s->detail }}</td>
                          <td>{{ $s->created_at }}</td>
                          <td style="text-align: center">
                            <a href="/stockout/hapus/{{ $s->id }}" class="btn btn-danger btn-sm"><span class="far fa-trash-alt" aria-hidden="true"></a>
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
                  {{ $stockout->links() }}
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