<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuickShop - Manage Users</title>
  <script src="https://kit.fontawesome.com/a3c696c988.js" crossorigin="anonymous"></script>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    #navbar {
      background-color: maroon;
      color: #fff;
      text-align: center;
      padding: 10px;
    }

    #navbar h2 {
      margin: 0;
      color: #fff;
    }

    #sidenav {
      width: 250px;
      background-color: #800000;
      padding-top: 20px;
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      overflow-x: hidden;
      padding-bottom: 60px;
    }

    #sidenav a {
      padding: 10px;
      text-decoration: none;
      font-size: 18px;
      color: #fff;
      display: block;
      margin-bottom: 20px;
    }

    #sidenav a:hover {
      background-color: #ddd;
      color: maroon;
    }

    .content-view {
      margin-left: 250px;
      padding: 20px;
    }

    h3 {
      color: maroon;
      margin-bottom: 15px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
      font-size: 14px;
      margin-right: -200px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: maroon;
      color: #fff;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    button {
      padding: 5px 10px;
      background-color: maroon;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      margin-right: 5px;
    }

    button:hover {
      background-color: #800000;
    }

    form {
      margin-bottom: 20px;
    }

    form label {
      margin-right: 5px;
    }

    form input[type="text"],
    form input[type="email"],
    form input[type="password"] {
      padding: 5px;
      width: 200px;
      margin-right: 10px;
    }

    form button[type="submit"] {
      padding: 5px 10px;
      background-color: maroon;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    form button[type="submit"]:hover {
      background-color: #800000;
    }

    .overlay {
      display: none;
      align-items: center;
      justify-content: center;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 1000;
    }

    .popup {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      color: black;
      max-width: 400px;
      width: 80%;
    }

    .popup label {
      display: block;
      margin-bottom: 10px;
      color: #A5494D;
      font-weight: bold;
    }

    .popup input[type="date"],
    .popup input[type="number"] {
      width: calc(100% - 20px);
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #A5494D;
      border-radius: 5px;
    }

    .popup button {
      width: calc(50% - 5px);
      border: none;
      border-radius: 5px;
      background-color: #4CAF50;
      color: white;
      cursor: pointer;
    }

    #cancel {
      margin-top: 10px;
      background-color: #ff6666;
    }
  </style>
</head>
<body>
  <div id="navbar">
    <h2>QUICKSHOP|ADMINISTRATOR</h2>
  </div>

  <div id="sidenav">
    <a href="admin.php" style="font-size: 24px;">MS Administrator</a>
    <a href="admin.php"><i class="fas fa-home"></i> Home</a>
    <a href="manage_users.php"><i class="fas fa-users-cog"></i> Manage Users</a>
    <a href="manage_product.php"><i class="fas fa-box-open"></i> Manage Products</a>
    <a href="manage_orders.php"><i class="fas fa-clipboard-list"></i> Manage Orders</a>
    <a href="manage_orderdetails.php"><i class="fas fa-database"></i> Manage Order Deatails</a>
    <a href="Logout.php"><i class="fas fa-power-off"></i> Log Out</a>
  </div>

  <div class="content-view">
    <h3>Add User</h3>
    <form id="addUserForm" action="add_user.php" method="post"> 
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required><br><br>
      <label for="email">User Email:</label>
      <input type="email" id="email" name="email" required><br><br> 
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br><br>
      <label for="role">Role:</label>
      <input type="text" id="role" name="role" required><br><br>
      <button type="submit">Add User</button>
    </form>

    <h3>Manage Users</h3>
    <table>
      <thead>
        <tr>
          <th>User ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Password</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include 'connection.php';
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
        ?>
        <tr>
          <td><?php echo $row["UserID"]; ?></td>
          <td><?php echo $row["Name"]; ?></td>
          <td><?php echo $row["Email"]; ?></td>
          <td><?php echo $row["Password"]; ?></td>
          <td><?php echo $row["Role"]; ?></td>
          <td>
            <form action="delete_user.php" method="get">
              <button type="submit" name="delete" value="<?php echo $row["UserID"]; ?>">Delete</button>
            </form>
            <button type="button" onclick="UserDetailsPopup('<?php echo $row['UserID']; ?>', '<?php echo $row['Name']; ?>', '<?php echo $row['Email']; ?>', '<?php echo $row['Password']; ?>', '<?php echo $row['Role']; ?>')">Update</button>
          </td>
        </tr>
        <?php
          }
        } else {
          echo "0 results";
        }
        ?>
      </tbody>
    </table>
    <script>
      function UserDetailsPopup(UserID, Name, Email, Password, Role) {
        var container = document.querySelector("body");
        var popup = document.createElement("div");
        popup.classList.add("overlay");
        popup.style.display = "flex";
        popup.innerHTML =
        `<div class='popup'>
            <form id='feedback-form' action='update_user_details.php' method='post'>
                <input type="hidden" id="users_id" name="user_id" value="${UserID}">
                <label for='Name'>Name:</label>
                <input type="text" id="Name" name="Name" value="${Name}" required>
                <label for='Email'>Email:</label>
                <input type='email' id='Email' name='Email' value='${Email}' required>
                <label for='Password'>Password</label>
                <input type='password' id='Password' name='Password' value='${Password}' required>
                <label for='Role'>Role:</label>
                <input type="text" id="Role" name="Role" value="${Role}" required>
                <button type='submit'>Update</button>
            </form>
            <button id='cancel' onclick='closePopup()'>Cancel</button>
        </div>`;
        container.appendChild(popup);
      }

      function closePopup() {
        var popup = document.querySelector('.overlay');
        popup.parentNode.removeChild(popup);
      }
    </script>
  </div>
</body>
</html>
