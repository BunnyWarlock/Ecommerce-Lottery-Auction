<?php

/**
 * This is the views class for the table 'tierPrizes'
 */
class TierPrizesView extends TierPrizesModel{
  /**
   * Gets all the prizes with the specified tier number
   *
   * @param   int  $tierNo  The tier number
   *
   * @return  array|string  An array of rows, where each row is represented as an associative array.
   *                        Or returns a string if there is no rows.
   */
  public function getAllTierPrizes($tierNo){
    $results = $this->getTierPrizes($tierNo);
    return $results;
  }
}
