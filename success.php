<?php
        session_start();
        require("includes/common.php");

        $uid = $_SESSION['user_id'];


        $host = '127.0.0.1';
        $dbname = 'store';
        $username = 'root';
        $password = '';
        
        // Establish connection using PDO
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            // Set PDO to throw exceptions on errors
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }

        
        $query = "UPDATE user_item SET status = :status WHERE user_id = :uid";

// Prepare the statement
$stmt = $pdo->prepare($query);

if ($stmt) {
    // Bind parameters
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':uid', $uid);

    // Set the values for parameters
    $status = "Confirmed";
    $uid = $_SESSION['user_id'];

    // Execute the statement
    $stmt->execute();

    // Check if any rows were affected
    $rows_affected = $stmt->rowCount();

    if ($rows_affected > 0) {
        // Rows updated successfully
        // echo "User items updated successfully.";
    } else {
        // No rows updated
        // echo "No user items were updated.";
    }
} else {
    // Error in preparing the statement
    echo "Error: " . $pdo->errorInfo()[2];
}


?>

                <?php
                $transaction_id = $_GET['transaction_id'];
                $total_amount = $_GET['total_amount'];
                // $transaction_date = $_GET['transaction_date'];
                // $payment_method = $_GET['payment_method'];

                ?>
                        <!-- <div class="success-container">
                                <h1>Payment Successful!</h1>
                                <p>Transaction ID : <b><?php echo $transaction_id; ?></b></p></br>
                                <p>Amount: <b><?php echo $total_amount ?> </b></p>  </br>
                                <a href="index.php">Okay</a>
                        </div> -->
        </body>
</html>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title></title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="" />

    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        display: flex;
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
        height: 100vh;
      }
      .container {
        width: 600px;
        margin: 0 auto;
        background-color: white;
        padding: 20px;
        border: 1px solid #cccccc;
      }
      .logo {
        text-align: center;
      }
      .message {
        font-size: 24px;
        color: green;
        text-align: center;
        display: flex;
        justify-content: center;
      }
      .details {
        margin-top: 20px;
        font-size: 18px;
      }
      .detail {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
      }
      .label {
        font-weight: bold;
      }
      .value {
        color: #666666;
      }
      .btn {
        display: block;
        text-align: center;
        background-color: transparent;
      }
      button {
        border: none;
        outline: none;
        cursor: pointer;
      }
      .btn a {
        text-decoration: none;
        border: none;
        padding: 10px;
        margin: 10px;
        font-size: 20px;
        background-color: green;
        color: white;
        border-radius: 10px;
        outline: none;
      }
    </style>
  </head>
  <body>
  <?php
                $transaction_id = $_GET['transaction_id'];
                $total_amount = $_GET['total_amount'];
                // $transaction_date = $_GET['transaction_date'];
                // $payment_method = $_GET['payment_method'];

                ?>
    <div class="container">
      <div class="logo">
        <img src="img/thanks.png" alt="Logo" />
      </div>
      <div class="message">Your transaction has been completed.</div>
      <div class="details">
        <div class="detail">
          <div class="label">Transaction ID:</div>
          <div class="value"><?php echo $_GET['transaction_id']?></div>
        </div>
        <div class="detail">
          <div class="label">Amount(Paisa):</div>
          <div class="value"><?php echo $_GET['total_amount'];?></div>
        </div>
        <div class="detail">
          <div class="label">Status:</div>
          <div class="value"><?php echo $_GET['status'] ?></div>
        </div>

        <div class="btn">
          <button><a href="index.php">Return to home</a></button>
        </div>
      </div>
    </div>
    <script src="" async defer></script>
  </body>
</html>
