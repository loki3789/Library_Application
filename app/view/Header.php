!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="public/assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="public/assets/css/font-awesome.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Library Application</title>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand navbar-dark bg-dark">
                <a class="navbar-brand" href="#">Library</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample02">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home 
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="new.php" data-toggle="modal" data-target="#CreateContact">New book</a>

                            <div class="modal fade" id="CreateContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New Book :</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <form action="public/BooksController/processRequest" method="POST" enctype="multipart/form-data">
                                                <table class="d-flex justify-content-center">
                                                    <tr>
                                                        <td><label>Barcode value : </label></td>
                                                        <td class="form-group"><input class='form-control' name="Barcode_value" type="text"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label>Author : </label></td>
                                                        <td class="form-group"><input class='form-control' name="Author" type="text"></td>
                                                    </tr>	
                                                    <tr>
                                                        <td><label>Year of Publication : </label></td>
                                                        <td class="form-group"><input class='form-control' name="Year_of_Publication" type="text"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label>select file : </label></td>
                                                        <td class="form-group"><input type="file" name="uploaded_file"><br></td>
                                                    </tr>		
                                                </table>
                                                <br>
                                                <input class='btn btn-primary' type="submit" name="add" value="Add">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="getPopularBook.php" >Popular Book</a>
                        </li>
                    </ul>
                    <form method="POST" class="form-inline my-2 my-md-0">
                        <input class="form-control" type="text" name="name" placeholder="Search By Name" value="<?= $requested_book ?>">
                    </form>
                </div>
            </nav>
        </header>
