<!DOCTYPE html>
<?php
  include_once 'classes/db.class.php';
  include_once 'classes/auctionItemsModel.class.php';
  include_once 'classes/auctionItemsView.class.php';

  $viewObj = new auctionItemsView();
  $items = $viewObj->getAllAuctionItems();
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Browse Auction Items</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kimeiga/bahunya/dist/bahunya.min.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/style2.css">
  </head>

  <body style="max-width: none; width: fit-content;">
    <div class="bg">
      <img src="img/backgroundAuction.jpg" alt="Background image">
    </div>

    <div class="body" style="max-width: none; background-color: rgba(81, 39, 33, 0.8);">
      <main class="table">
        <section class="table_header">
          <h1 style="margin:0; padding:0;">All Auctions</h1>
          <div class="input_group">
            <input type="search" placeholder="Search Item...">
            <img src="img/search.svg" alt="">
          </div>
        </section>

        <section class="table_body">
          <table>
            <thead><tr>
               <th style="text-align:center;"><h3 style="margin:0; padding:0;"><b>
                 No. <span class="icon_arrow">&UpArrow;</span></b></h3></th>
               <th style="text-align:center;"><h3 style="margin:0; padding:0;"><b>
                 Item Name <span class="icon_arrow">&UpArrow;</span></b></h3></th>
               <th style="text-align:center;"><h3 style="margin:0; padding:0;"><b>
                 Current Bid <span class="icon_arrow">&UpArrow;</span></b></h3></th>
               <th style="text-align:center;"><h3 style="margin:0; padding:0;"><b>
                 Start Date <span class="icon_arrow">&UpArrow;</span></b></h3></th>
               <th style="text-align:center;"><h3 style="margin:0; padding:0;"><b>
                 End Date <span class="icon_arrow">&UpArrow;</span></b></h3></th>
            </tr></thead>

            <tbody>
              <?php
                if(is_array($items)){
                  $sn=1;
                  foreach($items as $item){
              ?>
                    <tr data-href="auctionItemPage.php?iID=<?php echo($item['ID']) ?>">
                      <td><?php echo $sn; ?></td>
                      <td><?php echo $item['name']??''; ?></td>
                      <td><?php echo $item['bid']??''; ?></td>
                      <td style="<?php if ($item['startDate'] > date("Y-m-d")) echo 'background-color: red; opacity: 50%;'; ?>"><?php echo $item['startDate']??''; ?></td>
                      <td style="<?php if ($item['endDate'] < date("Y-m-d")) echo 'background-color: red; opacity: 50%;'; ?>"><?php echo $item['endDate']??''; ?></td>
                    </tr>
              <?php $sn++;}}else{ ?>
                <tr>
                  <td colspan="5">
                    <h1 span style="margin:0; padding:0; font-size:75px; color: #fec89a;"> <?php echo $items; ?> </h1>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </section>
      </main>
      <script src="js/tableScript.js"></script>
    </div>

    <footer style="display: flex; justify-content: center; border: none;">
      <img class="logo" src="img/logo.jpg" alt="logo" height="50" width="50" style="border-radius:5px; margin: auto; opacity: 50%;">
    </footer>

    <script>
      document.addEventListener("DOMContentLoaded", () => {
        const rows = document.querySelectorAll("tr[data-href]");

        rows.forEach(row => {
            row.addEventListener("click", () => {
              window.location.href = row.dataset.href;
            });
        });
      });
    </script>
  </body>
</html>
