<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST["update_product"])){
    $pid        =$_POST["pid"];
    $name       = $_POST["name"];
    $name       = filter_var($name, FILTER_SANITIZE_STRING);
    $price      = $_POST["price"];
    $price      = filter_var($price, FILTER_SANITIZE_STRING);
    $category   = $_POST["category"];
    $category   = filter_var($category, FILTER_SANITIZE_STRING);
    $details    = $_POST["details"];
    $details    = filter_var($details, FILTER_SANITIZE_STRING);

    $image          = $_FILES["image"]["name"];
    $image          = filter_var($image , FILTER_SANITIZE_STRING);
    $image_size     = $_FILES["image"]["size"];
    $image_tmp_name = $_FILES["image"]["tmp_name"];
    $image_folder   = "uploaded_img/".$image;
    $old_image      =$_POST["old_image"];


    $update_product = $conn-> prepare("UPDATE products SET name = ?, category = ? , details = ?, price = ? WHERE id= ? ");
    $update_product->execute([$name, $category, $details, $price, $pid]);
    $message[]= "Cập Nhật Sản Phẩm Thành Công!";  

    if(!empty($image)){
        if($image_size > 2000000){
            $message[]= "Ảnh quá lớn!";
        }else{
            $update_image = $conn-> prepare("UPDATE products SET image = ? WHERE id = ? ");
            $update_image->execute([$image, $pid]);
            if($update_image){
                move_uploaded_file($image_tmp_name, $image_folder);
                unlink('uploaded_img/'.$old_image);
                $message[]= "Cập Nhật Ảnh Thành Công!";    

            }
             
        };
    };

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update products</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php';?>

<section class="update-product">
    <h1 class="title">cập Nhật Sản Phẩm</h1>
   

    <?php
        $update_id= $_GET["update"];
        $select_products = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $select_products->execute(["$update_id"]);
        if($select_products->rowCount() > 0){
            while($fetch_products  = $select_products->fetch(PDO::FETCH_ASSOC)){
   
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
        <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
        <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
        <input type="text" name="name" class="box" placeholder="enter product name" 
        required value="<?= $fetch_products['name']; ?>">
        <input type="number" name="price" min="0" class="box" placeholder="enter product price" 
        required value="<?= $fetch_products['price']; ?>">

        <select name="category" class="box" required>
                <option selected><?= $fetch_products['category']; ?></option>
                <option value="Rau Củ">Rau Củ</option>
                <option value="Trái Cây">Trái Cây</option>
                <option value="Thịt">Thịt</option>
                <option value="Cá">Cá</option>
        </select>
        <textarea name="details" required placeholder="enter product details" 
        class="box" cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>
        <input type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png">
        <div class="flex-btn">
        <input type="submit" value="Cập Nhật" class="btn" name="update_product">
        <a href="admin_products.php" class="option-btn">Quay Lại</a>
        </div>
       

    </form>

    <?php
        }
        }else{
            echo ' <p class="empty">Không tìm thấy sản phẩm !</p>';

        }  

    ?>

</section>
    
    <script src="js/script.js"></script>
</body>
</html>