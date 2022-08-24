<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST["update_profile"])){
    $name  = $_POST["name"];
    $name  = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST["email"];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $update_profile = $conn->prepare("UPDATE users SET name=?, email=?  WHERE id=?");
    $update_profile->execute([$name, $email, $user_id]);

    $image          = $_FILES["image"]["name"];
    $image_size     = $_FILES["image"]["size"];
    $image_tmp_name = $_FILES["image"]["tmp_name"];
    $image_folder   = "uploaded_img/".$image;
    $old_image  = $_POST["old_image"];

    if(!empty($image)){
        if($image_size > 2000000){
            $message[]= "Ảnh quá lớn!";
        }else{
            $update_image = $conn->prepare("UPDATE users SET image=?  WHERE id=?");
            $update_image->execute([$image, $user_id]);
            if($update_image){
                move_uploaded_file($image_tmp_name, $image_folder);
                unlink("uploaded_img/".$old_image);
                $message[]= "Cập Nhật Ảnh Thành Công!";

            };
        };
    };

    $old_pass     = $_POST["old_pass"];
    $update_pass  = md5($_POST["update_pass"]);
    $update_pass  =filter_var($update_pass, FILTER_SANITIZE_STRING);
    $new_pass     = md5($_POST["new_pass"]);
    $new_pass     =filter_var($new_pass, FILTER_SANITIZE_STRING);
    $confirm_pass = md5($_POST["confirm_pass"]);
    $confirm_pass =filter_var($confirm_pass, FILTER_SANITIZE_STRING);

    if(!empty($update_image) OR !empty($new_pass) OR !empty($confirm_pass)){
        if($update_image != $new_pass){
            $message[]= "Mật Khẩu cũ Không Trùng!";
        }elseif($new_pass!=$confirm_pass){
            $message[]= "Mật Khẩu Không Trùng!";
        }else{
            $update_pass_query =  $conn->prepare("UPDATE users SET password=?  WHERE id=?");
            $update_pass_query->execute([$confirm_pass, $user_id]);
            $message[]= " Cập Nhật Mật Khẩu Thành Công!";
        }
    };



}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update user profile</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/components.css">

</head>
<body>

<?php include 'header.php';

?>
<section class="update-profile">

    <h1 class="title">Cập Nhật Thông Tin</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
        <div class="flex">

            <div class="inputBox">

            <span>username :</span>
            <input type="text"  name="name" value="<?= $fetch_profile['name']; ?>"
            placeholder ="Cập nhật tên" required  class="box">

             <span>email :</span>
            <input type="email"  name="email" value="<?= $fetch_profile['email']; ?>"
            placeholder ="Cập nhật email" required  class="box">

             <span>update pic :</span>
             <input type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png">

             <input type="hidden" name="old_image" value="<?= $fetch_profile['image']; ?>">
            </div>

            <div class="inputBox">
            
            <input type="hidden" name="old_pass" value="<?= $fetch_profile['password']; ?>">
            <span>old password:</span>
            <input type="password"  name="update_pass" 
            placeholder ="enter previous password" required  class="box">

            <span>new password:</span>
            <input type="password"  name="new_pass" 
            placeholder ="enter new password" required  class="box">

            <span>confirm password:</span>
            <input type="password"  name="confirm_pass" 
            placeholder ="confirm new password" required  class="box">

            </div>
        </div>

        <div class="flex-btn">
        <input type="submit" value="Cập Nhật" class="btn" name="Cập Nhật">
        <a href="home.php" class="option-btn"> Quay Lại </a></p>
        </div>
    </form>

</section>
    
    <script src="js/script.js"></script>
</body>
</html>