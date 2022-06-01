<?php
include_once "../../itBook/Connect/Globals.php";

class DaoUser
{

    public function connectPDO()
    {
        try {
            $connect = Globals::getPDOConnection('bookIt');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $connect;
    }

    function save($name, $login, $password, $email, $token)
    {
        $connect = $this->connectPDO();
        $query = "INSERT INTO bookIt.users (name ,login, password, email, token ) VALUES (:name, :login, :password, :email, :token)";

        try {
            $res = $connect->prepare($query);
            $res->bindValue(':name', $name);
            $res->bindValue(':login', $login);
            $res->bindValue(':password', $password);
            $res->bindValue(':email', $email);
            $res->bindValue(':token', $token);
            $res->execute();
        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }
    }


    public function update($id, $name, $login)
    {
        $conn = $this->connectPDO();
        $query = "UPDATE bookIt.users SET name = :name, login = :login WHERE id=:id";
        try {
            $res = $conn->prepare($query);
            $res->bindValue(":id", $id);
            $res->bindValue(":name", $name);
            $res->bindValue(":login", $login);
            $res->execute();

        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . " " . __LINE__ . " " . $e->getMessage() . "<br>";
        }
    }


    public function delete($id)
    {
        $conn = $this->connectPDO();
        $query = "DELETE FROM bookIt.users WHERE id= :id;";
        try {
            $res = $conn->prepare($query);
            $res->bindValue(":id", $id);
            $res->execute();
        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . " " . __LINE__ . " " . $e->getMessage() . "<br>";
        }
    }


    public function authorization($email){
        $conn = $this->connectPDO();
        try {
            $query = "SELECT * FROM bookit.users WHERE email = :email";
            $res = $conn->prepare($query);
            $res->bindValue(":email", $email);
            $res->execute();
            $num = $res->rowCount();
            $res = $res->fetchAll(PDO::FETCH_ASSOC);


            if($num > 0){
                for ($i = 0; $i < $num; $i++) {
                    $fio = $res[$i]['name'];
                    $login_db = $res[$i]['login'];
                    $email_db = $res[$i]['email'];
                }

                if ($email == $email_db) {
                    $_SESSION['login'] = $login_db;
                    $_SESSION['fio'] = $fio;
                    $url = 'http://localhost/itBook/Web/index.php';
                    header('Location: '.$url);
                }
            }

        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }
    }

}