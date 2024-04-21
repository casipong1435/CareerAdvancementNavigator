$(document).ready(function(){

    $("#logout").click(function(){
        $("#submit-logout").submit();
    });

    $('#menu-toggle').click(function(){
        $('#wrapper').toggleClass('toggled');
    });

    $(".profile-image").click(function(){
        $url = $(this).attr('url');
        window.location = $url;
    });
    
    
});