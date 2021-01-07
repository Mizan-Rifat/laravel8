@extends('adminlte::page')

@section('title', 'Products')

@section('plugins.Select2', true)
@section('plugins.SummerNote', true)

@section('content_header')
    <h1>Products </h1>


    <div class="mt-3 text-right">
        <a class="btn btn-warning m-1" href="{{ route( get_route('product','index')) }}">
            <i class="fas fa-list">
            </i>
            Back To List
        </a>
    </div>
@stop


@section('content')

@if ($errors->any())
 @foreach ($errors->all() as $error)
     <div>{{$error}}</div>
 @endforeach
@endif


<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Product Nutritional Values</h3>
    </div>

    
<form 
        method="post" 
        {{-- action="{{ isset($data) ? route(get_route($dataType,'update')) : route(get_route($dataType,'store'))}}"  --}}
        action="{{ route('nutritionalvalues.update',['product'=>$product->id]) }}"
        role="form"
        enctype="multipart/form-data"
        id='form'
    >
        
        @csrf
        <div class="card-body">

            <table class="table table-striped">
                
                <tbody id='nvtbody'>

                    @foreach($nutritionalItems as $item)

                
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>
                                <input 
                                        type="text" 
                                        class="form-control"
                                        placeholder='Value'
                                        data-id="{{$item->id}}"
                                        value="{{ $product->nutritionalValues->where('id',$item->id)->first() != null ? $product->nutritionalValues->where('id',$item->id)->first()->pivot->value : null }}"
                                >
                            </td>
                        </tr>

                    @endforeach

                    <input 
                        type="hidden"
                        name="nutritionalValues" 
                    >

                </tbody>
            </table>


        </div>

     

        

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>


</div>

@endsection




@section('css')

@stop

@section('js')
<script>
    $(document).ready(function() {

        setValue();

        function getValue(){
            let values = {};
            $("#form :input[type=text]").each(function(){
                let input = $(this);
                if(input.val()){
                    values[input.data('id')] = { value : input.val() }
                }
            });
            return values;
        }

        function setValue(){
            let value = getValue();
            console.log({value})
            $("#nvtbody :input[name=nutritionalValues]").val(JSON.stringify(value))
        }

        $(document).on("change", "#form input" , function() {
            setValue();
        });
        
    })
</script>
@stop
