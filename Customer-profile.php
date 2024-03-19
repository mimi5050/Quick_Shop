<?php
session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickShop - Customer</title>
    <script src="https://kit.fontawesome.com/a3c696c988.js" crossorigin="anonymous"></script>
    <!-- CSS code-->
    <style>
        /* body styling */
        body {
            margin: 0;
            font-family: 'Times New Roman', sans-serif;
            background-color: #ffffff;
        }

        /* Style for the top menu */
        #navbar {
            background-color: #A5494D;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        /* Style for the side navigation */
        #sidenav {
            height: 100%;
            width: 15%;
            position: fixed;
            z-index: 0;
            top: 0;
            background-color: #A5494D;
            padding-top: 50px;
            text-align: justify;
            overflow-x: hidden;
        }

        #sidenav a {
            padding: 15px 8px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }

        #sidenav a:hover {
            background-color: #BB666A;
        }

        /* profile section styling */
        #ProfileViewing {
            margin-top: 3%;
        }

        .ViewProfile {
            width: 80%; /* Use a percentage width for responsiveness */
            max-width: 600px; /* Set a maximum width to maintain a reasonable size on larger screens */
            margin: 50px auto;
            margin-left: 35%;
            background-color: #d9d9d9; /* Grey background color for the container */
            padding: 20px;
            border: 2px solid #999; /* Border color for the container */
            border-radius: 8px; /* Border radius for rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow for a subtle effect */
            display: flex;
            align-items: center; /* Center vertically within the container */
        }

        .profile {
            display: flex;
            align-items: flex-start; /* Align items to the start (top) within the profile div */
        }

        .profile img {
            border-radius: 50%;
            width: 200px;
            height: 200px;
            margin-right: 20px;
        }

        .separator {
            border-left: 2px solid #999; /* Border color for the separator line */
            margin-right: 20px;
            height: 200px; /* Adjust height to match profile image */
        }

        .info label {
            font-weight: bold;
            margin-bottom: 9px; /* Add space between different label-value pairs */
            display: inline-block; /* Ensure each label-value pair is on the same line */
            width: 90px; /* Adjust the width as needed */
        }

        #Name, #UserID, #email, #role {
            background-color: #d9d9d9;
            border: 0px;
            font-size: 16px;
            font-family: Times New Roman;
            color:#808080;
        }

        #Editbutton{
            width: 180px;
            height: 30px;
            background-color: #A5494D;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
        }

        #SaveProfile,
        #Cancelbutton {
            width: 150px;
            height: 30px;
            background-color: #A5494D;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
        }

        @media only screen and (max-width: 768px) {
            .ViewProfile {
                width: 90%; /* Adjust the width for smaller screens */
            }
        }
    </style>
</head>
<body>
<!-- Top Menu-->
<div id="navbar">
    <h2 style="color:white">QUICKSHOP|CUSTOMER</h2>
</div>

<!-- Side Navigation -->
<div id="sidenav">
    <a href="Customer-Homepage.php" style="font-size: 24px;">MS Customer</a>
    <a href="Customer-profile.php" id="Profile_txt">
        <i class="fas fa-user-alt"></i>
        Profile
    </a>
    <a href="Customer-SearchProduct.php">
        <i class="fa-solid fa-magnifying-glass"></i>
        Search Product </a>

    <a href="Customer-EditLogin.php">
    <i class="fa-solid fa-pen-to-square"></i>
        Edit Login Details</a>

    <a href="Customer-OrderHistory.php">
        <i class="fa-solid fa-clock-rotate-left"></i>
        Order History</a>

    <a href="Logout.php">
        <i class="fas fa-power-off"></i>
        Log Out</a>
</div>

<!--Profile-->
<div id="ProfileViewing">
    <div class="ViewProfile">
        <div class="profile">
            <img id="uploadImage" src="default-image.jpg" alt="Profile Picture">
            <div class="separator"></div>
        </div>
        <?php
        if (isset($_SESSION['UserID'])) {
            $user_id = $_SESSION['UserID'];
            $sql = "SELECT * FROM users WHERE UserID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <form method="post" action="update_customer.php">
                      <div class="info">
                        <label>Name:</label> <input type="text" name="Name" id="Name" value="<?php echo $row["Name"]; ?>" class="editable" readonly><br>
                        <label>User ID:</label> <input type="text" name="UserID" id="UserID" value="<?php echo $row["UserID"]; ?>" readonly><br>
                        <label>Email:</label> <input type="email" name="email" id="email" value="<?php echo $row["Email"]; ?>" readonly><br>
                        <label>Role:</label> <input type="role" name="role" id="role" value="Customer" readonly><br>
                        <button id="Editbutton" onclick="EditProfile()" type="button">Edit Profile</button>
                        <button id="SaveProfile" name="submit" style="display: none;" type="submit">Save Profile</button>
                        <button id="Cancelbutton" onclick="Cancel('<?php echo $row['Name']; ?>')" style="display:none;" type="button"><i class="fa-solid fa-ban"></i> Cancel</button>
                      </div>
                    </form>
                    <?php
                }
            }
        }
        ?>
    </div>
</div>

<!-- java script code-->
<script>
    // Get the current URL
    var currentUrl = window.location.href;

    // Get the Profile_txt link
    var profileLink = document.getElementById('Profile_txt');

    // Check if the current URL contains 'Customer-profile.php'
    if (currentUrl.includes('Customer-profile.php')) {
        profileLink.style.backgroundColor = '#BB666A'; // Change background color
    } else {
        // Reset the styling if the current URL is not 'Customer-profile.php'
        profileLink.style.backgroundColor = '#A5494D'; // Reset background color
    }

    function EditProfile() {
    var inputs = document.querySelectorAll('.editable[readonly]');
    // Loop through each input and remove the readonly attribute
    inputs.forEach(function (input) {
        input.removeAttribute('readonly');
        input.style.border = '1px solid #A5494D'; // Set border style using JavaScript
    });

    document.getElementById("Editbutton").style.display = "none";
    document.getElementById("SaveProfile").style.display = "inline-block";
    document.getElementById("Cancelbutton").style.display = "inline-block";
}

function Cancel(Name) {
    document.getElementById("Name").value = Name;
    document.getElementById("Editbutton").style.display = "block";
    document.getElementById("SaveProfile").style.display = "none";
    document.getElementById("Cancelbutton").style.display = "none";

    var inputs = document.querySelectorAll('.editable:not([readonly])');
    inputs.forEach(function (input) {
        input.setAttribute('readonly', 'readonly');
        input.style.border = '0';
    });
}

</script>

</body>
</html>
