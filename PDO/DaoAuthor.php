<?php
include_once "../../itBook/Connect/Globals.php";

class DaoAuthor
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


    function save($fio)
    {

        $connect = $this->connectPDO();
        $query = "INSERT INTO bookIt.author (fio) VALUES (:fio)";

        try {
            $res = $connect->prepare($query);
            $res->bindValue(':fio', $fio);
            $res->execute();
        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }
    }

    function update($id, $fio)
    {

        $connect = $this->connectPDO();
        $query = "UPDATE bookIt.author SET fio =:fio WHERE id =:id";
        try {
            $res = $connect->prepare($query);
            $res->bindValue(':id', $id);
            $res->bindValue(':fio', $fio);
            $res->execute();
        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }
    }

    function delete($id)
    {
        $connect = $this->connectPDO();
        $query = "DELETE FROM bookIt.author WHERE id = :id";
        try {
            $res = $connect->prepare($query);
            $res->bindValue(':id', $id);
            $res->execute();

            $url = "http://localhost/itBook/Web/index.php";
            header('Location:' . $url);

        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }
    }

}