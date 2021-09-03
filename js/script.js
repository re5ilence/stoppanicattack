$(document).ready(function() {
    $('.burger').click(function(event) {
        $('.burger,.burger_on,header__section').toggleClass('active');
        $('body').toggleClass('lock');
    });

    $('.burger_on').click(function(){
       $('.burger,.burger_on,header__section').removeClass('active');
       $('body').removeClass('lock');
    });

});