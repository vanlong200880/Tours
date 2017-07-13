<?php
namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Category\Model\PostComment;
use Category\Model\CommentImage;
class CommentController extends AbstractActionController
{
  public function loadCommentAction(){
//    if($this->getRequest()->isXmlHttpRequest()){
//      $category = new Post();
      $postId = $this->params()->fromPost('id');
      $page = (int)$this->params()->fromPost('page', 1);
      $comment = new PostComment();
      $totalRecord = $comment->countCommentByPostId(array('post_id' => $postId));
      $totalPages = ceil($totalRecord / LIMIT_COMMENT);
      if($page > $totalPages){
        $page = $totalPages;
      }
      else if($page < 1){
        $page = 1;
      }
      $start = ($page - 1) * LIMIT_COMMENT;
      $parentComment = $comment->listCommentByPostId(array('post_id' => $postId, 'offset' => $start, 'limit' => LIMIT_COMMENT));
      $imageComment = new CommentImage();
      $dataComment = array();
      if($parentComment){
        foreach ($parentComment as $key => $value){
          $dataComment[$key] = array(
              'id' => $value['id'], 
              'post_id' => $value['post_id'],
              'user_id' => $value['user_id'],
              'title' => $value['title'],
              'content' => $value['content'],
              'parent' => $value['parent'],
              'created' => $value['created'],
              'status' => $value['status'],
              'device' => $value['device'],
              'fullname' => $value['username'],
              'avatar' => $value['avatar'],
              'come_back' => $value['come_back'],
              'persion' => $value['persion'],
              'total_bill' => $value['total_bill'],
              'total_like' => $value['total_like'],
              'commentChild' => '',
              'listImageComment' => ''
          );
          $commentChild = $comment->listCommentChildByParent(array('parent' => $value['id']));
          $dataComment[$key]['commentChild'] = $commentChild;
          $listImageComment = $imageComment->listImageByCommentId(array('post_comment_id' => $value['id']));
          if($listImageComment){
            $dataComment[$key]['listImageComment'] = $listImageComment;
          }
        }
      }
//      $post = $category->getPostById(array('id' => $id));
//      $fromLatitude = '';
//      $fromLongitude = '';
//      $toLatitude = '';
//      $toLongitude = '';
//      $message = '';
//      // get address from ip
//      $address = $this->params()->fromPost('address');
//      $session = new Container('currentAddress');
//      $session->address = $address;
//      if($session->address){
//        $geoCode = new MapGeoCode();
//        $geoAddress = $geoCode->geocode($session->address);
//        if($geoAddress){
//          $fromLatitude = $geoAddress[0];
//          $fromLongitude = $geoAddress[1];
//        }
//      }
//
//
//      if($post){
//        $toLatitude = $post->lat;
//        $toLongitude = $post->lng;
//      }
//      if($fromLatitude == '' || $fromLongitude == '' || $toLatitude == '' || $toLongitude == ''){
//        $message = 'Rất tiếc! Chúng tôi không tìm thấy địa chỉ của bạn trên google map.';
//      }
      $htmlViewPart = new ViewModel();
      $htmlViewPart->setTemplate('view/comment')
                   ->setTerminal(true)
                   ->setVariables([
                       'postId' => $postId,
                       'dataComment' => $dataComment,
                       'totalRecord' => $totalRecord,
                       'currentPage' => $page,
                       'postId' => $postId,
                       'start' => $start
                           ]);

      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);
      $jsonModel = new JsonModel();
      $jsonModel->setVariables([
          'htmlComment' => $htmlOutput,
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
  
  public function loadMoreCommentAction(){
    //    if($this->getRequest()->isXmlHttpRequest()){
//      $category = new Post();
      $postId = $this->params()->fromPost('id');
      $page = (int)$this->params()->fromPost('page', 1);
      $comment = new PostComment();
      $totalRecord = $comment->countCommentByPostId(array('post_id' => $postId));
      $totalPages = ceil($totalRecord / LIMIT_COMMENT);
      if($page > $totalPages){
        $page = $totalPages;
      }
      else if($page < 1){
        $page = 1;
      }
      $start = ($page - 1) * LIMIT_COMMENT;
      $parentComment = $comment->listCommentByPostId(array('post_id' => $postId, 'offset' => $start, 'limit' => LIMIT_COMMENT));
      $imageComment = new CommentImage();
      $dataComment = array();
      if($parentComment){
        foreach ($parentComment as $key => $value){
          $dataComment[$key] = array(
              'id' => $value['id'], 
              'post_id' => $value['post_id'],
              'user_id' => $value['user_id'],
              'title' => $value['title'],
              'content' => $value['content'],
              'parent' => $value['parent'],
              'created' => $value['created'],
              'status' => $value['status'],
              'device' => $value['device'],
              'fullname' => $value['username'],
              'avatar' => $value['avatar'],
              'come_back' => $value['come_back'],
              'persion' => $value['persion'],
              'total_bill' => $value['total_bill'],
              'total_like' => $value['total_like'],
              'commentChild' => '',
              'listImageComment' => ''
          );
          $commentChild = $comment->listCommentChildByParent(array('parent' => $value['id']));
          $dataComment[$key]['commentChild'] = $commentChild;
          $listImageComment = $imageComment->listImageByCommentId(array('post_comment_id' => $value['id']));
          if($listImageComment){
            $dataComment[$key]['listImageComment'] = $listImageComment;
          }
        }
      }

      $htmlViewPart = new ViewModel();
      $htmlViewPart->setTemplate('comment/load-more-comment')
                   ->setTerminal(true)
                   ->setVariables([
                       'postId' => $postId,
                       'dataComment' => $dataComment,
                       'totalRecord' => $totalRecord,
                       'currentPage' => $page,
                       'postId' => $postId,
                       'start' => $start,
                       'totalPage' => $totalPages
                           ]);

      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);
      $jsonModel = new JsonModel();
      $jsonModel->setVariables([
          'htmlComment' => $htmlOutput,
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
