<?php
namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class HotelController extends AbstractActionController
{
  public function detailAction(){
    $htmlViewPart = new ViewModel();
    $htmlViewPart->setTemplate('hotel/detail')
                 ->setTerminal(true)
                 ->setVariables(['arrayVar' => ['a', 'b', 'c']]);

    $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);

    $jsonModel = new JsonModel();
    $jsonModel->setVariables(['html' => $htmlOutput]);

    return $jsonModel;
  }
  public function viewRoomAction(){
      $htmlViewPart = new ViewModel();
      $htmlViewPart->setTemplate('hotel/view-room')
                   ->setTerminal(true)
                   ->setVariables(['arrayVar' => ['a', 'b', 'c']]);

      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);

      $jsonModel = new JsonModel();
      $jsonModel->setVariables(['html' => $htmlOutput]);

      return $jsonModel;
    }
}
