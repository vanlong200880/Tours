<?php
namespace Category\Block;
use Zend\View\Helper\AbstractHelper;
use Category\Model\Category;
use Category\Model\Nation;
use Category\Model\Province;
use Category\Model\District;
class searchAdvance extends AbstractHelper
{    
  public function __invoke() {
    $data = $this->view->partial('block/searchAdvance/searchAdvance.phtml', array('categoryType' => CATEGORY_TYPE));
    echo $data;
  }
}
