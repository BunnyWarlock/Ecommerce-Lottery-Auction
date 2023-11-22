<?php

/**
 * This is the view class of the table 'lottery'
 */
class lotteryView extends lotteryModel{
  /**
     * Gets the lottery information of the lottery with the specific name
     *
     * @param   string  $name  The name of the lottery to search for
     *
     * @return  array|null     An associative array representing a single row, or null if no rows are found.
     */
  public function getLotteryID($name){
    $results = $this->getLoteryByName($name);
    return $results;
  }

  /**
     * Gets all the lottery which starts before of at the specified date 
     * and ends after of at the specified date.
     *
     * @param   string  $date  Specifies a date. For example today's date
     *
     * @return  array|string   An array of rows, where each row is represented as an associative array.
     *                         Or returns a string if there is no rows or there was an error.
     */
  public function getLotteryByDate($date){
    $results = $this->getLottery($date);
    return $results;
  }
}
