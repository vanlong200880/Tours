<?php
namespace Backend\Block;
use Zend\View\Helper\AbstractHelper;
class backendMenu extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/backendMenu/backendMenu.phtml');
        echo $data;
    }
}
