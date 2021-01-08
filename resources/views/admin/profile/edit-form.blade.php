<form class="form-horizontal">

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input 
                                type="email" 
                                class="form-control" 
                                id="inputName" 
                                placeholder="Name"
                                name="name"
                                value="{{ $user->name }}"
                            >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input 
                                type="email" 
                                class="form-control" 
                                id="inputEmail" 
                                placeholder="Email"
                                name="email"
                                value="{{ $user->email }}"
                            >
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                                <a href="#">Change Password</a>
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