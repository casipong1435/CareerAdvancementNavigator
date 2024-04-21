$(document).ready(function(){

    setInterval(function(){

        setTimeout(function(){
            $('.message').fadeOut('slow');
        }, 5000);

        clearTimeout();
    }, 8000);

});