<?php
namespace Frontend\Block;
use Zend\View\Helper\AbstractHelper;
class cart extends AbstractHelper
{    
    public function __invoke() {
        $data = $this->view->partial('block/cart/cart.phtml');
        echo $data;
    }
}
