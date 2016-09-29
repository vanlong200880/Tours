<?php
namespace Hotel\Block;
use Zend\View\Helper\AbstractHelper;
class searchHotel extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/searchHotel/searchHotel.phtml');
        echo $data;
    }
}
