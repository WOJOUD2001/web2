<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$gender = $_POST['gender'];
	$remember = isset($_POST['remember']) ? true : false;
	$hash = password_hash($password, PASSWORD_DEFAULT);
	$host = "localhost";
	$username="root";
	$pass="";
	$dbname="web2";
    //PDO
	conn = new mysqli($host,$username,$passwordd,$dbname);
	$hashed_password = password_hash($password, PASSWORD_DEFAULT); 
	if($conn->connect_error){
	 die("connection failed:"$conn->connect_error); 	
	} 	
   $stmt = $conn->prepare("INSERT INTO users (name,email,password,gender) VALUES (?, ?, ?, ?)");
   $stmt->bind_param("ssss", $name, $email, $hashed_password, $gender);
    	if($stmt->execute()){ 	
	echo " created successfully"; 
	}
	else{
	echo "Error:"$conn->error; 
	} 
 $conn->close();
	if (empty($name)) {
		echo "Please enter your name";
		exit;
	}

	if (empty($email)) {
		echo "Please enter your email";
		exit;
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "Invalid email format";
		exit;
	}
	if (empty($password)) {
		echo "Please enter a password";
		exit;
	} else if (strlen($password) < 9) {
		echo "Password must be at least 9 characters long";
		exit;
	}
	if (empty($gender)) {
		echo "select your gender";
		exit;
	}
	if ($_FILES['image']['size'] > 1024*1024) {
		echo "Image size must be less than 1MB";
		exit;
	}
	$image_name = $_FILES['image']['name'];
	$image_tmp_name = $_FILES['image']['tmp_name'];
	$image_size = $_FILES['image']['size'];
}
?>
<!DOCTYPE html>
<html>
<body>
	<form  method="post" enctype="multipart/form-data">
    <fieldset>
		<label for="name">Name:</label>
		<input type="text" name="name"><br><br>
		<label for="email">Email  :</label>
		<input type="email" name="email" required><br>
		<label for="password">Password:</label>
		<input type="password"  name="password"><br>
		<label for="gender">Gender:</label>
		<input type="radio"  name="gender" value="1">
		<label for="male">Male</label>
		<input type="radio"  name="gender" value="2">
		<label for="female">Female</label><br><br>
		 <label for="Image">Image</label>
         <input  type="file" name="image" ><br>
		<input type="checkbox"name="Remmber" value="Remmber" required>
        <label for="Remmber"> Remmber Me</label><br>
		<button type="submit" >Sign Up</button>
</fieldset>
	</form>
</body>
</html>