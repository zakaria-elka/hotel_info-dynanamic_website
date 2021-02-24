<?php session_start ();?>
<html>
    <head>
    <title>Moroccodestinations</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="session.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="session.js"></script>
    </head>


    <body> 
    <ul> 
   <li> <a href="login.php">Morocco Destinations</a></li>
   <li><input type="text" id='search'/>
     <input type="image" class="imgsh" alt="search"
       src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSPuBfJlcSs4GaIOb_HF7O1RDHoTcXdc0lLOQ&usqp=CAU"
       onclick='search()'/></li>
   </ul>
<h3 class='title'>HOTELS</h3>

<input type="image" class="menu" alt="menu"
       src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWWIS3IxQw7MqoBAERuj0OXrv5hoL-LiWgZw&usqp=CAU"/>

  <div class="sidebar">

<h2><?php
if(isset($_SESSION['login'])){

  echo $_SESSION['login']; }

else {
header("Location:login.php");  
}?>
</h2>


<a href='saved.php'>Saved</a>
<a href="setting.php">Settings</a>

<a><form method="POST">
<input type="submit" name="logout" value="log out"/>
</form></a>
  </div>


<?php
///////////////////////////////////////////////////////////////////
$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';



 if (isset($_SESSION['login'])) {

    if (isset($_POST['logout'])){

        unset($_SESSION['login']);
        session_destroy();  
        
        echo "<script language='javascript'> ";
        echo "window.location.href = 'login.php'" ; 
        echo "</script>";
        }
        if($pageWasRefreshed!=1 and empty($_POST['fsav'])) {
          
  
    echo "<script language='javascript'> ";
    echo "alert('CONNECTED');  ";
    echo "</script>";
   
         
    }
} 


///////////////////////////////////show data////////////////////////////////////////////
$link = mysqli_connect("localhost", "root", "", "websitebase");
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
echo '<div class="container">'; 
$sql = "SELECT *FROM datacity ,images 
 WHERE datacity.nameplace like images.placeimage ";
if($result = mysqli_query($link, $sql)){
    if((mysqli_num_rows($result) > 0)  ){ 
        while($row = mysqli_fetch_array($result)){
          echo " <div class='card'>";
             echo '<img width="100%" height="200" class="photo" 
              src="data:images.image/jpeg;base64,'
            .base64_encode($row['image']).'"/> ';
          echo '<div class="card-body">';
                echo "<h2>" . $row['namecity'] . "</h2>";
                echo "<h3 class='city'>" . $row['nameplace'] . "</h3>";
                echo "<p>" . $row['citydesc'] . "</p>";
                echo "<a href='".$row['linkplace']."'>Link</a>";
                echo "<div class='favo'>
                <input type='image' class='fav'  alt='favoris'
                src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcB4cugMqQSbfVQrUZtgp4hmoruBn8qVz6-g&usqp=CAU'>        
                <span class='tooltext'>save me</span></div> ";
          echo "</div>";
        echo "</div>";}
echo "</div>";
        // Free result set
        mysqli_free_result($result);  
        mysqli_close($link);}}

    
        


?>


<?php   
    // ///////////////////////////////////////////SAVE PART//////////////////////////////////////////////////



if(isset($_POST['fsav'])){
 
  $s=$_POST['fsav'];
$user=$_SESSION['login'];

$link = mysqli_connect("localhost", "root", "", "websitebase");
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "INSERT INTO saved (user,savedname)  VALUES ('$user', '$s')";
mysqli_query($link, $sql);
echo "<script language='javascript'> ";
echo "alert('Saved');  ";
echo "</script>";


mysqli_close($link);}
?>
<form id='formsav' method='post'>
<input type='submit' name='fsav' id='sav'></input>
</form>




              </body>
</html>               