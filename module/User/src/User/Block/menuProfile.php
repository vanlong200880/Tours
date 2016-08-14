<?php
namespace User\Block;
use Zend\View\Helper\AbstractHelper;
class menuProfile extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/menuProfile/menuProfile.phtml');
        echo $data;
    }
}
