<?php

namespace App\Models;

use App\Models\Model;

class RutaSalienteModel extends Model
{
  /**
   * Count rows of table devices
   * @return array             
   */
  public function count()
  {
    $query = "SELECT COUNT(id) AS total FROM `asterisk`.`outbound_routes`";

    return $this->fetchSingleRow($query);
  }

  /**
   * Get sip devices    
   * @return array             
   */
  public function index()
  {
    $query = "SELECT route_id id, name  FROM `asterisk`.`outbound_routes`";
    //$parameters = ['id'];

    return $this->fetchRows($query);
  }
}