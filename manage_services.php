<?php
// ১. সেশন এবং ডাটাবেজ কানেকশন সবার আগে থাকবে
session_start();
if(!isset($_SESSION['admin_logged_in'])){ header("Location: admin_login.php"); exit(); }
include("connect.php");

// ২. সার্ভিস যোগ করার লজিক (হেডার ইনক্লুড করার আগেই এটি সম্পন্ন করতে হবে)
if(isset($_POST['add_service'])){
    $name = mysqli_real_escape_string($conn, $_POST['service_name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $status = $_POST['status'];

    $conn->query("INSERT INTO services (service_name, price, status) VALUES ('$name', '$price', '$status')");
    header("Location: manage_services.php");
    exit();
}

// ৩. সার্ভিস ডিলিট করার লজিক (হেডার ইনক্লুড করার আগেই এটি সম্পন্ন করতে হবে)
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM services WHERE service_id=$id");
    header("Location: manage_services.php");
    exit();
}

// ৪. গুরুত্বপূর্ণ: এখন হেডার ইনক্লুড করুন। এর ফলে ডিলিট বা অ্যাড হওয়ার পর পেজটি ফ্রেসভাবে লোড হবে।
include("header.php");
?>

<div style="min-height: 80vh; padding: 30px; background: #f4f7f6;">
    <div style="max-width: 1200px; margin: 0 auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="color: #d6006f; margin: 0;">🛠 Manage Services</h2>
            <a href="admin_dashboard.php" style="background: #2c3e50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 14px;">
                ⬅ Back to Dashboard
            </a>
        </div>
        
        <hr>

        <form method="POST" style="margin: 20px 0; display: grid; grid-template-columns: 1fr 1fr 1fr 100px; gap: 15px;">
            <input type="text" name="service_name" placeholder="Service Name" required style="padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
            <input type="number" name="price" placeholder="Price" required style="padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
            <select name="status" style="padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
            <button type="submit" name="add_service" style="background: #d6006f; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">Add</button>
        </form>

        <table border="1" width="100%" style="border-collapse: collapse; text-align: center; font-family: sans-serif;">
            <thead>
                <tr style="background: #f8f9fa; height: 45px; color: #333;">
                    <th>ID</th>
                    <th>Service Name</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = $conn->query("SELECT * FROM services ORDER BY service_id DESC");
                if($res && $res->num_rows > 0){
                    while($row = $res->fetch_assoc()){
                        echo "<tr style='height: 45px; border-bottom: 1px solid #eee;'>
                            <td>{$row['service_id']}</td>
                            <td>" . htmlspecialchars($row['service_name']) . "</td>
                            <td>" . number_format($row['price'], 2) . " TK</td>
                            <td>" . $row['status'] . "</td>
                            <td>
                                <a href='?delete={$row['service_id']}' onclick=\"return confirm('Are you sure you want to delete this service?')\" style='color: red; text-decoration: none; font-weight: bold;'>🗑 Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='padding: 20px;'>No services available.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("footer.php"); ?>