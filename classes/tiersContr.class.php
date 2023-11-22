<?php

/**
 * This is the controller class for the table 'tiers'
 */
class TiersContr extends TiersModel{
  /**
   * This takes the relevant inputs and adds a new row to the table 'tiers'
   *
   * @param   int  $tierNo  The tier number
   * 
   * @throws  Exception     The Exception message has the relevant string
   */
  public function createTier($tierNo){
    try{
      $this->setTier($tierNo);
    }
    catch(Exception $err){
      throw new Exception("Tier With that number already Exists!");
    }
  }
}
