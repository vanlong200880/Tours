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
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/[:category][/:nation][/:province][/:district]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Category\Controller',
                        'controller'    => 'Category',
                        'action'        => 'index',
//                        'format' => 'html',
                    ),
                    'constraints' => array(
                      'category'     => '[a-zA-Z0-9_-]*',
                      'nation'     => '[a-zA-Z0-9_-]*',
                      'province'     => '[a-zA-Z0-9_-]*',
                      'district'     => '[a-zA-Z0-9_-]*',
//                      'page'     	=> '[0-9]+',
                    ),
//                    'spec' => '/%category%/%nation%.%format%',
                ),
                
                
                
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
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
          'Category\Controller\Travel' => Controller\TravelController::class,
          'Category\Controller\Category' => Controller\CategoryController::class,
          'Category\Controller\Tour' => Controller\TourController::class,
          'Category\Controller\Comment' => Controller\CommentController::class,
        ),
    ),
    'view_helpers'    => array(
        'invokables'  => array(
//          'searchTravel'        => 'Travel\Block\searchTravel',
//          'footerTravel'        => 'Travel\Block\footerTravel',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/category'           => __DIR__ . '/../view/layout/layout.phtml',
            'travel/index'           => __DIR__ . '/../view/category/travel/index.phtml',
            'travel/index-nation'           => __DIR__ . '/../view/category/travel/index-nation.phtml',
            'travel/popup-view'           => __DIR__ . '/../view/category/travel/view.phtml',
            'travel/popup-map'           => __DIR__ . '/../view/category/travel/map.phtml',
            'travel/view-gallery'           => __DIR__ . '/../view/category/travel/view-gallery.phtml',
            'travel/video-detail-popup'           => __DIR__ . '/../view/category/travel/video-detail-popup.phtml',
            
            'view/comment'           => __DIR__ . '/../view/category/comment/view.phtml',
            'view/comment-popup'           => __DIR__ . '/../view/category/comment/comment-popup.phtml',
            'layout/tour'           => __DIR__ . '/../view/layout/layout-tour.phtml',
            'tour/index'           => __DIR__ . '/../view/category/tour/index.phtml',
            'tour/detail'          => __DIR__ . '/../view/category/tour/detail.phtml',
            'tour/view'          => __DIR__ . '/../view/category/tour/view.phtml',
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