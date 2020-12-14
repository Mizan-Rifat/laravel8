

<div class="form-group">
    <label>{{$label}}</label>
    <div class="row">

        @foreach($images as $image)
            <div class="col-sm-2 p-4 image_box">

                <div style="position:relative;">
                    <a href="{{asset($image)}}" data-toggle="lightbox" class="image-container" 
                    data-image="{{$image}}">
                        <img src="{{asset($image)}}" class="img-fluid mb-2 gallery_img" alt="white sample"/>
                    </a>
                        <button     
                            type="button" 
                            class="btn cls-btn" 
                            data-image={{$image}}   
                            aria-label="Close"
                        >
                            <i class="far fa-times-circle" style="pointer-events:none"></i>
                        </button>

                </div>
                
            </div>
            
        @endforeach
        
    </div>
</div>

<style>

    .cls-btn{
        height: 10px;
        padding: 0;
        position: absolute;
    }

</style>

<script>

let abc = @json(route($removeRoute,$arg));

console.log({abc})

    document.addEventListener("DOMContentLoaded", function() {
        $(".cls-btn").click(function (e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/product/removeimage/4",
                type: "post",
                data: {
                    image:e.target.dataset.image
                } ,
                success: function (response) {

                    console.log({response})
                    let asd = $('.image-container').filter(`[data-image='${e.target.dataset.image}']`).parent().parent().remove();
                    $(e.target).remove();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                }
            });
        });
    });

    


</script>