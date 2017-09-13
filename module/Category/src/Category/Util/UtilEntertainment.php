<?php
namespace Category\Util;
use Category\Model\Entertainment;
class UtilEntertainment{
  static function getTotalEntertainmentByPost($arrParam){
    $entertainment = new Entertainment();
    $getTotal = $entertainment->getTotalEntertainment(array('post_id' => $arrParam['post_id']));
    return $getTotal;
  }
}
