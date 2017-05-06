<?php
namespace Category\Block;
use Zend\View\Helper\AbstractHelper;
use Category\Model\Category;
use Category\Model\Nation;
use Category\Model\Province;
use Category\Model\District;
class searchCategory extends AbstractHelper
{    
  public function __invoke() {
    // Get list category
    $category = new Category();
    $categoryType = $category->listCategoryByParent(array('parent' => 0));
    // Get list nation
    $nation = new Nation();
    $listNation = $nation->listNation();
    
    //get list province
//    echo '<br><br><br><br><br><br><br><br><br><br>';
//    var_dump(NATION, PROVINCE, DISTRICT); die;
    $listProvince = array();
    if(NATION){
      $province = new Province();
      $listProvince = $province->listPorvinceByNation(array('nation_id' => NATION));
    }
    $listDistrict = array();
    if(PROVINCE){
      $district = new District();
      $listDistrict = $district->listDistrictByProvince(array('province_id' => PROVINCE));
//      var_dump($listDistrict); die;
    }
    $data = $this->view->partial('block/searchCategory/searchCategory.phtml', array('categoryType' => $categoryType, 'listNation' => $listNation, 'listProvince' => $listProvince, 'listDistrict' => $listDistrict));
    echo $data;
  }
}
