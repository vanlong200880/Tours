<?php
namespace Tour\Block;
use Zend\View\Helper\AbstractHelper;
class searchTour extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/searchTour/searchTour.phtml');
        echo $data;
    }
}
