<?php
include_once "../../itBook/Web/basic.php";
include_once "../../itBook/Connect/Globals.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

try {
    $connection = Globals::getPDOConnection('bookIt');
} catch (Exception $e) {
    echo $e->getMessage();
}

$query = "SELECT * FROM bookit.users Where id=:id";

try {
    $res = $connection->prepare($query);
    $res->bindValue(':id', $id);
    $res->execute();
    $num = $res->rowCount();
    $res = $res->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
}

for ($i = 0; $i < $num; $i++) {
    $user_id = $res[$i]['id'];
    $name = $res[$i]['name'];
    $login = $res[$i]['login'];
}

?>
<form method="post" action="" enctype="">
    <div class="container mt-3">
        <div class="card" style="width: 400px; border: solid;">

            <div class="mb-3" style="padding: 20px">
                <h3 style="text-align: center"> Update User</h3><br>
            </div>

            <div class="mb-3" style="margin-left: 20px; width: 250px;">
                <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?= $user_id ?>" placeholder="">
            </div>

            <div class="mb-3" style="margin-left: 20px; width: 250px;">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?= $name ?>" placeholder="">
            </div>

            <div class="mb-3" style="margin-left: 20px; width: 250px;">
                <label for="login" class="form-label">Login </label>
                <input type="text" class="form-control" name="login" id="login" value="<?= $login ?>" placeholder="">
            </div>

            <div class="mb-3" style="margin-left: 20px; width: 250px;">
                <button type="submit" class="btn btn-success" name="submit" id="submit">Save</button>
            </div>
        </div>
    </div>
</form>

<script src="../resources/js/updateUser.js"></script>




