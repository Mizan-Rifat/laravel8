@php

  $allFields = array_filter($allFields,function($field){
    return $field['indexShow'];
  });

@endphp

<div class="card">
       
        <div class="card-body">

        <form action="{{route(get_route($dataType,'bulkdestroy'))}}" id="myTable" method="post">
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

              

              @foreach($data as $item)
                  <tr>
                      <td>
                        <input type="checkbox" name="ids[]" class="checkboxes" value="{{$item->id}}">
                      </td>


                      @foreach($allFields as $field)

                        @if($field['type'] == 'images')
                            <td>
                              <img src="{{ asset(json_decode( $item->{$field['field']} )[0] ?? null ) }}" alt="" style="width:80px">
                            </td>

                        @elseif($field['type'] == 'image')
                            <td>
                            <img src="{{ asset($item->{$field['field']}) }}" alt="" style="width:80px">
                            </td>
                        @elseif($field['type'] == 'select')
                            <td>
                              {{ $item->{$field['field']}->{$field['relationship_field']} }}
                            </td>
                        @elseif($field['type'] == 'text-area')
                            <td>
                              {!! $item->{$field['field']} !!}
                            </td>
                        @elseif($field['type'] == 'relationship-select')
                            <td>
                              {!! $item->{$field['field']}->{$field['relationship_field']} !!}
                            </td>
                   
                        @elseif($field['type'] == 'relationship-multi-select')
                            <td>
                              {{ $item->{$field['field']}->pluck($field['relationship_field'])->implode(",") }}
                            </td>
                        @else
                          <td>
                            {{ $item->{$field['field']} }}
                          </td>
                        @endif

                      @endforeach              

                      @php
                        $arg = [];
                        $arg[singularDatatype($dataType)] = $item->id; 

                      @endphp

                      <x-tableActions 

                        :showroute="get_route($dataType,'show')"
                        :editroute="get_route($dataType,'edit')"
                        :destroyroute="get_route($dataType,'destroy')"
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
