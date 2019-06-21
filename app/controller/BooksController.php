<?php

require realpath($_SERVER["DOCUMENT_ROOT"]) . '\vendor\autoload.php';

class BooksController extends Home {

    function processRequest() {
        if (isset($_POST)) {
            if (isset($_POST['add'])) {
                $this->addBook();
            }

            if (isset($_POST['showPdf'])) {
                $this->showBook();
            }

            if (isset($_POST['rate'])) {
                $this->storeRatings();
            }
        }
    }

    function showBook() {

        $databaseObject = new Database;
        $pdo = $databaseObject->getConnection();

        $id = $_POST['id'];
        $pdfData = $databaseObject->selectBlob($id, $pdo);
        header("Content-Type:" . $pdfData['mime']);
        echo $pdfData['data'];
    }

    function addBook() {
        $databaseObject = new Database;
        $pdo = $databaseObject->getConnection();
        $Barcode_value = $_POST['Barcode_value'];
        $year_of_publication = $_POST['Year_of_Publication'];
        $author = $_POST['Author'];
        $name = $_FILES['uploaded_file']['name'];
        $Uploded_temporary_filePath = $_FILES['uploaded_file']['tmp_name'];
        $databaseObject->insertBlob($Uploded_temporary_filePath, "application/pdf", $name, $Barcode_value, $author, $year_of_publication, $pdo);

        header('location: ../../index.php');
    }

    function storeRatings() {
        $ratingsValue = $_POST['ratings'];
        $bookId = $_POST['id'];
        $databaseObject = new Database;
        $pdo = $databaseObject->getConnection();
        $databaseObject->storeRatings($pdo, $ratingsValue, $bookId);
        header('location: ./../../index.php');
    }

    function getAllBooks() {
        $databaseObject = new Database;
        $pdo = $databaseObject->getConnection();
        $data = $databaseObject->getAllBooks($pdo, 'files');
        return $data;
    }

    function searchBook($name) {
        $databaseObject = new Database;
        $pdo = $databaseObject->getConnection();

        $data = $databaseObject->searchBookByName($pdo, $name);
        return $data;
    }

    function popularBook() {

        $databaseObject = new Database;
        $pdo = $databaseObject->getConnection();
        $popularBook = $databaseObject->getPopularBook($pdo);
        $a = array();

        foreach ($popularBook as $book):
            if ($this->is_value_present($book['bookId'], $a) == 'true') {
                $index = $this->find_index($book['bookId'], $a);
                $sum = $book['ratingsValue'] + $a[$index][1];
                $a[$index][1] = $sum;
            } else {

                array_push($a, array($book['bookId'], $book['ratingsValue']));
            }

        endforeach;
        $popularBook1 = $this->find_maximum($a);
        $bookid = $popularBook1[0];
        $ratings = $popularBook1[0];
        $mostPopularBook = $databaseObject->getMost($pdo, $bookid);
        return $mostPopularBook;
    }

    function find_maximum($arrayOfData) {
        $bookid = 0;
        $ratings = 0;
        $max = 0;
        foreach ($arrayOfData as $data):
            if ($data[1] > $max) {
                $max = $data[1];
                $bookid = $data[0];
                $ratings = $data[1];
            }
        endforeach;
        return array($bookid, $ratings);
    }

    public function is_value_present($value, $arrayOfData) {
        foreach ($arrayOfData as $data):
            if ($data[0] == $value) {
                return 'true';
            }
        endforeach;
        return 'false';
    }

    function find_index($value, $arrayOfData) {
        $index = 0;
        foreach ($arrayOfData as $data):
            if ($data[0] == $value) {
                return $index;
            }
            $index = $index + 1;
        endforeach;
    }

}
