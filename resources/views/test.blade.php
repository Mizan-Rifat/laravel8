<!DOCTYPE html>
<html>

<head>
    <title>Laravel 8 Upload Multiple Image With Preview using jQuery - Tutsmake.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .btn-file {
    position: relative;
    overflow: hidden;
}

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
    </style>
</head>

<body>



<form action="/crud" method="post" id='form'>
@csrf

    <input type="text" name="model_name" id="" placeholder="model name">
<br>
    <input type="text" name="table_name" id="" placeholder="table name">
<br>
    <label for="id">ID:</label>

        <select name="id" id="id">
            <option value="true">Yes</option>
            <option value="false">No</option>
        </select>

        <br>
    <label for="timestamps">timestamps:</label>

        <select name="timestamps" id="timestamps">
            <option value="true">Yes</option>
            <option value="false">No</option>
        </select>


<br>
    <input type="text" name="name[]" placeholder="Column name" 
        autocomplete="off" class="form-control">

    <input type="text" name="type[]" placeholder="Type" 
        autocomplete="off" class="form-control">

        <label for="nullable">Nullable:</label>

        <select name="nullable[]" id="nullable">
            <option value="true">Yes</option>
            <option value="false">No</option>
        </select>


    <input type="text" name="default[]" placeholder="default" 
        autocomplete="off" class="form-control">


    <br>


        <button type="submit">submit</button>



</form>

<button id='add'>Add</button>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>

<script>
    let item = `
    <br>


    <input type="text" name="name[]" placeholder="Column name" 
        autocomplete="off" class="form-control">

    <input type="text" name="type[]" placeholder="Type" 
        autocomplete="off" class="form-control">

        <label for="nullable">Nullable:</label>

        <select name="nullable[]" id="nullable">
            <option value="true">Yes</option>
            <option value="false">No</option>
        </select>

    <input type="text" name="default[]" placeholder="default" 
        autocomplete="off" class="form-control">`


        $('#add').click(()=>{
            $( "#form" ).append( item );
        })

        
</script>

</body>

</html>