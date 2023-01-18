<!DOCTYPE html>
<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sign_up_style.css">
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.min.css">

    <title>Kaydol</title>


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
    $db_message="";
    $message_class="";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

        $image = $_FILES["image"];
        $name = $_POST["name"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $telno = $_POST["telno"];
        $address = $_POST["address"];
        $birthday = $_POST["birthday"];
        $gender = $_POST["gender"];
        $addtime = time();

       

        if ($image["error"] == 4) {

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

        $db = new Database();
        
        $image_path = "member_pictures/".$addtime."_".$image["name"];
        
        move_uploaded_file($image["tmp_name"],$image_path);


        $add = $db->Insert('INSERT INTO members SET
        MemberName=?,
        MemberLastname=?,
        MemberEmail=?,
        MemberPassword=?,
        MemberTelno=?,
        MemberAddress=?,
        MemberBirthday=?,
        MemberGender=?,
        MemberAddtime=?,
        MemberPicture=?
        ',array($name,$lastname,$email,md5($password),$telno,$address,$birthday,$gender,time(),$image_path)
        );

        if($add){

            $db_message="Yeni kayıt başarıyla oluşturuldu. Ana sayfaya yönlendiriliyorsunuz.";
            $message_class="active";

            $_SESSION["member"]=array(
                "name"=>$name,
                "lastname"=>$lastname,
                "email"=>$email,
                "password"=>$password,
                "telno"=>$telno,
                "address"=>$address,
                "bithday"=>$birthday,
                "gender"=>$gender,
                "addtime"=>$addtime,
                "memberpicture"=>$image_path
            );

            header("Refresh:8;url=index.php");

        }else{
            $db_message="Kayıt esnasında bir hata oluştu.";
            $message_class="";
        }




    } else {
    }



    ?>

    <?php include "header.php" ?>

    <div class="container">


        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
            <h1>Yeni Kayıt</h1>

            <div class="wrapper">
                <div class="image-container">
                    <i class="fa-regular fa-user"></i>
                    <img src="">

                </div>
                <label for="image-input" class="camera-icon">
                    <i class="fa-solid fa-camera"></i>
                </label>

                <input name="image" type="file" id="image-input" accept="image/*" hidden>


            </div>
            <span class="err_msg"><?php echo $image_error_msg; ?></span>

            <div class="input_container">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="name" placeholder="İsim" autocomplete="off" class="form_input">
                <span class="err_msg"><?php echo $name_error_msg; ?></span>
            </div>


            <div class="input_container">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="lastname" placeholder="Soyisim" autocomplete="off" class="form_input">
                <span class="err_msg"><?php echo $lastname_error_msg; ?></span>
            </div>


            <div class="input_container">
                <i class="fa-solid fa-envelope"></i>
                <input type="text" name="email" placeholder="E-mail" autocomplete="off" class="form_input">
                <span class="err_msg"><?php echo $email_error_msg; ?></span>
            </div>

            <div class="input_container">
                <i class="fa-solid fa-key"></i>
                <input type="password" name="password" placeholder="Şifre" autocomplete="off" class="form_input">
                <span class="err_msg"><?php echo $password_error_msg; ?></span>
            </div>


            <div class="input_container">
                <i class="fa-solid fa-phone"></i>
                <input type="text" name="telno" placeholder="Telno" autocomplete="off" class="form_input">
                <span class="err_msg"><?php echo $telno_error_msg; ?></span>
            </div>


            <div class="input_container address">

                <i class="fa-solid fa-map"></i>
                <h4>Adres</h4>

                <textarea id="address" name="address"></textarea>
                <span class="err_msg"><?php echo $address_error_msg; ?></span>
            </div>


            <div class="input_container date">
                <h4>Doğum Tarihi</h4>
                <input type="date" name="birthday" placeholder="Şifre" class="form_input">
                <span class="err_msg"><?php echo $birthday_error_msg; ?></span>
            </div>


            <div class="input_container radio">
                <h4>Cinsiyet</h4>
                <div>
                    <input value="e" type="radio" name="gender"> <span>Erkek</span>
                    <input value="k" type="radio" name="gender"> <span>Kadın</span>
                </div>
                <span class="err_msg"><?php echo $gender_error_msg; ?></span>

            </div>



            <input type="submit" name="submit" value="Gönder" class="submit-btn">

        </form>

        <div class="db-message <?php echo $message_class; ?>">
            <?php echo $db_message; ?>
        </div>
    </div>

    <?php include "footer.php" ?>

    <script>
        img_input = document.querySelector("#image-input");

        img_input.onchange = function(e) {
            if (e.target.files.length > 0) {
                src = URL.createObjectURL(e.target.files[0]);
                image = document.querySelector(".image-container img");
                image.src = src;

            }
        }
    </script>
</body>

</html>