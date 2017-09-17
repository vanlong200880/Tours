<?php
namespace User\Block;
use Zend\View\Helper\AbstractHelper;
class menuTravel extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/menuTravel/menuTravel.phtml');
        echo $data;
    }
}
