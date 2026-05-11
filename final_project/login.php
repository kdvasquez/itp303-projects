<?php
session_start();

// Is this user already logged in? 
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    // User is already logged in. Redirect to homepage
    header('Location: shop.php');
    exit(); // It's good practice to exit after a redirect
} else {
    // User is NOT logged in 
    // Was the form submitted?
    if (isset($_POST['inputName']) && isset($_POST['inputLastname']) && isset($_POST['inputEmail']) && isset($_POST['inputPassword'])) {
        // Form was submitted
        
        // // Debug statement to check form data
        // var_dump($_POST);

        // Check user credentials
        if($_POST['inputName'] == 'Susie' && $_POST['inputLastname'] == 'Poodle' && $_POST['inputEmail'] == 'pawleeze@usc.edu' && $_POST['inputPassword'] == 'USCitp303!'){
            //Valid login
            $_SESSION['logged_in'] = true;
            $_SESSION['inputName'] = $_POST['inputName'];
            $_SESSION['inputLastname'] = $_POST['inputLastname'];
            $_SESSION['inputEmail'] = $_POST['inputEmail'];
            $_SESSION['inputPassword'] = $_POST['inputPassword'];
            
            // Redirect to shop.php after setting session variables
            header('Location: shop.php');
            $_SESSION['message'] = "Hello there bruh!";

            exit(); // Terminate script execution after redirection
        } else {
            $error = "Invalid login";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Login page for Pawleeze, where user can access the site using Sessions and have name displayed">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">

    <title>Login</title>
    <style>
      #main {
        /* background: #6a11cb; */
        background: white;
        color: #CFBAE1;
        /* margin-left: 20px;
        margin-right: 20px; */
      }
      #lowered-img {
        width: 100px;
        height: 100px;
        margin-top: 300px;
        /* margin-right: 15px; */
        position: absolute;
        /* bottom: 0; */
      }
      .btn {
        background-color: #6a11cb;
      }

    </style>
</head>
<body>
<div class="container d-flex justify-content-center text-center" id="main">
<div class="row mt-5 mb-5">
<div class="col-sm-4 d-flex flex-column justify-content-center">Pawleeze 
        <img id=lowered-img src="https://i.pinimg.com/564x/dc/60/6e/dc606e2b4553c8fe3484d2b90572a5d3.jpg" alt="Pink Homepage Paw">
      </div>
      
      <div class="col-sm-8 fw-bold mb-2 fs-5 offset-sm-4">

    <h2>Login</h2>
    <p class="d-inline-block">Please login to continue!</p>

    <?php if(isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>

    <form method="POST" action="login.php">
      <div class="mb-4 row align-items-center ">
        <label for="inputName" class="col-sm-4 form-label">Name:</label>
        <div class="col-sm-8" >
          <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Susie" required >
          <small id="name-error" class="form-text text-danger"></small>
        </div>
      </div> <!--.row-->
          
      <div class="mb-4 row align-items-center ">
        <label for="inputLastname" class="col-sm-4 ml-3 form-label">Lastname:</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="inputLastname" name="inputLastname" placeholder="Poodle" required >
          <small id="lastname-error" class="form-text text-danger"></small>
        </div>
      </div> <!--.row-->

        <div class="mb-4 row align-items-center ">

        <label for="inputEmail" class="col-sm-4 form-label">Email:</label>
        <div class="col-sm-8" >
        <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="pawleeze@usc.edu" required>
        <small id="email-error" class="form-text text-danger"></small>
        </div>
          </div> <!--.row-->

        <div class="mb-4 row align-items-center ">

        
        <label for="inputPassword" class="col-sm-4 form-label">Password:</label>
        <div class="col-sm-8" >

        <input type="password" class="form-control" id="inputPassword" name="inputPassword"placeholder="USCitp303!" required>
        <small id="password-error" class="form-text text-danger"></small>
        </div>
          </div> <!--.row-->
        
          <div class="row mt-3">
          <div class="col-sm-8 offset-sm-4">

        <input type="submit" value="Login">
        </div>

    </div>
    </form>
    A proper login:
          <ol>
            <li>Use placeholder info to login and pretend you're a user named Susie. </li>
            <li>Name and lastname start with an uppercase</li>
            <li>Email needs to end with "@usc.edu"</li>
            <li>Password must have an uppercase and lowercase letter, a number, and special symbol</li>

          </ol>
          </div>
      
      </div>
  
    </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>
  
  <script>


/***** Form Events *****/
document.querySelector(".login-form").onsubmit = function() {
    event.preventDefault()
    let valid = true

    const email = document.querySelector("#inputEmail").value.trim()
    console.log(email)
    const name = document.querySelector("#inputName").value.trim() 
    console.log(name)
    const lastname = document.querySelector("#inputLastname").value.trim()

    //Checks name
    const regexName = /^[A-Z][a-z]*$/
    if (name.length === 0) {
        valid = false 
        document.querySelector("#name-error").innerHTML = "First name cannot be empty."
    } else if (!regexName.test(name)){
        valid = false;
        document.querySelector("#name-error").innerHTML = "Invalid First Name."
    } else {
        document.querySelector("#name-error").innerHTML = ""
    }

    // Checks last name
    if (lastname.length === 0) {
        valid = false 
        document.querySelector("#lastname-error").innerHTML = "Name cannot be empty."
    } else if (!regexName.test(lastname)){
        valid = false;
        document.querySelector("#lastname-error").innerHTML = "Invalid Last Name."
    } else {
        document.querySelector("#lastname-error").innerHTML = ""
    }

  // Checks email
  const EMAIL_REGEX = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

  if (email.length === 0) {
      valid = false
      document.querySelector("#email-error").innerHTML = "Email cannot be empty."
  }else if (email.indexOf('@') === -1) {
    valid = false
    document.querySelector("#email-error").innerHTML = 'Email must contain "@" character.'
  }else if (!EMAIL_REGEX.test(email)) {
    valid = false
    document.querySelector("#email-error").innerHTML = 'Must be a valid email.'
  }else if(!email.toLowerCase().endsWith("usc.edu")){
      valid = false;
      document.querySelector("#email-error").innerHTML = "Must be usc email"
  }else {
    document.querySelector("#email-error").innerHTML = ""
  }
    // Checks password
    const password = document.querySelector("#inputPassword").value.trim()
    // Regular expressions for each requirement
    const uppercaseReg = /[A-Z]/
    const lowercaseReg = /[a-z]/
    const digitReg = /\d/
    const specialCharReg = /[!@#$%^&*]/
    
    if(password.length === 0){
        valid = false 
        document.querySelector("#password-error").innerHTML = "Password cannot be empty."
    } else if(!uppercaseReg.test(password)) {
        valid = false;
        document.querySelector("#password-error").innerHTML = "Insecure Password"
    } else if(!lowercaseReg.test(password)) {
        valid = false;
        document.querySelector("#password-error").innerHTML = "Insecure Password"
    } else if(!digitReg.test(password)) {
        valid = false;
        document.querySelector("#password-error").innerHTML = "Insecure Password"
    } else if(!specialCharReg.test(password)) {
        valid = false;
        document.querySelector("#password-error").innerHTML = "Insecure Password"
    } else {
        document.querySelector("#password-error").innerHTML = ""
    }
    if(valid){
      window.location.href = "shop.php";
    }

    return false;
}
</script>
</body>
</html>
