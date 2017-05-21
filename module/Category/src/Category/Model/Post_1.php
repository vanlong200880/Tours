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
      $select->columns(array('totalPost' => new Expression('COUNT(category.type)')))
              ->join('category', 'category.id = post.category_id', array('type'))
              ->group('category.type')
              ->where(array('status_id' => 1))
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
      $select ->join('category', 'category.id = post.category_id', array('type'))
              ->where(array('status_id' => 1));
      $arrId = array($arrayParam['CategoryIdCurrent']);
      if($arrayParam['categoryId']){
        foreach ($arrayParam['categoryId'] as $value){
          array_push($arrId, $value['id']);
        }
      }
      $select->where->in('category_id', $arrId);
      if($arrayParam['nationId']){
        $select->where(array('post.nation_id' => $arrayParam['nationId']));
      }
      if($arrayParam['provinceId']){
        $select->where(array('post.province_id' => $arrayParam['provinceId']));
      }
      if($arrayParam['districtId']){
        $select->where(array('post.district_id' => $arrayParam['districtId']));
      }
      
      if($arrayParam['categoryType']){
        switch ($arrayParam['categoryType']){
        case 'travel':
          // Lấy tổng trò chơi
          $entertainmentType = new EntertainmentType();
          $listEntertainmentType = $entertainmentType->getAllCategoryChildById(2, 'vi');
          $arrEntertainmentType = array();
          if($listEntertainmentType){
            foreach ($listEntertainmentType as $value){
              array_push($arrEntertainmentType, $value['id']);
            }
          }
          
          $entertaiment = new Entertainment();
          $totalEntertaiment = $entertaiment->getAllEntertainmentByListId($arrEntertainmentType);
//          var_dump($totalEntertaiment); die;
//          $totalEntertaiment   = new Select( 'category' );
//          $totalEntertaiment->columns( array( 'total' => new Expression('COUNT(*)') ) );
          $select->columns(
              array(
                  'id', 'name', 'slug', 'hot', 'new', 'sticky', 'address', 'lat', 'lng'
//                  'totalEntertaiment' => new \Zend\Db\Sql\Expression( '?', array( ($totalEntertaiment)? $totalEntertaiment->total: 0 ) )
                  ));
          $select->join('travel', 'post.id = travel.post_id', array());
//          $select->join(
//                  array(
//                      'd' => 'entertainment',
////                      'd.travel_id' => 'travel.id'
//                      ),
//                  'd.travel_id = travel.id',
//                  array('totala' => new Expression('COUNT(*)')),
//                  Select::SQL_STAR,
//                  Select::JOIN_RIGHT
//                  array(),
//    Select::JOIN_RIGHT
//                  array('totala' => new Expression('COUNT(*)')), 
//                  Select::SQL_STAR ,
//                  Select::JOIN_RIGHT
//                  );
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
      $select->join('nation', 'post.nation_id= nation.id', array('nation_name' => 'name', 'nation_type' => 'type'));
      $select->join('province', 'post.province_id= province.id', array('province_name' => 'name', 'province_type' => 'type'));
      $select->join('district', 'post.district_id= district.id', array('district_name' => 'name', 'district_type' => 'type'));
      $select->join('ward', 'post.ward_id= ward.id', array('ward_name' => 'name', 'ward_type' => 'type'));
      
      $resultSet = $this->selectWith($select);
      $resultSet->buffer()->toArray();
      return $resultSet;
   }
}   
