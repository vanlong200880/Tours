<?php
namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class TasteController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    public function detailAction(){
      $htmlViewPart = new ViewModel();
      $htmlViewPart->setTemplate('taste/detail')
                   ->setTerminal(true)
                   ->setVariables(['arrayVar' => ['a', 'b', 'c']]);

      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);

      $jsonModel = new JsonModel();
      $jsonModel->setVariables(['html' => $htmlOutput]);

      return $jsonModel;
    }
    
    public function orderAction(){
      $htmlViewPart = new ViewModel();
      $htmlViewPart->setTemplate('taste/taste-order')
                   ->setTerminal(true)
                   ->setVariables(['arrayVar' => ['a', 'b', 'c']]);

      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);

      $jsonModel = new JsonModel();
      $jsonModel->setVariables(['html' => $htmlOutput]);

      return $jsonModel;
    }
    public function pageDetailAction(){
      return new ViewModel();
    }
}
