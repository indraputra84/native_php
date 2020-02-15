<?php 

include "action.php";

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    
    <div class="container">
      <div class="jumbotron">
        <h1>Medicine Stock</h1>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="panel panel-danger">
            <div class="panel-heading">Enter Medicine Details</div>
            <div class="panel-body">

              <?php 
                if(isset($_GET["update"])){
                  // php 5.6
                  // if(isset($_GET["id"])){
                  //   $id = $_GET["id"];
                  // }

                  // php 7
                  $id = $_GET["id"] ?? null;
                  $where = array("id"=>$id,);
                  $row = $obj->select_record("medicines",$where);
                  ?>
                    <form method="post" action="action.php">
                      <table class="table table-hover">
                        <tr>
                          <td><input type="hidden" name="id" value="<?php echo $id;?>" class="form-control"></td>
                        </tr>
                        <tr>
                          <td>Medicine Name</td>
                          <td><input type="text" name="name" class="form-control" value="<?php echo $row["m_name"]?>" placeholder="Enter Medicine Name"></td>
                        </tr>
                        <tr>
                          <td>Quanity</td>
                          <td><input type="text" name="qty" class="form-control" value="<?php echo $row["qty"]?>" placeholder="Enter Quanity"></td>
                        </tr>
                        <tr>
                          <td colspan="2" align="center"><input type="submit" name="edit" class="btn btn-primary" value="Update"></td>
                        </tr>
                      </table>
                    </form>
                  <?php
                }else{
                  ?>
                  <form method="post" action="action.php">
                    <table class="table table-hover">
                      <tr>
                        <td>Medicine Name</td>
                        <td><input type="text" name="name" class="form-control" placeholder="Enter Medicine Name"></td>
                      </tr>
                      <tr>
                        <td>Quanity</td>
                        <td><input type="text" name="qty" class="form-control" placeholder="Enter Quanity"></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center"><input type="submit" name="submit" class="btn btn-primary" value="Store"></td>
                      </tr>
                    </table>
                  </form>
                  <?php
                }
                
              ?>
            </div>
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-md-2">
          <?php
          // for ($x = 0; $x < count($result); $x++) {
          //   echo $result[$x][0] . "<BR>";  // outputs the first column from every row
          // }
          ?>
          </div>
          <div class="col-md-8">
            <table class="table table-bordered">
              <tr>
                <th>#</th>
                <th>Medicine Name</th>
                <th>Availabe Stock</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
              <?php
                $myrow = $obj->fetch_record("medicines");
                foreach ($myrow as $row) {
                  ?>

                    <tr>
                      <th><?php echo $row["id"];?></th>
                      <th><?php echo $row["m_name"];?></th>
                      <th><?php echo $row["qty"];?></th>
                      <th><a href="index.php?update=1&id=<?php echo $row["id"];?>" class="btn btn-warning">Edit</a></th>
                      <th><a href="action.php?delete=1&id=<?php echo $row["id"]?>" name="delete" class="btn btn-danger">Delete</a></th>
                    </tr>

                  <?php
                }
              ?>
              
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
      
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>