<!DOCTYPE html>
<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/contact_us_style.css">
    <title>İletişim</title>
</head>

<body>

    <?php
    $path = __FILE__;
    $file_name = pathinfo($path, PATHINFO_FILENAME);
    require "db.class.php";
    ?>
    <?php include "header.php" ?>

    <div class="container">
        <form>
            <h1>İletişim Formu</h1>
            <input type="text" id="firstName" placeholder="İsim" required>
            <input type="text" id="lastName" placeholder="Soyisim" required>
            <input type="email" id="email" placeholder="Email" required>
            <input type="text" id="mobile" placeholder="Telefon" required>
            <h4>Mesajınızı Buraya Giriniz...</h4>
            <textarea required></textarea>
            <input type="submit" value="Gönder" id="button">
        </form>
    </div>

    <?php include "footer.php" ?>

</body>

</html>