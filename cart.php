<?php
require("includes/common.php");
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cart | Life Style Store</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid" id="content">
            <?php include 'includes/header.php'; ?>
            <?php
// // session_start();
// include('connect.php');
// if(isset($_POST['submit'])){
// 	$cash="Pay with Khalti";
// 	$name=$_POST['fullname'];
// 	$number=$_POST['phone_no'];
// 	$email=$_POST['email'];
// 	$address=$_POST['address'];
// }
// if($_SERVER["REQUEST_METHOD"]=="POST"){
// 	if(isset($_POST['submit'])){
// 	$query1 = "INSERT into customer(Fullname,Email,Phone,address,Delivery) values('$name','$email','$number','$address','$cash')";
// 	if(mysqli_query($conn,$query1)){
// 		$Order_Id=mysqli_insert_id($conn);
// 		$_SESSION['order'] = $Order_Id;
// 		$query2="INSERT INTO customer_order(`
//     order_id`,`item_name`,`price`,`quantity`) VALUES (?,?,?,?)";
// 		$stmt=mysqli_prepare($conn, $query2) or die("Failed to prepare");
// 		if($stmt){
// 			mysqli_stmt_bind_param($stmt, "isii", $Order_Id, $Item_Name, $Price, $Quantity) or die("Failed to bind param");
// 			foreach($_SESSION['cart'] as $key => $values)
// 			{
// 				$Item_Name = $values['Item_Name'];
// 				$Price = $values['Price'];
// 				$Quantity = $values['Quantity'];
// 				mysqli_stmt_execute($stmt);
// 			}
// 			// unset($_SESSION['cart']);
// 			echo "<script>
// 		window.location.href='buy.php';
// 		</script>";
// 		}
// 	}
// 	else{
// 		echo "<script>
// 		alert('SQL Error');
// 		window.location.href='cart.php';
// 		</script>";
// 	}
// }
// }
// // header("location:buy.php");

?>

            <div class="col-lg-4 col-md-6 ">
                    <img src="img/confirmorder.png" style="float: left;">
                </div>
            <div class="row decor_bg">
                <div class="col-md-6">
                    <table class="table table-striped">
    
                        <!--show table only if there are items added in the cart-->
                        <?php
                        $sum = 0;$id='';
                        $user_id = $_SESSION['user_id'];
                        $query = "SELECT items.price AS Price, items.id As id, items.name AS Name FROM user_item JOIN items ON user_item.item_id = items.id WHERE user_item.user_id='$user_id' and `status`=1";
                        $result = mysqli_query($con, $query)or die($mysqli_error($con));
                        if (mysqli_num_rows($result) >= 1) {
                            ?>
                            <thead>
                                <tr>
                                    <th>Item Number</th>
                                    <th>Item Name</th>
                                    <th>Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                    $sum+= $row["Price"];
                                    $id .= $row["id"] . ", ";
                                    echo "<tr><td>" . "#" . $row["id"] . "</td><td>" . $row["Name"] . "</td><td>Rs " . $row["Price"] . "</td><td><a href='cart-remove.php?id={$row['id']}' class='remove_item_link'> Remove</a></td></tr>";
                                }
                                $id = rtrim($id, ", ");
                                echo "<tr><td></td><td>Total</td><td>Rs " . $sum;
                                // echo "<tr><td></td><td>Total</td><td>Rs " . $sum . "</td></tr><form action='validate'><input type='submit' class='btn btn-primary' value='Checkout'></form>";
                                ?>
                                <form action="validate.php" method="POST">
                                    <input type="number" name="total" id="amount" value="<?php echo $sum ?>" hidden>
                                    <input type='submit' class='btn btn-primary' value='Checkout'>
                                </form>
                            </tbody>
                            <?php
                        } else {

                            echo "Heyy!! Your Cart is Empty. Please add items to the cart first!";
                        }
                        ?>
                        
                        <?php
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <?php include("includes/footer.php"); ?>
    </body>
</html>