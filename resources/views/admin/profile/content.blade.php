

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">

                  

                  <!-- <form id='dpForm' action="{{ route('users.update',['user'=>Auth::user()]) }}" method="post" enctype="multipart/form-data"> -->
                  @include('admin.profile.imageUpload')

                  


                  

                </div>

                <h3 class="profile-username text-center">{{ $user->name }}</h3>

                @foreach($user->roles as $role)

                    <p class="text-muted text-center">{{ $role->display_name }}</p>

                @endforeach


                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">

                    <h5 class="card-title">  
                      {{ Route::currentRouteName() == 'profile.password_change' ? 'Password' : 'General Info' }}
                    </h5>
              </div>

              <div class="card-body">

                  <div class="active tab-pane" id="activity">

                      @if(Route::currentRouteName() == 'profile.password_change')
                          @include('admin.profile.password')
                      @else
                        @include('admin.profile.edit-form')
                      @endif

                  </div>

              </div>
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>


@section('js')
  <script>
          
          


  </script>
  @parent
@stop