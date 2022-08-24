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
    <title>orders</title>

     <!-- font awesome cdn link  -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <?php include 'header.php';?>

    <section class="placed-orders">

<h1 class="title">Đơn Hàng</h1>

<div class="box-container">

<?php
   $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
   $select_orders->execute([$user_id]);
   if($select_orders->rowCount() > 0){
      while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
?>
<div class="box">
   <p> Ngày : <span><?= $fetch_orders['placed_on']; ?></span> </p>
   <p> Tên : <span><?= $fetch_orders['name']; ?></span> </p>
   <p> SĐT : <span><?= $fetch_orders['number']; ?></span> </p>
   <p> Email : <span><?= $fetch_orders['email']; ?></span> </p>
   <p> Địa chỉ : <span><?= $fetch_orders['address']; ?></span> </p>
   <p> Phương thức thanh toán : <span><?= $fetch_orders['method']; ?></span> </p>
   <p> Đơn đặt hàng của bạn : <span><?= $fetch_orders['total_products']; ?></span> </p>
   <p> Tổng giá : <span><?= $fetch_orders['total_price']; ?>VNĐ</span> </p>
   <p> Tình trạng thanh toán : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
</div>
<?php
   }
}else{
   echo '<p class="empty">chưa có đơn đặt hàng nào!</p>';
}
?>

</div>

</section>




<?php include 'footer.php'; ?>

<script src="js/script.js"></script>
</body>
</html>