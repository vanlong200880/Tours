<?php
namespace Frontend\Block;
use Zend\View\Helper\AbstractHelper;
class meta extends AbstractHelper
{
  public function __invoke($metaTitle = '', $metaKeyword = '', $metaDescription ='', $type = '', $url = '', $img ='') {
    $metaTitle        = ($metaTitle)?$metaTitle:META_TITLE;
    $metaKeyword      = ($metaKeyword)?$metaKeyword:META_KEYWORD;
    $metaDescription  = ($metaDescription)?$metaDescription:META_DESCRIPTION;
    $url              = ($url)?$url:URL_HOME;
    $img              = ($img)?$img:IMAGE_DEFAULT;
    $type              = ($type)?$type:TYPE;
    $data = $this->view->partial('block/meta/meta.phtml', 
            array(
                'metaTitle' => $metaTitle, 
                'metaKeyword' => $metaKeyword,
                'metaDescription' => $metaDescription,
                'url' => $url,
                'img' => $img,
            ));
    echo $data;
  }
}
