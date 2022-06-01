<?php
include_once "../../ItBook/Entity/User.php";
include_once "../../ItBook/PDO/DaoUser.php";

session_start();

if (isset($_POST['saveUser'])) {
    $name = $_POST['name'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    if ($name != null and $login != null and $password != null and $email != null) {
        $user = new User($name, $login, $password, $email);
        $name = $user->getName();
        $login = $user->getLogin();
        $password = $user->getPassword();
        $password = md5($password);
        $email = $user->getEmail();
        $save = new DaoUser();
        function create_guid()
        { // Create GUID (Globally Unique Identifier)
            $guid = '';
            $namespace = rand(11111, 99999);
            $uid = uniqid('', true);
            $data = $namespace;
            $data .= $_SERVER['REQUEST_TIME'];
            $data .= $_SERVER['HTTP_USER_AGENT'];
            $data .= $_SERVER['REMOTE_ADDR'];
            $data .= $_SERVER['REMOTE_PORT'];
            $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
            $guid = substr($hash, 0, 8) . '-' .
                substr($hash, 8, 4) . '-' .
                substr($hash, 12, 4) . '-' .
                substr($hash, 16, 4) . '-' .
                substr($hash, 20, 12);
            return $guid;
        }

        $token = create_guid();
        $save->save($name, $login, $password, $email, $token);
        $authorization = new DaoUser();
        $authorization ->authorization($email);
    }
}

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $login = $_POST['login'];
    if ($name != null and $login != null) {
        $update = new DaoUser();
        $update->update($user_id, $name, $login);
        ?>
        <script>
            window.location = 'http://localhost/itBook/Web/userWeb.php';
        </script>
        <?php
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delUsers = new DaoUser();
    $delUsers->delete($id);
    ?>
    <script>
        window.location = 'http://localhost/itBook/Web/userWeb.php';
    </script>
    <?php
}
