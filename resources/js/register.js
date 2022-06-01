$(function () {
    $('#submit').click(function () {
        window.location = 'http://localhost/itBook/Web/index.php';
        let name = $('#name').val();
        let login = $('#login').val();
        let password = $('#password').val();
        let email = $('#email').val();
        let saveUser = "saveUser";

        if (name.length === 0) {
            alert('Tile:\nfield to fill');
        }

        if (login.length === 0) {
            alert('Tile:\nfield to fill');
        }

        if (password.length === 0) {
            alert('Tile:\nfield to fill');
        }

        if (email.length === 0) {
            alert('Tile:\nfield to fill');
        }

        $.ajax({
            url: "/ItBook/Controller/userAjax.php",
            method: "POST",
            data: {
                'saveUser' :saveUser,
                'name': name,
                'login': login,
                'password': password,
                'email': email
            },
            dataType: "json",
            success: function (data) {
                alert("Отправка" + data);
            }
        });
    });
});