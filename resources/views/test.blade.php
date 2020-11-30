
<form action="/test" method="post" id='form'>
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