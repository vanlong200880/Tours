<?php
namespace Category\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\Feature;
class PostVideo extends AbstractTableGateway
{
	//Tên bảng
   protected $table = 'post_video';
   
   /**-----------------------------------------------------------------------------------------
    * Gọi adapter
    -------------------------------------------------------------------------------------------*/
   public function __construct()
   {	
      $this->featureSet = new Feature\FeatureSet();
      $this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
    	$this->initialize();      
   }
   
   // Lấy danh sách video theo post detail id
   public function getListVideoByDetailPostId($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->order('post_video.created ASC');
      $select->columns(array('id', 'name', 'type', 'view', 'created', 'status', 'post_detail_id'))
              ->where(array('post_detail_id' => $arrayParam['post_detail_id'], 'post_video.status' => 1));
      $select->join('user', 'user.id = post_video.user_id', array('fullname'));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->toArray();
      return $resultSet;
   }
}   
