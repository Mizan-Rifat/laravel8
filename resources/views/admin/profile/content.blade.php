

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <input id="profile-image-upload" class="hidden" type="file" >
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('images/avatars/'.$user->avatar) }}"
                       alt="User profile picture">
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
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                  <div class="active tab-pane" id="activity">
                      @include('admin.profile.edit-form')
                  </div>
                  <div class="tab-pane" id="timeline">
                    @include('admin.profile.password')
                  </div>
                </div>
                <!-- /.tab-content -->
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
          
          $(function() {
              $('.profile-user-img').on('click', function() {
                  $('#profile-image-upload').click();
              });
          });


  </script>
  @parent
@stop