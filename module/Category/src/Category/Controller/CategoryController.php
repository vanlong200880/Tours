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
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\Iterator as paginatorIterator;
class CategoryController extends AbstractActionController
{
  protected $viewModel;
  protected $jsonModel;
  protected $serviceManager;
  protected $language;
  public function __construct() {
    $this->language = 'vi';
    $this->jsonModel = new JsonModel();
    $this->viewModel = new ViewModel();
  }

  public function indexAction()
  {
    $slug = $this->params()->fromRoute('category');
    $nationSlug = $this->params()->fromQuery('nation');
    $page = $this->params()->fromQuery('page',1);
    $provinceSlug = $this->params()->fromRoute('province');
    $districtSlug = $this->params()->fromRoute('district');
    $filter = $this->params()->fromQuery('filter');
    $star = $this->params()->fromQuery('star');
    $sort = $this->params()->fromPost('sort');
    $min = $this->params()->fromQuery('min');
    $max = $this->params()->fromQuery('max');
    $area = $this->params()->fromQuery('area');
    $keyword = $this->params()->fromQuery('keyword');
    
    define('FILTER', $filter);
    define('STAR', $star);
    define('MIN', $min);
    define('MAX', $max);
    define('AREA', $area);
    define('KEYWORD', $keyword);
    define('SORT', $keyword);
    
    // Check category exists
    $category = new category();
    $categoryExists = $category->listCategoryBySlug(array('slug' => $slug));
    if($categoryExists){
      define('CATEGORY', $categoryExists->id);
      define('CATEGORY_TYPE', $categoryExists->type);
    }
    
    switch ($categoryExists->type){
      case 'travel':
        $this->viewModel->setTemplate('travel/index');
//        $htmlViewPart->setTemplate('travel/load-data-travel');
        break;
      case 'tour':
        $this->layout('layout/tour');
        $this->viewModel->setTemplate('tour/index');
        break;
      case 'hotel':
        $this->layout('layout/hotel');
        $this->viewModel->setTemplate('hotel/index');
        break;
      case 'taste':
        $this->layout('layout/taste');
        $this->viewModel->setTemplate('taste/index');
        break;
      case 'video':
        $this->layout('layout/video');
        $this->viewModel->setTemplate('video/index');
        break;
      case 'utilities':
        $this->layout('layout/utilities');
        $this->viewModel->setTemplate('utilities/index');
        break;
      case 'diary':
        $this->layout('layout/diary');
        $this->viewModel->setTemplate('diary/index');
        break;
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
    $this->viewModel->setVariable('currentPage', $page);
    // set category variable
    $this->viewModel->setVariable('category', $categoryExists);
    $listIdCatgory = $category->getAllCategoryChildBySlug($categoryExists->id);
//    $dataPost = $post->getPostByCategory(array('language' => 'vi','categoryType' => $categoryExists->type,'CategoryIdCurrent' => $categoryExists->id,'categoryId' => $listIdCatgory,'nationId' => 1, 'provinceId' => 1, 'districtId' => 1));
//    var_dump($dataPost); die;
//    switch ($slug){
//      case 'du-lich':
////        if($nation || $province):
////          $this->viewModel->setTemplate('travel/index');
////        else:
//          // List province by nation id
////          $listPorvince = $province->listPorvinceByNation(array('id' => 1));
////          $this->viewModel->setVariable('listProvince', $listPorvince);
//          $this->viewModel->setTemplate('travel/index');
////        endif;
//        break;
//      /* ----------------------------------------------------*/
//      case 'diem-an-uong':
//        $this->layout('layout/taste');
//        $this->viewModel->setTemplate('taste/index');
//        break;
//      /* ----------------------------------------------------*/
//      case 'khach-san':
//        $this->layout('layout/hotel');
//        $this->viewModel->setTemplate('hotel/index');
//        break;
//      /* ----------------------------------------------------*/
//      case 'tour-du-lich':
//        $this->layout('layout/tour');
//        $this->viewModel->setTemplate('tour/index');
//        break;
//      /* ----------------------------------------------------*/
//      case 'video':
//        $this->layout('layout/video');
//        $this->viewModel->setTemplate('video/index');
//        break;
//      /* ----------------------------------------------------*/
//      case 'diary':
//        die('a');
//        break;
//      /* ----------------------------------------------------*/
//      default :
//        break;
//    }
    return $this->viewModel;
  }
  
  public function loadDataAction(){
//    if($this->getRequest()->isXmlHttpRequest()){
      $slug = $this->params()->fromPost('category');
      $nationSlug = $this->params()->fromPost('nation');
      $provinceSlug = $this->params()->fromPost('province');
      $districtSlug = $this->params()->fromPost('district');
      $page = $this->params()->fromPost('page', 1);
      $filter = $this->params()->fromPost('filter');
      $sort = $this->params()->fromPost('sort');
      $star = $this->params()->fromPost('star');
      $min = $this->params()->fromPost('min');
      $max = $this->params()->fromPost('max');
      $area = $this->params()->fromPost('area');
      $keyword = $this->params()->fromPost('keyword');

//      define('FILTER', $filter);
//      define('STAR', $star);
//      define('MIN', $min);
//      define('MAX', $max);
//      define('AREA', $area);
//      define('KEYWORD', $keyword);
      // Check category exists
      $category = new category();
      $categoryExists = $category->listCategoryBySlug(array('slug' => $slug));
      if($categoryExists){
        define('CATEGORY', $categoryExists->id);
      }
      $nationId = $districtId = $provinceId = '';
      $nation = new Nation();
      $nationCurrent = $nation->currentNation(array('alias' => $nationSlug));
      if($nationCurrent){
        $nationId = $nationCurrent->id;
      }
      // get district
      $district = new District();
      
      $province = new Province();
      $provinceExists = $province->currentProvince(array('alias' => $provinceSlug));
      if($provinceExists){
        define('PROVINCE', $provinceExists->id);
        $provinceId = $provinceExists->id;
      }
  //     get title region
      if($districtSlug && $provinceSlug){
        $regionExists = $district->currentDistrict(array('alias' => $districtSlug));
        $districtId = $regionExists->id;
      }

      if($districtSlug == '' && $provinceSlug){
        $regionExists = $province->currentProvince(array('alias' => $provinceSlug));
      }

      if(($districtSlug == '' && $provinceSlug == '') || ($districtSlug && $provinceSlug && $nationSlug)){
        $nationSlug = ($nationSlug) ? $nationSlug : 'viet-nam';
        $regionExists = $nation->currentNation(array('alias' => $nationSlug));
      }
      $post = new Post();
      $htmlViewPart = new ViewModel();
      switch ($categoryExists->type){
        case 'travel':
          
          // Lấy danh sách bài viết travel
          $listIdCatgory = $category->getAllCategoryChildBySlug($categoryExists->id);
          $dataPost = $post->getPostByCategory(array(
             'categoryType' => $categoryExists->type,
             'CategoryIdCurrent' => $categoryExists->id,
             'categoryId' => $listIdCatgory,
             'nationId' => 1, 
             'provinceId' => 1, 
             'districtId' => 1,
             'filter' => $filter,
             'sort' => $sort,
             'star' => $star,
             'min' => $min,
             'max' => $max,
             'area' => $area,
             'keyword' => $keyword
             ));
          $paginator = new Paginator(new paginatorIterator($dataPost));
          $paginator->setCurrentPageNumber($page)
                    ->setItemCountPerPage(ITEM_PAGE)
                    ->setPageRange(PAGE_RAND);
          $htmlViewPart->setTemplate('travel/load-data-travel');
          break;
        case 'tour':
          // Lấy danh sách bài viết tour
          $listIdCatgory = $category->getAllCategoryChildBySlug($categoryExists->id);
          $dataPost = $post->getPostByCategory(array(
             'categoryType' => $categoryExists->type,
             'CategoryIdCurrent' => $categoryExists->id,
             'categoryId' => $listIdCatgory,
             'nationId' => 1, 
             'provinceId' => 1, 
             'districtId' => 1,
             'filter' => $filter,
             'sort' => $sort,
             'star' => $star,
             'min' => $min,
             'max' => $max,
             'area' => $area,
             'keyword' => $keyword,
             'language' => $this->language
             ));
          $paginator = new Paginator(new paginatorIterator($dataPost));
          $paginator->setCurrentPageNumber($page)
                    ->setItemCountPerPage(ITEM_PAGE)
                    ->setPageRange(PAGE_RAND);
          $htmlViewPart->setTemplate('tour/load-data-tour');
          break;
        case 'hotel':
          // Lấy danh sách bài viết hotel
          $listIdCatgory = $category->getAllCategoryChildBySlug($categoryExists->id);
          $dataPost = $post->getPostByCategory(array(
             'categoryType' => $categoryExists->type,
             'CategoryIdCurrent' => $categoryExists->id,
             'categoryId' => $listIdCatgory,
             'nationId' => 1, 
             'provinceId' => 1, 
             'districtId' => 1,
             'filter' => $filter,
             'sort' => $sort,
             'star' => $star,
             'min' => $min,
             'max' => $max,
             'area' => $area,
             'keyword' => $keyword,
             'language' => $this->language
             ));
          $paginator = new Paginator(new paginatorIterator($dataPost));
          $paginator->setCurrentPageNumber($page)
                    ->setItemCountPerPage(ITEM_PAGE)
                    ->setPageRange(PAGE_RAND);
          $htmlViewPart->setTemplate('hotel/load-data-hotel');
          break;
        case 'taste':
          $htmlViewPart->setTemplate('taste/load-data-taste');
          break;
      }
      $htmlViewPart->setTerminal(true)
                   ->setVariables([
                       'filter' => $filter,
                       'min' => $min,
                       'max' => $max,
                       'area' => $area,
                       'sort' => $sort,
                       'keyword' => $keyword,
                       'star' => $star,
                       'province' => $provinceSlug, 
                       'district' => $districtSlug, 
                       'nation' => $nationSlug,
                       'page' => $page,
                       'paginator' => $paginator,
                       'regionExists' => $regionExists,
                       'category' => $categoryExists]);
      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);
      $jsonModel = new JsonModel();
      $jsonModel->setVariables(['html' => $htmlOutput]);
      return $jsonModel;
//    }else{
//      die('Forbidden access');
//    }
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
