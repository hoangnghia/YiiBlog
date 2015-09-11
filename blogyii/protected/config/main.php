<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Blog tutorial',
	// 'theme'=>'blackboot',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.vendors.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

		
	),
	


	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		//Activate the Cache Component
		'cache'=>array( 
	    	'class'=>'system.caching.CDbCache'
		),

		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'caseSensitive' =>false,
			'rules'=>array(

				'<controller:\w+>/<action:\w+>/<id:\w+>/*'=>'<controller>/<action>',
				// '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				// '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning,',					 
					// 'filter'=>'CLogFilter',
					 // 'categories'=>'system.*',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning,info,',
					'logFile'=>'application_site.log',
					// 'filter'=>'CLogFilter',
					 
				),
				//pqp
				 array(
                    'class' => 'application.extensions.pqp.PQPLogRoute',
                    'categories' => 'application.*, exception.*',
                ),

				 // array(
     //                'class'=>'CEmailLogRoute',
     //                'levels'=>'error, warning',
     //                'emails'=>array('hoangnghiagll@gmail.com'),
     //            ),
				  array(
                    'class'=>'CProfileLogRoute',
                    'report'=>'summary',
                    // lists execution time of every marked code block
                    // report can also be set to callstack
                ),
				// uncomment the following to show log messages on web pages
				
				// array(
				// 	'class'=>'CWebLogRoute',
				// 	'levels' => 'error,warning,info,trace',
				// 	'categories' => 'system.db.*',
				// ),
				
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
