<?php
namespace Category\Block;
use Zend\View\Helper\AbstractHelper;
use Category\Model\Category;
use Category\Model\Nation;
use Category\Model\Province;
use Category\Model\District;
use Zend\Session\Container;
class searchAdvance extends AbstractHelper
{    
  public function __invoke() {
    $session = new Container('currentAddress');
    $data = $this->view->partial('block/searchAdvance/searchAdvance.phtml', array('currentAddress' => $session->address,'categoryType' => CATEGORY_TYPE));
    echo $data;
  }
}
