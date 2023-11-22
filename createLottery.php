<!DOCTYPE html>
<?php
  include_once 'classes/db.class.php';
  include_once 'classes/lotteryModel.class.php';
  include_once 'classes/lotteryTiersModel.class.php';
  include_once 'classes/lotteryContr.class.php';
  include_once 'classes/lotteryView.class.php';
  include_once 'classes/lotteryTiersContr.class.php';
  include_once 'classes/tiersModel.class.php';
  include_once 'classes/tiersView.class.php';

  $errMessage = "";

  $tiersViewObj = new TiersView();
  $tierAvailable = $tiersViewObj->getAllTiers();

  if ($_SERVER["REQUEST_METHOD"] === "POST"){
    if (!array_key_exists("tierNo", $_POST)){
      $errMessage = "Lottery needs at least one Tier";
    }
    else{
      $contrObj = new lotteryContr();
      $viewObj = new lotteryView();
      $tierContrObj = new lotteryTiersContr();
      $tierNo = $_POST["tierNo"];
      $tierProbability = $_POST["tierProbability"];
      try{
        $contrObj->createLottery($_POST["name"], $_POST["startDate"], $_POST["endDate"]);
        $id = $viewObj->getLotteryID($_POST["name"]);
        for ($i = 0; $i < count($tierNo); $i++)
          $tierContrObj->createLotteryTier($id["ID"], $tierNo[$i], $tierProbability[$i]);
        header("Location: createLottery.php");
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
    <title>Create Lottery</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kimeiga/bahunya/dist/bahunya.min.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/style3.css">

    <script>
      let tiersAvailable = [];

      tiersAvailable = [
        <?php
          foreach ($tierAvailable as $t)
            echo "\"" . $t["tierNo"] . "\", ";
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

      <h1 style="margin:0; padding:0; color: #cbc8c7;">Create Lottery</h1>
      <?php if (!empty($errMessage)): ?>
        <em style="color:red; font-size:20px;"><b><?= $errMessage ?></b></em>
      <?php endif; ?>

      <form method="post">
        <div>
          <label for="name">Name of the Lottery</label>
          <input type="text" name="name" placeholder="Enter the name of the lottery"
                 style="margin-right: 0px !important; width: 100%" required>
        </div>

        <div>
          <label for="startDate">Start Date of the Lottery</label>
          <input type="date" name="startDate" style="margin-right: 0px !important; width: 100%" required>
        </div>

        <div>
          <label for="endDate">End Date of the Lottery</label>
          <input type="date" name="endDate" style="margin-right: 0px !important; width: 100%" required>
        </div>

        <div class="wrap">
          <h2 style="margin-top: 0px !important; margin-bottom: 0px !important; color: #cbc8c7;">Add Tiers</h2>
          <a class="add">&plus;</a>
        </div>
        <div class="inp-group">

        </div>

        <script src="js/dynamicForms.js"></script>

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
