<?php
require "connection.php";
session_start();
session_regenerate_id(true);
$email = "";
$name = "";
$errors = array();

//if user signup button
if(isset($_POST['signup'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $gender = mysqli_real_escape_string($con, $_POST['gen']);
    $phone=mysqli_real_escape_string($con,$_POST['phon']);
    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }
    $email_check = "SELECT * FROM usertab WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO usertab (name, email, password, code, status,gender,phonenum)
                        values('$name', '$email', '$encpass', '$code', '$status','$gender','$phone')";
        $data_check = mysqli_query($con, $insert_data);
        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: studentmarket.sp@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
          }
          else{
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }

}
    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertab WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE usertab SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: login-user.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click login button

    if(isset($_POST['loginuser']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $check_email = "SELECT * FROM usertab WHERE email = '$email'";
        $res = mysqli_query($con, $check_email);
        $email_count=mysqli_num_rows($res);
        if($email_count){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            $pass_decode = password_verify($password, $fetch_pass);
            if($pass_decode){
                $_SESSION['email'] = $email;
                $status = $fetch['status'];
                if($status == 'verified'){
                  $n = "SELECT `name` FROM `usertab` WHERE `email`='$email'";
                  $q = mysqli_query($con,$n);
                  $res = mysqli_fetch_assoc($q);
                  $name = $res['name'];
                  date_default_timezone_set('Asia/Kolkata');
                  $insert_data="INSERT INTO logininfo (`name`, `email`) VALUES ('$name', '$email')";
                  $data_check = mysqli_query($con, $insert_data);
                  if($data_check){
                    echo "Loged in successfully";
                    header('location: showproducts.php');
                  }
                }
                else{
                  $info = "It's look like you haven't still verify your email - $email";
                  $_SESSION['info'] = $info;
                  header('location: user-otp.php');
                }
              }
              else{
                $errors['email'] = "Incorrect email or password!";
            }
            }
            else{
            $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
        }
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM usertab WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE usertab SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: studentmarket.sp@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a passwrod reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertab WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE usertab SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }

   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: login-user.php');
    }

    //if postad button clicked
    if(isset($_POST['upload'])){
        $fn= mysqli_real_escape_string($con, $_POST['un']);
        $title = mysqli_real_escape_string($con, $_POST['title']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $desc = mysqli_real_escape_string($con, $_POST['descr']);
        $rad = mysqli_real_escape_string($con, $_POST['val']);
        $pri = mysqli_real_escape_string($con, $_POST['pr']);
        $files = $_FILES["files"];
        $filename = $files['name'];
        $fileerror = $files['error'];
        $filetmp = $files["tmp_name"];
        $filetext= explode('.',$filename);
        $filecheck = strtolower(end($filetext));
        $fileextstored = array('png','jpg','jpeg');
        if(in_array($filecheck,$fileextstored))
        {
          $destinationfile = "uploadimg/".$filename;
          move_uploaded_file($filetmp,$destinationfile);
          if(count($errors) === 0 and $_SESSION['email'] == $email)
          {
            $insert="INSERT INTO `adaccept`(`name`, `title`, `email`, `descrip`, `type`, `price`, `image`)
                      VALUES ('$fn','$title','$email','$desc','$rad','$pri','$destinationfile')";
            $qtry=mysqli_query($con,$insert);
            if($qtry){
              $email="studentmarket.admn@gmail.com";
              $subject = "Regarding AD Posting";
              $message = "Hello Admin,

Someone has added their products for AD, Please Verify it.

Regards,
Team StudentMarket.";
              $sender = "From: studentmarket.sp@gmail.com";
              mail($email, $subject, $message, $sender);
              echo '<script>alert("AD Added Successfully ADmin review it and accept it"); window.location:"showproducts.php";</script>';
            }
          }
          else{
                  $errors['db-error'] = "Failed while inserting data into database!";
                  echo '<script>alert("Please Enter registered email");</script>';
              }
        }
      }






      /*
      if($rad=="Apron"){
        $insert_data = "INSERT INTO apron (title, email, image, descrip,type,name,price)
                        values('$title', '$email','$destinationfile','$desc', '$rad','$fn',$pri)";
        $data_check = mysqli_query($con, $insert_data);
      }
      elseif($rad=="Stationery")
      {
        $insert_data = "INSERT INTO stn (title, email, image, descrip,type,name,price)
                        values('$title', '$email', '$destinationfile','$desc', '$rad','$fn','$pri')";
        $data_check = mysqli_query($con, $insert_data);
      }
      elseif($rad=="Books")
      {
        $insert_data = "INSERT INTO books (title, email, image, descrip,type,name,price)
                        values('$title', '$email', '$destinationfile','$desc', '$rad','$fn','$pri')";
        $data_check = mysqli_query($con, $insert_data);
      }
      */






      if(isset($_POST['index_bt']))
      {
        if($_SESSION['email']!=null)
        {
          header("location:showproducts.php");
        }
        else{
          header("location:showproducts-nl.php");
        }

      }

      if(isset($_POST['report1'])){
        $aid= $_POST['rep_inp1'];
        if($_SESSION['email']!=null){
          $email1=$_SESSION['email'];
          $que_1 = "INSERT INTO `report`(`email`, `adid`, `type`) VALUES ('$email1','$aid','Apron')";
          $q=mysqli_query($con,$que_1);
          if($q===true)
          {
            echo '<script>alert("Successfully reported");</script>';
          }
          else{
            echo '<script>alert("Failed while reporting");</script>';
          }
        }
        else{
          header("location:login-user.php");
        }
      }


      if(isset($_POST['breport1'])){
        $aid= $_POST['rep_inp1'];
        if($_SESSION['email']!=null){
          $email1=$_SESSION['email'];
          $que_1 = "INSERT INTO `report`(`email`, `adid`, `type`) VALUES ('$email1','$aid','Book')";
          $q=mysqli_query($con,$que_1);
          if($q===true)
          {
            echo '<script>alert("Successfully reported");</script>';
          }
          else{
            echo '<script>alert("Failed while reporting");</script>';
            header('location:books.php');
          }
        }
        else{
          header("location:login-user.php");
        }
      }


      if(isset($_POST['sreport1'])){
        $aid= $_POST['rep_inp1'];
        if($_SESSION['email']!=null){
          $email1=$_SESSION['email'];
          $que_1 = "INSERT INTO `report`(`email`, `adid`, `type`) VALUES ('$email1','$aid','Stationery')";
          $q=mysqli_query($con,$que_1);
          if($q===true)
          {
            echo '<script>alert("Successfully reported");</script>';
          }
          else{
            echo '<script>alert("Failed while reporting");</script>';
            header('location:stationery.php');
          }
        }
        else{
          header("location:login-user.php");
        }
      }


      if(isset($_POST['adel']))
      {
        $daid=$_POST['user_del'];
        $yr="SELECT * FROM `request` WHERE adid='$daid'";
        $ii=mysqli_query($con,$yr);
        if(mysqli_num_rows($ii)>0){
          $oii="DELETE FROM request WHERE adid='$daid'";
          $ti=mysqli_query($con,$oii);
          if($ti)
          {
            $iu="DELETE FROM apron WHERE id='$daid'";
            $we=mysqli_query($con,$iu);
            header("location:profile.php");
          }
        }
        else
        {
          $iu="DELETE FROM apron WHERE id='$daid'";
          $we=mysqli_query($con,$iu);
          header("location:profile.php");
        }
      }
      if(isset($_POST['bdel']))
      {
        $daid=$_POST['book_del'];
        $yr="DELETE FROM request WHERE adid='$daid'";
        $ii=mysqli_query($con,$yr);
        if($ii){
          $oii="DELETE FROM books WHERE id='$daid'";
          header("location:profile.php");
        }
        else
        {
          echo '<script>alert("Failed while deleting");</script>';
          header("location:profile.php");
        }
      }
      if(isset($_POST['sdel']))
      {
        $daid=$_POST['stn_del'];
        $yr="DELETE FROM request WHERE adid='$daid'";
        $ii=mysqli_query($con,$yr);
          if($ii){
            $oii="DELETE FROM stn WHERE id='$daid'";
            header("location:profile.php");
          }
        else
        {
          echo '<script>alert("Failed while deleting");</script>';
          header("location:profile.php");
        }
      }

      if(isset($_POST['cnt_sell']))
      {
        $adid=$_POST['ad_id'];
        $que= "SELECT * FROM `apron` WHERE id ='$adid' ";
        $qr = mysqli_query($con,$que);
        $row= mysqli_fetch_assoc($qr);
        $remail=$_SESSION['email'];
        $acemail=$row['email'];
        $acname=$row['name'];
        $adtype=$row['type'];
        if($_SESSION['email']!=null and $remail!=$acemail)
        {
            $ye=" SELECT * FROM request WHERE adid='$adid' AND reqemail='$remail'";
            $y= mysqli_query($con,$ye);
            if(mysqli_num_rows($y)==0)
            {
              $qe= "SELECT * FROM `usertab` WHERE email ='$remail' ";
              $qyr = mysqli_query($con,$qe);
              $rows= mysqli_fetch_assoc($qyr);
              $rename=$rows['name'];
              $inq= "INSERT INTO `request`(`adid`, `reqemail`, `accpemail`, `reqname`, `accpname`, `type`) VALUES ('$adid','$remail','$acemail','$rename','$acname','$adtype')";
              $iqrun=mysqli_query($con,$inq);
              echo '<script>alert("Requested Successfully");</script>';
              $email=$acemail;
              $subject = "Regarding AD Posting";
              $message = "Dear User,

Someone Requested for the AD you have Posted.
Please Login to see details.

Regards,
Team StudentMarket.";
              $sender = "From: studentmarket.sp@gmail.com";
              mail($email, $subject, $message, $sender);
            }
            else{
              echo '<script>alert("Already Requested");</script>';
            }
          }
          else
          {
            echo '<script>alert("Cannot request to own AD");</script>';
          }
        }

        if(isset($_POST['bcnt_sell']))
        {
          $adid=$_POST['ad_id'];
          $que= "SELECT * FROM `books` WHERE id ='$adid' ";
          $qr = mysqli_query($con,$que);
          $row= mysqli_fetch_assoc($qr);
          $remail=$_SESSION['email'];
          $acemail=$row['email'];
          $acname=$row['name'];
          $adtype=$row['type'];
          if($_SESSION['email']!=null and $remail!=$acemail)
          {
            $ye="SELECT * FROM request WHERE adid='$adid' AND reqemail='$remail'";
            $y= mysqli_query($con,$ye);
            if(mysqli_num_rows($y) > 0)
            {
              echo '<script>alert("Already Requested");</script>';
            }
            else{
              $qe= "SELECT * FROM `usertab` WHERE email ='$remail' ";
              $qyr = mysqli_query($con,$qe);
              $rows= mysqli_fetch_assoc($qyr);
              $rename=$rows['name'];
              $inq= "INSERT INTO `request`(`adid`, `reqemail`, `accpemail`, `reqname`, `accpname`, `type`) VALUES ('$adid','$remail','$acemail','$rename','$acname','$adtype')";
              $iqrun=mysqli_query($con,$inq);
              $email=$acemail;
              $subject = "Regarding AD Posting";
              $message = "Dear User,

Someone Requested for the AD you have Posted.
Please Login to see the details.

Regards,
Team StudentMarket.";
              $sender = "From: studentmarket.sp@gmail.com";
              mail($email, $subject, $message, $sender);
              echo '<script>alert("Requested Successfully");</script>';
            }
          }
          else
          {
            echo '<script>alert("Cannot request to own AD");</script>';
          }
        }




          if(isset($_POST['scnt_sell']))
          {
            $adid=$_POST['ad_id'];
            $que= "SELECT * FROM `stn` WHERE id ='$adid' ";
            $qr = mysqli_query($con,$que);
            $row= mysqli_fetch_assoc($qr);
            $remail=$_SESSION['email'];
            $acemail=$row['email'];
            $acname=$row['name'];
            $adtype=$row['type'];
            if($_SESSION['email']!=null and $remail!=$acemail)
            {
              $ye=" SELECT * FROM request WHERE adid='$adid' AND reqemail='$remail'";
              $y= mysqli_query($con,$ye);
              if(mysqli_num_rows($y)==0)
              {
                $qe= "SELECT * FROM `usertab` WHERE email ='$remail' ";
                $qyr = mysqli_query($con,$qe);
                $rows= mysqli_fetch_assoc($qyr);
                $rename=$rows['name'];
                $inq= "INSERT INTO `request`(`adid`, `reqemail`, `accpemail`, `reqname`, `accpname`, `type`) VALUES ('$adid','$remail','$acemail','$rename','$acname','$adtype')";
                $iqrun=mysqli_query($con,$inq);
                $email=$acemail;
                $subject = "Regarding AD Posting";
                $message = "Dear User,

Someone Requested for the AD you have Posted.
Please Login to see details.

Regards,
Team StudentMarket.";
                $sender = "From: studentmarket.sp@gmail.com";
                mail($email, $subject, $message, $sender);
                echo '<script>alert("Requested Successfully");</script>';
              }
              else
              {
                echo '<script>alert("Already Requested");</script>';
              }
            }
            else
            {
              echo '<script>alert("Cannot request to own AD");</script>';
            }
          }


      if(isset($_POST['accept_a']))
      {
        $aemail=$_SESSION['email'];
        $r=$_POST['rid'];
        $rel="SELECT * FROM `request` WHERE rid='$r'";
        $ro=mysqli_query($con,$rel);
        $rqo=mysqli_fetch_assoc($ro);
        $a=$rqo['adid'];
        $acn=$rqo['accpname'];
        $reem=$rqo['reqemail'];
        $ty=$rqo['type'];
        if(mysqli_num_rows($ro)>0)
        {
          $qs="SELECT * FROM usertab WHERE email='$aemail'";
          $req=mysqli_query($con,$qs);
          $rq=mysqli_fetch_assoc($req);
          $acph=$rq['phonenum'];
          if(mysqli_num_rows($req)>0)
          {
            $pe="INSERT INTO `acceptreq`( `rid`, `adid`, `accemail`, `acname`,`reemail`,`accphone`,`type`)
            VALUES ('$r','$a','$aemail','$acn','$reem','$acph','$ty')";
            $e=mysqli_query($con,$pe);
            $email=$reem;
            $subject = "Regarding AD Posting";
            $message = "Dear User,

Someone Accepted your request for the AD.

Regards,
Team StudentMarket.";
            $sender = "From: studentmarket.sp@gmail.com";
            mail($email, $subject, $message, $sender);
            if($e)
            {
              $qre="DELETE FROM request WHERE rid='$r'";
              $f=mysqli_query($con,$qre);
              header("location:requets.php");
            }
          }
        }
      }
      if(isset($_POST['reject_a']))
      {
        $r=$_POST['rid'];
        $rel="SELECT * FROM `request` WHERE rid='$r'";
        $ro=mysqli_query($con,$rel);
        $rqo=mysqli_fetch_assoc($ro);
        $a=$rqo['adid'];
        $acn=$rqo['reqname'];
        $reem=$rqo['reqemail'];
        $ty=$rqo['type'];
        if(mysqli_num_rows($ro)>0)
        {
          $pe="INSERT INTO `rejectreq`( `rid`, `adid`, `reqemail`, `reqname`,`type`)
          VALUES ('$r','$a','$reem','$acn','$ty')";
          $e=mysqli_query($con,$pe);
          $email=$reem;
          $subject = "Regarding AD Posting";
          $message = "Dear User,

Someone Rejected the Request for the AD you have requested.
Please Login to see details.

Regards,
Team StudentMarket.";
          $sender = "From: studentmarket.sp@gmail.com";
          mail($email, $subject, $message, $sender);
          if($e)
          {
            $qre="DELETE FROM request WHERE rid='$r'";
            $f=mysqli_query($con,$qre);
            header("location:requets.php");
          }
        }
      }
      if(isset($_POST['req_del']))
      {
        $seda=$_POST['seda'];
        $quer=" DELETE FROM request WHERE rid='$seda'";
        $quep=mysqli_query($con,$quer);
        header("location:requets.php");
      }
      if(isset($_POST['nl_arep']))
      {
        echo '<script>alert("Login to report");</script>';
        header('location:login-user.php');
      }
      if(isset($_POST['nl-acs']))
      {
        echo '<script>alert("Log in to conatct");</script>';
        header("location:login-user.php");
      }
?>
