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
    $select->columns(array('travel_id'));
    $select->join('entertainment_detail', 'entertainment_detail.entertainment_id = entertainment.id', array('id','name', 'description', 'language', 'status'));
    $select->where(array('travel_id' => $arrayParam['travel_id'], 'entertainment_type_id' => $arrayParam['entertainment_type_id']));
    $select->where(array('entertainment_detail.language' => $arrayParam['language'], 'entertainment_detail.status' => 1));
    $select->join('travel_price', 'travel_price.entertainment_id = entertainment.id', array('price_adult', 'price_child'));
    $resultSet = $this->selectWith($select);
    $resultSet = $resultSet->toArray();
    return $resultSet;
  }
  
  public function getTotalEntertainment($arrayParam = null){
    $select = new Select();
    $select->from($this->table);
    $select->columns(array('id', 'count'=>new \Zend\Db\Sql\Expression('COUNT(*)')));
    $select->join('entertainment_detail', 'entertainment_detail.entertainment_id = entertainment.id', array('type', 'name'));
    $select->where(array('travel_id' => $arrayParam['post_id']));
    $select->group('entertainment_detail.type');
    //$select->where(array('entertainment_detail.language' => $arrayParam['language'], 'entertainment_detail.status' => 1));
    //$select->join('travel_price', 'travel_price.entertainment_id = entertainment.id', array('price_adult', 'price_child'));
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
