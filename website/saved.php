<?php session_start ();?>
<html>
    <head>
    <title>Moroccodestinations</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="saved.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="saved.js"></script>
    </head>
    <body> 
    
      

  <a href="session.php" style="text-decoration: none; color:black;">BACK</a>
  <p id="txt">click on a place to show it</p>
  <div id='aff'>
  <?php  
   $user=$_SESSION['login'];  
//////////////////////////////show data///////////

if(isset($_POST['fsav'])){
 

$s=$_POST['fsav'];  
$link = mysqli_connect("localhost", "root", "", "websitebase");
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$sql = "SELECT *FROM datacity ,images 
 WHERE datacity.nameplace like images.placeimage and datacity.nameplace like '$s' ";
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
      
      
      
      }}}


?>
  </div>


 
<?php
/////////////////////////delete DAta///////////////
if(isset($_POST["fsav1"])){
$s=$_POST["fsav1"];

try{//connection maa database
  $pdo=new PDO("mysql:host=localhost;dbname=websitebase","root","");
  
  }catch(PDOException $e){
  echo"tfo lmachakil".$e->getMessage;}
  



$qr="DELETE from saved where savedname like '$s' and user like '$user'";
$pdo->exec($qr);


  }
?>    
  
  
  
  <?php
  //////////////////////////////////////////////////////FIRST part//////////////////////
  if(empty($_SESSION['login'])){
  header("Location:login.php");  
  }

 
  //////////////////////////////////////////SHow tab/////////////////
  $link = mysqli_connect("localhost", "root", "", "websitebase");
 

  if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }
 
  $sql = "SELECT *FROM saved 
  WHERE user like '$user'"; 
  $i=1;
  
  if($result = mysqli_query($link, $sql)){
    if((mysqli_num_rows($result) > 0)){ 
      echo "<table class='table table-bordered table-dark' id='tab'>
  <thead>
    <tr>
      <th scope='col'>#</th>
      <th scope='col'>PLACE SAVED</th>
    </tr> </thead>";
        while($row = mysqli_fetch_array($result)){
        echo "<tbody>
        <tr>
          <th scope='row'>".$i."</th>
          <td><button class='btn'>".$row['savedname']."</button>
          <input type='image' class='fav'  alt='favoris'
          src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcREScexVXeSw8h5LOFVT1ewYv8QJ4ASrBPnJg&usqp=CAU'/>
          </td></tr> </tbody>";
         
          $i++;}
        echo "</table>";  
        mysqli_free_result($result);  
        mysqli_close($link);}
        else{

          echo "<script language='javascript'> ";
          echo "alert('NONE Data Found');  ";
          echo "</script>";
          echo "<p id='blabla'>save place to show it</p>";
        }     
      
      }
 
        
?>


<!--////////////////js share data to php///////// -->
<form id='formsav' method='post'>
<input type='submit' name='fsav' id='sav'></input>
</form>
<form id='formsav' method='post'>
<input type='submit' name='fsav1' id='sav1'></input>
</form>

</body>
</html>