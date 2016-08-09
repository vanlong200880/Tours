<?php
namespace User\Block;
use Zend\View\Helper\AbstractHelper;
class timeline extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/timeline/timeline.phtml');
        echo $data;
    }
}
