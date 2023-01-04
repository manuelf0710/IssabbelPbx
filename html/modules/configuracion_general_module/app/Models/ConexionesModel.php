<?php

namespace App\Models;

use App\Models\Model;

class ConexionesModel extends Model
{
  /**
   * Count rows of table devices
   * @return array             
   */
  public function count()
  {
    $query = "SELECT COUNT(id) AS total FROM `asterisk`.`conexionesbd`";

    return $this->fetchSingleRow($query);
  }

  /**
   * Get sip devices    
   * @return array             
   */
  public function lista()
  {
    $query = "SELECT id, motor  FROM `asterisk`.`conexionesbd`";
    //$parameters = ['id'];

    return $this->fetchRows($query);
  }

  public function index()
  {
    $query = "SELECT *  FROM `asterisk`.`conexionesbd`";
    $parameters = ['id'];

    return $this->fetchRows($query, $parameters);
  }  
}