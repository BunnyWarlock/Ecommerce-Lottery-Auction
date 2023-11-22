<?php

/**
 * This is the views class for the table 'tiers'
 */
class TiersView extends TiersModel{
  /**
   * Gets all the tiers stored in the table 'tiers'
   *
   * @return  array|string  An array of rows, where each row is represented as an associative array. 
   *                        Or returns a string if there is no rows or an error ocurred
   */
  public function getAllTiers(){
    $results = $this->getTiers();
    return $results;
  }
}
