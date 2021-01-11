@extends('adminlte::page')

@section('title', 'profile')

@section('plugins.Cropme', true)

@section('content_header')
    <h1>Test</h1>
@stop

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <div style="height: 200px;width:200px">
      <img id="image" src="/images/avatars/avatar5.png">
    </div>

    <button class="btn" id="btn">Click</button>


@endsection


@section('css')

<style>
.cropper-view-box{ 
  border-radius: 50% !important;
}

</style>

@stop


@section('js')
<script>

    $(document).ready(function() {
       
      const image = document.getElementById('image');
      const cropper = new Cropper(image, {
        // aspectRatio: ,
        viewMode:3
        
      });


      $('#btn').click(()=>{

        let imageData = cropper.getImageData();
        let data = cropper.getData();
        console.log({imageData})
        console.log({data})

      })


    });
    
</script>
@stop