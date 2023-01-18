<!DOCTYPE html>
<html lang="tr-TR">

<?php

use Illuminate\Support\Arr;

$path = __FILE__;
$file_name = pathinfo($path, PATHINFO_FILENAME);
session_start();

require "db.class.php";

$db = new Database();

$categoryID = $_GET["CategoryID"];

$categoryName = $db->getColumn('SELECT CategoryName FROM category WHERE CategoryID=?', array($categoryID));

$page = empty($_GET["page"]) ? 1 : $_GET["page"];

$page_limit = 6;

$start_limit = ($page * $page_limit) - $page_limit;

if ($categoryID == 0) {
    $total_record = $db->getColumn("SELECT COUNT(*) FROM books");
} else {
    $total_record = $db->getColumn('SELECT COUNT(*) FROM books WHERE BookCategoryId = ?', array($categoryID));
}


$total_page_number = ceil($total_record / $page_limit);

?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="#" type="image/x-icon">
    <link rel="stylesheet" href="css/books_style.css">

    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />


    <link rel="stylesheet" href="css/glider.min.css" />


    <title><?php echo $categoryName; ?> Kategorisindeki Kitaplar</title>


</head>

<body>



    <?php include "header.php" ?>



    <section class="banner">


        <div class="category-name">
            <?php echo $categoryName == "" ? "Tüm Ürünler" : $categoryName; ?>
        </div>

        <div class="product-container">




            <?php

            $books = new Database();

            if ($categoryID == 0) {


                $books = $books->getRows("SELECT * FROM books ORDER BY BookTitle LIMIT $start_limit,$page_limit");

                foreach ($books as $book) {


            ?>


                    <div class="product">
                        <img src="<?php echo $book->BookPicture; ?>">
                        <h3 class="product-name"><?php echo $book->BookTitle; ?></h3>
                        <h5 class="product-price"><?php echo $book->BookPrice; ?>₺</h5>

                        <div class="dwb-container">
                            <div><a href="product_detail.php?BookId=<?php echo $book->BookId; ?>"><i class="fa-solid fa-eye"></i></a></div>
                            <div><a href="#"><i class="fa-solid fa-heart"></i></a></div>
                            <div><a href="#"><i class="fa-solid fa-cart-shopping"></i></a></div>

                        </div>
                    </div>



                <?php
                }
            } else {
                $books = $books->getRows("SELECT * FROM books WHERE BookCategoryId= $categoryID LIMIT $start_limit,$page_limit");

                foreach ($books as $book) {


                ?>
                    <div class="product">
                        <img src="<?php echo $book->BookPicture; ?>">
                        <h3 class="product-name"><?php echo $book->BookTitle; ?></h3>
                        <h5 class="product-price"><?php echo $book->BookPrice; ?>₺</h5>

                        <div class="dwb-container">
                            <div><a href="product_detail.php?BookId=<?php echo $book->BookId; ?>"><i class="fa-solid fa-eye"></i></a></div>
                            <div><a href="#"><i class="fa-solid fa-heart"></i></a></div>
                            <div><a href="#"><i class="fa-solid fa-cart-shopping"></i></a></div>

                        </div>
                    </div>



            <?php
                }
            }
            ?>

        </div>

        <nav>

            <ul class="pagination">

                <?php

                if ($page == 1) {
                    echo '<li class="page-item inactive "><a class="page-link" href="javascript:void(0)">Geri</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page . '">' . $page . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page + 1 . '">' . $page + 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page + 2 . '">' . $page + 2 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page + 1 . '">İleri</a></li>';
                } elseif ($page == $total_page_number) {
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page - 1 . '">Geri</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page - 2 . '">' . $page - 2 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page - 1 . '">' . $page - 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page . '">' . $page . '</a></li>';

                    echo '<li class="page-item inactive "><a class="page-link" href="javascript:void(0)">İleri</a></li>';
                } elseif ($page == 2) {
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page - 1 . '">Geri</a></li>';

                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page - 1 . '">' . $page - 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page . '">' . $page . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page + 1 . '">' . $page + 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page + 2 . '">' . $page + 2 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page + 1 . '">İleri</a></li>';
                } elseif ($page == $total_page_number - 1) {
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page - 1 . '">Geri</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page - 2 . '">' . $page - 2 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page - 1 . '">' . $page - 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page . '">' . $page . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page + 1 . '">' . $page + 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page + 1 . '">İleri</a></li>';
                } elseif ($page == $total_page_number - 2) {
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page - 1 . '">Geri</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page - 2 . '">' . $page - 2 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page - 1 . '">' . $page - 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page . '">' . $page . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page + 1 . '">' . $page + 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page + 2 . '">' . $page + 2 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page + 1 . '">İleri</a></li>';
                } else {
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page - 1 . '">Geri</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page - 2 . '">' . $page - 2 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page - 1 . '">' . $page - 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page . '">' . $page . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page + 1 . '">' . $page + 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page + 2 . '">' . $page + 2 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="books.php?CategoryID=' . $categoryID . '&page=' . $page + 1 . '">İleri</a></li>';
                }





                ?>




            </ul>
        </nav>





    </section>






    <?php include "footer.php" ?>






</body>

</html>