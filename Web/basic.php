<?php
session_start();

if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
    $fio = $_SESSION['fio'];

} else {
    $login = null;
    $fio = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List Book</title>
    <?php include_once "../../itBook/Web/header.php"; ?>
</head>
<body>
<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <a href="index.php"><img src="../resources/img/itbook.png" style="width: 100px; height: 50px; margin-right: 50px;"></a>
            </ul>

            <div class="text-end" style="" id="aut-text">
                <span tabindex="-1" id="ldap_auth_form_fio" style="padding: 20px"><?= $fio; ?></span>
            </div>

            <?php if ($fio != null) { ?>
                <button type="button" class="btn btn-outline-success" name="reg" id="reg" style="margin-left: 10px">
                    Личный кабинет
                </button>
            <?php } ?>


            <?php if ($fio == null) { ?>
                <div class="text-end" style="margin-left: 100px;" id="aut-text">
                    <button type="button" class="btn btn-warning" name="aut" id="aut">Войти</button>
                </div>
            <?php }else{ ?>
            <div class="text-end" style="margin-left: 100px; id="exit-text">
            <button type="button" class="btn btn-outline-danger" name="exit" id="exit" value="tru">Выйти</button>
        </div>
        <?php } ?>

    </div>
    </div>
</header>


<script src="../resources/js/basic.js"></script>

<?php
if (isset($_GET['destroy'])) {
    session_destroy();
}
?>

</body>
</html>
