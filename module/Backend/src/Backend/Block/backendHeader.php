<?php
namespace Backend\Block;
use Zend\View\Helper\AbstractHelper;
class backendHeader extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/backendHeader/backendHeader.phtml');
        echo $data;
    }
}
