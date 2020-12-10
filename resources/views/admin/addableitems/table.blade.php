@php

$allFields = config('datatypes.addable_items')['fields'];

@endphp


<div class="card">
       
        <div class="card-body">

        <form action="{{route('addableitem.bulkdestroy')}}" id="myTable" method="post">
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

              

              @foreach($addableitems as $addableitem)
                  <tr>
                      <td>
                        <input type="checkbox" name="ids[]" class="checkboxes" value="{{$addableitem->id}}">
                      </td>


                      @foreach($allFields as $field)

                        @if($field['type'] == 'image')
                          @if($addableitem->{$field['field']} != null)
                            <td>
                              <img src="{{ asset(json_decode( $addableitem->{$field['field']} )[0] ) }}" alt="" style="width:80px">
                            </td>
                          @else

                            <td></td>

                          @endif
                        @elseif($field['type'] == 'select')

                          @if(array_key_exists('relationship_field',$field))
                            <td>
                              {{ $addableitem->{$field['field']}->{$field['relationship_field']} }}
                            </td>
                          @else
                            <td>
                              {{ $addableitem->{$field['field']} }}
                            </td>
                          @endif
                        @elseif($field['type'] == 'text-area')
                            <td>
                              {!! $addableitem->{$field['field']} !!}
                            </td>
                        @else
                          <td>
                            {{ $addableitem->{$field['field']} }}
                          </td>
                        @endif

                      @endforeach              

                      @php
                        $arg = ['addableitem'=>$addableitem->id];
                      @endphp

                      <x-tableActions 

                        showroute='addableitem.show'
                        editroute='addableitem.edit'
                        destroyroute='addableitem.destroy'
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
