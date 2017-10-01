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
use Category\Util\MapGeoCode;
use Category\Model\PostImage;
use Category\Model\EntertainmentType;
use Category\Model\Entertainment;
use Category\Model\Vehicle;
use Category\Model\PostVideo;
use Category\Model\PostContact;
use Category\Model\EntertainmentDetail;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\Iterator as paginatorIterator;

class CategoryController extends AbstractActionController {

  protected $viewModel;
  protected $jsonModel;
  protected $serviceManager;
  protected $language;

  public function __construct() {
    $this->language = 'vi';
    $this->jsonModel = new JsonModel();
    $this->viewModel = new ViewModel();
  }

  public function indexAction() {
    $slug = $this->params()->fromRoute('category');
    $nationSlug = $this->params()->fromQuery('nation');
    $page = $this->params()->fromQuery('page', 1);
    $provinceSlug = $this->params()->fromRoute('province');
    $districtSlug = $this->params()->fromRoute('district');
    $filter = $this->params()->fromQuery('filter');
    $star = $this->params()->fromQuery('star');
    $sort = $this->params()->fromPost('sort');
    $min = $this->params()->fromQuery('min');
    $max = $this->params()->fromQuery('max');
    $area = $this->params()->fromQuery('area');
    $keyword = $this->params()->fromQuery('keyword');
    
    // set post id
    $postId = $this->params()->fromRoute('id');
    $this->viewModel->setVariable('postId', $postId);
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
    if ($categoryExists) {
      define('CATEGORY', $categoryExists->id);
      define('CATEGORY_TYPE', $categoryExists->type);
    }

    switch ($categoryExists->type) {
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

    if (!$categoryExists) {
      return $this->redirect()->toRoute('home');
    }
    // get district
    $district = new District();
    $districtExists = $district->currentDistrict(array('alias' => $districtSlug));
    if ($districtExists) {
      define('DISTRICT', $districtExists->id);
    }

//    $nation = new Nation();
//    $nationSlugDefine = ($nationSlug) ? $nationSlug : 'viet-nam';
//    $nationExists = $nation->currentNation(array('alias' => $nationSlugDefine));
//    if ($nationExists) {
//      define('NATION', $nationExists->id);
//    }

//    $province = new Province();
//    $provinceExists = $province->currentProvince(array('alias' => $provinceSlug));
//    if ($provinceExists) {
//      define('PROVINCE', $provinceExists->id);
//    }
    // get title region
//    if ($districtSlug && $provinceSlug) {
//      $regionExists = $district->currentDistrict(array('alias' => $districtSlug));
//      if (!$regionExists) {
//        return $this->redirect()->toRoute('home');
//      }
//    }

//    if ($districtSlug == '' && $provinceSlug) {
//      $regionExists = $province->currentProvince(array('alias' => $provinceSlug));
//      if (!$regionExists) {
//        return $this->redirect()->toRoute('home');
//      }
//    }
    
//    if (($districtSlug == '' && $provinceSlug == '') || ($districtSlug && $provinceSlug && $nationSlug)) {
//      $nationSlug = ($nationSlug) ? $nationSlug : 'viet-nam';
//      $regionExists = $nation->currentNation(array('alias' => $nationSlug));
//      if (!$regionExists) {
//        return $this->redirect()->toRoute('home');
//      }
//    }
    // Count total post by parent
    $post = new Post();
    $countPostByParent = $post->countPostByCategoryParent(array('nation_id' => NATION, 'province_id' => PROVINCE, 'district_id' => DISTRICT));
    $this->viewModel->setVariable('countPost', $countPostByParent);
//    $this->viewModel->setVariable('regionExists', $regionExists); 
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

  public function loadDataAction() {
//    if($this->getRequest()->isXmlHttpRequest()){
    $slug = $this->params()->fromPost('slug');
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
    if ($categoryExists) {
      define('CATEGORY', $categoryExists->id);
    }
    $nationId = $districtId = $provinceId = '';
    $nation = new Nation();
    $nationCurrent = $nation->currentNation(array('alias' => $nationSlug));
    if ($nationCurrent) {
      $nationId = $nationCurrent->id;
    }
    // get district
    $district = new District();

    $province = new Province();
    $provinceExists = $province->currentProvince(array('alias' => $provinceSlug));
    if ($provinceExists) {
      define('PROVINCE', $provinceExists->id);
      $provinceId = $provinceExists->id;
    }
    //     get title region
    if ($districtSlug && $provinceSlug) {
      $regionExists = $district->currentDistrict(array('alias' => $districtSlug));
      $districtId = $regionExists->id;
    }

    if ($districtSlug == '' && $provinceSlug) {
      $regionExists = $province->currentProvince(array('alias' => $provinceSlug));
    }

    if (($districtSlug == '' && $provinceSlug == '') || ($districtSlug && $provinceSlug && $nationSlug)) {
      $nationSlug = ($nationSlug) ? $nationSlug : 'viet-nam';
      $regionExists = $nation->currentNation(array('alias' => $nationSlug));
    }
    $post = new Post();
    $htmlViewPart = new ViewModel();
    switch ($categoryExists->type) {
      case 'travel':
//          die;
        // Lấy danh sách bài viết travel
        $listIdCatgory = $category->getAllCategoryChildBySlug($categoryExists->id);
        $dataPost = $post->getPostByCategory(array(
            'categoryType' => $categoryExists->type,
            'CategoryIdCurrent' => $categoryExists->id,
            'categoryId' => $listIdCatgory,
            'nationId' => $nationId,
            'provinceId' => $provinceId,
            'districtId' => $districtId,
            'filter' => $filter,
            'sort' => $sort,
            'star' => $star,
            'min' => $min,
            'max' => $max,
            'area' => $area,
            'keyword' => $keyword,
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
                'slug' => $slug,
                'categoryExists' => $categoryExists,
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
    $dataJson = array();
    if ($paginator->getTotalItemCount() > 0) {
      foreach ($paginator as $key => $value) {
        $dataJson[$key] = array(
            'title' => $value->name,
            'lat' => $value->lat,
            'lng' => $value->lng,
            'thumbnail' => $value->thumbnail,
            'type' => $value->type
        );
      }
    }
//      die;
    $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);
    $jsonModel = new JsonModel();
    $jsonModel->setVariables(['html' => $htmlOutput, 'dataJson' => $dataJson, 'categoryExists' => $nationId]);
    return $jsonModel;
//    }else{
//      die('Forbidden access');
//    }
  }

  public function detailAction() {
    $slug = $this->params()->fromRoute('slug');
    $id = $this->params()->fromRoute('id');
    //  Kiểm tra post tồn taij không
    $post = new Post();
    $dataPost = $post->checkPostDetailPageById(array('id' => $id, 'language' => $this->language));
//    echo '<pre>';
//    var_dump($dataPost); die;
//    $slug = 'video';
    // Check category exists
    $category = new category();
    $categoryExists = $category->listCategoryBySlug(array('slug' => $dataPost->category_slug));
    $this->viewModel->setVariable('category', $categoryExists);
    //set post id
    $this->viewModel->setVariable('postId', $id);
    $post = new Post();
      $dataPost = $post->getPostById(array('id' => $id, 'language' => $this->language, 'type' => 'travel'));
      $gallery = '';
      $dataEntertainmentType = '';
      $dataVehicle = '';
      $listVideo = '';
      $dataPostContact = '';
      $dataPostRelated = '';
      $dataJson = array();
      if($dataPost){
        $postImage = new PostImage();
        $gallery = $postImage->getListGalleryByDetailPostId(array('post_detail_id' => $dataPost->post_detail_id, 'language' => $this->language));
        
        // Lấy ra danh sách loại bảng giá
        $entertainmentType = new EntertainmentType();
        $entertainment = new Entertainment();
        $entertainmentTypeParentNull = $entertainmentType->getListEntertainmentByTravelId(array('parent' => 0, 'language' => $this->language));
        if($entertainmentTypeParentNull){
          foreach ($entertainmentTypeParentNull as $key => $value){
            // Kiểm tra có child
            $checkEntertainmentIsChild = $entertainmentType->getListEntertainmentByTravelId(array('parent' => $value['id'], 'language' => $this->language));
            $dataEntertainmentType[$key] = array(
              'id' => $value['id'],
              'name' => $value['name'],
              'description' => $value['description'],
              'language' => $value['language'],
              'status' => $value['status'],
              'type' => $value['type'],
              'child' => '',
              'dataChild' => ''
            );
            if($checkEntertainmentIsChild){
              $dataEntertainmentType[$key]['child'] = $checkEntertainmentIsChild;
              // Lấy danh sách trò chơi
              if($dataEntertainmentType[$key]['child']){
                foreach ($dataEntertainmentType[$key]['child'] as $k => $val){
                  $dataEntertainmentType[$key]['child'][$k] = array(
                    'id' => $val['id'],
                    'name' => $val['name'],
                    'description' => $val['description'],
                    'language' => $val['language'],
                    'status' => $val['status'],
                    'type' => $val['type'],
                    'dataChild' => ''
                  );
                  $dataEntertainmentChild = $entertainment->getAllEntertainmentByTravel(array('entertainment_type_id' => $val['id'], 'language' => $this->language, 'travel_id' => $id));
                  if($dataEntertainmentChild){
                    $dataEntertainmentType[$key]['child'][$k]['dataChild'] = $dataEntertainmentChild;
                  }
                }
              }
              
            }else{
              // Lấy danh sách trò chơi
              $dataEntertainmentChild = $entertainment->getAllEntertainmentByTravel(array('entertainment_type_id' => $value['id'], 'language' => $this->language,  'travel_id' => $id));
              if($dataEntertainmentChild){
                $dataEntertainmentType[$key]['dataChild'] = $dataEntertainmentChild;
              }
              
            }
          }
        }
        // Lấy danh sách phương tiện
        $vehicle = new Vehicle();
        $dataVehicle = $vehicle->getVehicleByTravelId(array('travel_id' => $dataPost->travel_id, 'language' => $this->language));
        
        // Lấy danh sách video
        $video = new PostVideo();
        $listVideo = $video->getListVideoByDetailPostId(array('post_detail_id' => $dataPost->post_detail_id, 'offset' => 0, 'limit' => 2));
        
        // Lấy danh sách liên hệ
        $contact = new PostContact();
        $dataPostContact = $contact->getListContactByPostId(array('post_id' => $dataPost->id));
        
        // Lấy danh sách bài viết khác cùng chuyên mục
        $dataPostRelated = $post->getPostRelatedByCategory(
                array(
                  'id' => $dataPost->id,
                  'category_id' => $dataPost->category_id,
                  'language' => $this->language,
                  'nationId' => 1,
                  'provinceId' => 1,
                  'districtId' => 1,
                  'limit' => 5
                ));
        
        // creared data json map post related page detail
        $allPostRelated = $post->getAllRelatedPost(
                array(
                    'id' => $dataPost->id,
                    'language' => $this->language,
                    'listType' => array('hotel', 'taste', 'tour'),
                    'limit' => 30
                )
            );
        $dataJson[0] = array(
                'title' => $dataPost->name,
                'lat' => $dataPost->lat,
                'lng' => $dataPost->lng,
                'thumbnail' => $dataPost->thumbnail,
                'type'  => $dataPost->type
            );
        if($allPostRelated){
          foreach ($allPostRelated as $value){
            array_push($dataJson, array(
                'title' => $value['name'],
                'lat' => $value['lat'],
                'lng' => $value['lng'],
                'thumbnail' => $value['thumbnail'],
                'type' => $value['type']
            ));
          }
        }
      }
      $this->viewModel->setVariable('dataPost', $dataPost);
      $this->viewModel->setVariable('gallery', $gallery);
      $this->viewModel->setVariable('dataEntertainment', $dataEntertainmentType);
      $this->viewModel->setVariable('dataVehicle', $dataVehicle);
      $this->viewModel->setVariable('listVideo', $listVideo);
      $this->viewModel->setVariable('dataPostContact', $dataPostContact);
      $this->viewModel->setVariable('dataPostRelated', $dataPostRelated);
      $this->viewModel->setVariable('dataPost', $dataPost);
      $this->viewModel->setVariable('dataPost', $dataPost);
    switch ($dataPost->type) {
      case 'travel':
        //set detail full page
        $mode = $this->params()->fromQuery('mode');
        if($mode == 'full'){
          $this->layout('layout/travel-full-detail');
          $this->viewModel->setTemplate('travel/detail-full');
        }else{
          $this->viewModel->setTemplate('travel/index');
        }
        break;
      /* ---------------------------------------------------- */
      case 'taste':
        $this->layout('layout/taste');
        $this->viewModel->setTemplate('taste/index');
        break;
      /* ---------------------------------------------------- */
      case 'hotel':
        $this->layout('layout/hotel');
        $this->viewModel->setTemplate('hotel/index');
        break;
      /* ---------------------------------------------------- */
      case 'tour':
        $this->layout('layout/tour');
        $this->viewModel->setTemplate('tour/index');
        break;
      /* ---------------------------------------------------- */
      case 'video':
        $this->layout('layout/video-detail');
        $this->viewModel->setTemplate('video/detail');
        break;
      /* ---------------------------------------------------- */
      case 'diary':
        die('a');
        break;
      case 'utilities':
        break;
      /* ---------------------------------------------------- */
      default :
        break;
    }
    return $this->viewModel;
  }

}
