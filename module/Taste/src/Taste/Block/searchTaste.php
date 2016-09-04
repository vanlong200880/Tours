<?php
namespace Taste\Block;
use Zend\View\Helper\AbstractHelper;
class searchTaste extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/searchTaste/searchTaste.phtml');
        echo $data;
    }
}
