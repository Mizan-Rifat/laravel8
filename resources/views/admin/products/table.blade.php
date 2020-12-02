@php

$roleFields = config('datatypes.products')['fields'];

$catName = "category";
$catame = "name";


@endphp


<div class="card">
       
        <div class="card-body">

        <form action="{{route('product.bulkdestroy')}}" id="myTable" method="post">
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

              

              @foreach($products as $product)
                  <tr>
                      <td>
                        <input type="checkbox" name="ids[]" class="checkboxes" value="{{$product->id}}">
                      </td>

                      <td>
                        {{$product->name}}
                      </td>
                      <td>
                        {{ $product->$catName->$catame }}
                      </td>
                      <td>
                        @php
                          $images = json_decode($product->image);
                        @endphp

                        @foreach($images as $image)
                          <img src="{{ asset($image) }}" alt="" style="width:80px">
                        @endforeach
                      </td>
                      <td>
                        {{$product->description}}
                      </td>
                      <td>
                        {{$product->price}}
                      </td>
                      <td>
                        {{$product->active}}
                      </td>
              

                      @php
                        $arg = ['product'=>$product->id];
                      @endphp

                      <x-tableActions 

                        showroute='product.show'
                        editroute='product.edit'
                        destroyroute='product.destroy'
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
