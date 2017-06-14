<?php
namespace Category\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\Feature;
class PostContact extends AbstractTableGateway
{
	//Tên bảng
   protected $table = 'post_contact';
   
   /**-----------------------------------------------------------------------------------------
    * Gọi adapter
    -------------------------------------------------------------------------------------------*/
   public function __construct()
   {	
      $this->featureSet = new Feature\FeatureSet();
      $this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
    	$this->initialize();      
   }
   
   // Lấy danh sách liên hệ
   public function getListContactByPostId($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->order('id ASC');
      $select->columns(array('id', 'name', 'email', 'zalo', 'avatar', 'skype', 'phone', 'hotline', 'status'))
              ->where(array('post_id' => $arrayParam['post_id'], 'status' => 1));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->toArray();
      return $resultSet;
   }
}   
