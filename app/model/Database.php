<?php

class Database {

    function getConnection() {
        $host = "localhost";
        $dbname = "contacts-manager-database";
        $username = "root";
        $password = "root";
        $options = [
            PDO::ATTR_EMULATE_PREPARES => false, // turn off emulation mode for "real" prepared statements
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
        ];
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);
        return $pdo;
    }

    function storeRatings($pdo, $ratingsValue, $bookId) {
        $stmt = $pdo->prepare("INSERT INTO storeratings(bookId,ratingsValue) VALUES(:bookId,:ratingsValue)");
        $result = $stmt->execute([
            ':bookId' => $bookId,
            ':ratingsValue' => $ratingsValue,
        ]);
        return $result;
    }

    function getAllBooks($pdo, $table) {
        $stmt = $pdo->prepare("SELECT id,name,barcodeValue,author,yearOfPublication FROM files ;");
        $stmt->execute([]);
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $arr;
    }

    function searchBookByName($pdo, $name) {
        $stmt = $pdo->prepare("SELECT id,name,barcodeValue,author,yearOfPublication FROM files  WHERE `name` LIKE :name;");
        $stmt->execute([':name' => $name]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function selectBlob($id, $pdo) {


        $sql = "SELECT mime,
                            data
                       FROM files
                      WHERE id =:id;";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":id" => $id));
        $stmt->bindColumn(1, $mime);
        $stmt->bindColumn(2, $data, PDO::PARAM_LOB);

        $stmt->fetch(PDO::FETCH_BOUND);

        return array("mime" => $mime, "data" => $data);
    }

    public function insertBlob($filePath, $mime, $name, $Barcode_value, $author, $year_of_publication, $pdo) {
        $blob = fopen($filePath, 'rb');

        $sql = "INSERT INTO files(mime,data,name,barcodeValue,author,yearOfPublication) VALUES(:mime,:data,:name,:barcode,:author,:yearofpublication)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':mime', $mime);
        $stmt->bindParam(':data', $blob, PDO::PARAM_LOB);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':barcode', $Barcode_value);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':yearofpublication', $year_of_publication);

        return $stmt->execute();
    }

    function getPopularBook($pdo) {
        $stmt = $pdo->prepare("SELECT bookId,ratingsValue FROM storeratings;");
        $stmt->execute([]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    function getMost($pdo, $bookId) {
        $stmt = $pdo->prepare("SELECT name,barcodeValue,author,yearOfPublication FROM files where id=:bookid;");
        $stmt->execute([":bookid" => $bookId]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

}
