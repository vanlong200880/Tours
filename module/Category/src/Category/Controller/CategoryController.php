<?php
namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\ServiceManager\ServiceManager;
use Category\Model\Nation;
use Category\Model\Province;
use Category\Model\District;
use Category\Model\Category;
use Category\Model\Post;
class CategoryController extends AbstractActionController
{
  protected $viewModel;
  protected $jsonModel;
  protected $serviceManager;
  public function __construct() {
//    $this->serviceManager = $serviceManager;
    $this->jsonModel = new JsonModel();
    $this->viewModel = new ViewModel();
  }
  public function indexAction()
  {
    $slug = $this->params()->fromRoute('category');
    $nationSlug = $this->params()->fromQuery('nation');
    $provinceSlug = $this->params()->fromRoute('province');
    $districtSlug = $this->params()->fromRoute('district');
    // Check category exists
    $category = new category();
    $categoryExists = $category->listCategoryBySlug(array('slug' => $slug));
    if($categoryExists){
      define('CATEGORY', $categoryExists->id);
    }
    if(!$categoryExists){
      return $this->redirect()->toRoute('home');
    }
    // get district
    $district = new District();
    $districtExists = $district->currentDistrict(array('alias' => $districtSlug));
    if($districtExists){
      define('DISTRICT', $districtExists->id);
    }
    
    $nation = new Nation();
    $nationSlugDefine = ($nationSlug) ? $nationSlug : 'viet-nam';
    $nationExists = $nation->currentNation(array('alias' => $nationSlugDefine));
    if($nationExists){
      define('NATION', $nationExists->id);
    }
    
    $province = new Province();
    $provinceExists = $province->currentProvince(array('alias' => $provinceSlug));
    if($provinceExists){
      define('PROVINCE', $provinceExists->id);
    }
    // get title region
    if($districtSlug && $provinceSlug){
      $regionExists = $district->currentDistrict(array('alias' => $districtSlug));
      if(!$regionExists){ return $this->redirect()->toRoute('home'); }
    }
    
    if($districtSlug == '' && $provinceSlug){
      $regionExists = $province->currentProvince(array('alias' => $provinceSlug));
      if(!$regionExists){ return $this->redirect()->toRoute('home'); }
    }
    
    if(($districtSlug == '' && $provinceSlug == '') || ($districtSlug && $provinceSlug && $nationSlug)){
      $nationSlug = ($nationSlug) ? $nationSlug : 'viet-nam';
      $regionExists = $nation->currentNation(array('alias' => $nationSlug));
      if(!$regionExists){ return $this->redirect()->toRoute('home'); }
    }
    // Count total post by parent
    $post = new Post();
    $countPostByParent = $post->countPostByCategoryParent(array('nation_id' => NATION, 'province_id' => PROVINCE, 'district_id' => DISTRICT));
    $this->viewModel->setVariable('countPost', $countPostByParent);
    $this->viewModel->setVariable('regionExists', $regionExists);
    
    // set category variable
    $this->viewModel->setVariable('category', $categoryExists);
    switch ($slug){
      case 'du-lich':
//        if($nation || $province):
//          $this->viewModel->setTemplate('travel/index');
//        else:
          // List province by nation id
//          $listPorvince = $province->listPorvinceByNation(array('id' => 1));
//          $this->viewModel->setVariable('listProvince', $listPorvince);
          $this->viewModel->setTemplate('travel/index');
//        endif;
        break;
      /* ----------------------------------------------------*/
      case 'diem-an-uong':
        $this->layout('layout/taste');
        $this->viewModel->setTemplate('taste/index');
        break;
      /* ----------------------------------------------------*/
      case 'khach-san':
        $this->layout('layout/hotel');
        $this->viewModel->setTemplate('hotel/index');
        break;
      /* ----------------------------------------------------*/
      case 'tour-du-lich':
        $this->layout('layout/tour');
        $this->viewModel->setTemplate('tour/index');
        break;
      /* ----------------------------------------------------*/
      case 'video':
        $this->layout('layout/video');
        $this->viewModel->setTemplate('video/index');
        break;
      /* ----------------------------------------------------*/
      case 'diary':
        die('a');
        break;
      /* ----------------------------------------------------*/
      default :
        break;
    }
    return $this->viewModel;
  }

  public function detailAction(){
    $slug = 'video';
    switch ($slug){
      case 'diem-du-lich':
        if($nation || $province):
          $this->viewModel->setTemplate('travel/index');
        else:
          $this->viewModel->setTemplate('travel/index-nation');
        endif;
        break;
      /* ----------------------------------------------------*/
      case 'diem-an-uong':
        $this->layout('layout/taste');
        $this->viewModel->setTemplate('taste/index');
        break;
      /* ----------------------------------------------------*/
      case 'khach-san':
        $this->layout('layout/hotel');
        $this->viewModel->setTemplate('hotel/index');
        break;
      /* ----------------------------------------------------*/
      case 'tour-du-lich':
        $this->layout('layout/tour');
        $this->viewModel->setTemplate('tour/index');
        break;
      /* ----------------------------------------------------*/
      case 'video':
        $this->layout('layout/video-detail');
        $this->viewModel->setTemplate('video/detail');
        break;
      /* ----------------------------------------------------*/
      case 'diary':
        die('a');
        break;
      /* ----------------------------------------------------*/
      default :
        break;
    }
    return $this->viewModel;
  }
}
