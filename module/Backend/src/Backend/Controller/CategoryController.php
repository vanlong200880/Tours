<?php
namespace Backend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class CategoryController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
