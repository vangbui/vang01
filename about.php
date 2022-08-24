<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>

     <!-- font awesome cdn link  -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <?php include 'header.php';?>


    <section class="about">
        <div class="row">

            <div class="box">
            <img src="images/about-img-1.png" alt="">
                <h3>Tại Sao Chọn Chúng Tôi ?</h3>
                <p>Ra đời từ mong mỏi đóng góp những sản phẩm, dịch vụ chất lượng nhất, tốt nhất cho người Việt Nam. 
            Với tiêu chí “công nghệ cao - sản phẩm sạch - dịch vụ tối ưu”, luôn hướng đến việc cung cấp 
            những sản phẩm đạt chất lượng cao cho thị trường.</p>
                <a href="contact.php" class="btn">Liên Hệ Chúng Tôi</a>
            </div>

            <div class="box">
            <img src="images/about-img-2.png" alt="">
                <h3>Sản Phẩm Của Chúng Tôi </h3>
                <p>Mỗi sản phẩm của Gaomi là một sự sáng tạo và vận dụng các công nghệ tối ưu nhất, thân thiện nhất. Chất lượng thực sự đẳng 
            cấp là mục tiêu dài hạn của Gaomi.
            Về mặt thương hiệu, hướng phát triển của Gaomi sẽ là thương hiệu mang giá trị về cảm xúc, 
            thương hiệu chất lượng hàng đầu trong ngành thực phẩm và tiêu dùng</p>
                <a href="shop.php" class="btn">Cửa Hàng Của Chúng Tôi</a>
            </div>
        </div>
    </section>

    <section class="reviews">
        <h1 class="title"></h1>
        <div class="box-container">

            <div class="box">
            <img src="images/pic-1.png" alt="">
                <p>Các loại trái cây tươi ngon, chất lượng, nguồn gốc xuất xứ rõ ràng, 
            giá cả hợp lý. Tôi rất thích nơi này.</p>
                    <div class="stars">
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star-half-alt"></i>

                    </div>
                    <h3>john deo</h3>
            </div>

            <div class="box">
            <img src="images/pic-2.png" alt="">
                <p>Rau củ về luôn tươi ngon, các loại hoa quả luôn cập nhật hàng ngày.</p>
                    <div class="stars">
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star-half-alt"></i>

                    </div>
                    <h3>Anna</h3>
            </div>

            <div class="box">
            <img src="images/pic-3.png" alt="">
                <p>Các loại hoa quả luôn được nhập về thường xuyên, đảm bảo sự tươi ngon, thơm mát phục vụ nhu 
            cầu của khách hàng. Nhân viên tư vấn nhiệt tình.</p>
                    <div class="stars">
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star-half-alt"></i>

                    </div>
                    <h3>Strain</h3>
            </div>

            <div class="box">
            <img src="images/pic-4.png" alt="">
                <p>Trái cây tại cửa hàng luôn được tôi tin dùng bởi sự tươi mới, nguyên chất, chất lượng đảm bảo, 
            hương vị thơm ngon được nhập khẩu 100% từ các nguồn hoa quả tươi nổi tiếng..</p>
                    <div class="stars">
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star-half-alt"></i>

                    </div>
                    <h3>Mian</h3>
            </div>
            <div class="box">
            <img src="images/pic-5.png" alt="">
                <p>Nguồn thực phẩm trái cây ngoại sạch cho cộng đồng và Gaomi luôn có chương trình bình ổn giá nhất sản phẩm chất lượng nhất. 
            Giá của từng loại rau củ, trái Cây luôn được công khai và niêm yết rõ ràng..</p>
                    <div class="stars">
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star-half-alt"></i>

                    </div>
                    <h3>Perter</h3>
            </div>

            <div class="box">
            <img src="images/pic-6.png" alt="">
                <p>Đảm bảo nguồn gốc sản phẩm cũng như chất lượng sản phẩm  
            nên tôi rất tin dùng khi mua sản phẩm ở Gaomi.</p>
                    <div class="stars">
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star-half-alt"></i>

                    </div>
                    <h3>Khánh Linh</h3>
            </div>

        </div>
    </section>






<?php include 'footer.php';?>

<script src="js/script.js"></script>
</body>
</html>