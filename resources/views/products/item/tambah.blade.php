@extends('layouts.app2')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">New Item</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/products/items">Items</a></li>
                <li class="breadcrumb-item active">Products </li>
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
                  <h3 class="card-title">Data Item</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="/items/itemtambahproses" method="post">
                  {{ csrf_field() }}
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputName1" placeholder="Enter name" value="{{ old('name') }}">
                        @if($errors->has('name'))
                            <div class="text-danger">
                                {{ $errors->first('name')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCategory1">Category</label>
                          <select class="form-control" name="category" id="exampleInputCategory1">
                              @foreach ($categories as $c)
                                  <option  value="{{ $c->name }}">{{ $c->name }}</option>
                              @endforeach
                          </select>
                          @if($errors->has('category'))
                              <div class="text-danger">
                                  {{ $errors->first('category')}}
                              </div>
                          @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUnit1">Unit</label>
                          <select class="form-control" name="unit" id="exampleInputUnit1">
                              @foreach ($units as $u)
                                  <option  value="{{ $u->name }}">{{ $u->name }}</option>
                              @endforeach
                          </select>
                          @if($errors->has('unit'))
                              <div class="text-danger">
                                  {{ $errors->first('unit')}}
                              </div>
                          @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPrice1">Price</label>
                          <input type="number" class="form-control" name="price" id="exampleInputPrice1" placeholder="Enter price" value="{{ old('price') }}">
                          @if($errors->has('price'))
                              <div class="text-danger">
                                  {{ $errors->first('price')}}
                              </div>
                          @endif
                      </div>
                      <div class="form-group">
                        <label for="exampleInputStock1">Stock</label>
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