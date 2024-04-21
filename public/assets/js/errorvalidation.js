$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#update_pending_training").on('submit', function(e){

        var id = $("#update_pending_training").attr('data-id');

        e.preventDefault();

        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(document).find('div.error-text').text('');
            },
            success:function(data){
                if(data.status == 1){
                    alert(data.msg);
                    $("#edit-pending-training"+id).modal('hide');
                }
                else{
                    $.each(data.error, function(prefix, val){
                        $('div.'+prefix+'_error').text(val[0]);
                    });
                }
            }
        });
        
    });

    $("#admin_edit_training").on('submit', function(e){

        e.preventDefault();

        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(document).find('div.error-text').text('');
            },
            success:function(data){
                if(data.status == 1){
                    alert(data.msg);
                    $("#edit-training").modal('hide');
                    window.location.reload();
                }
                else{
                    $.each(data.error, function(prefix, val){
                        $('div.'+prefix+'_error').text(val[0]);
                    });
                }
            }
        });

        
    });
    

    $("#submit_attendance_form").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(document).find('div.error-text').text('');
            },
            success:function(data){
                switch (data.status){
                    case 0:
                            $.each(data.error, function(prefix, val){
                                $('div.'+prefix+'_error').text(val[0]);
                            });

                        break;
                    case 1:
                            $('.error-alert').removeClass('d-none');
                            $('div.submitted_error').html(data.msg);

                            
                            setTimeout(function(){
                                $('.error-alert').addClass('d-none');
                                $('div.submitted_error').html('');
                            }, 8000);

                        break;
                    case 2:
                            alert(data.msg);
                            window.location.href = data.link;
                        break;
                    case 3:
                            $('div.otp_used_error').html(data.msg);
                            setTimeout(function(){
                                $('div.otp_used_error').html('');
                            }, 8000);
                        break;
                    case 4:
                            $('div.otp_used_error').html(data.msg);
                            setTimeout(function(){
                                $('div.otp_used_error').html('');
                            }, 8000);
                        break;
                }
            }
        });

    });

});
