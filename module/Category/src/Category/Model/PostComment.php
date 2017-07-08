<?php
namespace Category\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\Feature;
class PostComment extends AbstractTableGateway
{
	//Tên bảng
   protected $table = 'post_comment';
   
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
    * Danh sách bình luận
    * 
    * @param 	array 	$arrayParam		Dữ liệu truyền vào
    * @return 	array 	$resultSet		Dữ liệu trả về
    --------------------------------------------------------------------------------------------*/
   // Lấy danh sách comment parent
   public function listCommentByPostId($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->order('created ASC');
      $select->columns(array('id', 'post_id', 'total_like', 'user_id', 'title', 'come_back', 'total_bill', 'content', 'persion', 'parent','created', 'status', 'device'))->where(array('post_id' => $arrayParam['post_id'], 'post_comment.status' => 1));
      $select->join('user', 'user.id = user_id', array('username' => 'fullname', 'avatar'));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->toArray();
      return $resultSet;
   }
   public function listCommentChildByParent($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->order('created ASC');
      $select->columns(array('id', 'post_id', 'total_like' ,'user_id', 'title', 'come_back', 'total_bill', 'content', 'persion', 'parent','created', 'status', 'device'))->where(array('parent' => $arrayParam['parent'], 'post_comment.status' => 1));
      $select->join('user', 'user.id = user_id', array('username' => 'fullname', 'avatar'));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->toArray();
      return $resultSet;
   }
}   
