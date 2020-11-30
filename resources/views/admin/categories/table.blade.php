<div class="card">
       
        <div class="card-body">

        <form action="{{route('category.bulkdestroy')}}" id="myTable" method="post">
            @csrf
          <table class="table table-striped projects" id='example'>
              <thead>
                  <tr>
                      <th style="width: 1%">
                          <input type="checkbox" id="bulkSelect">
                      </th>
                      <th style="width: 20%">
                          Name
                      </th>
                      <th style="width: 20%">
                          
                      </th>
                  </tr>
              </thead>
              <tbody>

              

              @foreach($categories as $category)
                  <tr>
                      <td>
                        <input type="checkbox" name="ids[]" class="checkboxes" value="{{$category->id}}">
                      </td>
                      <td>
                            {{$category->name}}
                      </td>

                      @php
                        $arg = ['category'=>$category->id];
                      @endphp

                      <x-tableActions 

                        showroute='category.show'
                        editroute='category.edit'
                        destroyroute='category.destroy'
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
