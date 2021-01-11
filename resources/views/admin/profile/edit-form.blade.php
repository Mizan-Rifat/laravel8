<form class="form-horizontal" method="post" action="{{ route('users.update',['user'=>Auth::id()]) }}">

@csrf

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input 
                                type="text" 
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                id="inputName" 
                                placeholder="Name"
                                name="name"
                                value="{{ $user->name }}"
                            >
                            @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input 
                                type="email" 
                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                id="inputEmail" 
                                placeholder="Email"
                                name="email"
                                value="{{ $user->email }}"
                            >
                            
                            @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <a href="{{ route('profile.password_change') }}">Change Password</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10 text-right">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>