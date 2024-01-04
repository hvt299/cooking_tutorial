<?php
    require("model/customer_db.php");
    require("model/connect_db.php");
    require("model/rating_db.php");
    $count = 0;
    $idkhach = null;
    if (!isset($_COOKIE['idkhach'])) {
        echo "<script>alert('Vui lòng đăng nhập để đánh giá!'); location.href='login.php';</script>";
        return;
    }
    else{
        $idkhach = $_COOKIE['idkhach'];
    }
    $current_course = $_POST['course_id'];
    $course_id = $_POST['course_id'];
    $idkhach = $_COOKIE['idkhach'];
    $review_content = $_POST['review_content'];
    $star_rating = $_POST['star_rating'];
    if(has_number($idkhach, $current_course) == true){
            add_rating("", $idkhach, $course_id, $review_content, $star_rating);
            echo "<script>alert('Cảm ơn đánh giá của bạn!'); location.href='course_info.php?course_id=$course_id';</script>";
            // header("Location: course_info.php?course_id=$course_id");
    }
    else{
        $idrating = get_idrating_by_student_course($idkhach, $current_course);
        update_rating($idrating, $review_content, $star_rating);
        echo "<script>alert('Bạn đã chỉnh sửa đánh giá thành công!'); location.href='course_info.php?course_id=$course_id';</script>";
    }
?>
