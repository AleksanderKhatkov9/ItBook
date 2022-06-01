<?php
include_once "../../itBook/Web/basic.php";
include_once "../../itBook/Connect/Globals.php";

if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
    $fio = $_SESSION['fio'];
}


try {
    $connect = Globals::getPDOConnection('bookIt');
} catch (Exception $e) {
    echo "<br> Исключение: " . __FILE__ . " " . __LINE__ . " " . $e->getMessage() . "<br>";
}

if($login !=null){

$query = "SELECT users.name, users.login, users.email, rules.rules_user, rules.rules_code From users JOIN user_rules ON users.id = user_rules.user_id
JOIN rules ON user_rules.rules_id = rules.id Where users.name= :fio";

try {
    $result = $connect->prepare($query);
    $result->bindValue('fio', $fio);
    $result->execute();
    $num = $result->rowCount();
    $result = $result->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "<br> Исключение: " . __FILE__ . " " . __LINE__ . " " . $e->getMessage() . "<br>";
}


foreach ($result as $val) {
    $name = $val['name'];
    $email = $val['email'];
    $rules_user = $val['rules_user'];
    $rules_code = $val['rules_code'];
}


$query = "SELECT book.id,book.title, author.id as author_id_book, author.fio, book.date FROM book JOIN book_author ON book.id = book_author.id_book
JOIN author ON book_author.id_author = author.id order by book.date desc";


try {
    $res = $connect->prepare($query);
    $res->execute();
    $num = $res->rowCount();
    $res = $res->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "<br> Исключение: " . __FILE__ . " " . __LINE__ . " " . $e->getMessage() . "<br>";
}
?>

<br>
<div class="container-lg" style="padding-block: 40px;">
    <div class="table-responsive" style="padding: 100px">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Book <b>List</b></h2></div>
                    <div class="col-sm-4">
                        <?php
                        if (empty($rules_user)) {
                            $rules_user = null;
                        }

                        if (empty($rules_code)) {
                            $rules_code = null;
                        }

                        if ($rules_code == 10) { ?>
                            <button type="submit" class="btn btn-success" name="author" id="author"><i class="fa fa-plus"></i> Add New Author</button>
                            <button type="submit" class="btn btn-primary" name="book" id="book"><i class="fa fa-plus"></i> Add New Book</button
                        <?php } ?>

                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>N</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php

                    $count = 1;
                    for ($i = 0;$i < $num;$i++) {
                    $id = $res[$i]['id'];
                    $title = $res[$i]['title'];
                    $date = $res[$i]['date'];
                    list($year, $month, $day) = explode("-", $date);
                    $Date = "${day}.${month}.${year}";
                    $fio = $res[$i]['fio'];
                    $id_author = $res[$i]['author_id_book'];
                    ?>

                <tr>
                    <td> <?= $count++; ?></td>
                    <td> <?= $title; ?></td>
                    <td> <?= $fio; ?></td>
                    <td><?= $Date ?></td>


                    <td>
                        <?php if ($rules_code == 10) { ?>
                            <a href="updateBook.php?edit=<?= $id; ?> " class="edit" data-toggle=""><i
                                        class="material-icons" data-toggle="" title="" style="color: green;"></i></a>
                            <a href="../Controller/ajax.php?id=<?= $id; ?>&?id_author=<?= $id_author; ?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete" style="color: red;"></i></a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mb-3" style="margin-block: 50px" >
        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="select"
                id="select" style="width: 400px; display: inline-block;margin-right: 5px;">
            <option value="1">Список книг с указанием автора</option>
            <option value="2">Список авторов с количеством книг</option>
        </select>
        <button type="submit" class="btn btn-success" name="show" id="show">Show</button>
    </div>


    <?php
    //        Список книг с указанием автора
    $query = "SELECT book.title, author.fio FROM book JOIN book_author ON book.id = book_author.id_book
JOIN author ON book_author.id_author = author.id";

    try {
        $res = $connect->prepare($query);
        $res->execute();
        $num = $res->rowCount();
        $res = $res->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
    }

    if ($num > 0) {
    echo '
   <div class="container" id = "book-1" style="display: none">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">N</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
            </tr>
            </thead>
            <tbody>
            <tr>';


        $count = 1;
        foreach ($res as $value) {
            $title = $value['title'];
            $fio = $value['fio'];
            ?>

            <td><?= $count++; ?></td>
            <td><?= $title; ?></td>
            <td><?= $fio; ?></td>
            </tr>
            <?php
        }
    }
    echo '
    </tbody>
    </table>
    </div>';


    //   Список авторов с количеством книг
    $query = "SELECT author.fio, COUNT(*) as count_book FROM book JOIN book_author ON book.id = book_author.id_book
    JOIN author ON book_author.id_author = author.id group by author.fio";

    try {
        $res = $connect->prepare($query);
        $res->execute();
        $num = $res->rowCount();
        $res = $res->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
    }

    if ($num > 0) {
    echo '
             <div class="container" id="book-2" style="display: none">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">N</th>
                <th scope="col">Author</th>
                <th scope="col">COUNT BOOK</th>
            </tr>
            </thead>
            <tbody>
            <tr>';


    $count = 1;
    foreach ($res as $value) {
    $fio = $value['fio'];
    $count_book = $value['count_book'];
    ?>

    <tbody>
    <tr>
        <td><?= $count++; ?></td>
        <td><?= $fio; ?></td>
        <td style="background: #f8f9fa; color: #664d03; font-weight: bold;"><?= $count_book; ?></td>
    </tr>
    <?php
        }
    }

    echo '
    </tbody>
    </table>
 </div>';

    }
    ?>

</div>
</div>


<script src="../resources/js/index.js"></script>


<?php include_once "../../itBook/Web/footer.php" ?>
