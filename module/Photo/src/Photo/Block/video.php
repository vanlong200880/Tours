<?php
namespace Video\Block;
use Zend\View\Helper\AbstractHelper;
class video extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/video/video.phtml');
        echo $data;
    }
}
