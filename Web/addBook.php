<?php
include "../../itBook/Web/basic.php";
include "../../itBook/Connect/Globals.php";


try {
    $connection = Globals::getPDOConnection('bookIt');
} catch (Exception $e) {
    echo $e->getMessage();
}


$query = "SELECT * FROM bookIt.author";

try {
    $res = $connection->prepare($query);
    $res->execute();
    $num = $res->rowCount();
    $res = $res->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
}

?>

<form method="post" action="" enctype="">
    <div class="container mt-3" style="padding-block: 40px">
        <div class="card" style="width: 400px; border: solid;">
            <div class="mb-3" style="padding: 20px">
                <h3 style="text-align: center">Add Book</h3><br>
                <img src="../resources/img/book.png" style="width: 40%;">
            </div>

            <div class="mb-3" style="margin-left: 20px; width: 250px;">
                <input type="text" class="form-control" name="title" id="title" placeholder="Book Title">
            </div>

            <div class="mb-3" style="margin-left: 20px;">
                <select class="custom-select" id="select" style="width: 250px;">
                    <?php foreach ($res as $param) {
                        $id = $param['id'];
                        $fio = $param['fio']; ?>
                        <option value="<?= $id; ?>"><?= $fio; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3" style="margin-left: 20px; width: 250px;">
                <input type="date" class="form-control" name="date" id="date" placeholder="">
            </div>

            <div class="mb-3" style="margin-left: 20px">
                <button type="button" class="btn btn-success" name="submit" id="submit">Save</button>
            </div>

        </div>
    </div>
</form>


<script src="../resources/js/addBook.js"></script>



