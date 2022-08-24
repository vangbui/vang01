<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST["update_order"])){
    $order_id       =  $_POST["order_id"];
    $update_payment =  $_POST["update_payment"];
    $update_payment =  filter_var($update_payment, FILTER_SANITIZE_STRING);
    $update_payment =  $conn-> prepare("UPDATE orders SET payment_status = ? WHERE id= ?");
    $update_orders->execute([$update_payment, $order_id]);
    $message[]      ="Thanh toán đã được cập nhật !";

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php';?>

<seection class="dashboard">
    <h1 class="title">Thống Kê</h1>
<div class="box-container">
    <div class="box">
    <?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_pendings->execute(['pending']);
         while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
            $total_pendings += $fetch_pendings['total_price'];
         };
    ?>
    <h3><?=$total_pendings; ?>VNĐ</h3>
    <p>Đơn Hàng Đang Xử Lý</P>
    <a href="admin_orders.php" class="btn"> Đơn Hàng</a>
    </div>

    <div class="box">
    <?php
         $total_completed = 0;
         $select_completed = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_completed->execute(['completed']);
         while($fetch_completed = $select_completed->fetch(PDO::FETCH_ASSOC)){
            $total_completed += $fetch_completed['total_price'];
         };
    ?>
    <h3><?=$total_completed; ?>VNĐ</h3>
    <p>Đơn Hàng Đã Hoàn Thành</P>
    <a href="admin_orders.php"  class="btn"> Đơn Hàng</a>
    </div>

    <div class="box">
    <?php
        $select_orders = $conn->prepare("SELECT * FROM orders");
        $select_orders->execute();
        $number_of_orders = $select_orders->rowCount();
    ?>
    <h3><?=$number_of_orders; ?></h3>
    <p>Đặt Hàng</P>
    <a href="admin_orders.php" class="btn">Đặt Hàng</a>
    </div>


    <div class="box">
    <?php
        $select_products = $conn->prepare("SELECT * FROM products");
        $select_products->execute();
        $number_of_products = $select_products->rowCount();
    ?>
    <h3><?=$number_of_products; ?></h3>
    <p>Thêm Sản Phẩm</P>
    <a href="admin_products.php"  class="btn"> Sản Phẩm</a>
    </div>

    <div class="box">
    <?php
        $select_users = $conn->prepare("SELECT * FROM users WHERE user_type = ?");
        $select_users->execute(['user']);
        $number_of_users = $select_users->rowCount();
    ?>
    <h3><?=$number_of_users; ?></h3>
    <p>Tổng Khách Hàng</P>
    <a href="admin_users.php"  class="btn">Khách Hàng</a>
    </div>

    <div class="box">
    <?php
        $select_admins = $conn->prepare("SELECT * FROM users WHERE user_type = ?");
        $select_admins->execute(['admin']);
        $number_of_admins = $select_admins->rowCount();
    ?>
    <h3><?=$number_of_admins; ?></h3>
    <p>Tổng Quản Trị Viên</P>
    <a href="admin_users.php"  class="btn"> Quản Trị Viên</a>
    </div>

    <div class="box">
    <?php
        $select_accounts = $conn->prepare("SELECT * FROM users");
        $select_accounts->execute();
        $number_of_accounts = $select_accounts->rowCount();
    ?>
    <h3><?=$number_of_accounts; ?></h3>
    <p>Tổng Tài Khoản</P>
    <a href="admin_users.php"  class="btn">Tài Khoản</a>
    </div>

    <div class="box">
    <?php
        $select_messages = $conn->prepare("SELECT * FROM  message");
        $select_messages->execute();
        $number_of_messages = $select_messages->rowCount();
    ?>
    <h3><?=$number_of_messages; ?></h3>
    <p>Tổng Khách Hàng</P>
    <a href="admin_contacts.php"  class="btn">Liên Hệ</a>
    </div>

    

</div>
</seection>
    


    <script src="js/script.js"></script>
</body>
</html>