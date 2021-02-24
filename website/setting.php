<?php session_start ();?>
<html>
    <head>
    <title>Moroccodestinations</title>
    <link rel="stylesheet" href="setting.css">
    <script src="setting.js"></script>
    </head>
    <body> 
    <a href="session.php" style="text-decoration: none; color:black;">BACK</a>

    <?php

if(empty($_SESSION['login'])){
  header("Location:login.php");  
  }

try{//connection maa database
$pdo=new PDO("mysql:host=localhost;dbname=websitebase","root","");

}catch(PDOException $e){
echo"tfo lmachakil".$e->getMessage;


}

?>
<div id='inner'>    
    <form id='f' method="post"  action="">
    <fieldset>
    <legend>Password setting</legend>
    <table>
  <tr><td>Current password</td></tr>
  <tr><td><input type="password" name="cpas" required></td></tr>
  <tr><td>new password</td></tr>
  <tr><td><input type="password"  name="npas" required></td></tr>
  <tr><td>Confirm the new password</td></tr>
  <tr><td><input type="password"   name="npas2" required></td></tr>
  <tr><td><input type="submit" value="Change Password" class="btn" name="passwordbtn" style="background-color:rgb(255, 128, 9);"></td></tr>
  </table>
  </fieldset>
  </form> 

  <form id='f2' method="post" action="">
    <fieldset>
    <legend> Email setting</legend>
    <table>
  <tr><td>Current email</td></tr>
  <tr><td><input type="email" name="cmail" required></td></tr>
  <tr><td>Password</td></tr>
  <tr><td><input type="password" name="mailpw" required></td></tr>
  <tr><td>new email</td></tr>
  <tr><td><input type="email" name="nmail" required></td></tr>
  <tr><td><input type="submit" value="Change email" class="btn" name="emailbtn" style="background-color:rgb(255, 128, 9);"></td></tr>
  </table>
  </fieldset>
  </form> 

  <form  method="post" action="">
  <fieldset id='delpas'>
  <legend>Delete account</legend>
  <table>
  <tr><td>password</td></tr>
  <tr><td><input type="password" name="pw" required  ></td><td></tr>
  <tr><td><input type="submit" name="delete" class="btn" value="Delete account" style="background-color:rgb(255, 128, 9);"></td></tr>
  </table>
  </fieldset>
  </form>
</div>  

  <form  method="post" action="">
  <fieldset id='inner2'>
  <legend>Contact support</legend>
  <table>
  <tr id="message"><td>Your Message </td></tr>
  <tr id="messagearea"><td><textarea></textarea></td></tr>
  <tr><td><button type="button" id="bottona" onclick="idghatyadharsupport()" style="background-color:rgb(255, 128, 9);color:white;">Contact Now</button></td></tr>
  <tr id="message3"><td><input type="submit" value="send"  style="background-color:rgb(255, 128, 9); color:white;"> </td></tr>
  
</table>
  </fieldset>
  </form>

<?php
$s=$_SESSION['login'];
//partia ta3 modification dial les donnees liwst tableau acount
if(isset($_POST['passwordbtn'])||isset($_POST['emailbtn'])||isset($_POST['delete'])){

if(isset($_POST['passwordbtn'])){//parti modification password
  if($_POST['npas']!=$_POST['npas2'])
  echo"<script>alert('Password doesnt match');window.location.replace('setting.php');</script>";
  else{
  $pw=$_POST['cpas'];
$q="SELECT * FROM acount where pasword='$pw'";
$res=$pdo->query($q);
$verif=$res->rowCount();

if($verif>0){
$newpas=$_POST['npas2'];
$edit="UPDATE acount set pasword='$newpas' WHERE pasword='$pw' ";
$pdo->exec($edit);
echo"<script>alert('password changed successfully'); window.location.replace('setting.php');</script>";

}
else
echo"<script>alert('wrong password, enter the right password to make changes'); window.location.replace('setting.php');</script>";

}

}


if(isset($_POST['emailbtn'])){//parti modification email
  $currentmail=$_POST['cmail'];
$mailsearch="SELECT * from acount where email='$currentmail'";
$result=$pdo->query($mailsearch);
$nrows=$result->rowCount();
if($nrows>0){
$pd=$_POST['mailpw'];
$pswrdverif="SELECT * FROM acount where pasword='$pd'";
$result=$pdo->query($pswrdverif);
$nrows=$result->rowCount();
if($nrows>0){

$email=$_POST['nmail'];
$verif="SELECT * from acount where email='$email'";
$mailexist=$pdo->query($verif);
$v=$mailexist->rowCount();


if($v==0){
$q="UPDATE acount set email='$email' where email='$currentmail'";
$pdo->exec($q);
echo"<script>alert('Email changed successfully'); window.location.replace('setting.php');</script>";
}
else{
echo"<script>alert('the new email you entered is already used by aother user'); window.location.replace('setting.php');</script>";  
}

}
else{

  echo"<script>alert('wrong password, enter the right one to make changes'); window.location.replace('setting.php');</script>";
}
}
else{
  echo"<script>alert('email  doesnt exists'); window.location.replace('setting.php');</script>";

}





}

if(isset($_POST['delete'])){//partie ta3 delete account
$pw=$_POST['pw'];
$q="SELECT * from acount where pasword='$pw'";
$res=$pdo->query($q);
$nres=$res->rowCount();
if($nres>0){
$qr="DELETE from acount where pasword='$pw' and user like '$s'";
$pdo->exec($qr);
echo"<script>alert('account deleted successfully'); window.location.href='index.php';</script>";

}
else{
  echo"<script>alert('wrong password'); window.location.replace('setting.php');</script>";

}





}


}






?>

  






</body>
</html>