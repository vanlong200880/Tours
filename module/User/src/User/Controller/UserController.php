<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    public function profileAction(){
      return new ViewModel();
    }
    public function orderAction(){
      return new ViewModel();
    }
    public function viewOrderAction(){
      return new ViewModel();
    }
    public function changePasswordAction(){
      return new ViewModel();
    }
}
