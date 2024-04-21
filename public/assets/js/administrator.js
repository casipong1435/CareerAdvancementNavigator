$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    //Deleting user in modal

    $('.btn-delete').on('click',function(e){
        e.preventDefault();

        var id = this.id;

        $.ajax({
            url: '/admin/dashboard/administrator/delete/' + id,
            type: 'DELETE',
            success: function(result){
                if (result['status']){
                    $('.' + result['row']).remove();
                    $('#delete_admin_modal'+id).modal("hide");
                }else{
                    alert('Delete Failed');
                    $('#delete_admin_modal'+id).modal("hide");
                }
            }
        });
    });

    $('select.conducted_by').on('change', function(){
        //alert($(this).find('option:selected').text());
        $(this).find('option:selected').text() == 'Others' ? $('input.conducted_by').removeClass('d-none'):$('input.conducted_by').addClass('d-none');
    });

    $('select.type_of_ld').on('change', function(){
        //alert($(this).find('option:selected').text());
        $(this).find('option:selected').text() == 'Others' ? $('input.type_of_ld').removeClass('d-none'):$('input.type_of_ld').addClass('d-none');
    });

    $('select.source_of_budget').on('change', function(){
        //alert($(this).find('option:selected').text());
        $(this).find('option:selected').text() == 'Others' ? $('input.source_of_budget').removeClass('d-none'):$('input.source_of_budget').addClass('d-none');
    });

    $('select.service_provider').on('change', function(){
        //alert($(this).find('option:selected').text());
        $(this).find('option:selected').text() == 'Others' ? $('input.service_provider').removeClass('d-none'):$('input.service_provider').addClass('d-none');
    });

    $('select.training_type').on('change', function(){
        //alert($(this).find('option:selected').text());
        $(this).find('option:selected').text() == 'Others' ? $('input.training_type').removeClass('d-none'):$('input.training_type').addClass('d-none');
    });


});

 
    