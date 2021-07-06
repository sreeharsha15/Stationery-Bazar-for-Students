<?php require "controllerUserData.php" ?>
<?php require "connection.php" ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <style>
      h5{
        color:#0e49b5;
      }
      .thea{
        background-color: black;
        color: white ;
      }
    </style>
    <meta charset="utf-8">
    <title>Requests</title>
  </head>
  <body>
    <nav class="navbar  navbar-expand-lg  navbar-dark "style="background-color:#0e49b5">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Products</a>
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
          <li class="nav-item">
            <a class="nav-link active"id="ad" href="showproducts.php">Products</a>
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
    <div class="card h-100">
      <div class="card-body">
        <div class="row gutters">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <h5>Requests-Sent</h5>
            <table class="table table-striped table-hover table-responsive" id="td">
              <thead class='thea'>
                <tr>
                  <th scope="col">Req-Id</th>
                  <th scope="col">Ad-Id</th>
                  <th scope="col">Seller-Name</th>
                  <th scope="col">Type</th>
                  <th scope="col">Remove</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $email = $_SESSION['email'];
                $query="SELECT * FROM request WHERE reqemail='$email'";
                $query_run= mysqli_query($con,$query);
                $check_ap= mysqli_num_rows($query_run)>0;
                if($check_ap){
                  while($row= mysqli_fetch_assoc($query_run)){
                 ?>
                <tr>
                  <td><?php echo $row['rid'];?></td>
                  <td><?php echo $row['adid'];?></td>
                  <td><?php echo $row['accpname'];?></td>
                  <td><?php echo $row['type'];?></td>
                  <form method="POST" action="controllerUserData.php">
                    <input type="hidden" name="seda" value="<?php echo $row['rid']; ?>">
                    <td><button type="submit" name="req_del" class="btn btn-outline-danger btn-sm"> x </button></td>
                  </form>
                </tr>
                <?php
              }
            }
          ?>
              </tbody>
            </table>
            <h5>Requests-Received</h5>
            <table class="table table-striped table-hover table-responsive" id="td">
              <thead class='thea'>
                <tr>
                  <th scope="col">Req-Id</th>
                  <th scope="col">Ad-Id</th>
                  <th scope="col">Buyer-Name</th>
                  <th scope="col">Type</th>
                  <th scope="col">Accept</th>
                  <th scope="col">Reject</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $email = $_SESSION['email'];
                $query="SELECT * FROM request WHERE accpemail='$email'";
                $query_run= mysqli_query($con,$query);
                $check_ap= mysqli_num_rows($query_run)>0;
                if($check_ap){
                  while($row= mysqli_fetch_assoc($query_run)){
                 ?>
                <tr>
                  <td><?php echo $row['rid'];?></td>
                  <td><?php echo $row['adid'];?></td>
                  <td><?php echo $row['reqname'];?></td>
                  <td><?php echo $row['type'];?></td>
                  <form method="POST" action="controllerUserData.php">
                    <input type="hidden" name="rid" value="<?php echo $row['rid'] ;?>">
                    <td><button type="submit" name="accept_a" class="btn btn-outline-success btn-sm"> y </button></td>
                    <td><button type="submit" name="reject_a" class="btn btn-outline-danger btn-sm"> x </button></td>
                  </form>
                </tr>
                <?php
              }
            }
          ?>
      </tbody>
    </table>
    <h5>Requests-Accepted</h5>
    <table class="table table-striped table-hover table-responsive" id="td">
      <thead class='thea'>
        <tr>
          <th scope="col">Req-Id</th>
          <th scope="col">Ad-Id</th>
          <th scope="col">Seller-Name</th>
          <th scope="col">Seller-Email</th>
          <th scope="col">Seller-phone</th>
          <th scope="col">Type</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $email = $_SESSION['email'];
        $query="SELECT * FROM acceptreq WHERE reemail='$email'";
        $query_run= mysqli_query($con,$query);
        $check_ap= mysqli_num_rows($query_run)>0;
        if($check_ap){
          while($row= mysqli_fetch_assoc($query_run)){
         ?>
        <tr>
          <td><?php echo $row['rid'];?></td>
          <td><?php echo $row['adid'];?></td>
          <td><?php echo $row['acname'];?></td>
          <td><?php echo $row['accemail'];?></td>
          <td><?php echo $row['accphone'];?></td>
          <td><?php echo $row['type']; ?></td>
        </tr>
        <?php
      }
    }
  ?>
</tbody>
</table>
<h5>Requests-Rejected</h5>
<table class="table table-striped table-hover table-responsive" id="td">
  <thead class='thea'>
    <tr>
      <th scope="col">Req-Id</th>
      <th scope="col">Ad-Id</th>
      <th scope="col">Buyer-Name</th>
      <th scope="col">Buyer-Email</th>
      <th scope="col">Type</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $email = $_SESSION['email'];
    $query="SELECT * FROM rejectreq WHERE reqemail='$email'";
    $query_run= mysqli_query($con,$query);
    $check_ap= mysqli_num_rows($query_run)>0;
    if($check_ap){
      while($row= mysqli_fetch_assoc($query_run)){
     ?>
    <tr>
      <td><?php echo $row['rid'];?></td>
      <td><?php echo $row['adid'];?></td>
      <td><?php echo $row['reqname'];?></td>
      <td><?php echo $row['reqemail'];?></td>
      <td><?php echo $row['type'];?></td>
    </tr>
    <?php
  }
}
?>
</tbody>
</table>
<h5>Requests-Accepted</h5>
<table class="table table-striped table-hover table-responsive" id="td">
  <thead class='thea'>
    <tr>
      <th scope="col">Req-Id</th>
      <th scope="col">Ad-Id</th>
      <th scope="col">Buyer-Name</th>
      <th scope="col">Buyer-Email</th>
      <th scope="col">Buyer-phone</th>
      <th scope="col">Type</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $email = $_SESSION['email'];
    $query="SELECT * FROM acceptreq WHERE reemail='$email'";
    $query_run= mysqli_query($con,$query);
    $check_ap= mysqli_num_rows($query_run)>0;
    if($check_ap){
      while($row= mysqli_fetch_assoc($query_run)){
     ?>
    <tr>
      <td><?php echo $row['rid'];?></td>
      <td><?php echo $row['adid'];?></td>
      <td><?php echo $row['acname'];?></td>
      <td><?php echo $row['accemail'];?></td>
      <td><?php echo $row['accphone'];?></td>
      <td><?php echo $row['type']; ?></td>
    </tr>
    <?php
  }
}
?>
</tbody>
</table>
</div>
</div>
</div>
</div>
  </body>
</html>
