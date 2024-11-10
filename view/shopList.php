<?php
  include("dashbSides.php");
include_once "../model/shop.php";

$shops = Shop::getAllShops();
include_once "../model/order.php"; // Include the Order model

$orders = Order::getAllOrders(); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <title>Document</title>
    <style>
        .recent-orders table img {
            max-width: 50px;
            height: auto;
            display: block;
            margin: 0 auto;
            border-radius: 50%;
        }
        
        .delete-btn {
            background-color: var(--color-danger);
            border: none;
            color: white;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s, transform 0.3s;
        }

        /* Icon style */
        .delete-icon {
            margin-right: 5px;
        }

        /* Animation on hover */
        .delete-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
<main>
    <div class="recent-orders all">
        <h2>Shops</h2>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Photo</th>
                <th>Action</th> <!-- Added column for Delete button -->
            </tr>
            </thead>
            <tbody>
            <?php foreach ($shops as $shop): ?>
                <tr>
                    <td><?php echo $shop['id']; ?></td>
                    <td><?php echo $shop['name']; ?></td>
                    <td><?php echo $shop['price']; ?></td>
                    <td><img src="../uploads/<?php echo $shop['photo']; ?>" alt="Shop Photo"></td>
                    <td>
                        <button class="delete-btn" data-id="<?php echo $shop['id']; ?>">
                            <i class="fas fa-trash delete-icon"></i> Delete
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="recent-orders all">
        <h2>Orders</h2>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>User Name</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total</th>
                <!-- You can add more columns if needed -->
            </tr>
            </thead>
            <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['userId']; ?></td>
                    <td><?php echo $order['userName']; ?></td>
                    <td><?php echo $order['shopId']; ?></td>
                    <td><?php echo $order['shopname']; ?></td>
                    <td><?php echo $order['quantity']; ?></td>
                    <td><?php echo $order['total']; ?></td>
                    <!-- Add more cells for additional columns if needed -->
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('.delete-btn').click(function() {
        var shopId = $(this).data('id');
        
        // Display confirmation dialog before deleting
        if (confirm("Are you sure you want to delete this shop?")) {
            $.ajax({
                url: '../controller/delete_shop.php',
                method: 'POST',
                data: { 
                    shopId: shopId,
                    action: 'delete_shop' // Include the 'action' parameter
                },
                success: function(response) {
                    alert(response.message);
                    // Refresh the page or remove the deleted row from the table
                    // For now, let's reload the page
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert('Error occurred while deleting shop!');
                }
            });
        }
    });
});

</script>
</body>
</html>
