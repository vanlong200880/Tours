<?php
namespace Category\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Combine;
use Zend\Db\TableGateway\Feature;
class Category extends AbstractTableGateway
{
	//Tên bảng
   protected $table = 'category';
   
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
    * Danh sách thể loại
    * Nơi sử dụng: Block_Menu
    * 
    * @param 	array 	$arrayParam		Dữ liệu truyền vào
    * @return 	array 	$resultSet		Dữ liệu trả về
    --------------------------------------------------------------------------------------------*/
   public function listCategoryMenu($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      // Sắp Xếp
      $select->order('menu_order ASC');
      // Lấy danh sách thể loại gốc
      $select->columns(array('id', 'parent', 'type'))->where(array('parent' => 0, 'status' => 1));
      $select->join('category_detail', 'category_detail.category_id = category.id', array('name', 'slug','menu_order', 'thumbnail'));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->toArray();
      if($resultSet){
        foreach ($resultSet as $key => $value){
          $root = $this->listCategoryByParent(array('parent' => $value['id']));
          $resultSet[$key]['root'] = $root;
          if($root){
            foreach ($root as $k => $val){
              $child = $this->listCategoryByParent(array('parent' => $val['id']));
              $resultSet[$key]['root'][$k]['child'] = $child;
            }
          }
        }
      }
      return $resultSet;
   }
   
   // Lấy danh sách item menu theo parent
   public function listCategoryByParent($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->order('menu_order ASC');
      $select->columns(array('id', 'parent', 'type'))->where(array('parent' => $arrayParam['parent'], 'status' => 1));
      $select->join('category_detail', 'category_detail.category_id = category.id', array('name', 'slug','menu_order','thumbnail'));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->toArray();
      return $resultSet;
   }
   
   // Lấy danh mục theo slug
   public function listCategoryBySlug($arrayParam = null)
   {
      $select = new Select();
      $select->from($this->table);
      $select->order('menu_order ASC');
      //$select->columns(array('id', 'name', 'slug', 'parent', 'type','menu_order'))->where(array('slug' => $arrayParam['slug'], 'status' => 1));
      $select->columns(array('id', 'parent', 'type'));
      $select->join('category_detail', 'category_detail.category_id = category.id', array('name', 'slug','menu_order','thumbnail'));
      $select->where(array('category_detail.slug' => $arrayParam['slug'], 'category_detail.status' => 1));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->current();
      return $resultSet;
   }
   
   // get all cat id by slug
   public function getAllCategoryChildBySlug($parent){
      $select = new Select();
      $select->from($this->table);
      $select->columns(array('id'))
              ->where(array('parent' => $parent));
      
      $sub = new Select();
      $sub->from($this->table);
      $sub->columns(array('id'))
              ->where(array('parent' => $parent));
      
      $select1 = new Select();
      $select1->from($this->table);
      $select1->columns(array('id'))
              ->where->in('parent', $sub);
      
      $select->combine($select1);
      $resultSet = $this->selectWith($select);
      $resultset = $resultSet->toArray();
    return $resultset;
   }
}   
