<?php
include("dashbSides.php");
include_once "../model/booking.php";
include_once "../model/reservation.php";

$bookings = Booking::getAllBookings();
$reservations = Reservation::getAllReservations();
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
    <style>
       
        .recent-orders table img {
            max-width: 100px; 
            height: auto; 
            display: block; 
            margin: 0 auto; 
        }

        .update-btn,
        .delete-btn,
        .delete-reservation-btn {
            padding: 0.6rem 1rem;
            border: none;
            border-radius: var(--border-radius-1);
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-weight: bold;
        }

        .update-btn {
            background-color: var(--color-success);
            color: var(--color-white);
        }

        .delete-btn {
            background-color: var(--color-danger);
            color: var(--color-white);
        }
        .delete-reservation-btn{
            background-color: var(--color-danger);
            color: var(--color-white);
        }

        .update-btn:hover,
        .delete-btn:hover,
        .delete-reservation-btn {
            filter: brightness(90%);
        }

        #updateBookingForm {
            display: none;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 20px;
        }

        #updateBookingForm label {
            display: block;
            margin-bottom: 10px;
        }

        #updateBookingForm input[type="text"],
        #updateBookingForm input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #updateBookingForm input[type="submit"] {
            background-color: var(--color-primary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        #updateBookingForm input[type="submit"]:hover {
            background-color: var(--color-primary-dark);
        }

        #updateBookingForm button[type="button"] {
            background-color: var(--color-danger);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        #updateBookingForm button[type="button"]:hover {
            background-color: var(--color-danger-dark);
        }

    </style>
    <title>Document</title>
</head>
<body>
<main>
    
    <div class="recent-orders all">
        <h2>Bookings</h2>
        <table>
          
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th>Photo</th>
                    <th>Available</th>
                    <th>Actions</th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo $booking['id']; ?></td>
                        <td><?php echo $booking['name']; ?></td>
                        <td><?php echo $booking['description']; ?></td>
                        <td><?php echo $booking['price']; ?></td>
                        <td><?php echo $booking['date']; ?></td>
                        <td><img src="../uploads/<?php echo $booking['photo']; ?>"></td>
                        <td><?php echo $booking['number']; ?></td>
                        <td>
                            <button class="update-btn" data-id="<?php echo $booking['id']; ?>">Update</button>
                            <button class="delete-btn" data-id="<?php echo $booking['id']; ?>"><i class="fas fa-trash delete-icon"></i> Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div id="updateBookingForm">
            <h2>Update Booking</h2>
            <form id="updateForm">
                <label for="updateName">Name:</label>
                <input type="text" id="updateName" name="name"><br>
                <label for="updateDescription">Description:</label>
                <input type="text" id="updateDescription" name="description"><br>
                <label for="updatePrice">Price:</label>
                <input type="text" id="updatePrice" name="price"><br>
                <label for="updateDate">Date:</label>
                <input type="date" id="updateDate" name="date"><br>
                <label for="updateNumber">Number:</label> 
                <input type="text" id="updateNumber" name="number"><br>
                <input type="submit" value="Update">
                <button type="button" onclick="closeForm()">Close</button>
            </form>
        </div>
    </div>

    
    <div class="recent-orders all">
        <h2>Reservations</h2>
        <table>
           
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Booking ID</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($reservations): ?>
                    <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td><?php echo $reservation['id']; ?></td>
                            <td><?php echo $reservation['userId']; ?></td>
                            <td><?php echo $reservation['userName']; ?></td>
                            <td><?php echo $reservation['userEmail']; ?></td>
                            <td><?php echo $reservation['bookingId']; ?></td>
                            <td><button class="delete-reservation-btn" data-id="<?php echo $reservation['id']; ?>"><i class="fas fa-trash delete-icon"></i> Delete</button></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No reservations found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".delete-btn").click(function() {
            var id = $(this).data("id");
            if (confirm("Are you sure you want to delete this booking?")) {
                $.ajax({
                    url: "../controller/deleteBookingController.php",
                    method: "POST",
                    data: { action: "delete_booking", id: id },
                    dataType: "json",
                    success: function(response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert("Error deleting booking: " + xhr.responseText);
                    }
                });
            }
        });

       
    $(".update-btn").click(function() {
        var id = $(this).data("id");
        $.ajax({
            url: "../controller/updateBookingController.php",
            method: "POST",
            data: { action: "update_booking", id: id },
            dataType: "json",
            success: function(response) {
                $("#updateName").val(response.name);
                $("#updateDescription").val(response.description);
                $("#updatePrice").val(response.price);
                $("#updateDate").val(response.date);
                $("#updateNumber").val(response.number);
                $("#updateBookingForm").show();
                $("#updateForm").data("booking-id", id);
            },
            error: function(xhr, status, error) {
                console.log("Error retrieving booking data: " + xhr.responseText);
                alert("Error retrieving booking data: " + xhr.responseText);
            }
        });
    });

    $("#updateForm").submit(function(event) {
        event.preventDefault(); 
        var id = $(this).data("booking-id");
        var name = $("#updateName").val();
        var description = $("#updateDescription").val();
        var price = $("#updatePrice").val();
        var date = $("#updateDate").val();
        var number = $("#updateNumber").val();
        
        if (name === "") {
            name = $("#updateName").attr("placeholder");
        }
        if (description === "") {
            description = $("#updateDescription").attr("placeholder");
        }
        if (price === "") {
            price = $("#updatePrice").attr("placeholder");
        }
        if (date === "") {
            date = $("#updateDate").attr("placeholder");
        }
        if (number === "") {
            number = $("#updateNumber").attr("placeholder");
        }
        
        $.ajax({
            url: "../controller/updateBookingController.php",
            method: "POST",
            data: {
                action: "update_booking",
                id: id,
                name: name,
                description: description,
                price: price,
                date: date ,
                number: number
            },
            dataType: "json",
            success: function(response) {
                alert(response.message);
                location.reload(); 
            },
            error: function(xhr, status, error) {
                alert("Error updating booking: " + xhr.responseText);
            }
        });
    });
});

$(document).ready(function() {
    $(".delete-reservation-btn").click(function() {
        var id = $(this).data("id");
       console.log("Reservation ID to delete:", id); 
        if (confirm("Are you sure you want to delete this reservation?")) {
            $.ajax({
                url: "../controller/deleteReservationController.php", 
                method: "POST",
                data:  { action: "delete_reservation", id: id },
                dataType: "json",
                success: function(response) {
                    alert(response.message);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert("Error deleting reservation: " + xhr.responseText);
                    console.log("Error deleting reservation: " + xhr.responseText);
                }
            });
        }
    });
});


function closeForm() {
    $("#updateBookingForm").hide();
}
</script>
</body>
</html>
