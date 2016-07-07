<?php

namespace Travel\Block;
use Zend\View\Helper\AbstractHelper;
class headerTravel extends AbstractHelper
{    
    public function __invoke() {
      $data = $this->view->partial('block/headerTravel/headerTravel.phtml', array());
      echo $data;
    }
}
