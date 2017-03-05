<?php
namespace Backend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class NationController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    public function addAction()
    {
        return new ViewModel();
    }
}
