<?php
namespace Category\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\Feature;
class Nation extends AbstractTableGateway
{
	//Tên bảng
   protected $table = 'nation';
   
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
   // Lấy danh sách Nation
   public function listNation($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->order('menu_order ASC');
      $select->columns(array('id', 'name','type','type', 'alias', 'status','menu_order','name_en', 'active'))->where(array('status' => 1));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->toArray();
      return $resultSet;
   }
   
   public function currentNation($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->order('menu_order ASC');
      $select->columns(array('id', 'name','type', 'alias', 'status','menu_order','name_en', 'active'))->where(array('alias' => $arrayParam['alias'],'status' => 1));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->current();
      return $resultSet;
   }
}   
