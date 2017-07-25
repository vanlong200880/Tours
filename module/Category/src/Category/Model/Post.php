<?php
namespace Category\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\Feature;
use Zend\Db\Sql\Expression;
use Category\Model\EntertainmentType;
use Category\Model\Entertainment;
class Post extends AbstractTableGateway
{
	//Tên bảng
   protected $table = 'post';
   
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
    * Đếm tổng bài viết theo danh mục
    * 
    * 
    * @param 	array 	$arrayParam		Dữ liệu truyền vào
    * @return 	array 	$resultSet		Dữ liệu trả về
    --------------------------------------------------------------------------------------------*/
   public function countPostByCategoryParent($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
//      $select ->join('category_detail', 'category.id = category_detail.category_id', array('slug'));
//      $select ->join('post_detail', 'post.id = post_detail.post_id', array('slug', 'name'));
//      $select->where(array('post_detail.status_id' => 1));
//      
      $select->columns(array('totalPost' => new Expression('COUNT(category.type)')))
              ->join('category', 'category.id = post.category_id', array('type'))
              ->join('category_detail', 'category.id = category_detail.category_id', array('category_slug' => 'slug'))
              ->join('post_detail', 'post.id = post_detail.post_id', array('post_slug' => 'slug', 'name'))
              ->group('category.type')
              ->where(array('post_detail.status_id' => 1))
              ->where->in('category.type', array('travel', 'tour', 'hotel', 'taste'));
      if($arrayParam['nation_id'] && $arrayParam['province_id'] && $arrayParam['district_id']){
        $select->where(array('district_id' => $arrayParam['district_id']));
      }
      if($arrayParam['nation_id'] && $arrayParam['province_id'] && $arrayParam['district_id'] == ''){
        $select->where(array('province_id' => $arrayParam['province_id']));
      }
      if($arrayParam['nation_id'] && $arrayParam['province_id'] == '' && $arrayParam['district_id'] == ''){
        $select->where(array('nation_id' => $arrayParam['nation_id']));
      }
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->toArray();
      return $resultSet;
   }
   
   // Lấy bài viết theo danh mục
   public function getPostByCategory($arrayParam = null){
      $select = new Select();
      $select->from($this->table);
      $select ->join('category', 'category.id = post.category_id', array('type'));
      $select ->join('category_detail', 'category.id = category_detail.category_id', array('category_slug' => 'slug'));
      $select ->join('post_detail', 'post.id = post_detail.post_id', array('post_slug' => 'slug', 'name', 'hot', 'new', 'address'));
      $select->where(array('post_detail.status_id' => 1));
      $arrId = array($arrayParam['CategoryIdCurrent']);
      
      $select->join('nation', 'post_detail.nation_id= nation.id', array('nation_name' => 'name', 'nation_type' => 'type'));
      $select->join('province', 'post_detail.province_id = province.id', array('province_name' => 'name', 'province_type' => 'type'));
      $select->join('district', 'post_detail.district_id = district.id', array('district_name' => 'name', 'district_type' => 'type'));
      $select->join('ward', 'post_detail.ward_id= ward.id', array('ward_name' => 'name', 'ward_type' => 'type'));
      if($arrayParam['categoryId']){
        foreach ($arrayParam['categoryId'] as $value){
          array_push($arrId, $value['id']);
        }
      }
      if(isset($arrayParam['type']) == 'tour'){
        $select->join('tour', 'post.id = tour.post_id', array('price', 'excerptTour' => 'excerpt', 'address', 'commitment', 'language'));
        $select->where(array('tour.language' => $arrayParam['language']));
      }
      $select->where->in('post.category_id', $arrId);
      if($arrayParam['nationId']){
        $select->where(array('post_detail.nation_id' => $arrayParam['nationId']));
      }
      if($arrayParam['provinceId']){
        $select->where(array('post_detail.province_id' => $arrayParam['provinceId']));
      }
      if($arrayParam['districtId']){
        $select->where(array('post_detail.district_id' => $arrayParam['districtId']));
      }
      
      if($arrayParam['categoryType']){
        switch ($arrayParam['categoryType']){
        case 'travel':
          $select->columns(
              array('id'));
          if($arrayParam['filter'] == 'news'){
            $select->order('post_detail.new ASC');
          }
          if($arrayParam['filter'] == 'hot'){
            $select->order('post_detail.hot ASC');
          }
          if($arrayParam['filter'] == 'view'){
            $select->order('post_detail.view DESC');
          }
          $select->order('post_detail.menu_order ASC');
          $select->order('post_detail.publish_date DESC');
          break;
        case 'tour':
          break;
        case 'hotel':
          break;
        case 'taste':
          break;
        case 'video':
          break;
        case 'diary':
          break;
          case 'utilities':
            break;
        }
      }
      
      
      $resultSet = $this->selectWith($select);
      $resultSet->buffer()->toArray();
      return $resultSet;
   }
   
