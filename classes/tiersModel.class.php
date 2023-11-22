<?php

/**
 * This is the model class for the table 'tiers'
 */
class TiersModel extends Db{
  /**
   * This takes the relevant inputs and adds a new row to the table 'tiers'
   *
   * @param   int  $tierNo  The tier number
   */
  protected function setTier($tierNo){
    $mysqli = $this->connect();
    $sql = "insert into tiers(tierNo) values (?)";
    $stmt = $mysqli->stmt_init();
    if (!$stmt->prepare($sql))
      die("SQL Error: " . $mysqli->error);
    $stmt->bind_param("s", $tierNo);
    $stmt->execute();
  }

  /**
   * Gets all the tiers stored in the table 'tiers'
   *
   * @return  array|string  An array of rows, where each row is represented as an associative array. 
   *                        Or returns a string if there is no rows or an error ocurred
   */
  protected function getTiers(){
    $mysqli = $this->connect();
    $sql = "select * from tiers";
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
