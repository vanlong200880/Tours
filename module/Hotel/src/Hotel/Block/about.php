<?php
namespace Frontend\Block;
use Zend\View\Helper\AbstractHelper;
class about extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/about/about.phtml');
        echo $data;
    }
}
