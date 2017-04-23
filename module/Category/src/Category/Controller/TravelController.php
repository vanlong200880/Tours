<?php
namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

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
      $htmlViewPart = new ViewModel();
      $htmlViewPart->setTemplate('travel/popup-map')
                   ->setTerminal(true)
                   ->setVariables(['arrayVar' => ['a', 'b', 'c']]);

      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);

      $jsonModel = new JsonModel();
      $jsonModel->setVariables(['html' => $htmlOutput]);

      return $jsonModel;
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
