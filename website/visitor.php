<html>
    <head>
    <title>Moroccodestinations</title>
    <link rel="stylesheet" type="text/css" href="visitor.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="visitor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

     
    </head>
    <body> 
     <nav>
    <ul>

    <li> <a href="index.php">HOME</a></li>
    <li> <a href="login.php">LOGIN</a></li>
    <li> <a href="register.php">REGISTER</a></li>

    </ul>
</nav>

<input type=button value="show more" class="showmore" onclick="reg()">

<?php   
$link = mysqli_connect("localhost", "root", "", "websitebase");
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
echo '<div class="container">'; 
$sql = "SELECT *FROM datacity ,images 
 WHERE datacity.nameplace like images.placeimage limit 2";
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
          echo "</div>";
        echo "</div>";}
echo "</div>";
        // Free result set
        mysqli_free_result($result);  
        mysqli_close($link);}}




?> 


 



 
    
 
    </body>
</html>