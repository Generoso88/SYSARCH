
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #690500, #934B00, #C84C09); 
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      background-color: rgba(255, 255, 255, 0.8);
      padding: 20px;
      border-radius: 30px;
      box-shadow: 0 0 50px rgba(0, 0, 0, 0.2);
      align-items: center;
    }

    h2 {
      text-align: center;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="password"] {
      width: 90%;
      padding: 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    button {

      width: 100%;
      padding: 10px;
      border: none;
      background-color: #2b8a00;
      color: white;
      border-radius: 5px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    button:hover {
      background-color: #42d400;
      transform: translate3d(0, -3px, 0); /* 3D hover effect */
    }

    .logo-container img {
        display: inline-block;
        
        width: 150px ;
        height: 150px;
        border-radius: 20px;
        padding-left: 75px;
        padding-right: 75px;
        padding-bottom: 20px;
        padding-top: 20px;
        
        
    }

    
  </style>
</head>
<body>
  <div class="container">
  <?php

        $con = mysqli_connect("localhost", "root", "", "student_monitoring_system");
        if (isset($_POST["login"])) {
            $Email_Address = $_POST['email'];
            $Password = $_POST['password'];
            $sql = "SELECT * FROM users WHERE Email_Address = '$Email_Address'";
            $result = mysqli_query($con, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                echo "Retrieved password from database: " . $user ['password'];
                if ($Password == $user["password"]){
                    header("Location: index.php");
                    die();
                }else {
                    echo "<div class='alert alert-success'>Incorrect Password</div>";
                }
            }else {
                echo "<div class='alert alert-success'>ID Number Not Found</div>";
            }
        }
    ?>
    <h2>User Login</h2>
    <form action="php_database.php" method="post"></form>
    <div class="logo-container"> <img  src="https://steamusercontent-a.akamaihd.net/ugc/931554599166866018/57FD8FC0619DF19E0C0B8BCAF9CEA77B9F880304/?interpolation=lanczos-none&output-format=jpeg&output-quality=95&fit=inside%7C637%3A358&composite-to=*,*%7C637%3A358&background-color=black" alt="GG" style="border-radius: 80%;">
    </form> </div>
    <form id="login-form">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" id="login-btn" name="login">Login</button>

    <p> Don't have an account yet? <a href="activity31.php"> Register Here </a> </p>
  
  </div>
  
</body>
</html>