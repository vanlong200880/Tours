<?php

namespace Frontend\Block;
use Zend\View\Helper\AbstractHelper;
class search extends AbstractHelper
{    
    public function __invoke() {
      $data = $this->view->partial('block/search/search.phtml', array());
      echo $data;
    }
}
