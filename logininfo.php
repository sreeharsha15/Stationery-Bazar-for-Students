<?php require "connection.php"; ?>
<?php require "adminUserData.php"; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <title>LoginInfo</title>
    <style>
      .table{
        margin-top: 30px;
        width:80%;
        margin-left:auto;
        margin-right:auto;
      }
      .thea{
        background-color : black;
        color : white;
      }
      .heading{
        text-align: center;
        margin-top:20px;
      }
      #hm{
        margin-top: 15px;
      }
      #ad{
        margin-top: 15px;
      }
    </style>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <nav class="navbar  navbar-expand-lg  navbar-dark "style="background-color:#0e49b5">
      <div class="container-fluid">
        <a class="navbar-brand" href="admin.html" >Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" id="hm" aria-current="page" href="products.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active"id="ad" href="report.php">Report</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active"id="ad" href="users.php">Users</a>
            </li>
            <li class="nav-item dropdown dropstart">
            <img class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" src="prof.png" />
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li>
                  <button type="button" class="btn btn-light"><a href="logout-admin.php">Logout</a></button>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div>
    <h3 class="heading">
      LoginInfo
    </h3>
    <table class="table table-striped table-hover" id="td">
      <thead class='thea'>
        <tr>
          <th scope="col">Login-Id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Date-Time</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query="SELECT * FROM logininfo";
        $query_run= mysqli_query($con,$query);
        $check_ap= mysqli_num_rows($query_run)>0;
        if($check_ap){
          while($row= mysqli_fetch_assoc($query_run)){
         ?>
        <tr>
          <td><?php echo $row['loginid'];?></td>
          <td><?php echo $row['name'];?></td>
          <td><?php echo $row['email'];?></td>
          <td><?php echo $row['dttm'];?></td>
          <form  action="adminUserData.php" method="POST">
            <input type='hidden' name='log_id' value="<?php echo $row['loginid']; ?>"/>
            <td><button type="submit" class="btn btn-outline-danger btn-sm" name='logdel'> X </button></td>
          </form>
        </tr>
        <?php
      }
    }
  ?>
      </tbody>
    </table>
    </div>
  </body>
</html>
