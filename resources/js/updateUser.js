$(function () {
    $('#submit').click(function () {
        alert('Click');
        let update = "user_id";
        let user_id = $('#user_id').val();
        let name = $('#name').val();
        let login = $('#login').val();

        // window.location = 'http://localhost/ItBook/Web/index.php';
        if (name.length === 0) {
            alert('Tile:\nfield to fill');
        }
        if (login.length === 0) {
            alert('Tile:\nfield to fill');
        }

        $.ajax({
            url: "/ItBook/Controller/userAjax.php",
            method: "POST",
            data: {
                'update': update,
                'user_id': user_id,
                'name': name,
                'login': login,
            },
            dataType: "json",
            success: function (data) {
                alert("Отправка" + data);
            }
        });

    });
});