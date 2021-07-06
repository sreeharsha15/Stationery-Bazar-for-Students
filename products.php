<?php require "connection.php"; ?>
<?php require "adminUserData.php" ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <title>Products</title>
    <style>
      .table{
        margin-top: 30px;
        width: 70%;
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
      #td{
        align-items: center;
      }
      @media(max-width:500px) {
        .table{
          width: 50%;
          margin-left:auto;
          margin-right:auto;
      }
    }
    </style>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <nav class="navbar  navbar-expand-lg  navbar-dark "style="background-color:#0e49b5">
      <div class="container-fluid">
        <a class="navbar-brand" href="admin.html">Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active"id="ad" href="logininfo.php">logininfo</a>
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
      ApronsAD
    </h3>
    <table class="table table-striped table-hover table-responsive" id="td">
      <thead class='thea'>
        <tr>
          <th scope="col">ApronAD-Id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Title</th>
          <th scope="col">Descrip</th>
          <th scope="col">Type</th>
          <th scope="col">Price</th>
          <th scope="col">Img</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query="SELECT * FROM apron";
        $query_run= mysqli_query($con,$query);
        $check_ap= mysqli_num_rows($query_run)>0;
        if($check_ap){
          while($row= mysqli_fetch_assoc($query_run)){
            $del=$row['id'];
         ?>
        <tr>
          <td><?php echo $row['id'];?></td>
          <td><?php echo $row['name'];?></td>
          <td><?php echo $row['email'];?></td>
          <td><?php echo $row['title'];?></td>
          <td><?php echo $row['descrip'];?></td>
          <td><?php echo $row['type'];?></td>
          <td><?php echo $row['price'];?></td>
          <td id="td"><img src="<?php echo $row["image"]; ?>" width="100px" height="100px" alt="apronimg"></td>
          <form class="" action="products.php" method="post">
            <input type='hidden' name='ap_id' value="<?php echo $row['id']; ?>"/>
            <td><button type="submit" class="btn btn-outline-danger btn-sm" name='apdel'> X </button></td>
          </form>
        </tr>
        <?php
      }
    }
  ?>
      </tbody>
    </table>
    </div>
    <div>
    <h3 class="heading">
      BooksAD
    </h3>
    <table class="table table-striped table-hover table-responsive" id="td">
      <thead class='thea'>
        <tr>
          <th scope="col">BookAD-Id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Title</th>
          <th scope="col">Descrip</th>
          <th scope="col">Type</th>
          <th scope="col">Price</th>
          <th scope="col">Image</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query="SELECT * FROM books";
        $query_run= mysqli_query($con,$query);
        $check_ap= mysqli_num_rows($query_run)>0;
        if($check_ap){
          while($row= mysqli_fetch_assoc($query_run)){
         ?>
        <tr>
          <td><?php echo $row['id'];?></td>
          <td><?php echo $row['name'];?></td>
          <td><?php echo $row['email'];?></td>
          <td><?php echo $row['title'];?></td>
          <td><?php echo $row['descrip'];?></td>
          <td><?php echo $row['type'];?></td>
          <td><?php echo $row['price'];?></td>
          <td id="td"><img id="img" src="<?php echo $row["image"]; ?>" width="100px" height="100px" alt="apronimg"></td>
          <form class="" action="products.php" method="post">
            <input type='hidden' name='bo_id' value="<?php echo $row['id']; ?>"/>
            <td><button type="submit" class="btn btn-outline-danger btn-sm" name='bodel'> X </button></td>
          </form>
        </tr>
        <?php
      }
    }
  ?>
      </tbody>
    </table>
    </div>
    <div>
    <h3 class="heading">
      StationeryAD
    </h3>
    <table class="table table-striped table-hover table-responsive" id="td">
      <thead class='thea'>
        <tr>
          <th scope="col">StationeryAD-Id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Title</th>
          <th scope="col">Descrip</th>
          <th scope="col">Type</th>
          <th scope="col">Price</th>
          <th scope="col">Image</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query="SELECT * FROM stn";
        $query_run= mysqli_query($con,$query);
        $check_ap= mysqli_num_rows($query_run)>0;
        if($check_ap){
          while($row= mysqli_fetch_assoc($query_run)){
         ?>
        <tr>
          <td><?php echo $row['id'];?></td>
          <td><?php echo $row['name'];?></td>
          <td><?php echo $row['email'];?></td>
          <td><?php echo $row['title'];?></td>
          <td><?php echo $row['descrip'];?></td>
          <td><?php echo $row['type'];?></td>
          <td><?php echo $row['price'];?></td>
          <td id="td"><img id="img" src="<?php echo $row["image"]; ?>" width="100px" height="100px" alt="apronimg"></td>
          <form class="" action="products.php" method="post">
            <input type='hidden' name='stn_id' value="<?php echo $row['id']; ?>"/>
            <td><button type="submit" class="btn btn-outline-danger btn-sm" name='stndel'> X </button></td>
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
