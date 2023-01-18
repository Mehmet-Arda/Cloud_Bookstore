<!DOCTYPE html>
<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin_panel_style.css">
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.min.css">

    <title>Document</title>


</head>

<body>


    <?php
    $path = __FILE__;
    $file_name = pathinfo($path, PATHINFO_FILENAME);
    require "db.class.php";
    session_start();

    $db = new Database();


    $page = empty($_GET["page"]) ? 1 : $_GET["page"];

    $page_limit = 4;

    $start_limit = ($page * $page_limit) - $page_limit;


    $total_record = $db->getColumn("SELECT COUNT(*) FROM members");



    $total_page_number = ceil($total_record / $page_limit);

    ?>





    <?php include "header.php" ?>

    <div class="container">


        <h1>Siteye Kayıtlı Üyeler</h1>
        <table class="content-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fotoğraf</th>
                    <th scope="col">İsim</th>
                    <th scope="col">Soyisim</th>
                    <th scope="col">Email</th>

                    <th scope="col">Doğum Tarihi</th>
                    <th scope="col">Cinsiyet</th>
                    <th scope="col">Eklenme Tarihi</th>
                </tr>
            </thead>

            <tbody>


                <?php
                $db = new Database();
                $counter = 1;

                $members = $db->getRows("SELECT * FROM members ORDER BY MemberID LIMIT $start_limit,$page_limit");
                $counter = $start_limit+1;
                foreach ($members as $member) {

                ?>

                    <tr>
                        <td scope="row"><?php echo $counter; ?></td>
                        <td><img src="<?php echo $member->MemberPicture; ?>"></td>
                        <td><?php echo $member->MemberName; ?></td>
                        <td><?php echo $member->MemberLastname; ?></td>
                        <td><?php echo $member->MemberEmail; ?></td>
                        <td><?php echo $member->MemberBirthday; ?></td>
                        <td><?php echo $member->MemberGender == "e" ? "Erkek" : "Kadın"; ?></td>
                        <td><?php echo date("Y-m-d", $member->MemberAddtime); ?></td>
                    </tr>




                <?php
                    $counter++;
                }
                ?>

            </tbody>

        </table>

        <nav>

            <ul class="pagination">

                <?php

                if ($page == 1) {
                    echo '<li class="page-item inactive "><a class="page-link" href="javascript:void(0)">Geri</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page . '">' . $page . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page + 1 . '">' . $page + 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page + 2 . '">' . $page + 2 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page + 1 . '">İleri</a></li>';
                } elseif ($page == $total_page_number) {
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page - 1 . '">Geri</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page - 2 . '">' . $page - 2 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page - 1 . '">' . $page - 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page . '">' . $page . '</a></li>';

                    echo '<li class="page-item inactive "><a class="page-link" href="javascript:void(0)">İleri</a></li>';
                } elseif ($page == 2) {
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page - 1 . '">Geri</a></li>';

                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page - 1 . '">' . $page - 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page . '">' . $page . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page + 1 . '">' . $page + 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page + 2 . '">' . $page + 2 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page + 1 . '">İleri</a></li>';
                } elseif ($page == $total_page_number - 1) {
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page - 1 . '">Geri</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page - 2 . '">' . $page - 2 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page - 1 . '">' . $page - 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page . '">' . $page . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page + 1 . '">' . $page + 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page + 1 . '">İleri</a></li>';
                } elseif ($page == $total_page_number - 2) {
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page - 1 . '">Geri</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page - 2 . '">' . $page - 2 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page - 1 . '">' . $page - 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page . '">' . $page . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page + 1 . '">' . $page + 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page + 2 . '">' . $page + 2 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page + 1 . '">İleri</a></li>';
                } else {
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page - 1 . '">Geri</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page - 2 . '">' . $page - 2 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page - 1 . '">' . $page - 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page . '">' . $page . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page + 1 . '">' . $page + 1 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page + 2 . '">' . $page + 2 . '</a></li>';
                    echo '<li class="page-item "><a class="page-link" href="admin_panel.php?page=' . $page + 1 . '">İleri</a></li>';
                }





                ?>




            </ul>
        </nav>


        <a class="add-book" href="add_book.php"><img src="images/add_book.png">Kitap Ekle</a>

    </div>

    <?php include "footer.php" ?>


</body>

</html>