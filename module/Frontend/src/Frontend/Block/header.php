<?php

namespace Frontend\Block;
use Zend\View\Helper\AbstractHelper;
use Category\Model\Category;
class header extends AbstractHelper
{    
    public function __invoke() {
      $category = new Category();
      $listCategoryMenu = $category->listCategoryMenu();
      var_dump($listCategoryMenu[0]); die;
      $data = $this->view->partial('block/header/header.phtml', array());
      echo $data;
    }
}
