<?php
include_once "../../itBook/Web/basic.php";
include_once "../../itBook/Connect/Globals.php";

if (isset($_GET['edit'])) {
    $id_book = $_GET['edit'];
}

try {
    $connection = Globals::getPDOConnection('bookIt');
} catch (Exception $e) {
    echo $e->getMessage();
}


try {
    $query = "SELECT book.id, book.title, author.fio, book.date, author.id as author_id FROM book JOIN book_author ON book.id = book_author.id_book
JOIN author ON book_author.id_author = author.id WHERE book.id=:id";
    $res = $connection->prepare($query);
    $res->bindValue(':id', $id_book);
    $res->execute();
    $num = $res->rowCount();
    $res = $res->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
}

for ($i = 0; $i < $num; $i++) {
    $book_id = $res[$i]['id'];
    $fio = $res[$i]['fio'];
    $title = $res[$i]['title'];
    $date = $res[$i]['date'];
    $author_id = $res[$i]['author_id'];
}


?>
<form method="post" action="" enctype="">
    <div class="container mt-3" style="padding-block: 40px">
        <div class="card" style="width: 400px; border: solid;">

            <div class="mb-3" style="padding: 20px">
                <h3 style="text-align: center"> Update Book</h3><br>
            </div>

            <div class="mb-3" style="margin-left: 20px; width: 250px;">
                <input type="hidden" class="form-control" name="id_book" id="id_book" value="<?=$book_id ?>">
            </div>

            <div class="mb-3" style="margin-left: 20px; width: 250px;">
                <input type="hidden" class="form-control" name="id_author" id="id_author" value="<?= $author_id ?>">
            </div>

            <div class="mb-3" style="margin-left: 20px; width: 250px;">
                <label for="title" class="form-label">Book Title</label>
                <input type="text" class="form-control" name="title" id="title" value="<?= $title ?>" placeholder="">
            </div>


            <div class="mb-3" style="margin-left: 20px; width: 250px;">
                <label for="fio" class="form-label">Book Author</label>
                <input type="text" class="form-control" name="fio" id="fio" value="<?= $fio ?>" placeholder="">
            </div>

            <div class="mb-3" style="margin-left: 20px; width: 250px;">
                <label for="date" class="form-label">Date </label>
                <input type="date" class="form-control" name="date" id="date" value="<?= $date ?>"
                       placeholder="">
            </div>

            <div class="mb-3" style="margin-left: 20px; width: 250px;">
                <button type="button" class="btn btn-success" name="submit" id="submit">Save</button>
            </div>
        </div>
    </div>
</form>


<script src="../resources/js/updateBook.js"></script>







