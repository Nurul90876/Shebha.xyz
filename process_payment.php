<?php
// ১. টাইমজোন সেট করা (যাতে আপনার বর্তমান সময়ের সাথে মিলে)
date_default_timezone_set('Asia/Dhaka'); 

// ডাটাবেজ কানেকশন
$conn = mysqli_connect("localhost", "root", "", "household_service_db");

if (isset($_POST['confirm_pay'])) {
    $selected_method = mysqli_real_escape_string($conn, $_POST['selected_method']); 
    $wallet_num = isset($_POST['wallet_num']) ? mysqli_real_escape_string($conn, $_POST['wallet_num']) : 'N/A';
    
    // অ্যামাউন্ট ইনপুট থেকে নেওয়া
    $amount = isset($_POST['amount']) ? mysqli_real_escape_string($conn, $_POST['amount']) : '0.00';
    
    $transaction_ref = "REF-" . rand(100000, 999999); 
    $transaction_id = "TXN-" . strtoupper(uniqid()); 
    $status = "Success"; 

    // ২. বর্তমান রিয়েল টাইম জেনারেট করা
    $update_date_time = date("d M Y, h:i:s A"); 

    // payments টেবিল থেকে আইডি খুঁজে বের করা
    $query = "SELECT payment_id FROM payments WHERE method = '$selected_method' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $db_payment_id = $row['payment_id'];

        // ৩. transactions টেবিলে ইনসার্ট
        $sql = "INSERT INTO transactions (transaction_id, payment_id, transaction_ref, status, gateway_response) 
                VALUES ('$transaction_id', '$db_payment_id', '$transaction_ref', '$status', 'Paid via $selected_method at $update_date_time')";

        if (mysqli_query($conn, $sql)) {
            include("header.php");
            ?>
            <div style="min-height: 80vh; padding: 50px 20px; background: #f4f7f6;">
                <div id="invoice" style="max-width: 600px; margin: auto; background: white; padding: 40px; border-radius: 15px; border-top: 10px solid #d6006f; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                    <div style="text-align: center; margin-bottom: 30px;">
                        <h1 style="color: #27ae60; margin: 0;">✔ Payment Success</h1>
                        <p style="color: #666;">Payment processed at: <strong><?php echo $update_date_time; ?></strong></p>
                    </div>

                    <div style="border-bottom: 2px dashed #eee; padding-bottom: 20px; margin-bottom: 20px;">
                        <h3 style="margin: 0; color: #333;">Digital Invoice</h3>
                        <p style="color: #d6006f; font-size: 14px; font-weight: bold;">Confirmed On: <?php echo $update_date_time; ?></p>
                    </div>

                    <table style="width: 100%; line-height: 2;">
                        <tr><td style="color: #777;">Transaction ID:</td><td style="text-align: right; font-weight: bold;"><?php echo $transaction_id; ?></td></tr>
                        <tr><td style="color: #777;">Reference:</td><td style="text-align: right;"><?php echo $transaction_ref; ?></td></tr>
                        <tr><td style="color: #777;">Method:</td><td style="text-align: right;"><?php echo ucfirst($selected_method); ?></td></tr>
                        <tr><td style="color: #777;">Wallet Number:</td><td style="text-align: right;"><?php echo $wallet_num; ?></td></tr>
                        <tr style="font-size: 20px; font-weight: bold; color: #d6006f;">
                            <td style="padding-top: 20px;">Total Amount:</td>
                            <td style="text-align: right; padding-top: 20px;">৳ <?php echo $amount; ?></td>
                        </tr>
                    </table>

                    <div style="margin-top: 40px; text-align: center;">
                        <button onclick="window.print()" style="background: #2c3e50; color: white; padding: 12px 25px; border: none; border-radius: 5px; cursor: pointer;">Print Invoice</button>
                        <a href="index.php" style="background: #d6006f; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; display: inline-block; margin-left: 10px;">Back to Home</a>
                    </div>
                </div>
            </div>
            <?php
            include("footer.php");
            exit();
        }
    } else {
        header("Location: sheba_pay.php?error=method_not_found");
        exit();
    }
}
?>