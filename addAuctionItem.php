<!DOCTYPE html>
<?php
  include_once 'classes/db.class.php';
  include_once 'classes/auctionItemsModel.class.php';
  include_once 'classes/auctionItemsContr.class.php';

  $errMessage = "";

  if ($_SERVER["REQUEST_METHOD"] === "POST"){
    if ($_FILES['image']['error'] === 0){
      $fileName = basename($_FILES["image"]["name"]);
      $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
      $allowedTypes = array('jpg','png','jpeg','gif');
      if(in_array($fileType, $allowedTypes)){
        $contrObj = new AuctionItemsContr();
        try{
          $contrObj->createAuction($_POST["name"], $_POST["sBid"], $_POST["description"], $fileType, $_POST["startDate"], $_POST["endDate"]);
          $fileTmpName = $_FILES['image']['tmp_name'];
          $fileDestination = "uploads/" . $_POST["name"] . "." . $fileType;
          move_uploaded_file($fileTmpName, $fileDestination);
        }
        catch(Exception $err){
          $errMessage = $err->getMessage();
        }
      }
      else{
        $errMessage = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
      }
    }
    else{
      $errMessage = "There was an error uploading your file";
    }
  }
?>

<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Create Lottery</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kimeiga/bahunya/dist/bahunya.min.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/style3.css">
  </head>

  <body>
    <div class="bg">
      <img src="img/backgroundAuction.jpg" alt="Background image">
    </div>

    <div class="body" style="background-color: rgba(81, 39, 33, 0.8);">
      <div class="header">
        <h1 span style="margin:0; padding:0; font-size:75px; color: #fec89a;">E-commerce Website</h1>
        <h3 style="margin: 0; padding: 0; color: #cbc8c7;">
          <u>Seller side feature</u></h3>
        <br>
      </div>

      <h1 style="margin:0; padding:0; color: #cbc8c7;">Add Auction Item</h1>
      <?php if (!empty($errMessage)): ?>
        <em style="color:red; font-size:20px;"><b><?= $errMessage ?></b></em>
      <?php endif; ?>

      <form method="post" enctype="multipart/form-data">
        <div>
          <label for="name">Name of the Item</label>
          <input type="text" name="name" placeholder="Enter the name of the Item"
                 style="margin-right: 0px !important; width: 100%" required>
        </div>

        <div>
          <label for="sBid">Starting Bid of the Item</label>
          <input type="number" step="any" name="sBid" placeholder="Enter the Starting Bid of the Item"
                 min=0 style="margin-right: 0px !important; width: 100%" required>
        </div>

        <div>
          <label for="description">Description of the Item</label>
          <input type="text" name="description" placeholder="Enter Product Description"
                 style="margin-right: 0px !important; width: 100%" required>
        </div>

        <div>
          <label for="startDate">Start Date of the Auction</label>
          <input type="date" name="startDate" style="margin-right: 0px !important; width: 100%" required>
        </div>

        <div>
          <label for="endDate">End Date of the Auction</label>
          <input type="date" name="endDate" style="margin-right: 0px !important; width: 100%" required>
        </div>

        <div>
          <label for="image">Image of the Item</label>
          <input type="file" name="image" style="margin-right: 0px !important; width: 100%" required>
        </div>

        <div class="header">
          <button style="margin:10; padding:10; background-color: rgba(0, 0, 0, 0.0); border: none;">
            <br><h3 style="margin:0; padding:0; color: #fec89a;">Create Lottery</h3>
          </button>
        </div>
      </form>
    </div>

    <footer style="display: flex; justify-content: center; border: none;">
      <img class="logo" src="img/logo.jpg" alt="logo" height="50" width="50" style="border-radius:5px; margin: auto; opacity: 50%;">
    </footer>

  </body>

</html>
