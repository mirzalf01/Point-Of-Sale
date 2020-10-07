@extends('layouts.app2')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Edit Customer</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/customers">Customers</a></li>
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
                  <h3 class="card-title">Data Customer</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="/customers/editproses" method="post">
                  {{ csrf_field() }}
                  <div class="card-body">
                    <input type="hidden" class="form-control" name="id" value="{{ $customer->id }}">
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                      <input type="text" class="form-control" name="name" id="exampleInputName1" placeholder="Enter name" value="{{ $customer->name }}">
                        @if($errors->has('name'))
                                  <div class="text-danger">
                                      {{ $errors->first('name')}}
                                  </div>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="sel1">Gender</label>
                        <select class="form-control" id="sel1" name="gender">
                            @if ($customer->gender == "M" or $customer->gender == "m")
                                <option selected>M</option>
                                <option>F</option>
                            @else
                                <option>M</option>
                                <option selected>F</option>
                            @endif
                        </select>
                        @if($errors->has('gender'))
                                <div class="text-danger">
                                    {{ $errors->first('gender')}}
                                </div>
                        @endif
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPhone1">Phone</label>
                          <input type="number" class="form-control" name="phone" id="exampleInputPhone1" placeholder="Enter phone number" value="{{ $customer->phone }}">
                          @if($errors->has('phone'))
                                  <div class="text-danger">
                                      {{ $errors->first('phone')}}
                                  </div>
                          @endif  
                      </div>
                      <div class="form-group">
                          <label for="exampleInputAddress1">Address</label>
                          <input type="text" class="form-control" name="address" id="exampleInputAddress" placeholder="Enter address" value="{{ $customer->address }}">
                          @if($errors->has('address'))
                                  <div class="text-danger">
                                      {{ $errors->first('address')}}
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