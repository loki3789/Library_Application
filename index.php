<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates


and open the template in the editor.
-->
<?php
require '../vendor/autoload.php';

$requested_book = "";
$paginate = 1;

$book=new BooksController();
$config=new Config();
$books = $book->getAllBooks();

if(isset($_GET['popularBook'])){
$books = $book->popularBook();
}

if (isset($_POST['name'])) {
    $requested_book = $_POST['name'];
    $books = ($book->searchBook($requested_book) != []) ? $book->searchBook($requested_book) : $books;
}

$pages = $config->pages(sizeof($books));

if (isset($_GET['p'])) {
    $paginate = (((integer) $_GET['p'] == 0) || ((integer) $_GET['p'] > $pages)) ? 1 : (integer) $_GET['p'];
}

$books = $config->refill($paginate, $books);



include(realpath($_SERVER["DOCUMENT_ROOT"]) . '\Library_application\app\view\mainPage.php');

?>