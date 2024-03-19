<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuickShop - Registration</title>
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

    .register-form {
      width: 50%;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-top: 50px;
    }

    .register-form h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .register-form label {
      display: block;
      margin-bottom: 5px;
    }

    .register-form input[type="text"],
    .register-form input[type="email"],
    .register-form input[type="password"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    .register-form select {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    .register-form input[type="submit"] {
      background-color: maroon;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
    }

    .register-form input[type="submit"]:hover {
      background-color: #800000;
    }
  </style>
</head>
<body>
  <div id="navbar">
    <h2>QUICKSHOP | REGISTRATION</h2>
  </div>

  <div class="register-form">
    <h2>Register</h2>
    <form action="register_backend.php" method="post">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <label for="role">Role:</label>
      <select id="role" name="role" required>
        
        <option value="sales_manager">Sales Manager</option>
        <option value="inventory_manager">Inventory Manager</option>
        <option value="customer">Customer</option>
      </select>

      <input type="submit" value="Register">
    </form>
  </div>

</body>
</html>
