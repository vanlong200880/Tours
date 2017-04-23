<?php
namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class TourController extends AbstractActionController
{
  public function detailAction(){
    $htmlViewPart = new ViewModel();
    $htmlViewPart->setTemplate('tour/detail')
                 ->setTerminal(true)
                 ->setVariables(['arrayVar' => ['a', 'b', 'c']]);
    $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);

    // get comment
    $htmlCommentPart = new ViewModel();
    $htmlCommentPart->setTemplate('view/comment')
                 ->setTerminal(true)
                 ->setVariables(['arrayVar' => ['a', 'b', 'c']]);
    $htmlCommentOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlCommentPart);

    // comment form
    $htmlCommentFormPart = new ViewModel();
    $htmlCommentFormPart->setTemplate('view/comment-popup')
                 ->setTerminal(true)
                 ->setVariables(['arrayVar' => ['a', 'b', 'c']]);
    $htmlCommentFormOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlCommentFormPart);
    
    $jsonModel = new JsonModel();
    $jsonModel->setVariables(['html' => $htmlOutput, 'htmlComment' => $htmlCommentOutput ,'htmlCommentFormOutput' => $htmlCommentFormOutput]);

    return $jsonModel;
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
