$(document).ready(function(){
    Webcam.set({
        width: 320,
        height: 240,
        image_format: "jpeg",
        jpeg_quality: 90
    });

    $("#accesscamera").on('click', function(){
        Webcam.reset();
        Webcam.on('error', function(){
            $('#photoModal').modal('hide');
            swal({
                title: 'Warning',
                text: 'Please give permission to access your camera',
                icon: 'warning'
            });
        });

        Webcam.attach('#my_camera');
    });

    $('#takephoto').on('click', take_snapshot);

    $("#retakephoto").on('click', function(){
        $('#my_camera').addClass('d-block');
        $('#my_camera').removeClass('d-none');

        $('#result').addClass('d-none');

        $('#takephoto').addClass('d-block');
        $('#takephoto').removeClass('d-none');

        $('#retakephoto').addClass('d-none');
        $('#retakephoto').removeClass('d-block');

        $('#uploadphoto').addClass('d-none');
        $('#uploadphoto').removeClass('d-block');
    });

    

    $('#close-modal').on('click', function(){
        Webcam.reset();
    });
});

function take_snapshot(){
    Webcam.snap(function(data_uri){
        $('#result').html('<img src=" '+ data_uri +' "class="d-block mx-auto rounded"/>');
        
        var raw_image_data = data_uri.replace(/^data\:image\/w+\;base64\,/, '');
        $('#photoStore').val(raw_image_data);

    });

    $('#my_camera').removeClass('d-block');
    $('#my_camera').addClass('d-none');

    $('#result').removeClass('d-none');
    $('#result').addClass('d-block');

    $('#takephoto').removeClass('d-block');
    $('#takephoto').addClass('d-none');

    $('#retakephoto').removeClass('d-none');
    $('#retakephoto').addClass('d-block');

    $('#uploadphoto').removeClass('d-none');
    $('#uploadphoto').addClass('d-block');
}
