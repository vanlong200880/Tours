<?php

namespace Category\Block;
use Zend\View\Helper\AbstractHelper;
class headerCategory extends AbstractHelper
{    
  public function __invoke() {
    $data = $this->view->partial('block/headerCategory/headerCategory.phtml', array());
    echo $data;
  }
}
