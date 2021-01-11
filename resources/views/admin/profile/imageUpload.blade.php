<form id='dpForm' action="{{ route('profile.update_avatar',['user'=>Auth::user()]) }}" method="post" enctype="multipart/form-data">
  @csrf

  <div class="d-flex justify-content-end" >
    <input id="profile-image-upload" class="hidden" type="file" onchange="readURL(this);">
    <input id="profile-image-link" class="hidden" type="hidden" name='avatar'>

    <button type='button' id="imgEditBtn" class="btn"><i class="fas fa-edit"></i></button>
    <button type='button' id="cancelEditBtn" class="btn hidden"><i class="fas fa-times-circle"></i></button>
    <button type='button' id="saveBtn" class="btn hidden"><i class="fas fa-save"></i></button>
    
  </div>

</form>
<div id="imgContainer">
  <div class="d-flex justify-content-center">
    <div class="img-circle d-flex justify-content-center align-items-center">
      <img class="profile-user-img img-fluid" src="{{ asset('/images'.$user->avatar) }}" alt="User profile picture">

      <div class="spinner-border" id='spinner' role="status">
        <span class="sr-only">Loading...</span>
      </div>
    
    </div>
  </div>
</div>

  <div id="exam"></div>


  @section('js')
  <script>


    $('#imgEditBtn').on('click', function() {
      $('#profile-image-upload').click();
    });

    function readURL(input) {


      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {

          $('#imgContainer').css('display',"none");
          $('#imgEditBtn').css('display',"none");
          $('#cancelEditBtn').css('display',"unset");
          $('#saveBtn').css('display',"unset");


          let newImgUrl = e.target.result

          var exam = $('#exam').cropme({

            "container": {
              "width": '100%',
              "height": '100%'
            },
            "viewport": {
              "width": 100,
              "height": 100,
              "type": "circle", // or 'square'
              "border": {
                "width": 2,
                "enable": true,
                "color": "#fff"
              }
            },
            "zoom": {
              // "min": .1,
              // "max": 3,
              "enable": true,
              "mouseWheel": true,
              "slider": false
            },
            transformOrigin: 'viewport'

          });

          exam.cropme('bind', {
            url: newImgUrl,
          })



        };

        reader.readAsDataURL(input.files[0]);
      }

    }

    $('#cancelEditBtn').click((e)=>{
      $('#exam').cropme('destroy')
      
      $('#imgContainer').css('display',"unset");
      $('#imgEditBtn').css('display',"unset");
      $('.profile-user-img').css('display',"unset");
      $('#cancelEditBtn').css('display',"none");
      $('#saveBtn').css('display',"none");
    })

    $('#saveBtn').click((e)=>{
      $('#exam').cropme('crop')
        .then((output) => {

          $('#profile-image-link').val(output)
          $('#dpForm').submit()



          // $('#imgContainer').css('display',"unset");
          // $('.profile-user-img').css('display',"none");
          // $('#imgEditBtn').css('display',"unset");
          // $('#spinner').css('display',"unset");
          // $('#cancelEditBtn').css('display',"none");
          // $('#saveBtn').css('display',"none");

          // console.log({output})

          

          
          // $('#exam').cropme('destroy')

          // $.ajax({
          //     // url: "/test",
          //     url: "{{ route('profile.update_avatar',['user'=>Auth::user()]) }}",
          //     type: "post",
          //     data: {
          //       "_token": "{{ csrf_token() }}",
          //       'avatar':output
          //     } ,
          //     success: function (response) {
          //       $('.profile-user-img').css('display',"unset");
          //       $('#spinner').css('display',"none");
          //       $('.profile-user-img').attr('src', response);

          //       // You will get response from your PHP page (what you echo or print)
          //     },
          //     error: function(jqXHR, textStatus, errorThrown) {
          //       console.log(textStatus, errorThrown);
          //     }
          // });

        })
    })
  </script>
  @parent
  @stop