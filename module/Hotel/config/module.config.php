<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Hotel;

return array(
    'router' => array(
        'routes' => array(
            'hotel' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/khach-san',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Hotel\Controller',
                        'controller' => 'Hotel\Controller\Hotel',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
//                  'hotel-category' => array(
//                    'type' => 'Segment',
//                    'options' => array(
//                      'route' => '/[:category]',
//
//                      'defaults' => array(
//                        '__NAMESPACE__' => 'Hotel\Controller',
//                        'controller' => 'Hotel\Controller\Category',
//                        'action' => 'index',
//                        'category' => '[a-zA-Z0-9_-]*'
//                      ),
//                      'constraints' => array(
//                        'category'     => '[a-zA-Z0-9_-]*',
//                      ),
//                    ),
//                  ),
//                  
//                  'hotel-detail' => array(
//                    'type' => 'Segment',
//                    'options' => array(
//                      'route' => '/detail',
//
//                      'defaults' => array(
//                        '__NAMESPACE__' => 'Hotel\Controller',
//                        'controller' => 'Hotel\Controller\Hotel',
//                        'action' => 'detail',
//                      ),
//                    ),
//                  ),
                  
//                  'hotel-room' => array(
//                    'type' => 'Segment',
//                    'options' => array(
//                      'route' => '/room',
//
//                      'defaults' => array(
//                        '__NAMESPACE__' => 'Hotel\Controller',
//                        'controller' => 'Hotel\Controller\Hotel',
//                        'action' => 'room',
//                      ),
//                    ),
//                  ),
                  
                ),
            ),
          
            'hotel-category' => array(
              'type' => 'Segment',
              'options' => array(
                'route' => '/khach-san/[:nation][/:province][/:district][/trang-:page]',
                'defaults' => array(
                  '__NAMESPACE__' => 'Hotel\Controller',
                  'controller' => 'Hotel\Controller\Hotel',
                  'action' => 'index',
                ),
                'constraints' => array(
                  'nation'     => '[a-zA-Z0-9_-]*',
                  'province'     => '[a-zA-Z0-9_-]*',
                  'district'     => '[a-zA-Z0-9_-]*',
                  'page'     	=> '[0-9]+',
                ),
              ),
            ),
          
            'hotel-detail' => array(
              'type' => 'Segment',
              'options' => array(
                'route' => '/hotel-detail',

                'defaults' => array(
                  '__NAMESPACE__' => 'Hotel\Controller',
                  'controller' => 'Hotel\Controller\Hotel',
                  'action' => 'detail',
                ),
              ),
            ),
                  
            'hotel-room' => array(
              'type' => 'Segment',
              'options' => array(
                'route' => '/hotel-room',

                'defaults' => array(
                  '__NAMESPACE__' => 'Hotel\Controller',
                  'controller' => 'Hotel\Controller\Hotel',
                  'action' => 'room',
                ),
              ),
            ),
          
            'hotel-page-detail' => array (
              'type' => 'Zend\Mvc\Router\Http\Regex',
              'options' => array (
                'regex' => '/khach-san/(?<slug>[a-zA-Z0-9-]+)-pr-(?<id>[0-9]+)?(\.(?<format>(html)))?',
                  'defaults' => array(
                    '__NAMESPACE__' => 'Hotel\Controller',
                    'controller' => 'Hotel\Controller\Hotel',
                    'action' => 'pageDetail',
                    'format' => 'html',
                  ),
                  'spec' => '/khach-san/%slug%-pr-%id%.%format%'
              )
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
          'Hotel\Controller\Hotel' => Controller\HotelController::class,
          'Hotel\Controller\Category' => Controller\CategoryController::class
        ),
    ),
    'view_helpers'    => array(
        'invokables'  => array(
          'searchHotel'        => 'Hotel\Block\searchHotel',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/hotel'           => __DIR__ . '/../view/layout/layout.phtml',
            'hotel/index/index' => __DIR__ . '/../view/hotel/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'layout/popup-hotel-detail'           => __DIR__ . '/../view/hotel/hotel/detail.phtml',
            'layout/popup-hotel-room'           => __DIR__ . '/../view/hotel/hotel/room.phtml',
            'layout/hotel-page-detail'           => __DIR__ . '/../view/layout/page-detail.phtml',
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
