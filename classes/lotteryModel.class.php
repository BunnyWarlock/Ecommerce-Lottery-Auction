<?php

/**
 * This is the model class of the table 'lottery'
 */
class LotteryModel extends Db{
    /**
     * Gets all the lottery which starts before of at the specified date 
     * and ends after of at the specified date.
     *
     * @param   string  $date  Specifies a date. For example today's date
     *
     * @return  array|string   An array of rows, where each row is represented as an associative array.
     *                         Or returns a string if there is no rows or there was an error.
     */
    protected function getLottery($date){
      $mysqli = $this->connect();
      $sql = "select * from lottery where startDate <= '{$date}' AND endDate >= '{$date}'";
      $result = $mysqli->query($sql);
      if($result== true){
        if ($result->num_rows > 0) {
          $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
          $lottery= $row;
        } else {
          $lottery= "No Lottery Happening Right Now. Check Later.";
        }
      }else{
        $lottery= "Something did now work like they were supposed to";
      }
      return $lottery;
    }

    /**
     * Gets the lottery information of the lottery with the specific name
     *
     * @param   string  $name  The name of the lottery to search for
     *
     * @return  array|null     An associative array representing a single row, or null if no rows are found.
     */
    protected function getLoteryByName($name){
      $mysqli = $this->connect();
      $sql = sprintf("select ID from lottery where name = '%s'", $mysqli->real_escape_string($name));
      $result = $mysqli->query($sql);
      $id = $result->fetch_assoc();
      return $id;
    }

    /**
     * Adds a new row to the table 'lottery' with the given information
     *
     * @param   string  $name       The name of the lottery
     * @param   string  $startDate  When the lottery starts
     * @param   string  $endDate    When the lottery ends
     */
    protected function setLottery($name, $startDate, $endDate){
      $mysqli = $this->connect();
      $sql = "insert into lottery(name, startDate, endDate) values (?, ?, ?)";
      $stmt = $mysqli->stmt_init();
      if (!$stmt->prepare($sql))
        die("SQL Error: " . $mysqli->error);
      $stmt->bind_param("sss", $name, $startDate, $endDate);
      $stmt->execute();
    }
}
