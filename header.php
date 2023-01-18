<!DOCTYPE html>
<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header_style.css">
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.min.css">


</head>

<body>


    <?php



    $categoryget = new Database();

    $categories = $categoryget->getRows('SELECT * FROM category ORDER BY CategoryID');

    ?>





    <header>

        <ul>
            <li class="nav_li_logo"><a href="index.php" class="logo"><img src="images/open-book.png"> Yıldız Kitapçı</a></li>


            <div class="nav_li_right">
                <li class="nav_li <?php echo $file_name == "index" ? 'active' : "" ?> "><a class="nav_li_a" href="index.php">Anasayfa</a></li>
                <li class="nav_li <?php echo $file_name == "about_us" ? 'active' : "" ?>"><a class="nav_li_a" href="about_us.php">Hakkımızda</a></li>

                <li class="nav_li <?php echo $file_name == "books" ? 'active' : "" ?>"><a class="nav_li_a" href="books.php?CategoryID=0">Ürünler</a>
                    <div class="nav_li_a_sub">
                        <ul>
                            <li>Yazarlar</li>
                            <li>Yayınevleri</li>
                            <li>Kategoriler
                                <ul class="nav_li_a_sub2">

                                    <?php

                                    foreach ($categories as $category) {


                                    ?>

                                        <a href="books.php?CategoryID=<?php echo $category->CategoryID; ?>">
                                            <li><?php echo $category->CategoryName; ?></li>
                                        </a>



                                    <?php
                                    }
                                    ?>

                                </ul>
                            </li>
                            <li>Ödüllü Kitaplar</li>
                            <li>Yeni Çıkanlar</li>
                            <li>E-kitaplar</li>
                        </ul>
                    </div>

                </li>

                <li class="nav_li <?php echo $file_name == "team" ? 'active' : "" ?>"><a class="nav_li_a" href="#">Takım</a></li>
                <li class="nav_li <?php echo $file_name == "contact_us" ? 'active' : "" ?>"><a class="nav_li_a" href="contact_us.php">İletişim</a></li>
                <li class="nav_li_profile">

                    <div class="profile_off_div">
                        <i id="profile_off_icon" class="fa-solid fa-user"></i>
                    </div>



                    <div class="profile-menu">


                        <h3>
                            <?php if(!empty($_SESSION["member"])){echo "Hoşgeldiniz";}elseif(!empty($_SESSION["admin"])){echo "Hoşgeldiniz";}else{echo "Ziyaretçi";} ?><br>
                            <span>
                                <?php 
                                if(!empty($_SESSION["member"])){echo  $_SESSION["member"]["name"] . " " . $_SESSION["member"]["lastname"];
                                }elseif(!empty($_SESSION["admin"])){
                                    echo  $_SESSION["admin"]["name"] . " " . $_SESSION["admin"]["lastname"];
                                }else{echo  "Lütfen giriş yapın ya da kaydolun";
                                } 
                                ?>
                            </span>
                        </h3>
                        <ul>
                            <?php
                            if (!empty($_SESSION["admin"])) {
                                echo '<li><img src="images/admin.png"><a href="admin_panel.php">Admin Panelim</a></li>
                                    <li><img src="images/user.png"><a href="#">Profilim</a></li>
                                    <li><img src="images/edit.png"><a href="#">Profili Düzenle</a></li>
                                    
                                    <li><img src="images/envelope.png"><a href="#">Gelen Kutusu</a></li>
                                    <li><img src="images/settings.png"><a href="#">Ayarlar</a></li>
                                    <li><img src="images/question.png"><a href="#">Yardım</a></li>
                                    <li><img src="images/log-out.png"><a href="exit.php">Çıkış Yap</a></li>';
                            }
                            elseif (empty($_SESSION["member"])) {
                                echo '<li><img src="images/sign-in.png"><a href="sign_in.php">Giriş Yap</a></li>
                                    <li><img src="images/sign-up.png"><a href="sign_up.php">Kaydol</a></li>';
                            } else {
                                echo '<li><img src="images/user.png"><a href="#">Profilim</a></li>
                                    <li><img src="images/edit.png"><a href="#">Profili Düzenle</a></li>
                                    
                                    <li><img src="images/envelope.png"><a href="#">Gelen Kutusu</a></li>
                                    <li><img src="images/settings.png"><a href="#">Ayarlar</a></li>
                                    <li><img src="images/question.png"><a href="#">Yardım</a></li>
                                    <li><img src="images/log-out.png"><a href="exit.php">Çıkış Yap</a></li>';
                            }
                            ?>

                        </ul>
                    </div>

                </li>
                <li class="nav_li_basket">
                    <div class="basket">
                        <i id="basket" class="fa-solid fa-basket-shopping">

                        </i>
                    </div>
                </li>

            </div>

        </ul>

    </header>

    <script>
        window.addEventListener("scroll", function() {
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        })

        const profile_menu = document.querySelector(".profile-menu");
        const profile_off_div = document.querySelector(".profile_off_div");



        profile_off_div.onclick = function() {
            profile_off_div.classList.toggle("active");
            profile_menu.classList.toggle("active");
        }
    </script>

</body>

</html>