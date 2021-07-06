<?php require "connection.php"; ?>
<?php require "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en".s3 dir="ltr">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="">
    <meta charset="utf-8">
    <title></title>
    <style>
    html {
      box-sizing: border-box;
    }

    *, *:before, *:after {
      box-sizing: inherit;
    }
    .column1 {
      float: left;
      width: 25%;
      margin-bottom: 16px;
      padding: 0 8px;
    }
    .btn1{
      border: none;
      outline: 0;
      font-weight: bold;
      display: inline-block;
      padding: 8px;
      color: white;
      background-color:#132c33;
      text-align: center;
      cursor: pointer;
      width: 100%;
      margin-bottom: 10px;
    }
    .btn1:hover {
      background-color: #0e6eb5;
    }
    .card1 {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      margin: 8px;
    }
    .container1 {
      padding: 0 16px;
    }

    .container1::after, .row::after {
      content: "";
      clear: both;
      display: table;
    }

    .title {
      color: grey;
    }
    body{
      font-family: "Ubuntu",sans-serif;
    }
    .column1 {
      float: left;
      width: 25%;
      padding: 0 8px;
      margin-bottom: 16px;
    }

    .card1 {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      margin: 8px;
    }
    .container1 {
      padding: 0 16px;
    }
    .container1::after, .row::after {
      content: "";
      clear: both;
      display: table;
    }
    .bottom{
      display: grid;
      background-color: #2d4059;
      grid-template-columns: 2fr 1.65fr 1fr;
      padding-top: 20px;
      color: #fdfdfd;
      padding-bottom: 30px;

    }

    .Link{
      color:#ffffff;
    }
    #hm{
      margin-top: 15px;
    }
    #ad{
      margin-top: 15px;
    }
    .col1
    {
      padding-left: 50px;
    }
    @media(max-width: 650px) {
      .column1 {
        width: 100%;
        display: block;
      }
      img{
        width: 100%;
        height: 100%;
      }
    }
    @media(max-width: 1200px) {
      img{
        width: 100%;
        height: 100%;
      }
    }
}
    </style>
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
            <li class="nav-item dropdown dropstart">
              <a class="nav-link active"id="ad" href="login-user.php">Login</a>
            </li>
            <li class="nav-item dropdown dropstart">
              <a class="nav-link active"id="ad" href="signup-user.php">Sign-up</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
      <div class="row1">
        <?php
        $query="SELECT * FROM books";
        $query_run= mysqli_query($con,$query);
        $check_ap= mysqli_num_rows($query_run)>0;
        if($check_ap){
          while($row= mysqli_fetch_assoc($query_run)){
            ?>
            <div class="column1">
              <div class="card1">
                <img src="<?php echo $row["image"]; ?>" width="150px" height="150px" alt="apronimg">
                <div class="container1">
                  <h2 class="card09-title1"><?php echo $row['id']; $id=$row['id'];?></h2>
                  <h2 class="card09-title1"><?php echo $row['title']; ?></h2>
                  <h3 class="card-title1">Rs.<?php echo $row['price']; ?> only</h3>
                  <h4 class="card-title1">Description</h4>
                  <p class="card-text1">
                    <?php echo $row["descrip"];?>
                  </p>
                  <h6 class="card-title1">Sold by: <?php echo $row["name"]; ?></h6>
                  <div style="width:100%;">
                      <form method="POST" action="apron.php">
                        <button class="btn1" type="submit" name="nl-acs" >ContactSeller</button>
                      </form>
                      <form method="POST" action="controllerUserData.php">
                        <button  class="btn1" type="submit" name="nl_arep">ReportAD</button>
                      </form>
                      </div>
                  </div>
                </div>
              </div>
              <div>
              <?php
            }
          }
          else{
            echo "No record found";
          }
            ?>
        </div>
      </div>
  </body>
  </html>
