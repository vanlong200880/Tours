<?php
namespace Category\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\Feature;
use Zend\Db\Sql\Expression;
class Entertainment extends AbstractTableGateway
{
	//Tên bảng
   protected $table = 'entertainment';
   
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
  public function getAllEntertainmentByTravel($arrayParam = null){
    $select = new Select();
    $select->from($this->table);
    $select->columns(array('id'));
    $select->join('entertaimment_detail', 'entertaimment_detail.entertainment_id = entertainment.id', array('name', 'description', 'language', 'status'));
    $select->where(array('entertainment_type_id' => $arrayParam['entertainment_type_id']));
    $select->where(array('entertaimment_detail.language' => $arrayParam['language'], 'entertaimment_detail.status' => 1));
    $resultSet = $this->selectWith($select);
    $resultSet = $resultSet->toArray();
    return $resultSet;
  }
  
//  
//   public function getAllEntertainmentByListId($arrayParam = null){
//      $select = new Select();
//      $select->from($this->table);
//      $select->columns(array('total' => new Expression('COUNT(*)')));
//      $select ->where(array('status' => 1));
//      $select->where->in('entertainment_type_id', $arrayParam);
//      $resultSet = $this->selectWith($select);
//      $resultSet = $resultSet->current();
//      return $resultSet;
//   }
}   
