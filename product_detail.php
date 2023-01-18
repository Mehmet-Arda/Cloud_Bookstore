<!DOCTYPE html>
<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/product_detail_style.css">
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.min.css">

    <title>Kitap İsmi</title>


</head>

<body>






    <?php
    require "db.class.php";

    $bookget = new Database();



    $bookID = $_GET["BookId"];



    $book = $bookget->getRow('SELECT * FROM books 
    INNER JOIN category ON books.BookCategoryId=category.CategoryID 
    INNER JOIN authors ON books.BookAuthorId=authors.AuthorID
     WHERE BookId=?', array($bookID));

    ?>
    <?php include "header.php" ?>

    <div class="container">

        <div class="product-detail">

            <div class="col">
                <img src="<?php echo $book->BookPicture; ?>">
            </div>

            <div class="col">
                <h3> <?php echo $book->BookTitle; ?></h3>

                <div class="yy">
                    <div>
                        <h4>Yazar:</h4> <span> <?php echo $book->AuthorName . " " . $book->AuthorLastname; ?></span>
                    </div>
                    <div>
                        <h4>Yayınevi:</h4> <span> Yıldız Kitapçılık</span>
                    </div>

                </div>

                <h2><?php echo $book->BookPrice; ?>₺</h2>

                <form method="POST">

                    <select name="product-count">
                        <option selected value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>

                    <button type="submit" value="<?php echo $bookID; ?>" name="submit"><i class="fa-solid fa-cart-arrow-down"></i>Sepete Ekle</button>

                </form>


                <h4 class="delivery-time">Standart Teslimat: <span><?php $mydate = date_create();
                                                                    date_modify($mydate, "+3 days");
                                                                    echo date_format($mydate, "d-M");
                                                                    date_modify($mydate, "+7 days");
                                                                    echo "  " . date_format($mydate, "d-M"); ?></span> </h4>

                <div class="favor">
                    <button name="favorite"><i class="fa-solid fa-bookmark"></i>Favorilerime Ekle</button>
                </div>


                <div class="details">
                    <div>
                        <span>Sayfa Sayısı : </span>
                        <h4> <?php echo $book->BookPage; ?></h4>
                    </div>
                    <div>
                        <span>İlk Baskı Yılı : </span>
                        <h4> <?php echo $book->BookPublicationDate; ?></h4>
                    </div>
                </div>
                <div class="details">
                    <div>
                        <span>Dil : </span>
                        <h4> <?php echo $book->BookLanguage; ?></h4>
                    </div>
                    <div>
                        <span>Ebat : </span>
                        <h4> <?php echo $book->BookSize; ?></h4>
                    </div>
                </div>

            </div>





        </div>


    </div>

    <?php include "footer.php" ?>

</body>

</html>