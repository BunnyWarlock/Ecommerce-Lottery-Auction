<?php

/**
 * This is the model class for the table 'tierPrizes'
 */
class TierPrizesModel extends Db{
  /**
   * This takes the relevant inputs and adds a new row to the table 'tierPrizes'
   *
   * @param   int  $tierNo    The tier number
   * @param   int  $itemID    The ID that uniquely identifies an item
   * @param   int  $discount  The % discount prize that will be gained by playing the lottery
   */
  protected function setTierPrizes($tierNo, $itemID, $discount){
    $mysqli = $this->connect();
    $sql = "insert into tierPrizes(tierNo, itemID, discount) values (?, ?, ?)";
    $stmt = $mysqli->stmt_init();
    if (!$stmt->prepare($sql))
      die("SQL Error: " . $mysqli->error);
    $stmt->bind_param("sss", $tierNo, $itemID, $discount);
    $stmt->execute();
  }

  /**
   * Gets all the prizes with the specified tier number
   *
   * @param   int  $tierNo  The tier number
   *
   * @return  array|string  An array of rows, where each row is represented as an associative array.
   *                        Or returns a string if there is no rows.
   */
  protected function getTierPrizes($tierNo){
    $mysqli = $this->connect();
    $sql = "select itemID, discount from tierPrizes where tierNo = {$tierNo}";
    $result = $mysqli->query($sql);
    if($result== true){
      if ($result->num_rows > 0) {
        $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
        $prizes= $row;
      } else {
        $prizes= "No Item in this tier?";
      }
    }else{
      $prizes= mysqli_error($db);
    }
    return $prizes;
  }
}
