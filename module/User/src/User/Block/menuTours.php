<?php
namespace User\Block;
use Zend\View\Helper\AbstractHelper;
class menuTours extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/menuTours/menuTours.phtml');
        echo $data;
    }
}
