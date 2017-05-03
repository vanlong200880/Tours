<?php
namespace Category\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;
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
      $select->columns(array('id', 'name', 'slug', 'parent', 'type','menu_order'))->where(array('parent' => 0, 'status' => 1));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->toArray();
      if($resultSet){
        foreach ($resultSet as $key => $value){
          $root = $this->listCategoryByParent(array('parent' => $value['id']));
          $resultSet[$key]['root'] = $root;
          if($root){
            foreach ($root as $k => $val){
              $child = $this->listCategoryByParent(array('parent' => $val['id']));
              $resultSet[$key]['root'][$key]['child'] = $child;
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
      // Sắp Xếp
      $select->order('menu_order ASC');
      // Lấy danh sách thể loại gốc
      $select->columns(array('id', 'name', 'slug', 'parent', 'type','menu_order'))->where(array('parent' => $arrayParam['parent'], 'status' => 1));
      $resultSet = $this->selectWith($select);
      $resultSet = $resultSet->toArray();
      return $resultSet;
   }
}   
