@extends('layouts.app2')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Employees</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/employees">Employees</a></li>
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
                <div class="col-md-3">
      
                  <!-- Profile Image -->
                  <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                      <div class="text-center">
                        @if (Auth::user()->image === null)
                        <img class="profile-user-img img-fluid img-circle"
                        src="{{ url('AdminLTE/dist/img/user2-160x160.jpg') }}"
                        alt="User profile picture">
                        @else
                        <img class="profile-user-img img-fluid img-circle"
                        src="{{url('/profile/'.Auth::user()->image) }}"
                        alt="User profile picture">
                        @endif
                        
                      </div>
      
                      <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
      
                      <p class="text-muted text-center">{{ Auth::user()->role }}</p>
      
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Email</b> <a class="float-right">{{ Auth::user()->email }}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Since</b> <a class="float-right">{{ date('d/m/Y', strtotime(Auth::user()->created_at)) }}</a>
                        </li>                  
                      </ul>
                    </div>
                    <!-- /.card-body -->
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                  <div class="card">
                    <div class="card-header p-2">
                      <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Change Password</a></li>
                      </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                          <!-- Post -->
                          <form class="form-horizontal" action="/user/profile/edit" enctype="multipart/form-data" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <div class="form-group row">
                              <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" name="name" id="inputName" value="{{ Auth::user()->name }}" placeholder="Name">
                              </div>
                              @if($errors->has('name'))
                                <div class="text-danger">
                                    {{ $errors->first('name')}}
                                </div>
                              @endif
                            </div>
                            <div class="form-group row">
                              <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="inputEmail" value="{{ Auth::user()->email }}" placeholder="Enter email address">
                              </div>
                              @if($errors->has('email'))
                                <div class="text-danger">
                                    {{ $errors->first('email')}}
                                </div>
                              @endif
                            </div>
                            <div class="form-group row">
                              <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                              <div class="col-sm-10">
                                @if (Auth::user()->phone === null)
                                <input type="text" name="phone" class="form-control" id="inputPhone" value="{{ old('phone') }}" placeholder="Enter phone number">
                                @else
                                <input type="text" name="phone" class="form-control" id="inputPhone" value="{{ Auth::user()->phone }}" placeholder="Enter phone number">
                                @endif
                              </div>
                              @if($errors->has('phone'))
                                <div class="text-danger">
                                    {{ $errors->first('phone')}}
                                </div>
                              @endif
                            </div>
                            <div class="form-group row">
                              <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                              <div class="col-sm-10">
                                @if (Auth::user()->address === null)
                                  <textarea class="form-control" name="address" id="inputAddress" placeholder="Enter address"></textarea>
                                @else
                                  <textarea class="form-control" name="address" id="inputAddress" placeholder="Enter address">{{ Auth::user()->address }}</textarea>
                                @endif
                              </div>
                              @if($errors->has('address'))
                                <div class="text-danger">
                                    {{ $errors->first('address')}}
                                </div>
                              @endif
                            </div>
                            <div class="row">
                              <div class="col-sm-2"><strong>Image</strong></div>
                              <div class="form-group col-sm-10">
                                <!-- <label for="customFile">Custom File</label> -->
                                <div class="custom-file">
                                  <input type="file" name="image" class="custom-file-input" id="customFile">
                                  <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                @if($errors->has('image'))
                                  <div class="text-danger">
                                      {{ $errors->first('image')}}
                                  </div>
                                @endif
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Edit</button>
                              </div>
                            </div>
                          </form>
                          <!-- /.post -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                          <!-- The timeline -->
                          <form class="form-horizontal" action="/user/password/change" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <div class="form-group row">
                              <label for="inputOld" class="col-sm-2 col-form-label">Password</label>
                              <div class="col-sm-10">
                                <input type="password" name="current_password" class="form-control" id="inputOld">
                              </div>
                              @if($errors->has('current_password'))
                                <div class="text-danger">
                                    {{ $errors->first('current_password')}}
                                </div>
                              @endif
                            </div>
                            <div class="form-group row">
                              <label for="inputNew" class="col-sm-2 col-form-label">New Password</label>
                              <div class="col-sm-10">
                                <input type="password" name="new_password" class="form-control" id="inputNew">
                              </div>
                              @if($errors->has('new_password'))
                                <div class="text-danger">
                                    {{ $errors->first('new_password')}}
                                </div>
                              @endif
                            </div>
                            <div class="form-group row">
                              <label for="inputNew2" class="col-sm-2 col-form-label">Confirm New Password</label>
                              <div class="col-sm-10">
                                <input type="password" name="new_password_confirmation" class="form-control" id="inputNew2">
                              </div>
                              @if($errors->has('new_confirm_password'))
                                <div class="text-danger">
                                    {{ $errors->first('new_confirm_password_password')}}
                                </div>
                              @endif
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </div>
                          </form>
                        </div>
                        <!-- /.tab-pane -->
                      </div>
                      <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                  </div>
                  <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
              </div>
        </div>
    </section>
@endsection
@section('javascripts')
<script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
  });
  var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
</script>    
@endsection