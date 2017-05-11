<?php
namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Category\Model\Province;
use Category\Model\Nation;
use Category\Model\District;

class RegionController extends AbstractActionController
{
  public function provinceAction(){
    if($this->getRequest()->isXmlHttpRequest()){
      $nationSlug = $this->params()->fromPost('alias');
      $province = new Province();
      $nation = new Nation();
      $currentNation = $nation->currentNation(array('alias' => $nationSlug));
      if($currentNation){
        $listProvice = $province->listPorvinceByNation(array('nation_id' => $currentNation->id));
      }else{
        $listProvice = array();
      }
      $htmlViewPart = new ViewModel();
      $htmlViewPart->setTemplate('region/province')
                   ->setTerminal(true)
                   ->setVariables(['data' => $listProvice]);
      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);
      $jsonModel = new JsonModel();
      $jsonModel->setVariables(['html' => $htmlOutput]);
      return $jsonModel;
    }else{
      die('Forbidden access');
    }
  }
  public function districtAction(){
//    if($this->getRequest()->isXmlHttpRequest()){
      $districtSlug = $this->params()->fromPost('alias');
//      $districtSlug = 'ho-chi-minh';
      $province = new Province();
      $district = new District();
      $currentDistrict = $province->currentProvince(array('alias' => $districtSlug));
      if($currentDistrict){
        $listDistrict = $district->listDistrictByProvince(array('province_id' => $currentDistrict->id));
      }else{
        $listDistrict = array();
      }
      $htmlViewPart = new ViewModel();
      $htmlViewPart->setTemplate('region/province')
                   ->setTerminal(true)
                   ->setVariables(['data' => $listDistrict]);
      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);
      $jsonModel = new JsonModel();
      $jsonModel->setVariables(['html' => $htmlOutput]);
      return $jsonModel;
//    }else{
//      die('Forbidden access');
//    }
  }
}
