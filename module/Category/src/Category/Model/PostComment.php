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
      $select->columns(array('id', 'post_id', 'total_like', 'user_id', 'title', 'come_back', 'total_bill', 'content', 'persion', 'parent','created', 'status', 'device'))->where(array('post_id' => $arrayParam['post_id'], 'post_comment.status' => 1, 'parent' => 0));
      $select->join('user', 'user.id = user_id', array('username' => 'fullname', 'avatar'));
      $select->offset($arrayParam['offset']);
      $select->limit($arrayParam['limit']);
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->toArray();
      return $resultSet;
   }
   // Đếm tổng số comment parent
   public function countCommentByPostId($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
//      $select->order('created ASC');
//      $select->columns(array('id', 'post_id', 'total_like', 'user_id', 'title', 'come_back', 'total_bill', 'content', 'persion', 'parent','created', 'status', 'device'))
      $select->where(array('post_id' => $arrayParam['post_id'], 'post_comment.status' => 1, 'parent' => 0));
      $select->join('user', 'user.id = user_id', array('username' => 'fullname', 'avatar'));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->count();
      return $resultSet;
   }
   public function listCommentChildByParent($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->order('created ASC');
      $select->columns(array('id', 'post_id', 'total_like' ,'user_id', 'title', 'come_back', 'total_bill', 'content', 'persion', 'parent','created', 'status', 'device'));
      $select->where(array('post_id' => $arrayParam['post_id'], 'parent' => $arrayParam['parent'], 'post_comment.status' => 1));
      $select->join('user', 'user.id = user_id', array('username' => 'fullname', 'avatar'));
      $select->offset($arrayParam['offset']);
      $select->limit($arrayParam['limit']);
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->toArray();
      return $resultSet;
   }
   
   public function countCommentChildByParent($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->order('created ASC');
      $select->columns(array('id', 'post_id', 'total_like' ,'user_id', 'title', 'come_back', 'total_bill', 'content', 'persion', 'parent','created', 'status', 'device'));
      $select->where(array('post_id' => $arrayParam['post_id'], 'parent' => $arrayParam['parent'], 'post_comment.status' => 1));
      $select->join('user', 'user.id = user_id', array('username' => 'fullname', 'avatar'));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->count();
      return $resultSet;
   }
   
   public function checkCommentById($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->order('created ASC');
      $select->columns(array('id', 'post_id', 'total_like' ,'user_id', 'title', 'come_back', 'total_bill', 'content', 'persion', 'parent','created', 'status', 'device'));
      $select->where(array('parent' => 0, 'post_comment.status' => 1, 'id' => $arrayParam['id']));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->current();
      return $resultSet;
   }
   
   public function createComment($arrayParam = null)
   {
      $data = array(
        'post_id' => $arrayParam['post_id'],
        'user_id' => $arrayParam['user_id'],
        'title' => $arrayParam['title'],
        'content' => $arrayParam['content'],
        'parent' => $arrayParam['parent'],
        'created' => $arrayParam['created'],
        'status' => $arrayParam['status'],
        'device' => $arrayParam['device'],
        'persion' => $arrayParam['persion'],
        'total_bill' => $arrayParam['total_bill'],
        'come_back' => $arrayParam['come_back'],
        'total_like' => $arrayParam['total_like']
      );
      $this->insert($data);
      return $this->lastInsertValue;
   }
   
   
   public function getCommentById($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->columns(array('id', 'post_id', 'total_like' ,'user_id', 'title', 'come_back', 'total_bill', 'content', 'persion', 'parent','created', 'status', 'device'));
      $select->where(array('post_id' => $arrayParam['post_id'], 'post_comment.status' => 1, 'post_comment.id' => $arrayParam['id']));
      $select->join('user', 'user.id = user_id', array('username' => 'fullname', 'avatar'));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->current();
      return $resultSet;
   }
   
  
}   
