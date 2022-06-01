$(function () {
    $('#book').click(function () {
        window.location = 'http://localhost/itBook/Web/addBook.php';
    });

    $('#author').click(function () {
        window.location = 'http://localhost/itBook/Web/addAuthor.php';
    });

    $('#show').click(function () {
        let select_book = $('select').val();

        if (select_book.length === 0) {
            alert('Date:\nfield to fill');
        }

        if (select_book == 1) {
            // alert('Список книг с указанием автора');
            $('#book-2').css('display', 'none');
            $('#book-1').css('display', 'block');

        } else {
            // alert('Список авторов с количеством книг');
            $('#book-1').css('display', 'none');
            $('#book-2').css('display', 'block');
        }
    });
});