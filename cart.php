<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
    $delete_cart_item->execute([$delete_id]);
    header('location:cart.php');
 }
 
 if(isset($_GET['delete_all'])){
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart_item->execute([$user_id]);
    header('location:cart.php');
 }
 
 if(isset($_POST['update_qty'])){
    $cart_id = $_POST['cart_id'];
    $p_qty = $_POST['p_qty'];
    $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);
    $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
    $update_qty->execute([$p_qty, $cart_id]);
    $message[] = 'số lượng  trong giỏ hàng đã được cập nhật';
 }
 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shopping cart</title>

     <!-- font awesome cdn link  -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <?php include 'header.php';?>

    <section class="shopping-cart">

<h1 class="title">Sản Phẩm</h1>

<div class="box-container">

<?php
   $grand_total = 0;
   $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $select_cart->execute([$user_id]);
   if($select_cart->rowCount() > 0){
      while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){ 
?>
<form action="" method="POST" class="box">
   <a href="cart.php?delete=<?= $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Xóa khỏi giỏ hàng?');"></a>
   <a href="view_page.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
   <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
   <div class="name"><?= $fetch_cart['name']; ?></div>
   <div class="price"><?= $fetch_cart['price']; ?>VNĐ</div>
   <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
   <div class="flex-btn">

      <input type="number" min="1" value="<?= $fetch_cart['quantity']; ?>" class="qty" name="p_qty">
      <input type="submit" value="Cập Nhật" name="update_qty" class="option-btn">
   </div>
   <div class="sub-total"> Tổng : <span><?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>VNĐ</span> </div>
</form>

<?php
   $grand_total += $sub_total;
    }
    }else{
    echo '<p class="empty">Giỏ hàng của bạn đang trống !</p>';
    }
?>
</div>

<div class="cart-total">
   <p>Tổng Cộng  : <span><?= $grand_total; ?>VNĐ</span></p>
   <a href="shop.php" class="option-btn">Tiếp Tục Mua Sản Phẩm</a>
   <a href="cart.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>">Xóa Tất Cả</a>
   <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Kiểm Tra</a>
</div>

</section>




<?php include 'footer.php';?>

<script src="js/script.js"></script>
</body>
</html>