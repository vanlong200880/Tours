<?php
namespace Category\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\Feature;
class PostImage extends AbstractTableGateway
{
	//Tên bảng
   protected $table = 'post_image';
   
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
   public function getListGalleryByDetailPostId($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->order('id ASC');
      $select->columns(array('id', 'name', 'type', 'language', 'width', 'status','height', 'post_detail_id'))
              ->where(array('post_detail_id' => $arrayParam['post_detail_id'],'status' => 1, 'language' => $arrayParam['language']));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->toArray();
      return $resultSet;
   }
}   
