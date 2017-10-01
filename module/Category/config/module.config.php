<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Category;

return array(
    'router' => array(
        'routes' => array(
            'category' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[:category][/:province][/:district]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category',
                        'action' => 'index',
                        'page' => '[0-9]+',
//                        'format' => 'html',
                    ),
                    'constraints' => array(
                        'category' => '[a-zA-Z0-9_-]*',
//                    'nation'     => '[a-zA-Z0-9_-]*',
                        'province' => '[a-zA-Z0-9_-]*',
                        'district' => '[a-zA-Z0-9_-]*',
//                    'page'     	=> 1,
                    ),
//                    'spec' => '/%category%/%nation%.%format%',
                ),
            ),
            'detail' => array(
                'type' => 'Zend\Mvc\Router\Http\Regex',
                'options' => array(
                    'regex' => '/(?<slug>[a-zA-Z0-9-]+)-(?<id>[0-9]+)?(\.(?<format>(html)))?',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Category',
                        'action' => 'detail',
                        'format' => 'html',
                    ),
                    'spec' => '/%slug%-%id%.%format%'
                )
            ),
//            'travel-province' => array(
//              'type' => 'Segment',
//              'options' => array(
//                'route' => '/dia-diem-di-choi/[:nation][/:province][/:district][/trang-:page]',
//                'defaults' => array(
//                  '__NAMESPACE__' => 'Travel',
//                  'controller' => 'Travel\Controller\Category',
//                  'action' => 'index',
//                ),
//                'constraints' => array(
//                  'nation'     => '[a-zA-Z0-9_-]*',
//                  'province'     => '[a-zA-Z0-9_-]*',
//                  'district'     => '[a-zA-Z0-9_-]*',
//                  'page'     	=> '[0-9]+',
//                ),
//              ),
//            ),
//          
//            'travel-detail' => array (
//              'type' => 'Zend\Mvc\Router\Http\Regex',
//              'options' => array (
//                'regex' => '/dia-diem-di-choi/(?<slug>[a-zA-Z0-9-]+)-pr-(?<id>[0-9]+)?(\.(?<format>(html)))?',
//                  'defaults' => array(
//                    '__NAMESPACE__' => 'Travel\Controller',
//                    'controller' => 'Travel\Controller\Category',
//                    'action' => 'detail',
//                    'format' => 'html',
//                  ),
//                  'spec' => '/dia-diem-di-choi/%slug%-pr-%id%.%format%'
//              )
//            ),
//          
            'popup-view' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/travel-view',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Travel',
                        'action' => 'view',
                    ),
                ),
            ),
            // render comment post
            'render-comment-post' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/render-comment-post',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Comment',
                        'action' => 'renderCommentPost',
                    ),
                ),
            ),
            // Load comment
            'load-comment' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/load-comment',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Comment',
                        'action' => 'loadComment',
                    ),
                ),
            ),
            // load more comment
            'load-video-by-post-id' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/load-video-by-post-id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Video',
                        'action' => 'loadVideoByPostId',
                    ),
                ),
            ),
            'load-more-video-by-post-id' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/load-more-video-by-post-id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Video',
                        'action' => 'loadMoreVideoByPostId',
                    ),
                ),
            ),
            // load more comment
            'load-more-comment' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/load-more-comment',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Comment',
                        'action' => 'loadMoreComment',
                    ),
                ),
            ),
            // Load more comment child
            'load-more-comment-child' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/load-more-comment-child',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Comment',
                        'action' => 'loadMoreCommentChild',
                    ),
                ),
            ),
            // create comment
            'create-comment' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/create-comment',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Comment',
                        'action' => 'createComment',
                    ),
                ),
            ),
            'image-detail' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/image-detail',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Comment',
                        'action' => 'imageDetail',
                    ),
                ),
            ),
            'region-province' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/province',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Region',
                        'action' => 'province',
                    ),
                ),
            ),
            'region-district' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/district',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Region',
                        'action' => 'district',
                    ),
                ),
            ),
            'popup-map' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/view-map',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Travel',
                        'action' => 'map',
                    ),
                ),
            ),
            'load-data' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/load-data',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Category',
                        'action' => 'loadData',
                    ),
                ),
            ),
            'view-gallery' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/view-gallery',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Travel',
                        'action' => 'viewGallery',
                    ),
                ),
            ),
            'video-detail-popup' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/view-video-detail',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Travel',
                        'action' => 'VideoDetailPopup',
                    ),
                ),
            ),
            // ------------------------------ tour ---------------------
            'tour-detail' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/tour-detail',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Tour',
                        'action' => 'detail',
                    ),
                ),
            ),
            'tour-view' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/tour-view',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Tour',
                        'action' => 'view',
                    ),
                ),
            ),
            // ------------------- hotel ------------
            'hotel-detail' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/hotel-detail',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Hotel',
                        'action' => 'detail',
                    ),
                ),
            ),
            'hotel-room' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/hotel-room',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Hotel',
                        'action' => 'viewRoom',
                    ),
                ),
            ),
            /* ------------------------------- taste --------------------- */
            'taste-detail' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/taste-detail',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Taste',
                        'action' => 'detail',
                    ),
                ),
            ),
            'taste-order' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/taste-order',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller' => 'Category\Controller\Taste',
                        'action' => 'order',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Category\Controller\Travel' => Controller\TravelController::class,
            'Category\Controller\Category' => Controller\CategoryController::class,
            'Category\Controller\Tour' => Controller\TourController::class,
            'Category\Controller\Comment' => Controller\CommentController::class,
            'Category\Controller\Hotel' => Controller\HotelController::class,
            'Category\Controller\Taste' => Controller\TasteController::class,
            'Category\Controller\Video' => Controller\VideoController::class,
            'Category\Controller\Region' => Controller\RegionController::class,
            'Category\Controller\Diary' => Controller\DiaryController::class,
            'Category\Controller\Utilities' => Controller\UtilitiesController::class,
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'searchCategory' => 'Category\Block\searchCategory',
            'headerCategory' => 'Category\Block\headerCategory',
            'searchAdvance' => 'Category\Block\searchAdvance',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/category' => __DIR__ . '/../view/layout/layout.phtml',
            'travel/index' => __DIR__ . '/../view/category/travel/index.phtml',
            'travel/index-nation' => __DIR__ . '/../view/category/travel/index-nation.phtml',
            'travel/popup-view' => __DIR__ . '/../view/category/travel/view.phtml',
            'travel/popup-map' => __DIR__ . '/../view/category/travel/map.phtml',
            'travel/view-gallery' => __DIR__ . '/../view/category/travel/view-gallery.phtml',
            'travel/video-detail-popup' => __DIR__ . '/../view/category/travel/video-detail-popup.phtml',
            'travel/load-data-travel' => __DIR__ . '/../view/category/travel/load-data-travel.phtml',
            'travel/detail-full' => __DIR__ . '/../view/category/travel/detail-full.phtml',
             'layout/travel-full-detail' => __DIR__ . '/../view/layout/layout-travel-full-detail.phtml',
            
            'view/comment' => __DIR__ . '/../view/category/comment/view.phtml',
            'comment/load-more-comment' => __DIR__ . '/../view/category/comment/load-more-comment.phtml',
            'comment/load-more-comment-child' => __DIR__ . '/../view/category/comment/load-more-comment-child.phtml',
            'comment/create-comment' => __DIR__ . '/../view/category/comment/create-comment.phtml',
            'image/image-detail' => __DIR__ . '/../view/category/comment/image-detail.phtml',
            'comment/render-comment-post' => __DIR__ . '/../view/category/comment/render-comment-post.phtml',
            'view/comment-popup' => __DIR__ . '/../view/category/comment/comment-popup.phtml',
            'layout/tour' => __DIR__ . '/../view/layout/layout-tour.phtml',
            'tour/index' => __DIR__ . '/../view/category/tour/index.phtml',
            'tour/detail' => __DIR__ . '/../view/category/tour/detail.phtml',
            'tour/view' => __DIR__ . '/../view/category/tour/view.phtml',
            'tour/load-data-tour' => __DIR__ . '/../view/category/tour/load-data-tour.phtml',
            'layout/hotel' => __DIR__ . '/../view/layout/layout-hotel.phtml',
            'hotel/index' => __DIR__ . '/../view/category/hotel/index.phtml',
            'hotel/detail' => __DIR__ . '/../view/category/hotel/detail.phtml',
            'hotel/view-room' => __DIR__ . '/../view/category/hotel/view-room.phtml',
            'hotel/load-data-hotel' => __DIR__ . '/../view/category/hotel/load-data-hotel.phtml',
            'layout/taste' => __DIR__ . '/../view/layout/layout-taste.phtml',
            'taste/index' => __DIR__ . '/../view/category/taste/index.phtml',
            'taste/detail' => __DIR__ . '/../view/category/taste/detail.phtml',
            'taste/taste-order' => __DIR__ . '/../view/category/taste/order.phtml',
            'taste/load-data-taste' => __DIR__ . '/../view/category/taste/load-data-taste.phtml',
            'layout/video-detail' => __DIR__ . '/../view/layout/layout-video-detail.phtml',
            'layout/video' => __DIR__ . '/../view/layout/layout-video.phtml',
            'video/index' => __DIR__ . '/../view/category/video/index.phtml',
            'video/detail' => __DIR__ . '/../view/category/video/detail.phtml',
            'video/load-video-by-post-id' => __DIR__ . '/../view/category/video/load-video-by-post-id.phtml',
            'video/load-more-video-by-post-id' => __DIR__ . '/../view/category/video/load-more-video-by-post-id.phtml',
            'layout/utilities' => __DIR__ . '/../view/layout/layout-utilities.phtml',
            'utilities/index' => __DIR__ . '/../view/category/utilities/index.phtml',
            'layout/diary' => __DIR__ . '/../view/layout/layout-diary.phtml',
            'diary/index' => __DIR__ . '/../view/category/diary/index.phtml',
            'region/province' => __DIR__ . '/../view/category/region/province.phtml',
            'paginationAjax' => __DIR__ . '/../view/partial/paginationAjax.phtml',
//            'travel/index/index' => __DIR__ . '/../view/travel/index/index.phtml',
//            'error/404'               => __DIR__ . '/../view/error/404.phtml',
//            'error/index'             => __DIR__ . '/../view/error/index.phtml',
//            'layout/popup-view'           => __DIR__ . '/../view/travel/category/view.phtml',
//            'layout/popup-map'           => __DIR__ . '/../view/travel/category/map.phtml',
//            'layout/detail-page'           => __DIR__ . '/../view/layout/detail.phtml',
//            'layout/view-gallery'           => __DIR__ . '/../view/travel/category/view-gallery.phtml',
//            'layout/video-detail-popup'           => __DIR__ . '/../view/travel/category/video-detail-popup.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy'
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
