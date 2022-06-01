<?php
include_once "../../itBook/Connect/Globals.php";

class BookAuthor
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

    function saveAllBook_Author($id_book, $id_author)
    {
        $connect = $this->connectPDO();
        $query = "INSERT INTO bookit.book_author (id_book, id_author ) VALUES (:id_book, :id_author)";
        try {
            $res = $connect->prepare($query);
            $res->bindValue(':id_book', $id_book);
            $res->bindValue(':id_author', $id_author);
            $res->execute();

        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }
    }


    function updateAllBook_Author($id_book, $id_author)
    {
        $connect = $this->connectPDO();
        $query = "UPDATE bookit.book_author SET id_book =:id_book, id_author = :id_author WHERE id_author=:id_author"; //error db
        try {
            $res = $connect->prepare($query);
            $res->bindValue(':id_book', $id_book);
            $res->bindValue(':id_author', $id_author);
            $res->execute();

        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }
    }

    function deleteAllBook_Author($id_book, $id_author)
    {
        $connect = $this->connectPDO();
        $query = "DELETE FROM bookit.book_author WHERE id_book = :id_book";
        try {
            $res = $connect->prepare($query);
            $res->bindValue(':id_book', $id_book);
            $res->execute();
        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }

        $query = "DELETE FROM bookit.book_author WHERE id_author = :id_author";
        try {
            $res = $connect->prepare($query);
            $res->bindValue(':id_author', $id_author);
            $res->execute();
        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }

    }

}