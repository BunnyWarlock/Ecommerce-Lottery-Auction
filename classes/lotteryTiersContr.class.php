<?php

/**
 * This is the controller class for the table 'lotteryTiers'
 */
class LotteryTiersContr extends lotteryTiersModel{
  /**
     * This takes the relevant inputs and adds a new row to the table 'auctionItems'
     *
     * @param   int  $lotteryID        The ID that uniquely identifies the lottery
     * @param   int  $tierNo           The specific tier number
     * @param   int  $tierProbability  The probability that tier will be found in the lottery
     * 
     * @throws  Exception               The Exception message has the relevant string
     */
  public function createLotteryTier($lotteryID, $tierNo, $tierProbability){
    try{
      $this->setLotteryTier($lotteryID, $tierNo, $tierProbability);
    }
    catch (Exception $err){
      throw new Exception("Tier Does Not Exist!");
    }
  }
}
