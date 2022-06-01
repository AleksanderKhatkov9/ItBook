$(function () {
    $('#submit').click(function () {
        let fio = $('#fio').val();
        let save_author = "save_author";
        window.location = 'http://localhost/itBook/Web/index.php';

        if (fio.length === 0) {
            alert('Tile:\nfield to fill');
        }

        $.ajax({
            url: "/ItBook/Controller/ajax.php",
            method: "POST",
            data: {
                'save_author': save_author,
                'fio': fio,
            },
            dataType: "json",
            success: function (data) {
                alert("Отправка" + data);

                if (data != null) {
                }
            }

        });
    });
});