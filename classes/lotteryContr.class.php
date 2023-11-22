<?php

/**
 * This is the controller class of the table 'lottery'
 */
class LotteryContr extends lotteryModel{
  /**
     * Adds a new row to the table 'lottery' with the given information
     *
     * @param   string  $name       The name of the lottery
     * @param   string  $startDate  When the lottery starts
     * @param   string  $endDate    When the lottery ends
     * 
     * @throws  Exception           The Exception message has the relevant string
     */
  public function createLottery($name, $startDate, $endDate){
    if ($startDate > $endDate)
      throw new Exception("Lottery Cannot End before it Starts!");
    try{
      $this->setLottery($name, $startDate, $endDate);
    }
    catch(Exception $err){
      throw new Exception("Lottery With that name already Exists!");
    }
  }
}
