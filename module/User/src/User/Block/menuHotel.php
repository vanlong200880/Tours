<?php
namespace User\Block;
use Zend\View\Helper\AbstractHelper;
class menuHotel extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/menuHotel/menuHotel.phtml');
        echo $data;
    }
}
