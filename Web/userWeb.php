<?php
include "../../itBook/Web/basic.php";
include "../../itBook/Connect/Globals.php";

if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
    $fio = $_SESSION['fio'];
}


try {
    $connect = Globals::getPDOConnection('bookIt');
} catch (Exception $e) {
    echo "<br> Исключение: " . __FILE__ . " " . __LINE__ . " " . $e->getMessage() . "<br>";
}


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


if($num > 0) {
    foreach ($result as $val) {
        $name = $val['name'];
        $email = $val['email'];
        $rules_user = $val['rules_user'];
        $rules_code = $val['rules_code'];
    }
}

try {
    $query = "SELECT * FROM bookit.users";
    $result = $connect->prepare($query);
    $result->execute();
    $num = $result->rowCount();
    $result = $result->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "<br> Исключение: " . __FILE__ . " " . __LINE__ . " " . $e->getMessage() . "<br>";
}
?>


<div class="container-lg">
    <div class="table-responsive" style="padding: 100px">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Admin <b>Users</b></h2></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>

                <tr>
                    <th>N</th>
                    <th>Name</th>
                    <th>Login</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php
                    $count = 1;
                    for ($i = 0;$i < $num;$i++) {
                    $id = $result[$i]['id'];
                    $name = $result[$i]['name'];
                    $login = $result[$i]['login'];
                    ?>

                    <td> <?= $count++; ?></td>
                    <td> <?= $name; ?></td>
                    <td><?= $login ?></td>

                    <td>
                        <?php if ($rules_code == 10) { ?>
                            <a href="updateUser.php?id=<?= $id; ?> " class="edit" data-toggle=""><i class="material-icons" data-toggle="" title="" style="color: green;"></i></a>
                            <a href="../Controller/userAjax.php?delete=<?= $id; ?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete" style="color: red;"></i></a>
                        <?php } ?>
                    </td>
                </tr>

                <?php
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>


















