<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('vendors', dirname(__FILE__) . '/../../vendors');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');
Yii::setPathOfAlias('editable', dirname(__FILE__) . '/../extensions/x-editable');
//Yii::setPathOfAlias('booster', dirname(__FILE__) . '/../../vendors/booster');
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Invoicing',
    'theme' => 'dashboard',
    // preloading 'log' component
    'preload' => array('log'),
    'timeZone' => 'America/Los_Angeles',
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.vendor.vernes.yiimailer.YiiMailer',
        /* 'bootstrap.components.*',
                 'bootstrap.widgets.*',
                 'bootstrap.helpers.*',
                 'bootstrap.behaviors.*',
                 'bootstrap.form.*',*/
        'editable.*'
        //   'booster.components.*',
        //    'booster.helpers.TbHtml',
        //    'booster.widgets.TbSelect2',
        // 'booster.widgets.TbEditableField'
        // 'ext.quickdlgs.*',
    ),
    'modules' => array(
        'nginvoice',

        // uncomment the following to enable the Gii tool    
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '1',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            // 'ipFilters'=>array('127.0.0.1','::1'),
        ),
        // 'support'

    ),
    // application components
    'components' => array(
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',
            // 'class' => '\TbApi',
        ),

        'editable' => array(
            'class' => 'editable.EditableConfig',
            'form' => 'bootstrap',
            //form style: 'bootstrap', 'jqueryui', 'plain' 
            'mode' => 'popup',
            //mode: 'popup' or 'inline'  
            'defaults' => array(
                //default settings for all editable elements
                'emptytext' => 'Click to edit'
            )
        ),
        'db3' => array(
            //'connectionString' => 'mysql:host=10.4.13.1:3306;dbname=yii2-invoices',
            'connectionString' => 'mysql:host=localhost;dbname=invoicedb2',
            'emulatePrepare' => true,
            'username' => 'prov',
            'password' => 'siripravi',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true
        ),
        'ePdf' => array(
            'class' => 'ext.yii-pdf.EYiiPdf',
            'params' => array(
                'mpdf' => array(
                    'librarySourcePath' => 'vendors.mpdf.mpdf.*',
                    'constants' => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class' => 'mpdf',
                    // the literal class filename to be loaded from the vendors folder
                    'defaultParams' => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                        'mode' => '',
                        //  This parameter specifies the mode of the new document.
                        'format' => 'Letter',
                        // format A4, A5, ...
                        'default_font_size' => 0,
                        // Sets the default document font size in points (pt)
                        'default_font' => '',
                        // Sets the default font-family for the new document.
                        'mgl' => 15,
                        // margin_left. Sets the page margins for the new document.
                        'mgr' => 15,
                        // margin_right
                        'mgt' => 16,
                        // margin_top
                        'mgb' => 16,
                        // margin_bottom
                        'mgh' => 9,
                        // margin_header
                        'mgf' => 9,
                        // margin_footer
                        'orientation' => 'P',
                        // landscape or portrait orientation
                    )
                ),
            ),
        ),
        'clientScript' => array(
            /* 'class' => 'ext.NLSClientScript',
             'mergeJs' => true, //def:true
             'compressMergedJs' => false, //def:false
 
            'mergeCss' => true, //def:true
            'compressMergedCss' => false, //def:false
             'mergeIfXhr' => true,*/
            'coreScriptPosition' => CClientScript::POS_END,
            //  'class' => 'application.components.MultidomainClientScript',
            //  'enableMultidomainAssets' => true,
            //  'assetsSubdomain' => 'static',
            //   'indexedAssetsSubdomain' => true,
            'packages' => array(
                /* 'jquery'=>array(
                        // 'baseUrl'=>'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/',
                                 'baseUrl'=>'/themes/dashboard/js/',  
                         'js'=>array('jquery.min.js'),
                               
                       ),*/
            )
        ),
        'widgetFactory' => array(
            'widgets' => array(
                'CJuiDatePicker' => array(
                    'themeUrl' => '/ajax/libs/jqueryui/1.11/themes',
                    'theme' => 'hotsneaks',
                ),
                'CJuiTabs' => array(
                    'themeUrl' => '/ajax/libs/jqueryui/1.11/themes',
                    'theme' => 'hotsneaks',
                ),
                'CJuiButton' => array(
                    'themeUrl' => '/ajax/libs/jqueryui/1.11/themes',
                    'theme' => 'hotsneaks',
                ),
                'JTimePicker' => array(
                    'theme' => 'hotsneaks',
                    'themeUrl' => '/ajax/libs/jqueryui/1.11/themes',
                ),
            ),
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'WebUser'
        ),
        /* 'mail' => array(
             'class' => 'vendors.yii-mail.YiiMail',
         //'useFileTransport' => false,
         ),*/
        // uncomment the following to enable URLs in path-format

        'urlManager' => array(
            'urlFormat' => 'path',
            'urlSuffix' => '.html',
            'rules' => array(
                'gii' => 'gii',
                'gii/<controller:\w+>' => 'gii/<controller>',
                'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
                // 'http://support.invoice.local' => 'support/support/index',
                // 'http://support.invoice.local/login' => 'support/support/login',
                //'/<type:\w+>' => 'search/admin/type/<type>',
                // '<controller:\w+>/<action:\w+>/<query:\w+>/<doc_type:\1>' => 'quote/<query>',
                // '<controller:\w+>/<action:\w+>/<query:\w+>/<doc_type:\2>' => 'invoice/<query>',
                'copyright.json' => 'site/copyrightJson',
                '<action:\w+>\.json' => 'site/<action>Json',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                // '<controller:\w+>/<action:\w+>\.json' => '/Json',
                '<view:\w+>' => 'site/page',


            ),
            'showScriptName' => false
        ),
        // uncomment the following to use a MySQL database

        'db' => array(
            //'connectionString' => 'sqlite:C:\yiisites\invoice.dev\protected\data\invoicedb.db',
            'connectionString' => 'sqlite:protected/data/invoicedb.db',
            // 'emulatePrepare' => true,
            // 'username' => 'root',
            // 'password' => '',
            //  'charset' => 'utf8',
        ),

        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),

            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'purnachandra.valluri@gmail.com',
        'InvPDFSavePath' => '/files/invoices'
    ),
);