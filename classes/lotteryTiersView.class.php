<?php

/**
 * This is the view class for the table lotteryTiers
 */
class lotteryTiersView extends lotteryTiersModel{
  /**
     * Gets all the tiers present in the lottery with the specified ID
     *
     * @param   int  $lotteryID  The ID that uniquely identifies the lottery
     *
     * @return  array|string     An array of rows, where each row is represented as an associative array.
     *                           Or returns a string if there is no rows.
     */
  public function getTiers($lotteryID){
    $results = $this->getLoteryTiers($lotteryID);
    return $results;
  }
}
