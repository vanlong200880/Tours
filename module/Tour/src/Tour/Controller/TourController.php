<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Tour\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class TourController extends AbstractActionController
{
    public function indexAction()
    {
      return new ViewModel();
    }
    public function detailAction(){
      $htmlViewPart = new ViewModel();
      $htmlViewPart->setTemplate('layout/detail')
                   ->setTerminal(true)
                   ->setVariables(['arrayVar' => ['a', 'b', 'c']]);

      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);

      $jsonModel = new JsonModel();
      $jsonModel->setVariables(['html' => $htmlOutput]);

      return $jsonModel;
    }
    public function pageDetailAction(){
      $this->layout('layout/tour-page-detail');
       return new ViewModel();
    }
}
