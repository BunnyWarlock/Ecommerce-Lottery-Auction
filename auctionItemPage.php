<!DOCTYPE html>
<?php
  include_once 'classes/db.class.php';
  include_once 'classes/auctionItemsModel.class.php';
  include_once 'classes/auctionItemsView.class.php';
  include_once 'classes/auctionItemsContr.class.php';

  $viewObj = new AuctionItemsView();
  $item = $viewObj->getAuctionItem($_GET["iID"]);
  $imgAddress = "\"uploads/" . $item["name"] . "." . $item["fileExtension"] . "\"";
  $end = ($item['endDate'] < date("Y-m-d"));
  $start = ($item['startDate'] > date("Y-m-d"));

  if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $contrObj = new AuctionItemsContr();
    $contrObj->updateBid($_GET["iID"], $_POST["bidder"], $_POST["bid"]);
    header("Location: auctionItemPage.php?iID={$_GET["iID"]}");
  }
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Product Page</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kimeiga/bahunya/dist/bahunya.min.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/style5.css">
  </head>
  <body>
    <div class="bg">
      <img src="img/backgroundAuction.jpg" alt="Background image">
    </div>

    <div class="container">
      <div class="product">
        <div class="gallery">
          <img src=<?= $imgAddress ?>>
        </div>

        <div class="details">
          <h1> <?= $item["name"] ?> </h1> <hr>
          <h2 style="margin-bottom: 0px !important;"> Current Bid: <?= $item["bid"] ?> </h2>
          <h2 style="margin-top: 0px !important;"> Current Bidder: <?= $item["bidder"] ?> </h2>
          <h4 style="margin-bottom: 0px !important;"> Auction Started On <?= $item["startDate"] ?> </h3>
          <h4 style="margin-top: 0px !important;"> Auction Will End On <?= $item["endDate"] ?> </h3>
          <h3 style="color: black; margin-bottom: 0px !important;"> Description </h3>
          <p> <?= $item["description"] ?> </p> <hr>

          <?php if (!($end || $start)){ ?>
            <h3 style="color: black;margin-top: 20px !important;"> Make a new Bid </h3>
            <form method="post">
              <div>
                <label for="bidder">What is your name</label>
                <input type="text" name="bidder" placeholder="Enter Your Name"
                       style="margin-right: 0px !important; width: 100%" required>
              </div>

              <div>
                <label for="bid">New Bid Amount</label>
                <input type="number" step="any" name="bid" placeholder="Enter new bid"
                       min=<?= $item["bid"]+1 ?> style="margin-right: 0px !important; width: 100%" required>
              </div>

              <div class="header">
                <button style="margin:10; padding:10; background-color: rgba(0, 0, 0, 0.0); border: none;">
                  <br><h3 style="margin:0; padding:0; color: rgb(81, 39, 33);">Make Bid</h3>
                </button>
              </div>
            </form>
          <?php } elseif ($start){ ?>
            <h3 style="color: black;margin-top: 20px !important;"> Auction Has Not Started Yet! </h3>
          <?php } else { ?>
            <h3 style="color: black;margin-top: 20px !important;"> Auction Has Already Ended! </h3>
          <?php } ?>
        </div>
      </div>
    </div>

    <footer style="display: flex; justify-content: center; border: none;">
      <img class="logo" src="img/logo.jpg" alt="logo" height="50" width="50" style="border-radius:5px; margin: auto; opacity: 50%;">
    </footer>
  </body>
</html>
