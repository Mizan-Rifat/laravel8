@php

$allFields = config('datatypes.products')['fields'];

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

                      @foreach($allFields as $field)


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


                      @foreach($allFields as $field)

                        @if($field['type'] == 'image')
                            <td>
                              <img src="{{ asset(json_decode( $product->{$field['field']} )[0] ) }}" alt="" style="width:80px">
                            </td>

                        @elseif($field['type'] == 'select')
                            <td>
                              {{ $product->{$field['field']}->{$field['relationship_field']} }}
                            </td>
                        @elseif($field['type'] == 'text-area')
                            <td>
                              {!! $product->{$field['field']} !!}
                            </td>
                        @else
                          <td>
                            {{ $product->{$field['field']} }}
                          </td>
                        @endif

                      @endforeach              

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
