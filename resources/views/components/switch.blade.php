<div class="custom-control custom-switch" id='switchContainer'>
  <input type="checkbox" class="custom-control-input" id="customSwitch1" name="{{$name}}" checked>
  <label class="custom-control-label" id='custom-control-label' for="customSwitch1">{{$label}}</label>

  @if ($errors->has($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {

    let name = $('#customSwitch1').attr('name');


    $('#customSwitch1').change((e)=>{
      if(!e.target.checked){
         var input = $("<input>").attr({type:'hidden',name,id:'hiddenOff'}).val("off");
          $('#switchContainer').append($(input)); 
      }else{
        $("#hiddenOff").remove()
      }
    })
     
     
  });
</script>