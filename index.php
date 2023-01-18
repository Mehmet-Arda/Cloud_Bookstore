<!DOCTYPE html>
<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="#" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />


    <link rel="stylesheet" href="css/glider.min.css" />


    <title>Anasayfa</title>


</head>

<body>

    <?php
    $path = __FILE__;
    $file_name = pathinfo($path, PATHINFO_FILENAME);
    session_start();

    require "db.class.php";

    ?>


    <?php include "header.php" ?>



    <section class="banner">


        <div class="book_search_container">


            <div class="book_category_container">

                <!--<h3>Aramak istediğiniz kategoriyi giriniz:</h3>-->

                <div class="select-box">


                    <div class="options-container">
                        <div class="option">
                            <input type="radio" class="radio" id="automobiles" name="category">
                            <label for="automobiles">Korku</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="automobiles" name="category">
                            <label for="automobiles">Gerilim</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="automobiles" name="category">
                            <label for="automobiles">Polisiye-Suç</label>
                        </div>


                        <div class="option">
                            <input type="radio" class="radio" id="automobiles" name="category">
                            <label for="automobiles">Fantastik</label>
                        </div>


                        <div class="option">
                            <input type="radio" class="radio" id="automobiles" name="category">
                            <label for="automobiles">Tarih</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="automobiles" name="category">
                            <label for="automobiles">Kişisel Gelişim</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="automobiles" name="category">
                            <label for="automobiles">Sınava Hazırlık</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="automobiles" name="category">
                            <label for="automobiles">Seç artık daha ne diyim</label>
                        </div>
                    </div>

                    <div class="selected">
                        Kitap Türü Seç
                    </div>


                </div>

            </div>


            <form action="" class="search-bar">
                <input type="text" placeholder="kitap aratın" name="search_book">
                <button type="submit"><img src="images/search.png"></button>
            </form>

        </div>



        <aside class="slider_left_aside">

        </aside>


        <section class="slider_container">


            <!-- Slider main container -->
            <div class="swiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide"><a href="#"><img src="images/ann0.png"></a></div>
                    <div class="swiper-slide"><a href="#"><img src="images/ann1.png"></a></div>
                    <div class="swiper-slide"><a href="#"><img src="images/ann2.png"></a></div>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>


            </div>

            <!--
            <aside class="slider_right_aside">

            </aside>
            -->


        </section>


        <div class="product-container">
            <?php

            $books = new Database();

            $books = $books->getRows('SELECT * FROM books LIMIT 10');

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
            ?>

        </div>







    </section>




    <section class="home-product-list">

    </section>


    <section class="p-slider">

        <h3 class="product-slider-heading">Ürünler</h3>


        <div class="slider-btns">

            <button aria-label="Previous" class="glider-prev">
                <span></span>
            </button>
            <button aria-label="Next" class="glider-next">
                <span></span>
            </button>
        </div>







        <div class="glider-contain">
            <div class="glider">

                <?php

                $booksget = new Database();

                $booksg = $booksget->getRows('SELECT * FROM books INNER JOIN category ON books.BookCategoryId=category.CategoryID ORDER BY BookId ASC LIMIT 10');

                foreach ($booksg as $book) {


                ?>



                    <div class="product-box">

                        <div class="p-img-container">
                            <div class="p-img">
                                <a href="product_detail.php?BookId=<?php echo $book->BookId; ?>">
                                    <img src="<?php echo $book->BookPicture; ?>">
                                </a>

                            </div>
                        </div>


                        <div class="p-box-text">

                            <div class="product-category">
                                <?php echo $book->CategoryName ?>
                            </div>

                            <a href="product_detail.php?BookId=<?php echo $book->BookId; ?>" class="product-title">
                                <?php echo $book->BookTitle; ?>
                            </a>

                            <div class="price-buy">
                                <span class="p-price"><?php echo $book->BookPrice; ?>₺</span>
                                <a href="#" class="buy-btn">Satın Al</a>
                            </div>

                        </div>

                    </div>



                <?php
                }
                ?>









            </div>

            <div role="tablist" class="dots"></div>
        </div>




















    </section>




    <?php include "footer.php" ?>


    <script type="text/javascript">
        const icon = document.querySelector(".icon");
        const search = document.querySelector(".search");




        const selected = document.querySelector(".selected");
        const optionsContainer = document.querySelector(".options-container");

        const optionsList = document.querySelectorAll(".option");

        selected.onclick = function() {
            optionsContainer.classList.toggle("active");

        }

        optionsList.forEach(o => {
            o.onclick = function() {
                selected.innerHTML = o.querySelector("label").innerHTML;
                optionsContainer.classList.remove("active");
            }
        })



        /*icon.onclick= function(){
            search.classList.toggle("active");
        }*/
    </script>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>



    <script>
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            autoplay: {
                delay: 20000,
                disableOnInteraction: false,

            },
            loop: true,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            responsive: [{
                // screens greater than >= 775px
                breakpoint: 1200,
                settings: {
                    // Set to `auto` and provide item width to adjust to viewport
                    slidesToShow: 4,
                    slidesToScroll: 2,

                }
            }, {
                // screens greater than >= 1024px
                breakpoint: 900,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,

                }
            }]


        });
    </script>


    <script src="glider.min.js"></script>

    <script>
        new Glider(document.querySelector('.glider'), {
            slidesToScroll: 1,
            slidesToShow: 4,
            draggable: true,
            dots: '.dots',
            arrows: {
                prev: '.glider-prev',
                next: '.glider-next'
            }
        });
    </script>

</body>

</html>