<?php
  include("../dbh/dbh.php");
  include("nav.php");
  $result = $mysqli->query("SELECT * FROM food") or die($mysqli->error);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">

    <title>Food Menu</title>

    <style>
      body{
        background: linear-gradient(to bottom right, #ff99ff -8%, #ffcc00 100%);
        background-attachment: fixed;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
      }
      }
    </style>
  </head>

  <body>
  	 <?php
      if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['alert']?> alert-dismissable text-center" style="margin-top: 30px;">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
          ?>
        </div>
      <?php endif ?>
      <div class="text-center" style="margin-top: 30px;">
        <h3 style="color: white; font-family: 'Permanent Marker', cursive;"><u>Food Menu</u></h3>
      </div>
      <div class="row" style="margin-left: 90px; margin-top: 50px;">
        <input class="form-control" id="myInput" type="text" placeholder="Search by food/shop/type..." style="width: 270px; border-radius: 15px;">
      </div>
  	<div class="container">
      <div class="row">
    		<table class="table table-striped table-hover" style="margin-top: 20px;">
    			<thead>
            <tr>
              <th style="text-align: center; border-top: 2px solid #FDFEFE;">Food</th>
              <th style="text-align: center; border-top: 2px solid #FDFEFE;">Price</th>
              <th style="text-align: center; border-top: 2px solid #FDFEFE;">Type</th>
              <th style="text-align: center; border-top: 2px solid #FDFEFE;">Shop Name</th>
              <th style="text-align: center; border-top: 2px solid #FDFEFE;">Availability</th>
              <th style="text-align: center; border-top: 2px solid #FDFEFE;">Quantity</th>
            </tr>
    			</thead>
          <tbody id="myTable">
            <?php
              while ($row = $result->fetch_assoc()): ?>
                <form action="cart.php" method="post">
          				<tr>
          					<td style="text-align: center;"><?php echo '<b>'.$row['food_name'].'</b>';?><br>"<?php echo '<i style="color: #626567;">'.$row['description'].'</i>'?>"</td>
          					<td style="text-align: center;"><?php echo $row['price'];?></td>
                    <td style="text-align: center;"><?php echo $row['type'];?></td>
                    <td style="text-align: center;"><?php echo $row['shop_name'];?></td>
                    <td style="text-align: center;"><?php if ($row['availability'] == "yes"):?>
                      <span style="color: green;"><b>&#10003;</b></span>
                      <?php else:?>
                        <span style="color: red;">&#10008;</span>
                      <?php endif;?>
                    </td>
          					<td style="text-align: center;">
          						<input type="number" placeholder="Qty" name="qty" min="1" value="1" style="width: 50px; background-color:white; opacity: 0.8; border-radius: 5px; text-align: center;">
          						<button type="submit" class="btn btn-primary" name="cart" style="padding: 3px 10px; border-radius: 10px;">Add</button>
          					</td>
                    <input type="hidden" name="food_id" value="<?php echo $row['food_id'];?>">
                    <input type="hidden" name="food_name" value="<?php echo $row['food_name'];?>">
                    <input type="hidden" name="price" value="<?php echo $row['price'];?>">
                    <input type="hidden" name="shop_name" value="<?php echo $row['shop_name'];?>">
                    <input type="hidden" name="availability" value="<?php echo $row['availability'];?>">
          				</tr>
                </form>
              <?php endwhile;?>
          </tbody>
    		</table>
      </div>
	</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
   <script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>
  </body>
</html>