<!DOCTYPE html>
<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add_book_style.css">
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.min.css">

    <title>Document</title>


</head>

<body>
    <?php

    require "db.class.php";

    session_start();

    $path = __FILE__;
    $file_name = pathinfo($path, PATHINFO_FILENAME);

    $image_error_msg = "";
    $name_error_msg = "";
    $lastname_error_msg = "";
    $email_error_msg = "";
    $password_error_msg = "";
    $telno_error_msg = "";
    $address_error_msg = "";
    $birthday_error_msg = "";
    $gender_error_msg = "";
    $db_message = "";
    $message_class = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

        $picture = $_FILES["picture"];
        $title = $_POST["title"];

        $isbn = $_POST["isbn"];
        $publication_date = $_POST["publication_date"];
        $size = $_POST["size"];
        $stock = $_POST["stock"];
        $price = $_POST["price"];
        $authorid = $_POST["authorid"];
        $categoryid = $_POST["categoryid"];
        $language = $_POST["language"];
        $page = $_POST["page"];



        /* if ($image["error"] == 4) {

            $image_error_msg = "Lütfen kullanıcı fotoğrafı seçiniz.";
        }
        if (empty($name)) {
            $name_error_msg = "İsim alanı boş bırakılamaz.";
        }

        if (empty($lastname)) {
            $lastname_error_msg = "Soyisim alanı boş bırakılamaz.";
        }

        if (empty($email)) {
            $email_error_msg = "Email alanı boş bırakılamaz.";
        }

        if (empty($password)) {
            $password_error_msg = "Şifre alanı boş bırakılamaz.";
        }

        if (empty($telno)) {
            $telno_error_msg = "Telefon Numarası alanı boş bırakılamaz.";
        }

        if (empty($address)) {
            $address_error_msg = "Adres alanı boş bırakılamaz.";
        }

        if (empty($birthday)) {
            $birthday_error_msg = "Doğum tarihi alanı boş bırakılamaz.";
        }
        if (empty($gender)) {
            $gender_error_msg = "Cinsiyet alanı boş bırakılamaz.";
        }
*/
        $db = new Database();

        $image_path = "books_images/" . time() . "_" . $picture["name"];

        if (move_uploaded_file($picture["tmp_name"], $image_path)) {
            $add = $db->Insert(
                'INSERT INTO books SET
        BookTitle=?,
        BookPicture=?,
        BookISBN=?,
        BookPublicationDate=?,
        BookSize=?,
        BookStock=?,
        BookPrice=?,
        BookAuthorId=?,
        BookCategoryId=?,
        BookLanguage=?,
        BookPage=?
        ',
                array($title, $image_path, $isbn, $publication_date, $size, $stock, $price, $authorid, $categoryid, $language, $page)
            );

            if ($add) {

                $db_message = "Yeni kitap başarıyla eklendi.";
                $message_class = "active";
            } else {
                $db_message = "Kayıt esnasında bir hata oluştu.";
                $message_class = "";
            }
        } else {
        }
    } else {
    }



    ?>

    <?php include "header.php" ?>

    <div class="container">


        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
            <h1>Yeni Kitap Ekle</h1>


            <div class="img-container">
                <figure class="image-container">
                    <img id="chosen-image">
                    <figcaption id="file-name"></figcaption>
                </figure>

                <input name="picture" type="file" id="upload-button" accept="image/*">
                <label for="upload-button">
                    <i class="fas fa-upload"></i> &nbsp; Kitap Resmi Seçiniz
                </label>
            </div>




            <div class="input_container">
                <i class="fa-solid fa-book"></i>
                <input type="text" name="title" placeholder="Kitap İsmi" autocomplete="off" class="form_input">

            </div>


            <div class="input_container">
                <i class="fa-solid fa-barcode"></i>
                <input type="text" name="isbn" placeholder="ISBN" autocomplete="off" class="form_input">

            </div>


            <div class="input_container">
                <i class="fa-solid fa-book-open"></i>
                <input type="number" name="page" placeholder="Sayfa Sayısı" autocomplete="off" class="form_input">

            </div>

            <div class="input_container">
                <i class="fa-solid fa-maximize"></i>
                <input type="text" name="size" placeholder="Boyut-En/Boy" autocomplete="off" class="form_input">

            </div>


            <div class="input_container">
                <i class="fa-solid fa-layer-group"></i>
                <input type="text" name="stock" placeholder="Stok" autocomplete="off" class="form_input">

            </div>


            <div class="input_container">
                <i class="fa-solid fa-tag"></i>
                <input type="text" name="price" placeholder="Fiyat" autocomplete="off" class="form_input">

            </div>

            <div class="input_container date">
                <h4>İlk Yayınlanma Tarihi</h4>
                <input type="date" name="publication_date" placeholder="İlk Yayın" class="form_input">
                <span class="err_msg"><?php echo $birthday_error_msg; ?></span>
            </div>

            <div class="input_container select">
                <i class="fa-solid fa-language"></i>
                <input type="text" name="language" placeholder="Dil" autocomplete="off" class="form_input">

            </div>


            <div class="input_container select">
                <i class="fa-solid fa-layer-group"></i>
                <select name="categoryid">

                    <?php

                    $db = new Database();

                    $categories = $db->getRows("SELECT * FROM category");

                    foreach ($categories as $category) {


                    ?>


                        <option value="<?php echo $category->CategoryID; ?>"><?php echo $category->CategoryName ?></option>




                    <?php
                    }
                    ?>

                </select>




            </div>


            <div class="input_container select">
                <i class="fa-solid fa-file-pen"></i>
                <select name="authorid">

                    <?php

                    $db = new Database();

                    $authors = $db->getRows("SELECT * FROM authors");

                    foreach ($authors as $author) {


                    ?>


                        <option value="<?php echo $author->AuthorID; ?>"><?php echo $author->AuthorName . " " . $author->AuthorLastname; ?></option>




                    <?php
                    }
                    ?>

                </select>




            </div>







            <input type="submit" name="submit" value="Kitap Ekle" class="submit-btn">

        </form>

        <div class="db-message <?php echo $message_class; ?>">
            <?php echo $db_message; ?>
        </div>
    </div>

    <?php include "footer.php" ?>

    <script>
        /*img_input = document.querySelector("#image-input");

        img_input.onchange = function(e) {
            if (e.target.files.length > 0) {
                src = URL.createObjectURL(e.target.files[0]);
                image = document.querySelector(".image-container img");
                image.src = src;

            }
        }*/

        let uploadButton = document.getElementById("upload-button");
        let chosenImage = document.getElementById("chosen-image");
        let fileName = document.getElementById("file-name");

        uploadButton.onchange = () => {
            let reader = new FileReader();
            reader.readAsDataURL(uploadButton.files[0]);
            reader.onload = () => {
                chosenImage.setAttribute("src", reader.result);
            }
            fileName.textContent = uploadButton.files[0].name;
        }
    </script>
</body>

</html>