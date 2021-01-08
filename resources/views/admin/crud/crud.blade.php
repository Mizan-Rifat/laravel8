@extends('adminlte::page')

@php

    $items = [ 'migration','model','controller','formRequest','routes','permissions'];

    $idOptions = collect([
        [
            'id' => 'true',
            'name' => 'Yes',
        ],
        [
            'id' => 'false',
            'name' => 'No',
        ],
    ]);

@endphp


@section('title', 'CRUD')

@section('content_header')
    <h1>CRUD Generator</h1>
    
@stop

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="card card-primary">
    

    <form 
        method="post" 
        action="/crud"
        role="form"
        enctype="multipart/form-data"
    >
        
        @csrf
        <div class="card-body">

        <div class="d-flex">

            @foreach($items as $item)

                <div class="custom-control custom-checkbox ml-4">
                    <input 
                        class="custom-control-input" 
                        type="checkbox" 
                        id="checkbox-{{$item}}"
                        name="{{$item}}" 
                    >
                    <label for="checkbox-{{$item}}" class="custom-control-label" style='font-weight:400'>{{ ucfirst($item) }}</label>
                </div>
            @endforeach
        
        </div>


        <div id="model_name">
            <x-input 
                label='Model Name' 
                name='model_name' 
                placeholder='Model Name' 
                :value='null'
            />
        </div>
        <div class="table_name" id="table_name">
            <x-input 
                label='Table Name' 
                name='table_name' 
                placeholder='Table Name' 
                :value='null'  
            />
        </div>
        <div class="card card-primary" id='mig'>
            <div class="card-body">
                <div class="form-group">
                    <label>Auto Increment ID</label>
                        <select 
                            class="form-control select2" 
                            style="width: 100%;" 
                            name="id"
                        >
                            <option value="true">Yes</option>
                            <option value="false">No</option>
                            
                        </select>

                </div>
                <div class="form-group">
                    <label>Timestamps</label>
                        <select 
                            class="form-control select2" 
                            style="width: 100%;" 
                            name="timestamps"
                        >
                            <option value="true">Yes</option>
                            <option value="false">No</option>
                            
                        </select>

                </div>

                <div id="table"></div>

                <div class="mt-3">
                    <button class="btn btn-primary mr-2" id="addColumn">
                        Add Column
                    </button>
                </div>
            </div>
            
        </div>

        

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

    

</div>





@endsection


@section('css')
@stop


@section('js')
<script>


    document.addEventListener("DOMContentLoaded", function() {
        // $('.select2').select2();
        $('#mig').hide();
        $('#table_name').hide();
        

        let item = `

            <div class="row mt-3">
                <div class="col">
                    <input type="text" class="form-control" name="name[]" placeholder="Column name" 
                    autocomplete="off">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="type[]" placeholder="Column name" 
                        autocomplete="off">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="default[]" placeholder="Default Value" 
                        autocomplete="off">
                </div>
                <div class="col">
                 
                    <div class="form-inline">
                        <label class='mr-2'>Nullable</label>
                        <select 
                            class="form-control select2" 
                            name="nullable[]"
                        >
                            <option value="false">No</option>
                            <option value="true">Yes</option>
                            
                        </select>

                    </div>
                </div>
                
                <button class="btn btn-danger mr-2" id="removeColumn">
                    Remove
                </button>

                
            </div>

        `

        $('#addColumn').click((e)=>{
            // console.log('sdf')
            e.preventDefault();
            $( "#table" ).append( item );
        })

        $(document).on("click", "button#removeColumn" , function() {
            
            $(this).parent().remove();
        });

        $("input[name='migration']").change((e)=>{
            if(e.target.checked){
                $('#mig').show();
                $('#table_name').show();
            }else{
                $('#mig').hide();
                $('#table_name').hide();
            }
        });
        
    },);

  


</script>
@stop