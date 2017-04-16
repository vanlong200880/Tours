<?php
namespace Travel\Block;
use Zend\View\Helper\AbstractHelper;
class searchTravel extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/searchTravel/searchTravel.phtml');
        echo $data;
    }
}
