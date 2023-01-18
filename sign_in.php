<!DOCTYPE html>
<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sign_in_style.css">
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.min.css">

    <title>Document</title>


</head>

<body>

    <?php
    $path = __FILE__;
    $file_name = pathinfo($path, PATHINFO_FILENAME);
    require "db.class.php";
    session_start();


    $signin_error_msg = "";
    $message_class = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

        $email = $_POST["email"];
        $password = $_POST["password"];

        if (empty($email) || empty($password)) {
            $signin_error_msg = "Lütfen gerekli alanları boş bırakmayın.";
        } else {
            $get = new Database();
            $get = $get->getRow('SELECT * FROM admins WHERE AdminEmail=? and AdminPassword=?', array($email, $password));
            if ($get) {
                $db_message = "Başarıyla admin girişi yapıldı. Ana sayfaya yönlendiriliyorsunuz.";
                $message_class = "active";

                $_SESSION["admin"] = array(
                    "name" => $get->AdminName,
                    "lastname" => $get->AdminLastname,
                    "email" => $get->AdminEmail,
                    "password" => $password,
                    /*"telno" => $get->MemberTelno,
                    "address" => $get->MemberAddress,
                    "bithday" => $get->MemberBirthday,
                    "gender" => $get->MemberGender,
                    "addtime" => $get->MemberAddtime,
                    "memberpicture" => $get->MemberPicture*/
                );
                header("Refresh:3;url=index.php");
            } else {
                $get = new Database();
                $get = $get->getRow('SELECT * FROM members WHERE MemberEmail=? and MemberPassword=?', array($email, md5($password)));

                if ($get) {

                    $db_message = "Başarıyla üye girişi yapıldı. Ana sayfaya yönlendiriliyorsunuz.";
                    $message_class = "active";


                    $_SESSION["member"] = array(
                        "name" => $get->MemberName,
                        "lastname" => $get->MemberLastname,
                        "email" => $get->MemberEmail,
                        "password" => $password,
                        "telno" => $get->MemberTelno,
                        "address" => $get->MemberAddress,
                        "bithday" => $get->MemberBirthday,
                        "gender" => $get->MemberGender,
                        "addtime" => $get->MemberAddtime,
                        "memberpicture" => $get->MemberPicture
                    );

                    header("Refresh:3;url=index.php");
                } else {
                    $signin_error_msg = "E-posta veya şifre hatalı.";
                    $db_message = "";
                    $message_class = "";
                }
            }
        }
    } else {
    }



    ?>

    <?php include "header.php" ?>

    <div class="container">

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <h1>Giriş Yap</h1>

            <div class="input_container">
                <i class="fa-solid fa-envelope"></i>
                <input type="text" name="email" placeholder="E-mail" autocomplete="off" class="form_input">

            </div>

            <div class="input_container">
                <i class="fa-solid fa-key"></i>
                <input type="password" name="password" placeholder="Şifre" autocomplete="off" class="form_input">

            </div>

            <span class="err_msg"><?php echo $signin_error_msg; ?></span>

            <div class="links">
                <a href="sign_up.php">Üye ol</a>
                <a href="#">Şifremi unuttum</a>

            </div>



            <input type="submit" name="submit" value="Giriş Yap" class="submit-btn">


        </form>

        <div class="db-message <?php echo $message_class; ?>">
            <?php echo $db_message; ?>
        </div>

    </div>

    <?php include "footer.php" ?>


</body>

</html>