<?php
namespace Frontend\Block;
use Zend\View\Helper\AbstractHelper;
class album extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/album/album.phtml');
        echo $data;
    }
}
