<?php
namespace Frontend\Block;
use Zend\View\Helper\AbstractHelper;
class userPost extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/userPost/userPost.phtml');
        echo $data;
    }
}
