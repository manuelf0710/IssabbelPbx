<?php

namespace App\Models;

use App\Models\Model;

class IvrModel extends Model
{
  /**
   * Count rows of table devices
   * @return array             
   */
  public function count()
  {
    $query = "SELECT COUNT(id) AS total FROM `asterisk`.`ivr_details`";

    return $this->fetchSingleRow($query);
  }

  /**
   * Get sip devices    
   * @return array             
   */
  public function index()
  {
    $query = "SELECT id, name  FROM `asterisk`.`ivr_details`";
    $parameters = ['id'];

    return $this->fetchRows($query);
  }
}
