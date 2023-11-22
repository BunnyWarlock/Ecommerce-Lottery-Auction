<!DOCTYPE html>
<?php
  include_once 'classes/db.class.php';
  include_once 'classes/lotteryModel.class.php';
  include_once 'classes/lotteryTiersModel.class.php';
  include_once 'classes/lotteryView.class.php';
  include_once 'classes/lotteryTiersView.class.php';
  include_once 'classes/tierPrizesModel.class.php';
  include_once 'classes/tierPrizesView.class.php';
  include_once 'classes/itemsModel.class.php';
  include_once 'classes/itemsView.class.php';

  $viewObj = new lotteryView();
  $today = date("Y-m-d");
  $lottery = $viewObj->getLotteryByDate($today);
  $tiersViewObj = new lotteryTiersView();
  $itemViewObj = new ItemsView();
  $allItems = $itemViewObj->getAllItems();
?>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Spin Wheel App</title>

    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kimeiga/bahunya/dist/bahunya.min.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/style4.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script>
    <script>
      let prizeName = {};
      <?php foreach ($allItems as $i)
        echo "prizeName[" . $i["ID"] . "] = \"" . $i["name"] . "\";";
      ?>
    </script>
  </head>
  <body>
    <div class="bg">
      <img src="img/background.jpg" alt="Background image"  style="top: 0px !important; left: 0px !important;">
    </div>

    <?php
      if (is_array($lottery)){
        foreach ($lottery as $data) {
          $tier = $tiersViewObj->getTiers($data["ID"]);
          $totalProb = 0;
          foreach ($tier as $tierData)
            $totalProb += $tierData["tierProbability"];

          $tierPrizesViewObj = new TierPrizesView();
          $allPrizes = array();
          foreach ($tier as $tierData){
            $prizes = $tierPrizesViewObj->getAllTierPrizes($tierData["tierNo"]);
            $allPrizes[$tierData["tierNo"]] = $prizes;
          }
    ?>

      <div class="body">
        <div class="header">
          <h1 span style="margin:0; padding:0; font-size:75px; color: #fec89a;">Lottery</h1>
          <h3 style="margin: 0; padding: 0; color: #cbc8c7;">
            <u><?= $data["name"] ?></u></h3>
          <br>
        </div>

        <div class="container">
          <canvas id="wheel"></canvas>
          <button id="spin-btn">Spin</button>
          <img src="img/spinner-arrow-.svg" alt="spinner-arrow" />
        </div>
        <div id="final-value" style="color: #fec89a;">
          <p>Click On The Spin Button To Start</p>
        </div>
      </div>
      <script>
        let rotationalValues = [];
        let data = [];
        var pieColors = [];
        let labelArr = [];
        let lotteryPrizes = <?php echo json_encode($allPrizes); ?>;

        rotationValues = [
          <?php
            $minDegree = 0;
            foreach ($tier as $tierData){
              $step = ($tierData["tierProbability"]/$totalProb * 360);
              $maxDegree = $minDegree + $step - 1;
              echo "{ minDegree: " . $minDegree . ", maxDegree: " . $maxDegree . ", value: " . $tierData["tierNo"] . "},\n";
              $minDegree = $maxDegree + 1;
            }
          ?>
        ];
        data = [
          <?php
            foreach ($tier as $tierData)
              echo $tierData["tierProbability"] . ", ";
          ?>
        ];
        pieColors = [
          <?php
            for ($i = 0; $i < count($tier); $i++){
              if ($i & 1)
                echo "\"#6499E9\",\n";
              else
                echo "\"#9EDDFF\",\n";
            }
          ?>
        ];
        labelArr = [
          <?php
            foreach ($tier as $tierData)
              echo $tierData["tierNo"] . ", ";
          ?>
        ];
      </script>
      <script src="js/spinWheel.js"></script>

    <?php }} else{ ?>
      <div class="body">
        <div class="header">
          <h1 span style="margin:0; padding:0; font-size:75px; color: #fec89a;"><?= $lottery ?></h1>
        </div>
      </div>
    <?php } ?>

  </body>
</html>
