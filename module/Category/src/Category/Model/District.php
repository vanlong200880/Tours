<?php
namespace Category\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\Feature;
class District extends AbstractTableGateway
{
	//Tên bảng
   protected $table = 'district';
   
   /**-----------------------------------------------------------------------------------------
    * Gọi adapter
    -------------------------------------------------------------------------------------------*/
   public function __construct()
   {	
      $this->featureSet = new Feature\FeatureSet();
      $this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
    	$this->initialize();      
   }
   
    /**------------------------------------------------------------------------------------------
    *
    * Danh sách thể loại
    * 
    * @param 	array 	$arrayParam		Dữ liệu truyền vào
    * @return 	array 	$resultSet		Dữ liệu trả về
    --------------------------------------------------------------------------------------------*/
   // Lấy danh sách district
   public function listDistrictByProvince($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->order('id ASC');
      $select->columns(array('id', 'name', 'type', 'alias', 'province_id', 'status','name_en'))->where(array('province_id' => $arrayParam['province_id'],'status' => 1));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->toArray();
      return $resultSet;
   }
   
   public function currentDistrict($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->order('id ASC');
      $select->columns(array('id', 'name','type' ,'alias', 'province_id', 'status','name_en'))->where(array('alias' => $arrayParam['alias'],'status' => 1));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->current();
      return $resultSet;
   }
}   
