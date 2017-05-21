<?php
namespace Category\Util;
class MapGeoCode {
  function geocode($address){
      $address = urlencode($address);
      $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
      $resp_json = file_get_contents($url);
      $resp = json_decode($resp_json, true);
      if($resp['status']=='OK'){
        $lat = $resp['results'][0]['geometry']['location']['lat'];
        $lng = $resp['results'][0]['geometry']['location']['lng'];
        $formatted_address = $resp['results'][0]['formatted_address'];
        if($lat && $lng && $formatted_address){
            $data_arr = array();            
            array_push(
              $data_arr, 
              $lat, 
              $lng, 
              $formatted_address
            );
            return $data_arr;

        }else{
            return false;
        }

      }else{
          return false;
      }
  }
}
