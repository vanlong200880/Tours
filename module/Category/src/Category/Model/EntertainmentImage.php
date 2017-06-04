<?php
namespace Category\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\Feature;
class EntertainmentImage extends AbstractTableGateway
{
	//Tên bảng
   protected $table = 'entertainment_img';
   
   /**-----------------------------------------------------------------------------------------
    * Gọi adapter
    -------------------------------------------------------------------------------------------*/
   public function __construct()
   {	
      $this->featureSet = new Feature\FeatureSet();
      $this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
    	$this->initialize();      
   }
   
   // Lấy danh sách hình theo post detail id
   public function getListEntertainmentImage($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->order('id ASC');
      $select->columns(array('id', 'name', 'width', 'status','height', 'entertainment_id'))
              ->where(array('entertainment_id' => $arrayParam['entertainment_id']));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->toArray();
      return $resultSet;
   }
}   
