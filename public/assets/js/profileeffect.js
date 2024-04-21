$(document).ready(function(){

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    //User Effect

    $('#profile_edit').on('click', function(){
        $('.profile-cancel-button').removeClass('d-none');
        $('.profile-save-button').removeClass('d-none');
        $('#profile_edit').addClass('d-none');
        $('.updatable').prop('disabled', false);
    });

    $('.profile-cancel-button').on('click', function(){
        $('.profile-cancel-button').addClass('d-none');
        $('.profile-save-button').addClass('d-none');
        $('#profile_edit').removeClass('d-none');
        $('.updatable').prop('disabled', true);
    });
    
    //end effect editing

    $('.subject_select').change(function(){
        var selected = $('option:selected', this).text();
        
        if (selected == "Others"){
         $('.other-description').removeClass('d-none');
         $('.other-description').prop('disabled', false);
        }else{
         $('.other-description').addClass('d-none');
         $('.other-description').prop('disabled', true);
        }
 
     });
 
     $(".subject_select option").each(function() {
         $(this).siblings('[value="'+ this.value +'"]').remove();
     });
     
     $("select option").each(function() {
        $(this).siblings('[value="'+ this.value +'"]').remove();
    });

    $('.profile-pic').hover(function(){
        $('.profile-pic').css('opacity', '60%');
        $('.icon-holder').css('opacity', '60%');
    }, function(){
        $('.profile-pic').css('opacity', '100%');
    });

    $('.profile-pic').click(function(){
        var data = $(this).attr('data');
        //alert(data);
        $('.zoom-photo--'+data).removeClass('d-none');
        $('body').css('overflow', 'hidden');
    });

    $('.close-icon').click(function(){
        var data = $(this).attr('data');
        //alert(data);
        $('.zoom-photo--'+data).addClass('d-none');
        $('body').css('overflow', 'auto');
    });

    $('.icon-holder').hover(function(){
        $('.profile-pic').css('opacity', '60%');
        $('.icon-holder').css('opacity', '100%');
    }, function(){
        $('.profile-pic').css('opacity', '100%');
        $('.icon-holder').css('opacity', '60%');
    });

    $('.icon-holder').click(function(){
        $('#image-upload').click();
    });

    $('#image-upload').on('change', function(){
        $('#picture_change_btn').click();
    });

    
    $('#picture_change').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            success:function(data){
                if(data.status){
                    alert(data.msg);
                    window.location.reload();
                }
                else{
                    alert('Change Failed!');
                }
            }
        });
        
    });

    $('#triggersubmit').click(function(){
        $('#submitupdate').click();
    });

});