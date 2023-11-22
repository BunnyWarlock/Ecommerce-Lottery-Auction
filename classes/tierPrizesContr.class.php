<?php

/**
 * This is the controller class for the table 'tierPrizes'
 */
class TierPrizesContr extends TierPrizesModel{
  /**
   * This takes the relevant inputs and adds a new row to the table 'tierPrizes'
   *
   * @param   int  $tierNo    The tier number
   * @param   int  $itemID    The ID that uniquely identifies an item
   * @param   int  $discount  The % discount prize that will be gained by playing the lottery
   *
   * @throws  Exception       The Exception message has the relevant string
   */
  public function addTierPrizes($tierNo, $itemID, $discount){
    try{
      $this->setTierPrizes($tierNo, $itemID, $discount);
    }
    catch(Exception $err){
      throw new Exception("Tier With that number already Exists!");
    }
  }
}
