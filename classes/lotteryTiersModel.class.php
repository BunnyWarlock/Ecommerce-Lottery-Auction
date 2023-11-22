<?php

/**
 * This is the model class for the table 'lotteryTiers'
 */
class LotteryTiersModel extends Db{
    /**
     * This takes the relevant inputs and adds a new row to the table 'auctionItems'
     *
     * @param   int  $lotteryID        The ID that uniquely identifies the lottery
     * @param   int  $tierNo           The specific tier number
     * @param   int  $tierProbability  The probability that tier will be found in the lottery
     */
    protected function setLotteryTier($lotteryID, $tierNo, $tierProbability){
      $mysqli = $this->connect();
      $sql = "insert into lotteryTiers(lotteryID, tierNo, tierProbability) values (?, ?, ?)";
      $stmt = $mysqli->stmt_init();
      if (!$stmt->prepare($sql))
        die("SQL Error: " . $mysqli->error);
      $stmt->bind_param("sss", $lotteryID, $tierNo, $tierProbability);
      $stmt->execute();
    }

    /**
     * Gets all the tiers present in the lottery with the specified ID
     *
     * @param   int  $lotteryID  The ID that uniquely identifies the lottery
     *
     * @return  array|string     An array of rows, where each row is represented as an associative array.
     *                           Or returns a string if there is no rows.
     */
    protected function getLoteryTiers($lotteryID){
      $mysqli = $this->connect();
      $sql = "select * from lotteryTiers where lotteryID = {$lotteryID}";
      $result = $mysqli->query($sql);
      if($result== true){
        if ($result->num_rows > 0) {
          $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
          $tiers= $row;
        } else {
          $tiers= "No Item in Shop Inventory";
        }
      }else{
        $tiers= mysqli_error($db);
      }
      return $tiers;
    }
}
