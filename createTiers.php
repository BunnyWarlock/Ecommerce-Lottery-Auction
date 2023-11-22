<!DOCTYPE html>
<?php
  include_once 'classes/db.class.php';
  include_once 'classes/itemsModel.class.php';
  include_once 'classes/itemsView.class.php';
  include_once 'classes/tiersModel.class.php';
  include_once 'classes/tiersContr.class.php';
  include_once 'classes/tierPrizesModel.class.php';
  include_once 'classes/tierPrizesContr.class.php';

  $errMessage = "";

  $viewObj = new ItemsView();
  $items = $viewObj->getAllItems();

  if ($_SERVER["REQUEST_METHOD"] === "POST"){
    if (!array_key_exists("item", $_POST)){
      $errMessage = "Tier needs at least one Item";
    }
    else{
      $tiersContrObj = new TiersContr();
      $tierPrizesContrObj = new TierPrizesContr();
      try{
        $tiersContrObj->createTier($_POST["tierNo"]);
        $itemID = $_POST["item"];
        $discount = $_POST["discount"];
        for ($i = 0; $i < count($itemID); $i++)
          $tierPrizesContrObj->addTierPrizes($_POST["tierNo"], $itemID[$i], $discount[$i]);
        header("Location: createTiers.php");
      }
      catch(Exception $err){
        $errMessage = $err->getMessage();
      }
    }
  }
?>

<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Create Tier</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kimeiga/bahunya/dist/bahunya.min.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/style3.css">

    <script>
      let name = [];
      let id = [];

      name = [
        <?php
          foreach ($items as $item)
            echo "\"" . $item["name"] . "\", ";
        ?>
      ];
      id = [
        <?php
          foreach ($items as $item)
            echo $item["ID"] . ", ";
        ?>
      ];
    </script>
  </head>

  <body>
    <div class="bg">
      <img src="img/background.jpg" alt="Background image">
    </div>

    <div class="body">
      <div class="header">
        <h1 span style="margin:0; padding:0; font-size:75px; color: #fec89a;">E-commerce Website</h1>
        <h3 style="margin: 0; padding: 0; color: #cbc8c7;">
          <u>Seller side feature</u></h3>
        <br>
      </div>

      <h1 style="margin:0; padding:0; color: #cbc8c7;">Create Tier</h1>
      <?php if (!empty($errMessage)): ?>
        <em style="color:red; font-size:20px;"><b><?= $errMessage ?></b></em>
      <?php endif; ?>

      <form method="post">
        <div>
          <label for="tierNo">Tier Number</label>
          <input type="number" name="tierNo" placeholder="Enter the Tier Number"
                 style="margin-right: 0px !important; width: 100%" required>
        </div>

        <div class="wrap">
          <h2 style="margin-top: 0px !important; margin-bottom: 0px !important; color: #cbc8c7;">Add Items in Tier</h2>
          <a class="add">&plus;</a>
        </div>
        <div class="inp-group">

        </div>

        <script src="js/dynamicForms2.js"></script>

        <div class="header">
          <button style="margin:10; padding:10; background-color: rgba(0, 0, 0, 0.0); border: none;">
            <br><h3 style="margin:0; padding:0; color: #fec89a;">Create Tier</h3>
          </button>
        </div>
      </form>
    </div>

    <footer style="display: flex; justify-content: center; border: none;">
      <img class="logo" src="img/logo.jpg" alt="logo" height="50" width="50" style="border-radius:5px; margin: auto; opacity: 50%;">
    </footer>

  </body>

</html>
