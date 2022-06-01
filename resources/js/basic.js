$(function () {
    $('#aut').click(function () {
        window.location = 'http://localhost/ItBook/Web/aut.php';
    });

    $('#reg').click(function () {
        window.location = 'http://localhost/itBook/Web/userWeb.php';
    });

    $('#exit').click(function () {
        let destroy = $("#exit").val();
        $.ajax({
            url: "/itBook/Web/basic.php",
            method: "GET",
            data: {
                'destroy': destroy,
            },
            dataType: "json",
            success: function (data) {
                alert(data);
            }
        });
        window.location = 'http://localhost/itBook/Web/index.php';
    });
});