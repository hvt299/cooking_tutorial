<?php
    session_start();
    require("model/connect_db.php");
    require("model/menu_db.php");
    $menu_list = get_menu();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Về chúng tôi | Cooking Tutorial</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/73d99ea241.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Phần header (menu) -->
    <?php include("view/header.php"); ?>
    <main>
        <section class="mb-3">
            <div class="container py-5">
                <div class="title">
                    <h1><i class="fa-solid fa-code" style="font-size: 36px;"></i> Đội ngũ phát triển</h1>
                </div>
                <div class="sub-container">
                    <div class="teams">
                        <img src="images/lap-trinh-vien.png" alt="">
                        <div class="name">Hứa Viết Thái</div>
                        <div class="role">Developer</div>
                        <div class="about">
                            22SE1 - VKU<br>
                            <i class="fa-solid fa-location-dot"></i> Quảng Nam, Việt Nam<br>
                        </div>
                        <div class="social-links">
                            <a href="" class="card-title"><i class="fa-brands fa-facebook" style="position:unset;transform:none;"></i></a>
                            <a href="" class="card-title"><i class="fa-brands fa-instagram" style="position:unset;transform:none;"></i></a>
                            <a href="" class="card-title"><i class="fa-brands fa-twitter" style="position:unset;transform:none;"></i></a>
                            <a href="" class="card-title"><i class="fa-brands fa-github" style="position:unset;transform:none;"></i></a>
                        </div>
                    </div>

                    <div class="teams">
                        <img src="images/lap-trinh-vien.png" alt="">
                        <div class="name">Nguyễn Duy Phong</div>
                        <div class="role">Developer</div>
                        <div class="about">
                            22MC - VKU<br>
                            <i class="fa-solid fa-location-dot"></i> Nghệ An, Việt Nam<br>
                        </div>
                        <div class="social-links">
                            <a href="" class="card-title"><i class="fa-brands fa-facebook" style="position:unset;transform:none;"></i></a>
                            <a href="" class="card-title"><i class="fa-brands fa-instagram" style="position:unset;transform:none;"></i></a>
                            <a href="" class="card-title"><i class="fa-brands fa-twitter" style="position:unset;transform:none;"></i></a>
                            <a href="" class="card-title"><i class="fa-brands fa-github" style="position:unset;transform:none;"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Phần footer -->
        <?php include("view/footer.php"); ?>
    </main>

    <script>
        const toggleBtn = document.querySelector('.toggle_btn');
        const toggleBtnIcon = document.querySelector('.toggle_btn i');
        const dropDownMenu = document.querySelector('.dropdown_menu');

        toggleBtn.onclick = function() {
            dropDownMenu.classList.toggle('open');
            const isOpen = dropDownMenu.classList.contains('open');
            toggleBtnIcon.classList = isOpen ?
                'fa-solid fa-xmark' :
                'fa-solid fa-bars'
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>