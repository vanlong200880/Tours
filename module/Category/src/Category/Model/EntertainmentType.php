<?php
namespace Category\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\Feature;
use Zend\Db\Sql\Expression;
class EntertainmentType extends AbstractTableGateway
{
	//Tên bảng
   protected $table = 'entertainment_type';
   
   /**-----------------------------------------------------------------------------------------
    * Gọi adapter
    -------------------------------------------------------------------------------------------*/
   public function __construct()
   {	
   		$this->featureSet = new Feature\FeatureSet();
   		$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
    	$this->initialize();      
   }
   
  // Lấy ra loại trò chơi
  public function getListEntertainmentByTravelId($arrayParam = ''){
    $select = new Select();
    $select->from($this->table);
    $select->columns(array('id'))
          ->where(array('parent' => $arrayParam['parent']));
    $select->join('entertainment_type_detail', 'entertainment_type_detail.entertainment_type_id = entertainment_type.id', array('name', 'description', 'language', 'status', 'type'));
    $select->where(array('entertainment_type_detail.status' => 1, 'language' => $arrayParam['language']));
    $resultSet = $this->selectWith($select);
      $resultset = $resultSet->toArray();
    return $resultset;
  }
  


   public function getAllCategoryChildById($parent,$language){
      $select = new Select();
      $select->from($this->table);
      $select->columns(array('id'))
              ->where(array('parent' => $parent, 'language' => $language));
      
      $sub = new Select();
      $sub->from($this->table);
      $sub->columns(array('id'))
              ->where(array('parent' => $parent, 'language' => $language));
      
      $select1 = new Select();
      $select1->from($this->table);
      $select1->columns(array('id'))
              ->where->in('parent', $sub);
      
      $select->combine($select1);
      $resultSet = $this->selectWith($select);
      $resultset = $resultSet->toArray();
    return $resultset;
   }
}   
