<?php

namespace Frontend\Block;
use Zend\View\Helper\AbstractHelper;
class headerDetail extends AbstractHelper
{    
    public function __invoke() {
      $data = $this->view->partial('block/headerDetail/headerDetail.phtml', array());
      echo $data;
    }
}
