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
              'listImageComment' => '',
              'countChildComment' => 0,
              'currentChildPage' => 1
          );
          $countChildComment = $comment->countCommentChildByParent(array('post_id' => $postId, 'parent' => $value['id']));
          $dataComment[$key]['countChildComment'] = $countChildComment;
          $commentChild = $comment->listCommentChildByParent(array('post_id' => $postId, 'parent' => $value['id'], 'offset' => $start, 'limit' => LIMIT_COMMENT));
          $dataComment[$key]['commentChild'] = $commentChild;
          $listImageComment = $imageComment->listImageByCommentId(array('post_comment_id' => $value['id']));
          if($listImageComment){
            $dataComment[$key]['listImageComment'] = $listImageComment;
          }
        }
      }

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
              'listImageComment' => '',
              'countChildComment' => 0,
              'currentChildPage' => 1
          );
          $countChildComment = $comment->countCommentChildByParent(array('post_id' => $postId, 'parent' => $value['id']));
          $dataComment[$key]['countChildComment'] = $countChildComment;
          $commentChild = $comment->listCommentChildByParent(array('post_id' => $postId, 'parent' => $value['id'], 'offset' => $start, 'limit' => LIMIT_COMMENT));
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
  
  
  public function loadMoreCommentChildAction(){
    //    if($this->getRequest()->isXmlHttpRequest()){
      $postId = $this->params()->fromPost('id');
      $parentId = $this->params()->fromPost('parent');
      $page = (int)$this->params()->fromPost('page', 1);
      $comment = new PostComment();
      $totalChildRecord = $countChildComment = $comment->countCommentChildByParent(array('post_id' => $postId, 'parent' => $parentId));
      $totalChildPages = ceil($totalChildRecord / LIMIT_COMMENT);
      if($page > $totalChildPages){
        $page = $totalChildPages;
      }
      else if($page < 1){
        $page = 1;
      }
      $start = ($page - 1) * LIMIT_COMMENT;
      $commentChild = $comment->listCommentChildByParent(array('post_id' => $postId, 'parent' => $parentId, 'offset' => $start, 'limit' => LIMIT_COMMENT));
      $htmlViewPart = new ViewModel();
      $htmlViewPart->setTemplate('comment/load-more-comment-child')
                   ->setTerminal(true)
                   ->setVariables([
                       'postId' => $postId,
                       'dataCommentChild' => $commentChild,
                       'totalChildRecord' => $totalChildRecord,
                       'currentChildPage' => $page,
                       'postId' => $postId,
                       'start' => $start,
                       'totalChildPages' => $totalChildPages
                           ]);

      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);
      $jsonModel = new JsonModel();
      $jsonModel->setVariables([
          'htmlComment' => $htmlOutput,
          'currentChildPage' => $page,
          'postId' => $postId,
          'start' => $start,
          'totalChildPages' => $totalChildPages
      ]);

      return $jsonModel;
//    }else{
//      die('Forbidden access');
//    }
  }
  
  public function createCommentAction(){
    //    if($this->getRequest()->isXmlHttpRequest()){
      $commentId = $this->params()->fromPost('id');
//      $commentId = 1;
      $commentContent = $this->params()->fromPost('content');
//      $commentContent = 'adsa af';
      $postId = $this->params()->fromPost('postId');
//      $postId = 1;
      $comment = new PostComment();
      $createCommentId = '';
      // Check comment 
      $checkComment = $comment->checkCommentById(array('id' => $commentId));
      if($checkComment){
        // insert comment child
        $data = array(
          'post_id' => $postId,
          'user_id' => 1,
          'title' => '',
          'content' => $commentContent,
          'parent' => $commentId,
          'created' => time(),
          'status' => 1,
          'device' => 'Iphone',
          'persion' => 0,
          'total_bill' => 0,
          'come_back' => 0,
          'total_like' => 0
        );
        $createCommentId = $comment->createComment($data);
      }
      $dataCreateComment = '';
      if ($createCommentId){
        $dataCreateComment = $comment->getCommentById(array('post_id' =>$postId, 'id' => $createCommentId));
      }

      $htmlViewPart = new ViewModel();
      $htmlViewPart->setTemplate('comment/create-comment')
                   ->setTerminal(true)
                   ->setVariables([
                       'createComment' => $dataCreateComment,
                           ]);
      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);
      $jsonModel = new JsonModel();
      $jsonModel->setVariables([
          'htmlCreateComment' => $htmlOutput,
          'postId' => $postId,
          'commentId' => $commentId,
          'data' => $checkComment
      ]);

      return $jsonModel;
//    }else{
//      die('Forbidden access');
//    }
  }
  
  public function imageDetailAction(){
    //    if($this->getRequest()->isXmlHttpRequest()){
//      $commentId = $this->params()->fromPost('id');
//      $commentContent = $this->params()->fromPost('content');
//      $postId = $this->params()->fromPost('postId');
//      $comment = new PostComment();
//      $createCommentId = '';
//      // Check comment 
//      $checkComment = $comment->checkCommentById(array('id' => $commentId));
//      if($checkComment){
//        // insert comment child
//        $data = array(
//          'post_id' => $postId,
//          'user_id' => 1,
//          'title' => '',
//          'content' => $commentContent,
//          'parent' => $commentId,
//          'created' => time(),
//          'status' => 1,
//          'device' => 'Iphone',
//          'persion' => 0,
//          'total_bill' => 0,
//          'come_back' => 0,
//          'total_like' => 0
//        );
//        $createCommentId = $comment->createComment($data);
//      }
//      $dataCreateComment = '';
//      if ($createCommentId){
//        $dataCreateComment = $comment->getCommentById(array('post_id' =>$postId, 'id' => $createCommentId));
//      }

      $htmlViewPart = new ViewModel();
      $htmlViewPart->setTemplate('image/image-detail')
                   ->setTerminal(true)
                   ->setVariables([
//                       'createComment' => $dataCreateComment,
                           ]);
      $htmlOutput = $this->getServiceLocator()->get('viewrenderer')->render($htmlViewPart);
      $jsonModel = new JsonModel();
      $jsonModel->setVariables([
          'html' => $htmlOutput,
//          'postId' => $postId,
//          'commentId' => $commentId,
//          'data' => $checkComment
      ]);

      return $jsonModel;
//    }else{
//      die('Forbidden access');
//    }
  }
}
