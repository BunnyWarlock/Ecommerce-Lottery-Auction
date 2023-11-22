<?php

/**
 * This is the view class for the table 'auctionItems'
 */
class AuctionItemsView extends AuctionItemsModel{
  /**
     * Gets all the auction items stored in the table 'auctionItems'
     *
     * @return  array|string  An array of rows, where each row is represented as an associative array.
     *                        Or returns a string if there is no rows.
     */
  public function getAllAuctionItems(){
    $results = $this->getAuctionItems();
    return $results;
  }

  /**
     * Gets the specific auction item with the specified ID
     *
     * @param   int  $id    The ID of the item stored in auctionItems
     *
     * @return  array|null  An associative array representing a single row, or null if no rows are found.
     */
  public function getAuctionItem($id){
    $results = $this->getAuctionByID($id);
    return $results;
  }
}
