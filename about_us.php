<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="css/about_us_style.css">
</head>

<body>

    <?php
    $path = __FILE__;
    $file_name = pathinfo($path, PATHINFO_FILENAME);
    require "db.class.php";
    ?>

    <?php include "header.php" ?>

    <div class="container">
        <div class="about-section">
            <div class="inner-container">
                <h1>Hakkımızda</h1>
                <p class="text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus velit ducimus, enim inventore earum, eligendi nostrum pariatur necessitatibus eius dicta a voluptates sit deleniti autem error eos totam nisi neque voluptates sit deleniti autem error eos totam nisi neque.
                </p>
                <div class="skills">
                    <span>Lorem ipsum dolor</span>
                    <span>Lorem ipsum</span>
                    <span>Lorem ipsum dolor</span>
                </div>
            </div>
        </div>
    </div>


    <?php include "footer.php" ?>
</body>

</html>