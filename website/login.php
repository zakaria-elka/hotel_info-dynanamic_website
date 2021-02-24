<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="login.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <script>
$(document).ready(function(){
$(".center").slideDown(500);


}




)

 </script>

    <body>
        <div class="center">

        <h2 class="lgtxt">Login </h2>
  <form id='f' method="post">
  
  <label for="user" class="labeling">Username or email</label>
  <input type="text" id="user" name="user" name="email" required><br>
  <label for="pas"class="labeling">Password</label>
  <input type="password" id="pas" name="pas" required>
  <br>
  <input type="submit" value="Login" class="btn"  name='submit'> 
  <p class="opt">New here ? <a href="register.php">register</a> </p>
  

  </form>

  </div>
  <a href="index.php" style="text-decoration: none; color:black;" class="back">BACK</a>

        <?php
         // verify if the bttn is clicked.
         if(isset($_REQUEST["submit"])){
            $link = mysqli_connect("localhost", "root", "", "websitebase");//connect to the database
 
            // if error break connection
            if($link === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }

            // get element of text input
            $usem= htmlspecialchars($_REQUEST['user']);
            $pas=md5(htmlspecialchars($_REQUEST['pas']));
           
        
        

          // select element from datbase
          $sql = "SELECT * FROM acount WHERE (user = '$usem' and pasword = '$pas') 
          or (email = '$usem' and pasword = '$pas')";
          
          //verify if the request is valid.
          if($result = mysqli_query($link, $sql)){

              // verify if the usem and pass exist in database
              if(mysqli_num_rows($result) == 0){
                  echo "<script language='javascript'> ";
                  echo "alert('Verify Your input');  ";
                  echo "</script>";
                  
                  }
                  else{
                      
                      session_start ();
                      $_SESSION['login'] =$usem;//a variable that will sented
                 
                  // go for the other page with informations sented
                     header ('location: session.php');
                   
                    }
                 
                  // free variable results.  
                  mysqli_free_result($result);}
                
                  //close connection with database.
                  mysqli_close($link);


                 

                 
                }
               
       
       ?>
    </body>
</html>