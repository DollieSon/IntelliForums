<?php
    include 'includes/connect.php';
    include 'includes/header.php';
 ?>
 <!DOCTYPE html>
<html>
    <head>
        <link rel = "stylesheet" href = "css/loginStyles.css">
    </head>
    <body>
        <div class = "container">
            <form method="post">
                <h1>Registration</h1>
                <label for = "Fname" class = "content" >First Name: </label><br>
                <input type = "text" id = "Fname" class = "content inputs" name="firstname"><br>
                <label for = "LName" class = "content">Last Name: </label><br>
                <input type = "text" id = "LName" class = "content inputs" name="lastname"><br>
                <label for = "Email" class = "content">Email: </label><br>
                <input type = "text" id = "Email" class = "content inputs" name="email"><br>
                <label for = "username" class = "content">Username: </label><br>
                <input type = "text" id = "username" class = "content inputs" name="username"><br>
                <label for = "password" class = "content">Password: </label><br>
                <input type = "password" id = "password" class = "content inputs"  name="password"><br>
                <button type = "submit" class = "content" name="btnRegister">Register</button>
            </form>
			<?php	
				if(isset($_POST['btnRegister'])){
					if(empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password'])){
						echo '<script>alert("Some missing fields");</script>';
					} else{
						$email = $_POST['email'];
						$username = $_POST['username'];
						$check_email_duplicate_statement = "SELECT * from `tbluser` WHERE `email` = '$email'";
						$check_email_duplicate_query = mysqli_query($conn,$check_email_duplicate_statement);
						if(mysqli_num_rows($check_email_duplicate_query) == 0){
							$check_username_duplicate_statement = "SELECT * from `tbluser` WHERE `username` = '$username'";
							$check_username_duplicate_query = mysqli_query($conn,$check_username_duplicate_statement);
							if(mysqli_num_rows($check_username_duplicate_query) == 0){
								$insert_statement = "INSERT INTO `tbluser` (`firstname`, `lastname`, `username`, `email`, `password`) VALUES ('" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['username'] . "', '" . $_POST['email'] . "', '" . $_POST['password'] . "')";
								$insert_query = mysqli_query($conn,$insert_statement);
								if(!$insert_query){
									echo '<script>alert("Something went wrong!");</script>';
								} else{
									echo '<script>alert("Successful registration, you may now log in!");</script>';
								}
							} else{
								echo '<script>alert("This username is already in use!");</script>';
							}
						} else{
							echo '<script>alert("This email is already in use!");</script>';
						}
					}
				}
			?>
        </div>
    </body>
    <footer>
		<?php
        	include 'includes/footerLee.php';
        ?>
    </footer>
</html>

