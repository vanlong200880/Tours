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
use Category\Model\TourDetail;
use Category\Model\EntertainmentDetail;

class TourController extends AbstractActionController
{
  protected $language;
  public function __construct() {
    $this->language = 'vi';
    $this->jsonModel = new JsonModel();
    $this->viewModel = new ViewModel();
  }
  public function detailAction(){
    $id = $this->params()->fromPost('id');
      $htmlViewPart = new ViewModel();
      // Kiểm tra post có tồn tại không
      $post = new Post();
      $dataPost = $post->getPostById(array('id' => $id, 'language' => $this->language, 'type' => 'tour'));
      $gallery = '';
      $dataEntertainmentType = '';
      $dataVehicle = '';
      $listVideo = '';
      $dataPostContact = '';
      $dataPostRelated = '';
      $listTour = '';
      if($dataPost){
        $postImage = new PostImage();
        $gallery = $postImage->getListGalleryByDetailPostId(array('post_detail_id' => $dataPost->post_detail_id, 'language' => $this->language));
        
        // Lấy danh sách điểm tham quan trong tour
        $tourDetail = new TourDetail();
        $arrPostId = array();
        $dataListId = $tourDetail->listTourDetail(array('tour_id' => $dataPost->tourId));
        if($dataListId){
          foreach ($dataListId as $value){
            array_push($arrPostId, $value['post_id']);
          }
        }
        
        if($arrPostId){
          // Lấy danh sách điểm du lịch trong tour
          $listTour = $post->getPostByListId(array('listId' => $arrPostId));
        }
//        var_dump($listTour);
        // Lấy ra danh sách loại bảng giá
//        $entertainmentType = new EntertainmentType();
//        $entertainment = new Entertainment();
//        $entertainmentTypeParentNull = $entertainmentType->getListEntertainmentByTravelId(array('parent' => 0, 'language' => $this->language));
//        if($entertainmentTypeParentNull){
//          foreach ($entertainmentTypeParentNull as $key => $value){
//            // Kiểm tra có child
//            $checkEntertainmentIsChild = $entertainmentType->getListEntertainmentByTravelId(array('parent' => $value['id'], 'language' => $this->language));
//            $dataEntertainmentType[$key] = array(
//              'id' => $value['id'],
//              'name' => $value['name'],
//              'description' => $value['description'],
//              'language' => $value['language'],
//              'status' => $value['status'],
//              'type' => $value['type'],
//              'child' => '',
//              'dataChild' => ''
//            );
//            if($checkEntertainmentIsChild){
//              $dataEntertainmentType[$key]['child'] = $checkEntertainmentIsChild;
//              // Lấy danh sách trò chơi
//              if($dataEntertainmentType[$key]['child']){
//                foreach ($dataEntertainmentType[$key]['child'] as $k => $val){
//                  $dataEntertainmentType[$key]['child'][$k] = array(
//                    'id' => $val['id'],
//                    'name' => $val['name'],
//                    'description' => $val['description'],
//                    'language' => $val['language'],
//                    'status' => $val['status'],
//                    'type' => $val['type'],
//                    'dataChild' => ''
//                  );
//                  $dataEntertainmentChild = $entertainment->getAllEntertainmentByTravel(array('entertainment_type_id' => $val['id'], 'language' => $this->language));
//                  if($dataEntertainmentChild){
//                    $dataEntertainmentType[$key]['child'][$k]['dataChild'] = $dataEntertainmentChild;
//                  }
//                }
//              }
//              
//            }else{
//              // Lấy danh sách trò chơi
//              $dataEntertainmentChild = $entertainment->getAllEntertainmentByTravel(array('entertainment_type_id' => $value['id'], 'language' => $this->language));
//              if($dataEntertainmentChild){
//                $dataEntertainmentType[$key]['dataChild'] = $dataEntertainmentChild;
//              }
//              
//            }
//          }
//        }
        // Lấy danh sách phương tiện
//        $vehicle = new Vehicle();
//        $dataVehicle = $vehicle->getVehicleByTravelId(array('travel_id' => $dataPost->travel_id, 'language' => $this->language));
        
        // Lấy danh sách video
//        $video = new PostVideo();
//        $listVideo = $video->getListVideoByDetailPostId(array('post_detail_id' => $dataPost->post_detail_id));
        
        // Lấy danh sách liên hệ
        $contact = new PostContact();
        $dataPostContact = $contact->getListContactByPostId(array('post_id' => $dataPost->id));
        
        // Lấy danh sách bài viết khác cùng chuyên mục
        $dataPostRelated = $post->getPostRelatedByCategory(
                array(
                  'id' => $dataPost->id,
                  'category_id' => $dataPost->category_id,
                  'language' => $this->language,
                  'nationId' => '',
                  'provinceId' => '',
                  'districtId' => '',
                  'limit' => 5
                ));
      }
      
      
      
      $htmlViewPart->setTemplate('tour/detail')
                   ->setTerminal(true)
                   ->setVariables([
                       'id' => $id,
                       'listTour' => $listTour,
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
//    
//    $htmlViewPart = new ViewModel();
//    $htmlViewPart->setTemplate('tour/detail')
//                 ->setTerminal(true)
//                 ->setVariables(['arrayVar' => ['a', 'b', 'c']]);
//    $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);
//
//    // get comment
//    $htmlCommentPart = new ViewModel();
//    $htmlCommentPart->setTemplate('view/comment')
//                 ->setTerminal(true)
//                 ->setVariables(['arrayVar' => ['a', 'b', 'c']]);
//    $htmlCommentOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlCommentPart);
//
//    // comment form
//    $htmlCommentFormPart = new ViewModel();
//    $htmlCommentFormPart->setTemplate('view/comment-popup')
//                 ->setTerminal(true)
//                 ->setVariables(['arrayVar' => ['a', 'b', 'c']]);
//    $htmlCommentFormOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlCommentFormPart);
//    
//    $jsonModel = new JsonModel();
//    $jsonModel->setVariables(['html' => $htmlOutput, 'htmlComment' => $htmlCommentOutput ,'htmlCommentFormOutput' => $htmlCommentFormOutput]);
//
//    return $jsonModel;
  }
  
  public function viewAction(){
    $htmlViewPart = new ViewModel();
    $htmlViewPart->setTemplate('tour/view')
                 ->setTerminal(true)
                 ->setVariables(['arrayVar' => ['a', 'b', 'c']]);
    
    $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);

    $jsonModel = new JsonModel();
    $jsonModel->setVariables(['html' => $htmlOutput]);

    return $jsonModel;
  }
}
