<?php
namespace User\Block;
use Zend\View\Helper\AbstractHelper;
class menuTaste extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/menuTaste/menuTaste.phtml');
        echo $data;
    }
}
