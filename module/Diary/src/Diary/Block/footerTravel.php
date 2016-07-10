<?php

namespace Travel\Block;
use Zend\View\Helper\AbstractHelper;
class footerTravel extends AbstractHelper
{    
    public function __invoke() {
      $data = $this->view->partial('block/footerTravel/footerTravel.phtml', array());
      echo $data;
    }
}
