$(function () {
    $('#submit').click(function () {
        let email = $('#email').val();
        let reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (reg.test(email) === false) {
            alert('Введите корректный e-mail');
        }
        if (email.length === 0) {
            alert('Tile:\nfield to fill');
        }

        $("#message").css("display", "block");

        $.ajax({
            url: "/ItBook/Controller/email.php",
            method: "POST",
            data: {
                'email': email,
            },
            dataType: "json",
            success: function (data) {
                alert("Отправка" + data);
            }
        });
    });
});