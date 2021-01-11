<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropme@latest/dist/cropme.min.css">
</head>
<body>


<div id="example"></div>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/cropme@latest/dist/cropme.min.js"></script>
<script>


    $(document).ready(function() {
        var example = $('#example').cropme({

// width/height of the image cropper
"container": {
  "width": 400,
  "height": 400
},

// shape options
"viewport": {
  "width": 200,
  "height": 200,
  "type": "circle", // or 'square'
  "border": {
    "width": 2,
    "enable": true,
    "color": "#fff"
  }
},

// zoom options
"zoom": {
  "min": .1,
  "max": 3,
  "enable": true,
  "mouseWheel": true,
  "slider": true
},

// rotation options
"rotation": {
  "slider": true,
  "enable": true,
  "position": "left"
},

// or 'image'
transformOrigin: 'viewport'

});
        example.cropme('bind', {
            url: 'http://127.0.0.1:8000/images/avatars/avatar5.png'
        });

    });

</script>
    
</body>
</html>