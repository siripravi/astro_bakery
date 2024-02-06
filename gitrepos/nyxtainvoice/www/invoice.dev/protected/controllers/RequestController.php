<?php

class RequestController extends Controller
{

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl',
            'ajaxOnly -uploadFile'
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array(
                    'addTabularInputs',
                    'addStaff'
                ),
                'users' => array('*'),
            ),
            array(
                'deny',
                // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * @return array actions
     */
    public function actions()
    {
        return array(
            'addTabularInputs' => array(
                'class' => 'ext.actions.XTabularInputAction',
                'modelName' => 'CustomerCards',
                'viewName' => '/customer/_tabularInput',
            ),
            'addStaff' => array(
                'class' => 'ext.actions.XTabularInputAction',
                'modelName' => 'Employee',
                'viewName' => '/movement/_tabularInput',
            ),
        );
    }

}