<?php

/**
 * This is the model class for the table 'items'
 */
class ItemsModel extends Db{
  /**
   * Gets all the items stored in the table 'items'
   *
   * @return  array|string  An array of rows, where each row is represented as an associative array. 
   *                        Or returns a string if there is no rows or an error ocurred
   */
  protected function getItems(){
    $mysqli = $this->connect();
    $sql = "select ID, name from items";
    $result = $mysqli->query($sql);
    if($result== true){
      if ($result->num_rows > 0) {
        $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
        $items= $row;
      } else {
        $items= "There are no Items in the Inventory.";
      }
    }else{
      $items= "Something did now work like they were supposed to";
    }
    return $items;
  }
}
