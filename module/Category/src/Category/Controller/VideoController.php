<?php
namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Category\Model\PostVideo;

class VideoController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    public function categoryAction(){
      return new ViewModel();
    }
    public function detailAction(){
      return new ViewModel();
    }
    
    public function loadVideoByPostIdAction(){
      // Lấy danh sách video theo post id
      
//    if($this->getRequest()->isXmlHttpRequest()){
      $postVideo = new PostVideo();
      $postId = $this->params()->fromPost('postId');
      $page = (int)$this->params()->fromPost('page', 1);
      $totalRecord = $postVideo->countVideoByPostId(array('post_id' => $postId));
      $totalPages = ceil($totalRecord / LIMIT_LOAD_VIDEO);
      if($page > $totalPages && $totalPages > 0){
        $page = $totalPages;
      }
      else if($page < 1){
        $page = 1;
      }
      $start = ($page - 1) * LIMIT_LOAD_VIDEO;
      $listVideo = $postVideo->getListVideoByDetailPostId(array('post_detail_id' => $postId, 'offset' => $start, 'limit' => LIMIT_LOAD_VIDEO));
      $htmlViewPart = new ViewModel();
      $htmlViewPart->setTemplate('video/load-video-by-post-id')
                   ->setTerminal(true)
                   ->setVariables([
                       'listVideo' => $listVideo,
                       'totalRecord' => $totalRecord,
                       'currentPage' => $page,
                       'postId' => $postId,
                       'start' => $start
                           ]);

      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);
      $jsonModel = new JsonModel();
      $jsonModel->setVariables([
          'htmlVideo' => $htmlOutput,
          'currentPage' => $page,
          'postId' => $postId,
          'start' => $start,
          'totalPage' => $totalPages
              ]);

      return $jsonModel;
//    }else{
//      die('Forbidden access');
//    }
  }
  
  public function loadMoreVideoByPostIdAction(){
      // Lấy danh sách video theo post id
      
//    if($this->getRequest()->isXmlHttpRequest()){
      $postVideo = new PostVideo();
      $postId = $this->params()->fromPost('postId');
      $page = (int)$this->params()->fromPost('page', 1);
      $totalRecord = $postVideo->countVideoByPostId(array('post_id' => $postId));
      $totalPages = ceil($totalRecord / LIMIT_LOAD_VIDEO);
      if($page > $totalPages && $totalPages > 0){
        $page = $totalPages;
      }
      else if($page < 1){
        $page = 1;
      }
      $start = ($page - 1) * LIMIT_LOAD_VIDEO;
      $listVideo = $postVideo->getListVideoByDetailPostId(array('post_detail_id' => $postId, 'offset' => $start, 'limit' => LIMIT_LOAD_VIDEO));

      $htmlViewPart = new ViewModel();
      $htmlViewPart->setTemplate('video/load-more-video-by-post-id')
                   ->setTerminal(true)
                   ->setVariables([
                       'listVideo' => $listVideo,
                       'totalRecord' => $totalRecord,
                       'currentPage' => $page,
                       'postId' => $postId,
                       'start' => $start
                           ]);

      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);
      $jsonModel = new JsonModel();
      $jsonModel->setVariables([
          'htmlVideo' => $htmlOutput,
          'currentPage' => $page,
          'postId' => $postId,
          'start' => $start,
          'totalPage' => $totalPages
              ]);
      return $jsonModel;
//    }else{
//      die('Forbidden access');
//    }
  }
}
