$(document).ready(function(){
    $('.btn-select-user').click(function(){
       var training = $('.btn-select-user').attr('training-id');
       select_user(this.id, training);
    });

    $('.btn-cancel-user').click(function(){
        var training = $('.btn-cancel-user').attr('training-id');
        remove_user(this.id, training);
     });

   $('.delete_subject').click(function(){
        delete_subject(this.id, $('.delete_subject').attr('role'));
   });

   $('.delete_career').click(function(){
        delete_career(this.id, $('.delete_career').attr('role'));
   });

   $('.delete_education').click(function(){
        delete_education(this.id, $('.delete_education').attr('role'));
   });

   $('.btn-delete-training').click(function(){
    if (confirm("Are you sure you want to delete this training?")){
        delete_training(this.id, $('.btn-delete-training').attr('photo'), $('.btn-delete-training').attr('role'));
    }
    
   });

    function delete_subject(subject_id){
        var id = subject_id;
        $.ajax({
            url: '/delete-subject/' + id,
            type: 'DELETE',
    
            success: function(result){
                if(result['status']){
                    $('#' + result['div']).remove();
            
                    console.log('delete');
                }
                else{
                    alert('Delete Failed!');
                }
            }
        });
    };

    function delete_education(education_id){
        var id = education_id;
    
        $.ajax({
            url: '/delete-education/' + id,
            type: 'DELETE',
    
            success: function(result){
                if(result['status']){
                    $('#' + result['div']).remove();
                }
                else{
                    alert('Delete Failed!');
                }
            }
        });
    };
    
    function delete_career(career_id){
        var id = career_id;
    
        $.ajax({
            url: '/delete-career/' + id,
            type: 'DELETE',
    
            success: function(result){
                if(result['status']){
                    $('#' + result['div']).remove();
                }
                else{
                    alert('Delete Failed!');
                }
            }
        });
    };
    
    function delete_training(id, cop, role){
        var id = id;
    
        $.ajax({
            url: '/'+role+'/delete-pending-training/' + id + '/' + cop,
            type: 'DELETE',
    
            success: function(result){
                if(result['status']){
                    $('#delete_training_modal'+id).modal('hide');
                    $('#' + result['tr']).remove();
                }
                else{
                    alert('Delete Failed!');
                }
            }
        });

    };

    
});