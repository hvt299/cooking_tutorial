<?php
    session_start();
    require("model/connect_db.php");
    require("model/menu_db.php");
    require("model/course_db.php");
    // require("model/rating_db.php");
    $menu_list = get_menu();
    $course_list = get_course();
    // $rating_list = get_rating();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooking Tutorial</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/swiper@11.0.4/swiper-bundle.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/73d99ea241.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Phần header (menu) -->
    <?php include("view/header.php"); ?>
    <main>
        <section id="home">
            <h1>HỌC NẤU ĂN GIA ĐÌNH</h1>
            <p>
                Dạy nấu ăn gia đình chuyên nghiệp với các khóa học bếp gia đình độc đáo<br> 
                như bữa sáng thông minh, món ngon đãi tiệc, vào bếp cuối tuần...
            </p>
            <form class="form-inline" action="#">
                <input class="form-control mr-sm-2 mb-3" type="text" placeholder="Tìm khóa học bạn đang quan tâm" size="50px">
                <button class="btn btn-warning" type="submit" style="width: 100%">
                    <i class="fa-solid fa-magnifying-glass fa-beat-fade"></i>
                </button>
            </form>
        </section>

        <section class="mb-3">
            <div class="container py-5">
                <h2 class="text-center"><i class="fa-solid fa-layer-group" style="font-size: 36px;"></i> CÁC KHÓA HỌC CỦA CHÚNG TÔI</h2>
                <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
                    <?php foreach ($course_list as $course): ?>
                        <form action="course_info.php" method="GET">
                            <input type="hidden" name="course_id" value="<?php echo $course['IDKH']; ?>">
                            <div class="col h-100">
                                <div class="card h-100">
                                    <img src="<?php echo $course['HinhAnhKH']; ?>" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <a href="course_info.php?course_id=<?php echo $course['IDKH']; ?>"><h5 class="card-title"><?php echo $course['TenKH']; ?></h5></a>
                                        <!-- <p class="card-text">
                                            <?php
                                                // $avg_star_rating = get_avg_star_rating_by_course_id($course['IDKH']);
                                                // if (!empty($avg_star_rating)) {
                                                //     foreach ($avg_star_rating as $avg){
                                                //         $avg_star_rating = $avg['avg_star_rating'];
                                                //     }
                                                //     $avg_star_rating = round($avg_star_rating);
                                                // }else {
                                                //     $avg_star_rating = 0;
                                                // }
                                            ?>
                                            <?php //for ($i = 1; $i <= $avg_star_rating; $i++): ?>
                                            <i class="fa-solid fa-star"></i>
                                            <?php //endfor; ?>
                                            <?php //for ($i = 1; $i <= 5 - $avg_star_rating; $i++): ?>
                                            <i class="fa-regular fa-star"></i>
                                            <?php //endfor; ?>
                                        </p> -->
                                    </div>
                                    <div class="d-flex justify-content-around mb-4">
                                        <h4 class="price"><?php echo number_format($course['GiaHienTaiKH'],0,",",".")."<ins>đ</ins>"; ?></h4>
                                        <del><?php echo number_format($course['GiaGocKH'],0,",",".")."<ins>đ</ins>"; ?></del>
                                        <button class="btn btn-primary" type="submit">Khám phá ngay</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="mb-3">
            <div class="py-5 f5f6fa-bg-color">
                <h2 class="text-center"><i class="fa-solid fa-brain" style="font-size: 36px;"></i> NHỮNG VẤN ĐỀ GẶP PHẢI KHI TỰ NẤU ĂN</h2>
                <div class="row d-flex justify-content-center text-center py-5">
                    <div class="col-lg-2 col-sm-6">
                        <img src="images/ky_nang_nau_an.jpg" class="img-item" alt="">
                        <p class="card-text">Nếu bạn không có kinh nghiệm hoặc không biết cách nấu ăn, bạn có thể gặp khó khăn trong việc thực hiện các công thức và kỹ thuật nấu ăn cơ bản. Điều này có thể dẫn đến món ăn không ngon, chưa chín hoặc không đạt được kết quả như mong đợi.</p>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <img src="images/nguyen_lieu_nau_an.jpg" class="img-item" alt="">
                        <p class="card-text">Việc sử dụng các nguyên liệu không đúng cách hoặc không hiểu rõ về chúng có thể ảnh hưởng đến kết quả cuối cùng của món ăn. Đôi khi, sự thay thế nguyên liệu cũng có thể ảnh hưởng đến hương vị và cấu trúc của món ăn.</p>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <img src="images/thoi_gian_nau_an.jpg" class="img-item" alt="">
                        <p class="card-text">Nấu ăn đòi hỏi quản lý thời gian tốt. Nếu bạn không sắp xếp thời gian một cách hợp lý, có thể dẫn đến việc thực hiện nấu ăn không đúng lịch trình, món ăn không kịp thời hoặc bị cháy, chín quá lâu.</p>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <img src="images/cong_cu_nau_an.jpg" class="img-item" alt="">
                        <p class="card-text">Nếu bạn không có đủ thiết bị nấu ăn hoặc không gian để thực hiện các công thức phức tạp, bạn có thể gặp khó khăn trong việc thực hiện các bước nấu ăn. Điều này có thể làm giảm hiệu quả và sự thoải mái khi nấu ăn.</p>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <img src="images/cong_thuc_mon_an.jpg" class="img-item" alt="">
                        <p class="card-text">Khi tự nấu ăn, bạn phải quyết định công thức và kế hoạch món ăn. Điều này đòi hỏi khả năng lựa chọn và lập kế hoạch, và nếu không có ý tưởng rõ ràng, có thể gây khó khăn trong quá trình nấu ăn.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- <section class="mb-3">
            <div class="py-5">
                <h2 class="text-center"><i class="fa-solid fa-quote-left" style="font-size: 36px;"></i> CẢM NHẬN CỦA HỌC VIÊN</h2>
                <div class="wrapper">
                    <div class="slide-container">
                        <div class="slide-content swiper mySwiper pb-1">
                            <div class="card-wrapper swiper-wrapper">
                                <?php foreach ($rating_list as $rating): ?>
                                    <div class="card card-rating swiper-slide">
                                        <div class="image-content">
                                            <span class="overlay">

                                            </span>
                                            <div class="card-image">
                                                <img src="images/lap-trinh-vien.png" alt="" class="card-img">
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <h2 class="name">
                                                <?php
                                                    echo $rating['TenHV'];
                                                    echo "<br>";
                                                    echo $rating['TenKH'];
                                                ?>
                                            </h2>
                                            <p class="description">
                                                <?php for ($i = 1; $i <= $rating['SaoDG']; $i++): ?>
                                                    <i class="fa-solid fa-star"></i>
                                                <?php endfor; ?>
                                                <?php for ($i = 1; $i <= 5 - $rating['SaoDG']; $i++): ?>
                                                    <i class="fa-regular fa-star"></i>
                                                <?php endfor; ?>
                                                <br>
                                                <?php echo $rating['NoiDungDG']; ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="swiper-button-next swiper-navBtn"></div> -->
                    <!-- <div class="swiper-button-prev swiper-navBtn"></div> -->
                    <!-- <div class="swiper-pagination"></div> -->
                <!-- </div>
            </div>
        </section> -->
        
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11.0.4/swiper-bundle.min.js"></script>
    <script>
        // Initialize Swiper
        var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        loop:true,
        centerSlide:'true',
        fade:'true',
        grabCursor:'true',
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets:true,
        },
        navigation:{
            nextEl:".swiper-button-next",
            prevEl:".swiper-button-prev",
        },
        breakpoints:{
            0:{
                slidesPerView:1,
            },
            520:{
                slidesPerView:2,
            },
            950:{
                slidesPerView:3,
            },
        },
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>