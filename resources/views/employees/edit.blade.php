@extends('layouts.app2')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Edit Employee</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/suplliers">Employees</a></li>
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
                  <h3 class="card-title">Data Employee</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="/employees/editproses" method="post">
                  {{ csrf_field() }}
                  <div class="card-body">
                    <input type="hidden" class="form-control" name="id" value="{{ $employees->id }}">
                    <div class="form-group">
                      <label for="exampleInputName1">Name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputName1" placeholder="Enter name" value="{{ $employees->name }}">
                      @if($errors->has('name'))
                                <div class="text-danger">
                                    {{ $errors->first('name')}}
                                </div>
                      @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPhone1">Email</label>
                      <input type="email" class="form-control" name="email" id="exampleInputPhone1" placeholder="Enter email address" value="{{ $employees->email }}">
                      @if($errors->has('email'))
                              <div class="text-danger">
                                  {{ $errors->first('email')}}
                              </div>
                      @endif  
                    </div>
                    <div class="form-group">
                        <label for="sel1">Select list:</label>
                        <select class="form-control" id="sel1" name="role">
                            @if ($employees->role == "employee" or $employees->role == "Employee")
                            <option selected>Employee</option>
                            <option>Admin</option>
                            @else
                            <option>Employee</option>
                            <option selected>Admin</option>
                            @endif
                            
                        </select>
                        @if($errors->has('role'))
                                <div class="text-danger">
                                    {{ $errors->first('role')}}
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