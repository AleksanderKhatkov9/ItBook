$(function () {
    $('#submit').click(function () {
        window.location = 'http://localhost/itBook/Web/index.php';
        let title = $('#title').val();
        let fio = $('#select').val();
        let date = $('#date').val();
        let save_book = "save_book";

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
                'save_book': save_book,
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