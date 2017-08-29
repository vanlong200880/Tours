<?php
namespace Category\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\Feature;
class AmenitiesPost extends AbstractTableGateway
{
	//Tên bảng
   protected $table = 'amenities_post';
   
   /**-----------------------------------------------------------------------------------------
    * Gọi adapter
    -------------------------------------------------------------------------------------------*/
   public function __construct()
   {	
   		$this->featureSet = new Feature\FeatureSet();
   		$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
    	$this->initialize();      
   }
   
    /** --------------------------------------------------------------------------------------------*/
   // Lấy danh sách tiện nghi khách sạn
   public function listAmenitiesPostByPostId($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->columns(array('id', 'post_id','amenities_id'))
              ->join('amenities', 'amenities.id = amenities_post.amenities_id', array('name', 'status', 'icon'))
              ->where(array('post_id' => $arrayParam['post_id'], 'status' => 1));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->toArray();
      return $resultSet;
   }
}   
