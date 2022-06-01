<?php
include_once "../../ItBook/Entity/Book.php";
include_once "../../ItBook/PDO/DaoBook.php";
include_once "../../ItBook/PDO/DaoAuthor.php";
include_once "../../ItBook/PDO/BookAuthor.php";


if (isset($_POST['save_book'])) {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $id_author = $_POST['fio'];
    if ($title != null and $date != null and $id_author != null) {
        $book = new Book($title, $date);
        $title = $book->getTitle();
        $date = $book->getDate();
        $book = new DaoBook();
        $book->save($title, $date);
        $id_book = $book->getAll($title, $date); //id_book
        if ($id_book != null) {
            $book_Author = new BookAuthor();
            $book_Author->saveAllBook_Author($id_book, $id_author);
        }
    }
}

if (isset($_POST['update'])) {
    $id_book = $_POST['id_book'];
    $id_author = $_POST['id_author'];
    $title = $_POST['title'];
    $fio = $_POST['fio'];
    $date = $_POST['date'];
    if ($title != null and $date != null and $fio != null) {
        $upBook = new DaoBook();
        $upBook->update($id_book, $title, $date);
        $upAuthor = new DaoAuthor();
        $upAuthor->update($id_author, $fio);
        $book_Author = new BookAuthor();
        $book_Author->updateAllBook_Author($id_book, $id_author);
    }
}

if (isset($_GET['id'])) {
    $id_book = $_GET['id'];
    $id_author = $_GET['id_author'];
    $book = new DaoBook();
    $book->delete($id_book);
    $author = new DaoAuthor();
    $author->delete($id_author);
    $book_Author = new BookAuthor();
    $book_Author->deleteAllBook_Author($id_book, $id_author);
}

if (isset($_POST['save_author'])) {
    $fio = $_POST['fio'];
    if ($fio != null) {
        $save = new DaoAuthor();
        $save->save($fio);
    }
}





