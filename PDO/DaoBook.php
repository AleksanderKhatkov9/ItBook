<?php
include_once "../../itBook/Connect/Globals.php";


class DaoBook
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

    function save($title, $data)
    {
        $connect = $this->connectPDO();
        $query = "INSERT INTO bookIt.book (title, date ) VALUES (:title, :date)";
        try {
            $res = $connect->prepare($query);
            $res->bindValue(':title', $title);
            $res->bindValue(':date', $data);
            $res->execute();

        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }
    }

    function getAll($title, $date)
    {
        $connect = $this->connectPDO();
        $query = "SELECT * FROM bookit.book WHERE title=:title and date=:date";
        try {
            $res = $connect->prepare($query);
            $res->bindValue(':title', $title);
            $res->bindValue(':date', $date);
            $res->execute();
            $num = $res->rowCount();
            $res = $res->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }

        if ($num > 0) {
            foreach ($res as $param) {
                $id_book = $param['id'];
            }
        }
        return $id_book;
    }


    function update($id, $title, $data)
    {
        $connect = $this->connectPDO();
        $query = "UPDATE bookIt.book SET title =:title, date = :date WHERE id =:id";
        try {
            $res = $connect->prepare($query);
            $res->bindValue(':id', $id);
            $res->bindValue(':title', $title);
            $res->bindValue(':date', $data);
            $res->execute();
        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }
    }


    function delete($id)
    {
        $connect = $this->connectPDO();
        $query = "DELETE FROM bookIt.book WHERE id = :id";
        try {
            $res = $connect->prepare($query);
            $res->bindValue(':id', $id);
            $res->execute();
        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }
    }
}