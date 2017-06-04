<?php
namespace Category\Util;
use Category\Model\EntertainmentImage;
class EntertainmentGallery {
  static function getListEntertainmentGallery($arrParam = null){
    $entertainmentImage = new EntertainmentImage();
    $getListEntertainmentImage = $entertainmentImage->getListEntertainmentImage($arrParam);
    return $getListEntertainmentImage;
  }
}
