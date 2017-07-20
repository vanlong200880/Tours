<?php

namespace Frontend\Block;
use Zend\View\Helper\AbstractHelper;
use Category\Model\Category;
class menu extends AbstractHelper
{    
    public function __invoke() {
      $category = new Category();
      $listCategoryMenu = $category->listCategoryMenu();
      $data = $this->view->partial('block/menu/menu.phtml', array('listCategoryMenu' => $listCategoryMenu));
      echo $data;
    }
}
