<?php
require "connection.php";
session_start();
session_regenerate_id(true);
$email = "";
$name = "";
$errors = array();



if(isset($_POST['admin_login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $check_email = "SELECT * FROM admin WHERE uname = '$email'";
    $res = mysqli_query($con, $check_email);
    $email_count=mysqli_num_rows($res);
    if($email_count){
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['password'];
        if($fetch_pass===$password){
            $_SESSION['email'] = $email;
            header("location:admin.html");
          }
        else{
          $errors['email'] = "Incorrect password!";
        }
        }
        else{
        $errors['email'] = "Incorrect Username!";
    }
}
if(isset($_POST['logdel']))
{
  $logid=$_POST['log_id'];
  $que= "DELETE FROM logininfo WHERE loginid ='$logid' ";
  $qr = mysqli_query($con,$que);
  if($qr)
  {
    header("location:logininfo.php");
  }
  else
  {
    echo '<script>alert("Failed while deleting");</script>';
    header("location:logininfo.php");
  }
}
if(isset($_POST['repdel']))
{
  $logid=$_POST['rep_id'];
  $que= "DELETE FROM `report` WHERE reportid ='$logid' ";
  $qr = mysqli_query($con,$que);
  if($qr)
  {
    header("location:report.php");
  }
  else
  {
    echo '<script>alert("Failed while deleting");</script>';
    header("location:report.php");
  }
}
if(isset($_POST['userdel']))
{
  $logid=$_POST['user_id'];
  $que= "DELETE FROM `usertab` WHERE id ='$logid' ";
  $qr = mysqli_query($con,$que);
  if($qr)
  {
    header("location:users.php");
  }
  else
  {
    echo '<script>alert("Failed while deleting");</script>';
    header("location:users.php");
  }
}
if(isset($_POST['apdel']))
{
  $logid=$_POST['ap_id'];
  $que= "DELETE FROM apron WHERE id ='$logid' ";
  $qr = mysqli_query($con,$que);
  if($qr)
  {
    header("location:products.php");
  }
  else
  {
    echo '<script>alert("Failed while deleting");</script>';
    header("location:products.php");
  }
}
if(isset($_POST['bodel']))
{
  $logid=$_POST['bo_id'];
  $que= "DELETE FROM books WHERE id ='$logid' ";
  $qr = mysqli_query($con,$que);
  if($qr)
  {
    header("location.products.php");
  }
  else
  {
    echo '<script>alert("Failed while deleting");</script>';
    header("location:products.php");
  }
}if(isset($_POST['stndel']))
{
  $logid=$_POST['stn_id'];
  $que= "DELETE FROM stn WHERE id ='$logid' ";
  $qr = mysqli_query($con,$que);
  if($qr)
  {
    header("location:products.php");
  }
  else
  {
    echo '<script>alert("Failed while deleting");</script>';
    header("location:products.php");
  }
}
if(isset($_POST['adminaccept']))
{
  $ty=$_POST['ap_ty'];
  $id=$_POST['apid'];
  $queri="SELECT * FROM adaccept WHERE id='$id'";
  $querirun=mysqli_query($con,$queri);
  $row=mysqli_fetch_assoc($querirun);
  $nam=$row['name'];
  $tit=$row['title'];
  $email=$row['email'];
  $desc=$row['descrip'];
  $price=$row['price'];
  $destinationfile=$row['image'];
  if($querirun){
    if($ty=="Apron"){
      $insert_data = "INSERT INTO apron (title, email, image, descrip,type,name,price)
                      values('$tit', '$email','$destinationfile','$desc', '$ty','$nam',$price)";
      $data_check = mysqli_query($con, $insert_data);
      if($data_check){
        $re="DELETE FROM adaccept WHERE id='$id'";
        $teye=mysqli_query($con,$re);
        header("location:adminaccad.php");
      }
    }
    elseif($ty=="Stationery")
    {
      $insert_data = "INSERT INTO stn (title, email, image, descrip,type,name,price)
                      values('$tit', '$email','$destinationfile','$desc', '$ty','$nam','$price')";
      $data_check = mysqli_query($con, $insert_data);
      if($data_check){
        $re="DELETE FROM adaccept WHERE id='$id'";
        $teye=mysqli_query($con,$re);
        header("location:adminaccad.php");
      }
    }
    elseif($ty=="Books")
    {
      $insert_data = "INSERT INTO books (title, email, image, descrip,type,name,price)
                      values('$tit', '$email', '$destinationfile','$desc', '$ty','$nam','$price')";
      $data_check = mysqli_query($con, $insert_data);
      if($data_check){
        $re="DELETE FROM adaccept WHERE id='$id'";
        $teye=mysqli_query($con,$re);
          header("location:adminaccad.php");
      }
    }
  }
}


if(isset($_POST['adminreject']))
{
  $id=$_POST['idap'];
  $qr="DELETE FROM adaccept WHERE id='$id'";
  $qrun=mysqli_query($con,$qr);
  if($qrun)
  {
    $email=$_POST['uemail'];
    $subject = "Regarding AD Posting";
    $message = "Dear User,

We have detected that your posting non relavent ADs on our website. So we are not gonna accept the AD you have posted.
Futher posting of such ADs may lead to your account deactivation and we hope that you wont repeat it once again.

Regards,
Admin.";
    $sender = "From: studentmarket.sp@gmail.com";
    mail($email, $subject, $message, $sender);
    echo "<script>alert('Deleted successfully'); location:'adminaccad.php';</script>";
  }
}
