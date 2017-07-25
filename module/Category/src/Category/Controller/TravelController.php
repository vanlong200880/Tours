<?php
namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Category\Model\Post;
use Zend\Session\Container;
use Category\Util\MapGeoCode;
use Category\Model\PostImage;
use Category\Model\EntertainmentType;
use Category\Model\Entertainment;
use Category\Model\Vehicle;
use Category\Model\PostVideo;
use Category\Model\PostContact;
use Category\Model\EntertainmentDetail;
class TravelController extends AbstractActionController
{
  protected $language;
  public function __construct() {
    $this->language = 'vi';
    $this->jsonModel = new JsonModel();
    $this->viewModel = new ViewModel();
  }
    public function viewAction(){
      $id = $this->params()->fromPost('id');
      $htmlViewPart = new ViewModel();
      
      // Kiểm tra post có tồn tại không
      $post = new Post();
      $dataPost = $post->getPostById(array('id' => $id, 'language' => $this->language, 'type' => 'travel'));
      $gallery = '';
      $dataEntertainmentType = '';
      $dataVehicle = '';
      $listVideo = '';
      $dataPostContact = '';
      $dataPostRelated = '';
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
                  $dataEntertainmentChild = $entertainment->getAllEntertainmentByTravel(array('entertainment_type_id' => $val['id'], 'language' => $this->language));
                  if($dataEntertainmentChild){
                    $dataEntertainmentType[$key]['child'][$k]['dataChild'] = $dataEntertainmentChild;
                  }
                }
              }
              
            }else{
              // Lấy danh sách trò chơi
              $dataEntertainmentChild = $entertainment->getAllEntertainmentByTravel(array('entertainment_type_id' => $value['id'], 'language' => $this->language));
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
        $listVideo = $video->getListVideoByDetailPostId(array('post_detail_id' => $dataPost->post_detail_id));
        
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
      }
      
      
      
      $htmlViewPart->setTemplate('travel/popup-view')
                   ->setTerminal(true)
                   ->setVariables([
                       'id' => $id,
                       'dataPost' => $dataPost,
                       'gallery' => $gallery,
                       'dataEntertainment' => $dataEntertainmentType,
                       'dataVehicle' => $dataVehicle,
                       'listVideo' => $listVideo,
                       'dataPostContact' => $dataPostContact,
                       'dataPostRelated' => $dataPostRelated
                           ]);
      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);
      
      // get comment
//      $htmlCommentPart = new ViewModel();
//      $htmlCommentPart->setTemplate('view/comment')
//                   ->setTerminal(true)
//                   ->setVariables(['arrayVar' => ['a', 'b', 'c']]);
//      $htmlCommentOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlCommentPart);
      $jsonModel = new JsonModel();
      $jsonModel->setVariables(['html' => $htmlOutput]);

      return $jsonModel;
    }
    
    public function mapAction(){
      if($this->getRequest()->isXmlHttpRequest()){
        $category = new Post();
        $id = $this->params()->fromPost('id');
        $post = $category->getPostById(array('id' => $id, 'type' => ''));
        $fromLatitude = '';
        $fromLongitude = '';
        $toLatitude = '';
        $toLongitude = '';
        $message = '';
        // get address from ip
        $address = $this->params()->fromPost('address');
        $session = new Container('currentAddress');
        $session->address = $address;
        if($session->address){
          $geoCode = new MapGeoCode();
          $geoAddress = $geoCode->geocode($session->address);
          if($geoAddress){
            $fromLatitude = $geoAddress[0];
            $fromLongitude = $geoAddress[1];
          }
        }

        
        if($post){
          $toLatitude = $post->lat;
          $toLongitude = $post->lng;
        }
        if($fromLatitude == '' || $fromLongitude == '' || $toLatitude == '' || $toLongitude == ''){
          $message = 'Rất tiếc! Chúng tôi không tìm thấy địa chỉ của bạn trên google map.';
        }
        $htmlViewPart = new ViewModel();
        $htmlViewPart->setTemplate('travel/popup-map')
                     ->setTerminal(true)
                     ->setVariables([
                        'post' => $post,
                        'fromLatitude' => $fromLatitude,
                        'fromLongitude' => $fromLongitude,
                        'toLatitude' => $toLatitude,
                        'toLongitude' => $toLongitude,
                             ]);

        $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);
        $jsonModel = new JsonModel();
        $jsonModel->setVariables([
            'html' => $htmlOutput, 
            'fromLatitude' => $fromLatitude,
            'fromLongitude' => $fromLongitude,
            'toLatitude' => $toLatitude,
            'toLongitude' => $toLongitude,
            'message' => $message,
            'a' => $session->address
                ]);

        return $jsonModel;
      }else{
        die('Forbidden access');
      }
    }
    public function viewGalleryAction(){
      $id = $this->params()->fromPost('id');
      $entertainmentGallery = new \Category\Model\EntertainmentImage();
      $listGallery = $entertainmentGallery->getListEntertainmentImage(array('entertainment_id' => $id));
      
      // get entertaiment detail
      $entertainmentDetail = new EntertainmentDetail();
      $dataEmtertainmentDetail = $entertainmentDetail->getEntertainmentDetailById(array('entertainment_id' => 4));
      $htmlViewPart = new ViewModel();
      $htmlViewPart->setTemplate('travel/view-gallery')
                   ->setTerminal(true)
                   ->setVariables(['listGallery' => $listGallery, 'entertaimentData' => $dataEmtertainmentDetail]);

      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);

      $jsonModel = new JsonModel();
      $jsonModel->setVariables(['html' => $htmlOutput]);

      return $jsonModel;
    }
    
    public function VideoDetailPopupAction(){
      $htmlViewPart = new ViewModel();
      $htmlViewPart->setTemplate('travel/video-detail-popup')
                   ->setTerminal(true)
                   ->setVariables(['arrayVar' => ['a', 'b', 'c']]);

      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);

      $jsonModel = new JsonModel();
      $jsonModel->setVariables(['html' => $htmlOutput]);

      return $jsonModel;
    }
}
