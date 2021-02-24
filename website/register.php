<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="register.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      
  </head>
  <body>
  <script>
$(document).ready(function(){
$(".center").slideDown(500);


}




)

 </script>


  <div class="center">
  <h2>Register</h2>
  <form id='f' method="post">
  <label for="user">Username</label>
  <input type="text" id="user" name="user" required><br>
  <label for="email">Email</label>
  <input type="email" id="email" name="email" required><br>
  <label for="pas">Password</label>
  <input type="password" id="pas" name="pas" required><br>
  <input type="submit" value="Register" class="btn" name="submit">
  <p class="opt">Already have an account? <a href="login.php">login</a></p><br>
  </form> 
  </div>
  <a href="index.php" style="text-decoration: none; color:black;">BACK</a>
     
  <?php
     
     if(isset($_REQUEST["submit"])){
     $link = mysqli_connect("localhost", "root", "", "websitebase");
 

     if($link === false){
         die("ERROR: Could not connect. " . mysqli_connect_error());
     }
      
     // html... covert a special caractere like char.
     $user =htmlspecialchars($_REQUEST['user']);
     $email= htmlspecialchars($_REQUEST['email']);
     $pas=htmlspecialchars($_REQUEST['pas']);
     $pas=MD5($pas);
    
     $sql1 = "SELECT email FROM acount WHERE email like '$email'";
     $sql = "SELECT user,email FROM acount WHERE user like '$user' or email like '$email'";

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) == 0){//data do not exist
        $sql = "INSERT INTO acount (user, email, pasword) VALUES ('$user', '$email', '$pas')";
        mysqli_query($link, $sql);
        echo "<script language='javascript'> ";
        echo "alert('Account AddEd'); 
        window.location.href='login.php' ";
        echo "</script>";
       
        }
        else{if($result = mysqli_query($link, $sql1)){
            if(mysqli_num_rows($result) > 0){
                echo "<script language='javascript'> ";
                echo "alert('EMAIL EXIST');  ";
                echo "</script>";
            }
            else{
            echo "<script language='javascript'> ";
            echo "alert('USER EXIST');  ";
            echo "</script>";}}}
     
        mysqli_free_result($result);}

     mysqli_close($link);}












       ?>
       
       
      
    

    </body>
</html>