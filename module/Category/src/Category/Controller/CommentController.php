<?php
namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class CommentController extends AbstractActionController
{
  public function loadCommentAction(){
//    if($this->getRequest()->isXmlHttpRequest()){
//      $category = new Post();
//      $id = $this->params()->fromPost('id');
//      $post = $category->getPostById(array('id' => $id));
//      $fromLatitude = '';
//      $fromLongitude = '';
//      $toLatitude = '';
//      $toLongitude = '';
//      $message = '';
//      // get address from ip
//      $address = $this->params()->fromPost('address');
//      $session = new Container('currentAddress');
//      $session->address = $address;
//      if($session->address){
//        $geoCode = new MapGeoCode();
//        $geoAddress = $geoCode->geocode($session->address);
//        if($geoAddress){
//          $fromLatitude = $geoAddress[0];
//          $fromLongitude = $geoAddress[1];
//        }
//      }
//
//
//      if($post){
//        $toLatitude = $post->lat;
//        $toLongitude = $post->lng;
//      }
//      if($fromLatitude == '' || $fromLongitude == '' || $toLatitude == '' || $toLongitude == ''){
//        $message = 'Rất tiếc! Chúng tôi không tìm thấy địa chỉ của bạn trên google map.';
//      }
      $htmlViewPart = new ViewModel();
      $htmlViewPart->setTemplate('view/comment')
                   ->setTerminal(true)
                   ->setVariables([
//                      'post' => $post,
//                      'fromLatitude' => $fromLatitude,
//                      'fromLongitude' => $fromLongitude,
//                      'toLatitude' => $toLatitude,
//                      'toLongitude' => $toLongitude,
                           ]);

      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);
      $jsonModel = new JsonModel();
      $jsonModel->setVariables([
          'htmlComment' => $htmlOutput,
//          'fromLatitude' => $fromLatitude,
//          'fromLongitude' => $fromLongitude,
//          'toLatitude' => $toLatitude,
//          'toLongitude' => $toLongitude,
//          'message' => $message,
//          'a' => $session->address
              ]);

      return $jsonModel;
//    }else{
//      die('Forbidden access');
//    }
  }
}
