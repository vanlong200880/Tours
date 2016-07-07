<?php
namespace Frontend\Block;
use Zend\View\Helper\AbstractHelper;
class news extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/news/news.phtml', array());
        echo $data;
    }
}
