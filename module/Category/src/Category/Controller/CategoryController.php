<?php
namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\ServiceManager\ServiceManager;

class CategoryController extends AbstractActionController
{
  protected $viewModel;
  protected $jsonModel;
  protected $serviceManager;
  public function __construct() {
//    $this->serviceManager = $serviceManager;
    $this->jsonModel = new JsonModel();
    $this->viewModel = new ViewModel();
  }
  public function indexAction()
  {
    $slug = $this->params()->fromRoute('category');
    $nation = $this->params()->fromRoute('nation');
    $province = $this->params()->fromRoute('province');
    switch ($slug){
      case 'diem-du-lich':
        if($nation || $province):
          $this->viewModel->setTemplate('travel/index');
        else:
          $this->viewModel->setTemplate('travel/index-nation');
        endif;
        break;
      /* ----------------------------------------------------*/
      case 'diem-an-uong':
        $this->layout('layout/taste');
        $this->viewModel->setTemplate('taste/index');
        break;
      /* ----------------------------------------------------*/
      case 'khach-san':
        $this->layout('layout/hotel');
        $this->viewModel->setTemplate('hotel/index');
        break;
      /* ----------------------------------------------------*/
      case 'tour-du-lich':
        $this->layout('layout/tour');
        $this->viewModel->setTemplate('tour/index');
        break;
      /* ----------------------------------------------------*/
      case 'diary':
        die('a');
        break;
      /* ----------------------------------------------------*/
      default :
        break;
    }
    return $this->viewModel;
  }

  public function detailAction(){
    $this->layout('layout/detail-page');
    return new ViewModel();
  }
}
