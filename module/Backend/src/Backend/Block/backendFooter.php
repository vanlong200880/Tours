<?php
namespace Backend\Block;
use Zend\View\Helper\AbstractHelper;
class backendFooter extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/backendFooter/backendFooter.phtml');
        echo $data;
    }
}
