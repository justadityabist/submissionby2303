<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="UTF-8">
<meta name ="viewport" content="width=device-width,initial scale=1 shrink-2-
fit=no">
<title>File Upload by 18BCE2303</title>
<style>
body{
 background-color:skyblue;
}
img {
float: left;
margin: 0px 50px 5px 0px;
}
body{
margin:5px 15px 5px 15px;
}
 body {
 font-family: "Raleway", sans-serif;

}
.column {
 float: left;
 width: 50%;
}
form {
 width: 70%;
 margin: auto;
}
h1,
h2 {
 text-align: center;
 margin: 20px auto;
 color: brown;
}
input[type="text"],
input[type="email"],
input[type="password"] {
 width: 300px;
 height: 20px;
 padding: 5px;
 border-radius: 6px;
 border: 1px solid #ccc;
 margin-bottom: 10px;
}
button {
 width: 100%;
 text-align: center;
 margin: auto !important;
 height: 40px;
 border-radius: 10px;
 background-color: #eee;
}
.ALL{
background-color: orange;
 }
</style>
</head>
<body >
<h2>Enter your personal details before uploading</h2>
<a href="logout.php">Logout</a>
<?php
$nameErr = $emailErr = $genderErr = $websiteErr = $commentErr=$cityErr="";
$name = $email = $gender = $comment = $website =$city= "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 if (empty($_POST["name"])) {
 $nameErr = "Name is required";
 } else {
 $name = test_input($_POST["name"]);
 // check if name only contains letters and whitespace
 if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
 $nameErr = "Only letters and white space allowed";
 }
 }
 if (empty($_POST["city"])) {
 $cityErr = "City is required";
 } else {
 $city = test_input($_POST["city"]);
 // check if name only contains letters and whitespace
 if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
 $cityErr = "Only letters and white space allowed";
 }
 }

 if (empty($_POST["email"])) {
 $emailErr = "Email is required";
 } else {
 $email = test_input($_POST["email"]);
 // check if e-mail address is well-formed
 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 $emailErr = "Invalid email format";
 }
 }

 if (empty($_POST["website"])) {
 $websiteErr = "Age is required";
 } else {
 $website = test_input($_POST["website"]);
 // check if URL address syntax is valid (this regular expression also allow s dashes in the URL)
 if (!preg_match("/^[1-9][0-9]{1,2}$/",$website)) {
 $websiteErr = "Invalid age";
 }
 }
 if (empty($_POST["comment"])) {
 $commentErr = "Phone no. is required";
 } else {

 $comment = test_input($_POST["comment"]);
 if (!preg_match("/^[789][0-9]{9}$/",$comment))
 {$commentErr="Invalid phone no.:";
 }
 }
 if (empty($_POST["gender"])) {
 $genderErr = "Gender is required";
 } else {
 $gender = test_input($_POST["gender"]);
 }
}
function test_input($data) {
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
}
if(isset($_FILES['image'])){
 $errors= array();
 $file_name = $_FILES['image']['name'];
 $file_size = $_FILES['image']['size'];
 $file_tmp = $_FILES['image']['tmp_name'];
 $file_type = $_FILES['image']['type'];

 $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

 $extensions= array("jpeg","jpg","png","pdf","doc","docx");

 if(in_array($file_ext,$extensions)=== false){
 $errors[]="extension not allowed, please choose a JPEG or PNG or PDF o
r DOC(x) file.";
 }

 if($file_size > 2097152) {
 $errors[]='File size must be less 2 MB';
 }
 $file_store="upload/".$file_name;

 move_uploaded_file($file_tmp,$file_store);

 /*if(empty($errors)==true) {
 move_uploaded_file($file_tmp,"images/".$file_name);
 //echo "Success";
 }else{
 print_r($errors);
 }*/
 }
?>
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"
]);?>" enctype="multipart/form-data">
 Name: <input type="text" name="name" value="<?php echo $name;?>">
 <span class="error">* <?php echo $nameErr;?></span>
 <br><br>
 E-mail: <input type="text" name="email" value="<?php echo $email;?>">
 <span class="error">* <?php echo $emailErr;?></span>
 <br><br>
 Age: <input type="text" name="website" value="<?php echo $website;?>">
 <span class="error">*<?php echo $websiteErr;?></span>
 <br><br>
 Phone: <input type="text" name="comment" value="<?php echo $comment;?>">
 <span class="error">* <?php echo $commentErr;?></span>
 <br><br>
 <br><br>
 City: <input type="text" name="city" value="<?php echo $city;?>">
 <span class="error">* <?php echo $cityErr;?></span>
 <br><br>
 Gender:
 <input type="radio" name="gender" <?php if (isset($gender) && $gender=="femal
e") echo "checked";?> value="female">Female
 <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male"
) echo "checked";?> value="male">Male
 <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other
") echo "checked";?> value="other">Other
 <span class="error">* <?php echo $genderErr;?></span>
 <br><br>
 <h4>Upload file</h4>
 <input type="file" name="image"/>
 <input type="submit" name="submit" value="Submit">
</form>
<?php
echo "<h2>Your Info:</h2>";
echo "<b>Name</b> $name";
echo "<br>";
echo "<b>Email</b> $email";
echo "<br>";
echo "<b>City</b> $city";
echo "<br>";
echo "<b>Phone:</b> $comment";
echo "<br>";
echo "<b>Age</b> $website";
echo "<br>";
echo "<b>Gender</b> $gender";
echo "<br>";
echo "<b>Filename</b>";
echo "<br>";
echo $_FILES['image']['name'];
echo "<br>";
echo "<b>Filesize</b>";
echo "<br>";
echo $_FILES['image']['size'];
echo "<br>";
echo "<b>Filetype</b>";
echo "<br>";
echo $_FILES['image']['type'];
echo "<br>";
?>
 </body>
</html>