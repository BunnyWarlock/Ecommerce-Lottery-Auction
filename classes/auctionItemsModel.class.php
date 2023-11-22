<?php

/**
 * This is the model class for the table 'auctionItems'
 */
class AuctionItemsModel extends Db{
    /**
     * This takes the relevant inputs and adds a new row to the table 'auctionItems'
     *
     * @param   string  $name           The name of the auction item
     * @param   double  $bid            The starting bid of the auction item
     * @param   string  $description    The description of the auction item
     * @param   string  $fileExtension  The file extension of the image of the auction item
     * @param   string  $startDate      The date the item will be put on auction
     * @param   string  $endDate        The date the item will be taken off of the auction
     */
    protected function setAuctionItem($name, $bid, $description, $fileExtension, $startDate, $endDate){
      $mysqli = $this->connect();
      $sql = "insert into auctionItems(name, bid, description, fileExtension, startDate, endDate) values (?, ?, ?, ?, ?, ?)";
      $stmt = $mysqli->stmt_init();
      if (!$stmt->prepare($sql))
        die("SQL Error: " . $mysqli->error);
      $stmt->bind_param("ssssss", $name, $bid, $description, $fileExtension, $startDate, $endDate);
      $stmt->execute();
    }

    /**
     * Gets all the auction items stored in the table 'auctionItems'
     *
     * @return  array|string  An array of rows, where each row is represented as an associative array.
     *                        Or returns a string if there is no rows.
     */
    protected function getAuctionItems(){
      $mysqli = $this->connect();
      $sql = "select * from auctionItems";
      $result = $mysqli->query($sql);
      if($result== true){
        if ($result->num_rows > 0) {
          $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
          $item= $row;
        } else {
          $item= "No Item in Shop Inventory";
        }
      }else{
        $item= mysqli_error($db);
      }
      return $item;
    }

    /**
     * Gets the specific auction item with the specified ID
     *
     * @param   int  $id    The ID of the item stored in auctionItems
     *
     * @return  array|null  An associative array representing a single row, or null if no rows are found.
     */
    protected function getAuctionByID($id){
      $mysqli = $this->connect();
      $sql = "select * from auctionItems where ID = {$id}";
      $result = $mysqli->query($sql);
      $id = $result->fetch_assoc();
      return $id;
    }

    /**
     * This identifies the item using the ID and then updates the bid and bidder column.
     * To be called after someone bids on the item.
     *
     * @param   int     $id       Used to identify the item
     * @param   string  $bidder   The name of the bidder
     * @param   double  $bid      The new bid
     */
    protected function updateAuctionItem($id, $bidder, $bid){
      $mysqli = $this->connect();
      $sql = "update auctionItems set bidder = ?, bid = ? where ID = ?";
      $stmt = $mysqli->stmt_init();
      if (!$stmt->prepare($sql))
        die("SQL Error: " . $mysqli->error);
      $stmt->bind_param("sss", $bidder, $bid, $id);
      $stmt->execute();
    }
}
