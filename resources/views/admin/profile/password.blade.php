@php

    $fields = [
        [
            'label'=>'Old Password',
            'name'=>'old_password',
        ],
        [
            'label'=>'New Password',
            'name'=>'password',
        ],
        [
            'label'=>'Confirm Password',
            'name'=>'password_confirmation',
        ],
    ];

@endphp

<form class="form-horizontal" method="post" action="{{ route('users.update',['user'=>Auth::id()]) }}">
    @csrf

    @foreach($fields as $field)

        <div class="form-group row">
            <label for="inputName" class="col-sm-3 col-form-label">
                {{ $field['label'] }}
            </label>

            <div class="col-sm-9">

                <div class="input-group">
                    <input 
                        type="password" 
                        class="form-control {{ $errors->has($field['name']) ? 'is-invalid' : '' }}" 
                        id="inputName" 
                        placeholder="{{ $field['label'] }}"
                        name="{{ $field['name'] }}"
                    >
                    <div class="input-group-append">
                        <span class="input-group-text eye"><i class="fas fa-eye"></i></span>
                    </div>
                    
                </div>
                
                @if ($errors->has($field['name']))
                            <span class="text-danger">{{ $errors->first($field['name']) }}</span>
                    @endif

            </div>
                
            

        </div>

    @endforeach

    <div class="form-group row">
        <div class="offset-sm-2 col-sm-10 text-right">
        <a href="{{ route('admin.profile') }}" class="btn btn-danger">Back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>



@section('js')
  <script>

    document.addEventListener("DOMContentLoaded", function() {

        $(document).on("click", "span.eye" , function() {
            let inputEl = $(this).closest('.input-group').children('.form-control')
            if(inputEl.attr("type") == 'password'){
                inputEl.attr("type",'text')
                $(this).find('i').removeClass( "fa-eye" ).addClass( "fa-eye-slash") 
            }else{
                inputEl.attr("type",'password')
                $(this).find('i').removeClass( "fa-eye-slash" ).addClass( "fa-eye")
            }
        });

    });


  </script>
  @parent
@stop