<div class="form-group">
    <label>{{$label}}</label>
    <div class="row">
        <div class="col-sm-2 p-4">

            @foreach($images as $image)
                <a href="{{asset($image)}}" data-toggle="lightbox">
                    <img src="{{asset($image)}}" class="img-fluid mb-2" alt="white sample"/>
                </a>
            @endforeach
        </div>
    </div>
</div>