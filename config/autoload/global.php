<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
  'module_layouts' => array(
		'Frontend'  => 'layout/frontend',
		'Backend'   => 'layout/backend',
    'Tour'      => 'layout/tour',
    'Video'      => 'layout/video',
    'Taste'     => 'layout/taste',
    'Tour'      => 'layout/tour',
    'Travel'    => 'layout/travel',
    'User'      => 'layout/user',
    'Diary'     => 'layout/diary',
    'Hotel'      => 'layout/hotel',
    'Photo'      => 'layout/photo',
    'Cart'      => 'layout/cart',
    'Gallery'      => 'layout/gallery',
    'Backend'      => 'layout/backend',
    'Category'      => 'layout/category',
	),
    // ...
);
