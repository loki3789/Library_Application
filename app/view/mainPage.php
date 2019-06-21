<!DOCTYPE html>
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
                            
                             <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?popularBook=1" name="PopularBookLink" >Popular Book</a>
                           
                            
                            
                        </li>
                    </ul>
                    <form method="POST" class="form-inline my-2 my-md-0">
                        <input class="form-control" type="text" name="name" placeholder="Search By Name" value="<?= $requested_book ?>">
                    </form>
                </div>
            </nav>
        </header>


        <!-- Page Content -->
        <div class="container">
            <!-- Page Heading -->
            <h5 class="my-4 text-center"> Available Books </h5>

            <div class="row">
                <?php foreach ($books as $book): ?>
                    <div class="col-lg-4 col-sm-6 portfolio-item Card">
                        <div class="card h-100 text-center">
                            <a href="#"><img class="user" src="public\assets\img\download.jpg" alt="user"></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#"> <?= $book['name'] ?> </a>
                                </h4>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        Barcode Value : <strong><?= $book['barcodeValue'] ?></strong>
                                    </li>
                                    <li class="list-group-item">
                                        Author : <strong><?= $book['author'] ?></strong>
                                    </li>
                                    <li class="list-group-item">
                                        Year of Publication : <strong><?= $book['yearOfPublication'] ?></strong>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer actions">
                                <h4>Actions</h4>
                                <form action="public/BooksController/processRequest" method="POST">
                                    <input type="text" name="id" value="<?= $book['id'] ?>" hidden="hidden">
                                    <input  class="btn btn-warning" type="submit" name="showPdf" value="read">

                                </form>
                                </br>
                                <button class="btn btn-danger" type="button" name="delete" data-toggle="modal" data-target="#RatingsModal<?= $book['id'] ?>">
                                    <i class="fa fa-star-half-empty"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                                    rate
                                </button>
                            </div>


                            <!-- ratings Modal -->
                            <div class="modal fade" id="RatingsModal<?= $book['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Give Your Ratings for : <strong><?= $book['name'] ?> </strong> </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="public/BooksController/processRequest" method="POST">
                                                <table class="d-flex justify-content-center">
                                                  <input type="text" name="id" value="<?= $book['id'] ?>" hidden="hidden">  
                                               <br><br>
                                      <input type="radio" checked="checked" value="1" name="ratings">1
                                        <input type="radio" value="2" name="ratings">2
                                        <input type="radio" value="3" name="ratings">3
                                        <input type="radio" value="4" name="ratings"> 4
                                        <input type="radio"  value="5" name="ratings">5
                                        <input type="radio" value="6" name="ratings">6
                                        <input type="radio"  value="7" name="ratings">7
                                        <input type="radio" value="8" name="ratings"> 8
                                        <input type="radio"  value="9" name="ratings">9
                                        <input type="radio"  value="10" name="ratings"> 10<br><br>
                                        <input type="submit" name="rate" value="Rate"></input>
                                        
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <!-- /.row -->
            <br><br><br>

            <footer class="page-footer font-small blue pt-4">
                <!-- Pagination -->
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="index.php?p=<?= $paginate - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php foreach (range(1, $pages) as $value): ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?p=<?= $value ?>"><?= $value ?></a>
                        </li>
                    <?php endforeach ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?p=<?= $paginate + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </footer>
        </div>
        <!-- /.container -->

        <script type="text/javascript" src="public/assets/js/jquery.js"></script>
        <script type="text/javascript" src="public/assets/js/popper.js"></script>
        <script type="text/javascript" src="public/assets/js/bootstrap.min.js"></script>
    </body>
</html>