$(document).ready(function() {
    $('.burger').click(function(event) {
        $('.burger,.burger_on,header__section').toggleClass('active');
        $('body').toggleClass('lock');
    });

    $('.burger_on').click(function(){
       $('.burger,.burger_on,header__section').removeClass('active');
       $('body').removeClass('lock');
    });

    $('#sendButton').click(function (e) {
        e.preventDefault();
        
        let name = $("#name").val();
        let email = $("#email").val();

        if (!validateInputData(name, email)) {
            return false;
        }

        $.ajax({
            type: "POST",
            url: "/mail.php",
            data: {
              name,
              email
            },
            success: function(result) {
              showMessage(result);
            },
            error: function(result) {
              showMessage('Не удалось отправить письмо.');
            }
        });
    });

    function showMessage(text) {
      $('#modal').html('<p>' + text + '</p>');

      $('#modal')    
      .css("display", "flex")
      .hide()
      .fadeIn();
      
      setTimeout(() => $('#modal').fadeOut(), 2000);
    }

    function emailIsValid(email) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
    }

    function validateInputData(name, email) {
      if (name.length < 2) {
        showMessage('Имя не должно быть меньше 2-х символов');
        return false;
      }

      if (!emailIsValid(email)) {
        showMessage('Введите корректный email');
        return false;
      }

      return true;
    }
});

