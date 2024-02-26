<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Registration</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #690500, #934B00, #C84C09);
      
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .container {
      background-color: rgba(255, 255, 255, 0.8);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
    .form-group {
      margin-bottom: 5px;
    }
    .form-group label {
      display: block;
      margin-bottom: 5px;
    }
    .form-group input[type="text"],
    input[type="password"] {
      width: 90%;
      padding: 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    .container button {
      width: 100%;
      padding: 10px;
      border: none;
      background-color: #00b607;
      color: #fff;
      border-radius: 5px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    .container button:hover {
      background-color: #00d208;
      transform: translate3d(0, -3px, 0);
    }
  </style>
</head>
<body>
  <div class="container">

  <?php
        session_start();
        $con = mysqli_connect("localhost", "root", "", "student_monitoring_system");

        if(isset($_POST["submit"])){
            $idno = $_POST['idno'];
            $First_Name = $_POST['firstname'];
            $Middle_Name = $_POST['middlename'];
            $Last_name = $_POST['lastname'];
            $Age = $_POST['age'];
            $Gender = $_POST['gender'];
            $Contact_Number = $_POST['contact'];
            $Year = $_POST['year'];
            $Course = $_POST['course'];
            $Role = $_POST['role'];
            $Email_Address = $_POST["email"];
            $Address = $_POST["address"];
            $Password = $_POST["password"];
            $Cpassword = $_POST["Cpassword"];

            
            $errors = array();

            if (empty($idno) OR empty($Last_Name) OR empty($First_Name) OR empty($Middle_Name) OR empty($Year) OR empty($Password) OR empty($Cpassword) OR empty($Course) OR empty($Email_Address) OR empty($Role)) {
              array_push($errors, "All Fields Are Required");
            }
            if (!filter_var($Email_Address, FILTER_VALIDATE_EMAIL)) {
              array_push($errors, "Email is not valid");
            }
            if (strlen($Password)<8) {
              array_push($errors, "Password must be at least 8 characters above");
            }
            if ($password !== $Cpassword) {
              array_push($errors, "Password does not match");
            }

            $check_query = "SELECT * FROM student_monitoring_system WHERE Email_Address = ?";
            $check_stmt = mysqli_prepare($con, $check_query);
            mysqli_stmt_bind_param($check_stmt, "s", $idno);
            mysqli_stmt_execute($check_stmt);
            mysqli_stmt_store_result($check_stmt);
            if (mysqli_stmt_num_rows($check_stmt) > 0) {
                array_push($errors, "Email already exists");
            }
            mysqli_stmt_close($check_stmt);

            if (count($errors)>0) {
                echo "<div class='alert alert-danger'>" . implode("<br>", $errors) . "</div>";
            } else {
                $query = "INSERT INTO student_monitoring_system (idno, firstname, middlename, lastname, age, gender, contact, year, course, role, email, address, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "isssisiisssss", $idno, $First_Name, $Middle_Name, $Last_Name, $Age, $Gender, $Contact_Number, $Year, $Course, $Role, $Email_Address, $Address, $Password);
                $result = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
    
                if ($result) {
                    echo "<div class='alert alert-success'>Registration successful</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error: " . mysqli_error($con) . "</div>";
                }
            }
        }
    ?>
    <h2>User Registration</h2>
    <form action="activity31.php" method="post"></form>
    
    <form id="registration-form">

      <div class="form-group">
        <label for="idno">ID Number:</label>
        <input type="text" id="idno" name="idno" required>
      </div>

      <div class="form-group">
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" required>
      </div>

      <div class="form-group">
        <label for="middlename">Middle Name:</label>
        <input type="text" id="middlename" name="middlename">
      </div>

      <div class="form-group">
        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" required>
      </div>

      <div class="form-group">
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>
      </div>

      <div class="form-group">
        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select>
      </div>

      <div class="form-group">
        <label for="contact">Contact Number:</label>
        <input type="text" id="contact" name="contact" required>
      </div>

      <div class="form-group">
        <label for="year">Year:</label>
        <input type="number" id="year" name="year" required>
      </div>
      <select id="course" name="course">
                    <option value="" disabled selected>Choose Course</option>
                    <option value="BSIT">BSIT</option>
                    <option value="BSCS">BSCS</option>
                    <option value="BSIS">BSIS</option>
                    <option value="BSCPE">BSCPE</option>
                </select>
                
                <select id="role" id="role" name="role">
                    <option value="" disabled selected>Choose Role</option>
                    <option value="Admin">Admin</option>
                    <option value="Student">Student</option>
                    <option value="Staff">Staff</option>
                    <option value="Alumni">Alumni</option>
      </select>    
      
	    <div class="form-group">
        <label for="emailaddress">Email Address:</label>
        <textarea id="emailaddress" name="emailaddress" rows="3" required></textarea>
      </div>
	  
	  
      <div class="form-group">
        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="4" required></textarea>
      </div>
      

	  
	  <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>  <br>
      </div>
	  
	  <div class="form-group">
        <label for="Cpassword">Confirm Password:</label>
        <input type="Cpassword" id="Cpassword" name="Cpassword" required>  <br>
      </div>
	  <br>
		
      <button type="submit" id="register-btn" name="submit">Register</button><br>
		<br>
    <a href="activity2.php">
      <button type="button" id="cancel-btn" >Login</button>
    </a>
      <p> Already have a student account? <a href="activity2.php"> Login Here </a> </p> 
		
    </form>
  </div>
</body>
</html>