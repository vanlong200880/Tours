<?php
namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Category\Model\Post;
use Zend\Session\Container;
use Category\Util\MapGeoCode;

class TravelController extends AbstractActionController
{
//    public function detailAction(){
//      $this->layout('layout/detail-page');
//      return new ViewModel();
//    }
    public function viewAction(){
      $htmlViewPart = new ViewModel();
      
      $htmlViewPart->setTemplate('travel/popup-view')
                   ->setTerminal(true)
                   ->setVariables(['arrayVar' => ['a', 'b', 'c']]);
      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);
      
      // get comment
      $htmlCommentPart = new ViewModel();
      $htmlCommentPart->setTemplate('view/comment')
                   ->setTerminal(true)
                   ->setVariables(['arrayVar' => ['a', 'b', 'c']]);
      $htmlCommentOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlCommentPart);
      $jsonModel = new JsonModel();
      $jsonModel->setVariables(['html' => $htmlOutput, 'htmlComment' => $htmlCommentOutput]);

      return $jsonModel;
    }
    
    public function mapAction(){
      if($this->getRequest()->isXmlHttpRequest()){
        $category = new Post();
        $id = $this->params()->fromPost('id');
        $post = $category->getPostById(array('id' => $id));
        $fromLatitude = '';
        $fromLongitude = '';
        $toLatitude = '';
        $toLongitude = '';
        $message = '';
        // get address from ip
        $address = $this->params()->fromPost('address');
        $session = new Container('currentAddress');
        $session->address = $address;
        if($address){
          $geoCode = new MapGeoCode();
          $geoAddress = $geoCode->geocode($address);
          if($geoAddress){
            $fromLatitude = $geoAddress[0];
            $fromLongitude = $geoAddress[1];
          }
        }

        if($fromLatitude == '' || $fromLongitude == '' || $toLatitude == '' || $toLongitude == ''){
          $message = 'Rất tiếc! Chúng tôi không tìm thấy địa chỉ của bạn trên google map.';
        }
        if($post){
          $toLatitude = $post->lat;
          $toLongitude = $post->lng;
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
            'message' => $message
                ]);

        return $jsonModel;
      }else{
        die('Forbidden access');
      }
    }
    public function viewGalleryAction(){
      $htmlViewPart = new ViewModel();
      $htmlViewPart->setTemplate('travel/view-gallery')
                   ->setTerminal(true)
                   ->setVariables(['arrayVar' => ['a', 'b', 'c']]);

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
