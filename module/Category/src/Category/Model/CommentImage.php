<?php
namespace Category\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\Feature;
class CommentImage extends AbstractTableGateway
{
	//Tên bảng
   protected $table = 'comment_image';
   
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
    * Danh sách hình bình luận
    * 
    * @param 	array 	$arrayParam		Dữ liệu truyền vào
    * @return 	array 	$resultSet		Dữ liệu trả về
    --------------------------------------------------------------------------------------------*/
   // Lấy danh sách district
   public function listImageByCommentId($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->order('id ASC');
      $select->columns(array('id', 'name', 'type', 'width', 'height', 'post_comment_id'))->where(array('post_comment_id' => $arrayParam['post_comment_id'], 'status' => 1));
      $select->limit($arrayParam['limit']);
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->toArray();
      return $resultSet;
   }
   public function countImageByCommentId($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->order('id ASC');
      $select->columns(array('id', 'name', 'type', 'width', 'height', 'post_comment_id'))->where(array('post_comment_id' => $arrayParam['post_comment_id'], 'status' => 1));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->count();
      return $resultSet;
   }
}   
