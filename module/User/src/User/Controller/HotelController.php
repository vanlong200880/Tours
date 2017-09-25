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

class HotelController extends AbstractActionController
{
    public function indexAction()
    {
      $this->layout('layout/user-admin-hotel');
        return new ViewModel();
    }
    public function createAction(){
      $this->layout('layout/user-admin-hotel');
      return new ViewModel();
    }
    public function createMenuAction(){
      $this->layout('layout/user-admin-hotel');
      return new ViewModel();
    }
    public function createRoomAction(){
      $this->layout('layout/user-admin-hotel');
      return new ViewModel();
    }
    public function orderAction(){
      $this->layout('layout/user-admin-hotel');
      return new ViewModel();
    }
    public function commentAction(){
      $this->layout('layout/user-admin-hotel');
      return new ViewModel();
    }
}
