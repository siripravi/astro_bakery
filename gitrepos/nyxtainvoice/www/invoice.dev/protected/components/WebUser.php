<?php

/**
 * @property boolean $isAdmin
 * @property boolean $isSuperAdmin
 * @property User $user
 */
class WebUser extends CWebUser
{

    /**
     * cache for the logged in User active record
     * @return User
     */
    private $_user;

    /**
     * is the user a superadmin ?
     * @return boolean
     */
    function getIsSuperAdmin()
    {
        return ($this->user && $this->user->level == User::LEVEL_SUPERADMIN);
    }

    /**
     * is the user an administrator ?
     * @return boolean
     */
    function getIsAdmin()
    {
        return ($this->user && $this->user->level >= User::LEVEL_ADMIN);
    }

    /**
     * is the user an administrator ?
     * @return boolean
     */
    function getIsSupport()
    {
        return ($this->user && $this->user->level >= User::LEVEL_SUPPORT);
    }

    /**
     * is the user an administrator ?
     * @return boolean
     */
    function getIsAuthor()
    {
        return ($this->user && $this->user->level >= User::LEVEL_AUTHOR);
    }

    /**
     * get the logged user
     * @return User|null the user active record or null if user is guest
     */
    function getUser()
    {
        if ($this->isGuest)
            return null;
        if ($this->_user === null) {
            $this->_user = User::model()->findByPk($this->id);
        }
        return $this->_user;
    }

    function getHomeUrl()
    {
        return $this->user->homeUrl;

    }
    public function loginRequired()
    {
        $app = Yii::app();
        $request = $app->getRequest();

        if (!$request->getIsAjaxRequest())
            $this->setReturnUrl($request->hostInfo . '/' . $request->pathInfo);

        if (($url = $this->loginUrl) !== null) {
            if (is_array($url)) {
                $route = isset($url[0]) ? $url[0] : $app->defaultController;
                $url = $app->createUrl($route, array_splice($url, 1));
            }
            $request->redirect($url);
        } else
            throw new CHttpException(403, Yii::t('yii', 'Login Required'));
    }

    public function afterLogin($fromCookie)
    {
        if ($fromCookie === false) {
            /* Yii::import('application.modules.user.models.*');
             UserDetail::model()->updateByPk($this->id,
                 array(
                     'last_login'=>date('Y-m-d H:i:s'),
                     'last_ip'   =>CommonHelper::ipToInt(),
                     )
                 );    */
            $app = Yii::app();
            $request = $app->getRequest();
            $request->redirect($this->user->homeUrl);
        }
    }


}