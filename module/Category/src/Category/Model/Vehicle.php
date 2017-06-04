<?php
namespace Category\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\Feature;
use Zend\Db\Sql\Expression;
class Vehicle extends AbstractTableGateway
{
	//Tên bảng
   protected $table = 'vehicle';
   
   /**-----------------------------------------------------------------------------------------
    * Gọi adapter
    -------------------------------------------------------------------------------------------*/
   public function __construct()
   {	
   		$this->featureSet = new Feature\FeatureSet();
   		$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
    	$this->initialize();      
   }
   // Lấy danh sách trò chơi theo tralvel id và entertainment type id
  public function getVehicleByTravelId($arrayParam = null){
    $select = new Select();
    $select->from($this->table);
    $select->columns(array('id', 'name', 'status', 'travel_id', 'language', 'price'));
    $select->where(array('travel_id' => $arrayParam['travel_id']));
    $select->where(array('language' => $arrayParam['language'], 'status' => 1));
    $resultSet = $this->selectWith($select);
    $resultSet = $resultSet->toArray();
    return $resultSet;
  }
}   
