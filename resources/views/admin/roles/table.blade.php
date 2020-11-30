@php

$roleFields = config('datatypes.roles')['fields'];

@endphp


<div class="card">
       
        <div class="card-body">

        <form action="{{route('roles.bulkdestroy')}}" id="myTable" method="post">
            @csrf
          <table class="table table-striped projects" id='example'>
              <thead>
                  <tr>
                      <th style="width: 1%">
                          <input type="checkbox" id="bulkSelect">
                      </th>

                      @foreach($roleFields as $field)


                        <th>
                            {{$field['label']}}
                        </th>

                      @endforeach

                      <th>
                          
                      </th>
                  </tr>
              </thead>
              <tbody>

              

              @foreach($roles as $role)
                  <tr>
                      <td>
                        <input type="checkbox" name="ids[]" class="checkboxes" value="{{$role->id}}">
                      </td>
                      <td>
                            {{$role->name}}
                      </td>
                      <td>
                            {{$role->display_name}}
                      </td>

                      @php
                        $arg = ['role'=>$role->id];
                      @endphp

                      <x-tableActions 

                        showroute='roles.show'
                        editroute='roles.edit'
                        destroyroute='roles.destroy'
                        :arg="$arg"

                      />
                      
                  </tr>

                @endforeach

               
                  
              </tbody>
          </table>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
