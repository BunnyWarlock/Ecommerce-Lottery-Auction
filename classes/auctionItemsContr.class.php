<?php

/**
 * This is the controller class for the table 'auctionItems'
 */
class AuctionItemsContr extends AuctionItemsModel{
  /**
   * This takes the relevant inputs and adds a new row to the table 'auctionItems'
   *
   * @param   string  $name           The name of the auction item
   * @param   double  $bid            The starting bid of the auction item
   * @param   string  $description    The description of the auction item
   * @param   string  $fileExtension  The file extension of the image of the auction item
   * @param   string  $startDate      The date the item will be put on auction
   * @param   string  $endDate        The date the item will be taken off of the auction
   *
   * @throws  Exception               The Exception message has the relevant string
   */
  public function createAuction($name, $bid, $description, $fileExtension, $startDate, $endDate){
    if ($startDate > $endDate)
      throw new Exception("Auction Cannot End before it Starts!");
    try{
      $this->setAuctionItem($name, $bid, $description, $fileExtension, $startDate, $endDate);
    }
    catch(Exception $err){
      throw new Exception("Auction Item With that name already Exists!");
    }
  }

  /**
   * This identifies the item using the ID and then updates the bid and bidder column.
   * To be called after someone bids on the item.
   *
   * @param   int     $id       Used to identify the item
   * @param   string  $bidder   The name of the bidder
   * @param   double  $bid      The new bid
   */
  public function updateBid($id, $bidder, $bid){
    $this->updateAuctionItem($id, $bidder, $bid);
  }
}
