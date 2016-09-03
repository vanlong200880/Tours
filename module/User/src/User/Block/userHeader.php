<?php
namespace User\Block;
use Zend\View\Helper\AbstractHelper;
class userHeader extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/userHeader/userHeader.phtml');
        echo $data;
    }
}