   public function getPostById($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->columns(array('id', 'user_id', 'category_id'));
      $select->join('category', 'category.id = post.category_id', array('type'));
      $select->join('category_detail', 'category.id = category_detail.category_id', array('category_slug' => 'slug', 'category_id' => 'category_id'));
      $select ->join('post_detail', 'post_detail.post_id = post.id', array('post_detail_id' => 'id','post_slug' => 'slug', 'name', 'hot', 'new', 'address', 'about', 'slug', 'content', 'language', 'status_id', 'excerpt'));
      $select->where(array('post_detail.status_id' => 1, 'post.id' => $arrayParam['id'], 'post_detail.language' => $arrayParam['language'] ));
      $select->join('nation', 'post_detail.nation_id= nation.id', array('nation_name' => 'name', 'nation_type' => 'type'));
      $select->join('province', 'post_detail.province_id= province.id', array('province_name' => 'name', 'province_type' => 'type'));
      $select->join('district', 'post_detail.district_id= district.id', array('district_name' => 'name', 'district_type' => 'type'));
      $select->join('ward', 'post_detail.ward_id= ward.id', array('ward_name' => 'name', 'ward_type' => 'type'));
      if($arrayParam['type'] == 'travel'){
        $select->join('travel', 'travel.post_id= post.id', array('travel_id' => 'id'));
      }
      
      if($arrayParam['type'] == 'tour'){
        $select->join('tour', 'tour.post_id= post.id', array('excerpt_des' => 'excerpt', 'commitment', 'address', 'price'));
      }

      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->current();
      return $resultSet;
   }
   
   // Lấy post related
   public function getPostRelatedByCategory($arrayParam = null){
      $select = new Select();
      $select->from($this->table);
      $select ->join('category', 'category.id = post.category_id', array('type'));
      $select ->join('category_detail', 'category.id = category_detail.category_id', array('category_slug' => 'slug'));
      $select ->join('post_detail', 'post.id = post_detail.post_id', array('post_slug' => 'slug', 'name', 'hot', 'new', 'address'));
      $select->where(array('post_detail.status_id' => 1, 'post_detail.language' => $arrayParam['language']));
      
      $select->join('nation', 'post_detail.nation_id= nation.id', array('nation_name' => 'name', 'nation_type' => 'type'));
      $select->join('province', 'post_detail.province_id= province.id', array('province_name' => 'name', 'province_type' => 'type'));
      $select->join('district', 'post_detail.district_id= district.id', array('district_name' => 'name', 'district_type' => 'type'));
      $select->join('ward', 'post_detail.ward_id= ward.id', array('ward_name' => 'name', 'ward_type' => 'type'));
      $select->where(array('post.category_id' => $arrayParam['category_id']));
      $select->where->addPredicate(new \Zend\Db\Sql\Predicate\NotIn('post.id', array($arrayParam['id'])));
      if($arrayParam['nationId']){
        $select->where(array('post_detail.nation_id' => $arrayParam['nationId']));
      }
      if($arrayParam['provinceId']){
        $select->where(array('post_detail.province_id' => $arrayParam['provinceId']));
      }
      if($arrayParam['districtId']){
        $select->where(array('post_detail.district_id' => $arrayParam['districtId']));
      }
      
      $select->order('post_detail.publish_date DESC');
      $select->limit($arrayParam['limit']);
      
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->toArray();
      return $resultSet;
   }
}   
