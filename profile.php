<?php require 'connection.php'; ?>
<?php require 'controllerUserData.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <meta charset="utf-8">
    <title></title>
    <style>
      body {
    margin: 0;
    color: #2e323c;
    background: #f5f6fa;
    position: relative;
    height: 100%;
    font-family: "Ubuntu";
}
.account-settings .user-profile {
    margin: 0 0 1rem 0;
    padding-bottom: 1rem;
    text-align: center;
}
.account-settings .user-profile .user-avatar {
    margin: 0 0 1rem 0;
}
.account-settings .user-profile .user-avatar img {
    width: 90px;
    height: 90px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
}
.account-settings .user-profile h5.user-name {
    margin: 0 0 0.5rem 0;
}
.account-settings .user-profile h6.user-email {
    margin: 0;
    font-size: 0.8rem;
    font-weight: 400;
    color: #9fa8b9;
}
.account-settings .about {
    margin: 2rem 0 0 0;
    text-align: center;
}
.account-settings .about h5 {
    margin: 0 0 15px 0;
    color: #0e49b5;
}
.account-settings .about p {
    font-size: 0.825rem;
}
.form-control {
    border: 1px solid #cfd1d8;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    font-size: .825rem;
    background: #ffffff;
    color: #2e323c;
}
.heading{
  margin-bottom:10px;
  margin-top:20px;
  color:#0e49b5;
}
.card {
    background: #ffffff;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    border: 0;
    margin-bottom: 1rem;
}
    </style>
  </head>
  <body>
    <nav class="navbar  navbar-expand-lg  navbar-dark "style="background-color:#0e49b5">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Profile</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" id="hm" aria-current="page" href="index1.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active"id="ad" href="postad.php">PostAd</a>
          </li>
          <li class="nav-item dropdown dropstart">
          <img class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" src="prof.png" />
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="profile.php">Profile</a></li>
              <li><a class="dropdown-item" href="requets.php">Requests</a></li>
              <li>
                <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="
    <div class="container">
      <div class="row gutters">
      <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
      <div class="card h-100">
      	<div class="card-body">
      		<div class="account-settings">
      			<div class="user-profile">
      				<div class="user-avatar">
      					<img src="profi.png" alt="profile">
      				</div>
              <?php
              $email=$_SESSION['email'];
              $query="SELECT * FROM usertab WHERE email='$email'";
              $query_run= mysqli_query($con,$query);
              $check_ap= mysqli_num_rows($query_run)>0;
              if($check_ap){
                while($row= mysqli_fetch_assoc($query_run)){
               ?>
      				<h5 class="user-name"><?php echo $row['name'] ?></h5>
      			</div>
            <?php
          }
        }
        ?>
      			<div class="about">
                  <button type="submit" id="submit" class="btn btn-secondary" onclick="location.href='requets.php';">Requests</button>
            </div>
      		</div>
      	</div>
      </div>
      </div>
      <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
      <div class="card h-100">
      	<div class="card-body">
      		<div class="row gutters">
      			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      				<h4 class="mb-2 text-primary" style="color:#0e49b5;">Personal Details</h4>
      			</div>
            <?php
            $email=$_SESSION['email'];
            $query="SELECT * FROM usertab WHERE email='$email'";
            $query_run= mysqli_query($con,$query);
            $check_ap= mysqli_num_rows($query_run)>0;
            if($check_ap){
              while($row= mysqli_fetch_assoc($query_run)){
             ?>
      			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="form-group">
                <label for="phone"><h6><u>PROFILE-ID</u></h6></label>
                <p>
                  <?php echo "SM".$row['id']; ?>
                </p>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        				<div class="form-group">
        					<label for="eMail"><h6><u>EMAIL</u></h6></label>
        					<p>
                    <?php echo $row['email'];?>
                  </p>
                </div>
      				<div class="form-group">
      					<label for="fullName"><h6><u>FULL NAME</u></h6></label>
                <p>
                  <?php echo $row['name']; ?>
                </p>
      				</div>
      			</div>
      			</div>
      			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
      			</div>
      			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
      				<div class="form-group">
      					<label for="website"><h6><u>GENDER</u></h6></label>
                <p style="color:">
                    <?php echo $row['gender']; ?>
                </p>
      				</div>
      			</div>
      		</div>
          <div>
          <h3 style="text-align:center;margin-bottom:20px;margin-top:10px;color:#0e49b5;">
            <u>MyADs</u>
          </h3>
          <h5 class="heading" style="color:#0e49b5;">
            Aprons
          </h5>
          <table class="table table-striped table-hover table-responsive" id="td">
            <thead class='thea'>
              <tr>
                <th scope="col">AD-Id</th>
                <th scope="col"+>Title</th>
                <th scope="col">Descrip</th>
                <th scope="col">Type</th>
                <th scope="col">Price</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php

              $query="SELECT * FROM apron WHERE email='$email'";
              $query_run= mysqli_query($con,$query);
              $check_ap= mysqli_num_rows($query_run)>0;
              if($check_ap){
                while($row= mysqli_fetch_assoc($query_run)){
                  $del=$row['id'];
               ?>
              <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['title'];?></td>
                <td><?php echo $row['descrip'];?></td>
                <td><?php echo $row['type'];?></td>
                <td><?php echo $row['price'];?></td>
                <form method="POST" action="controllerUserData.php">
                  <input type="hidden" name="user_del" value="<?php echo $row['id']; ?>">
                  <td><button type="submit" name="adel" class="btn btn-outline-danger btn-sm"> x </button></td>
                </form>
              </tr>
              <?php
            }
          }
        ?>
            </tbody>
          </table>
          <h5 class="heading">
            Books
          </h5>
          <table class="table table-striped table-hover table-responsive" id="td">
            <thead class='thea'>
              <tr>
                <th scope="col">AD-Id</th>
                <th scope="col">Title</th>
                <th scope="col">Descrip</th>
                <th scope="col">Type</th>
                <th scope="col">Price</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php

              $query="SELECT * FROM books WHERE email='$email'";
              $query_run= mysqli_query($con,$query);
              $check_ap= mysqli_num_rows($query_run)>0;
              if($check_ap){
                while($row= mysqli_fetch_assoc($query_run)){
                  $del=$row['id'];
               ?>
              <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['title'];?></td>
                <td><?php echo $row['descrip'];?></td>
                <td><?php echo $row['type'];?></td>
                <td><?php echo $row['price'];?></td>
                <form method="POST" action="profile.php">
                  <input type="hidden" name="book_del" value="<?php echo $row['id']; ?>">
                <td><button type="submit" name="bdel" class="btn btn-outline-danger btn-sm"> x </button></td>
              </form>
              </tr>
              <?php
            }
          }
        ?>
            </tbody>
          </table>
          <h5 class="heading" style="margin-bottom:10px;margin-top:20px;color:#0e49b5;">
            Stationery
          </h5>
          <table class="table table-striped table-hover table-responsive" id="td">
            <thead class='thea'>
              <tr>
                <th scope="col">AD-Id</th>
                <th scope="col">Title</th>
                <th scope="col">Descrip</th>
                <th scope="col">Type</th>
                <th scope="col">Price</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php

              $query="SELECT * FROM stn WHERE email='$email'";
              $query_run= mysqli_query($con,$query);
              $check_ap= mysqli_num_rows($query_run)>0;
              if($check_ap){
                while($row= mysqli_fetch_assoc($query_run)){
                  $del=$row['id'];
               ?>
              <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['title'];?></td>
                <td><?php echo $row['descrip'];?></td>
                <td><?php echo $row['type'];?></td>
                <td><?php echo $row['price'];?></td>
                <form method="POST" action="profile.php">
                  <input type="hidden" name="stn_del" value="<?php echo $row['id']; ?>">
                <td><button type="submit" name="sdel" class="btn btn-outline-danger btn-sm"> x </button></td>
              </form>
              </tr>
              <?php
            }
          }
        ?>
            </tbody>
          </table>
          </div>
    </div>
  </body>
  <?php
}
}
 ?>
</html>
