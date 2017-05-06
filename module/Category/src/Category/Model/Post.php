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
}   
