<?php

/**
 * This is the view class of the table 'items'
 */
class ItemsView extends ItemsModel{
  /**
   * Gets all the items stored in the table 'items'
   *
   * @return  array|string  An array of rows, where each row is represented as an associative array. 
   *                        Or returns a string if there is no rows or an error ocurred
   */
  public function getAllItems(){
    $results = $this->getItems();
    return $results;
  }
}
