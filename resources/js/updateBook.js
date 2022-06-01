$(function () {
    $('#submit').click(function () {
        let update = "update";
        let id_book = $('#id_book').val();
        let id_author = $('#id_author').val();
        let title = $('#title').val();
        let fio = $('#fio').val();
        let date = $('#date').val();
        window.location = 'http://localhost/ItBook/Web/index.php';
        if (title.length === 0) {
            alert('Tile:\nfield to fill');
        }
        if (fio.length === 0) {
            alert('Tile:\nfield to fill');
        }
        if (date.length === 0) {
            alert('Date:\nfield to fill');
        }

        $.ajax({
            url: "/ItBook/Controller/ajax.php",
            method: "POST",
            data: {
                'update': update,
                'id_book': id_book,
                'id_author': id_author,
                'title': title,
                'fio': fio,
                'date': date,
            },
            dataType: "json",
            success: function (data) {
                alert("Отправка" + data);
            }
        });
    });
});