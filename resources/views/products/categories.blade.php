@extends('layouts.app2')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Categories</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/products/categories">Categories</a></li>
                <li class="breadcrumb-item active">Products</li>
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
                  <a href="/categories/tambah" class="btn btn-sm btn-success float-left"><span class="fa fa-plus" aria-hidden="true"></span> Add Category</a>
  
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
                        <th style="width: 10%">#</th>
                        <th style="width: 70%">Name</th>
                        <th style="width: 20%">Option</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $key => $s)
                        <tr>
                            <td>{{ $categories->firstItem()+$key }}</td>
                            <td>{{ $s->name }}</td>
                            <td>
                                <a href="/categories/edit/{{ $s->id }}" class="btn btn-info btn-sm"><span class="fas fa-edit" aria-hidden="true"></span></a>
                                <a href="/categories/hapus/{{ $s->id }}" class="btn btn-danger btn-sm"><span class="far fa-trash-alt" aria-hidden="true"></a>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{ $categories->links() }}
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
        </div>
    </section>
@endsection