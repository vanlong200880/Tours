<?php
namespace Category\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\Feature;
use Zend\Db\Sql\Expression;
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
        $select->where(array('nation_id' => $arrayParam['nationId']));
      }
      if($arrayParam['provinceId']){
        $select->where(array('province_id' => $arrayParam['provinceId']));
      }
      if($arrayParam['districtId']){
        $select->where(array('district_id' => $arrayParam['districtId']));
      }
      
      if($arrayParam['categoryType']){
        switch ($arrayParam['categoryType']){
        case 'travel':
          $totalEntertaiment   = new Select( 'category' );
          $totalEntertaiment->columns( array( 'total' => new Expression('COUNT(*)') ) );
          $select->columns(
              array(
                  'id', 'name', 'slug', 'hot', 'new', 'sticky',
                  'totalEntertaiment' => new \Zend\Db\Sql\Expression( '?', array( $totalEntertaiment ) )
                  ));
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
}   
