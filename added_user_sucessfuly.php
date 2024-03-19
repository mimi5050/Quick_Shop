<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Added Successfully</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }
    .container {
      text-align: center;
      margin-top: 50px;
    }
    .success-message {
      color: maroon; 
    }
    .message {
      font-size: 24px;
      color: green;
    }
    .back-btn {
      padding: 10px 20px;
      background-color: maroon;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
      margin-top: 20px;
    }
    .back-btn:hover {
      background-color: #800000;
    }
  </style>
</head>
<body>
  <div class="container">
    <div style="color: maroon;" class="message">User added successfully!</div>
    <a href="manage_users.php" class="back-btn">Back to Manage Users</a>
  </div>
</body>
</html>
