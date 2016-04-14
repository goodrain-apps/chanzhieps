<?php
/**
 * The model class file of ZenTaoPHP framework.
 *
 * The author disclaims copyright to this source code.  In place of
 * a legal notice, here is a blessing:
 *
 *  May you do good and not evil.
 *  May you find forgiveness for yourself and forgive others.
 *  May you share freely, never taking more than you give.
 */

/**
 * The base class of model.
 *
 * @package framework
 */

class model
{
    /**
     * The global $app object.
     * 
     * @var object
     * @access protected
     */
    protected $app;

    /**
     * The global $config object.
     * 
     * @var object
     * @access protected
     */
    protected $config;

    /**
     * The global $lang object.
     * 
     * @var object
     * @access protected
     */
    protected $lang;

    /**
     * The global $dbh object, the database connection handler.
     * 
     * @var object
     * @access protected
     */
    protected $dbh;

    /**
     * The $dao object, used to access or update database.
     * 
     * @var object
     * @access protected
     */
    public $dao;

    /**
     * The $post object, used to access the $_POST var.
     * 
     * @var ojbect
     * @access public
     */
    public $post;

    /**
     * The $get object, used to access the $_GET var.
     * 
     * @var ojbect
     * @access public
     */
    public $get;

    /**
     * The $sesion object, used to access the $_SESSION var.
     * 
     * @var ojbect
     * @access public
     */
    public $session;

    /**
     * The $server object, used to access the $_SERVER var.
     * 
     * @var ojbect
     * @access public
     */
    public $server;

    /**
     * The $cookie object, used to access the $_COOKIE var.
     * 
     * @var ojbect
     * @access public
     */
    public $cookie;

    /**
     * The $global object, used to access the $_GLOBAL var.
     * 
     * @var ojbect
     * @access public
     */
    public $global;

    /**
     * The construct function.
     *
     * 1. global the global vars, refer them by the class member such as $this->app.
     * 2. set the pathes, config, lang of current module
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        global $app, $config, $lang, $dbh;
        $this->app    = $app;
        $this->config = $config;
        $this->lang   = $lang;
        $this->dbh    = $dbh;

        $moduleName = $this->getModuleName();
        if($moduleName != 'common')
        {
            $this->app->loadLang($moduleName);                    // the common lang file load by router's construction already.
            $this->app->loadConfig($moduleName, $exit = false);   // the common config file load by router's construction already.
        }
     
        $this->loadDAO();
        $this->setSuperVars();
    }

    /**
     * Get the module name of this model. Not the module user visiting.
     *
     * This method replace the 'ext' and 'model' string from the model class name, thus get the module name.
     * Not useing $app->getModuleName() because it return the module user is visiting. But one module can be
     * loaded by loadModel() so we must get the module name of thie model.
     * 
     * @access protected
     * @return string the module name.
     */
    protected function getModuleName()
    {
        $parentClass = get_parent_class($this);
        $selfClass   = get_class($this);
        $className   = $parentClass == 'model' ? $selfClass : $parentClass;
        if($className == 'extensionModel') return 'extension';
        return strtolower(str_ireplace(array('ext', 'Model'), '', $className));
    }

    /**
     * Set the super vars.
     * 
     * @access protected
     * @return void
     */
    protected function setSuperVars()
    {
        $this->post    = $this->app->post;
        $this->get     = $this->app->get;
        $this->server  = $this->app->server;
        $this->cookie  = $this->app->cookie;
        $this->session = $this->app->session;
        $this->global  = $this->app->global;
    }

    /**
     * Load the model of one module. After loaded, can use $this->modulename to visit the model object.
     * 
     * @param   string  $moduleName
     * @access  public
     * @return  object|bool  the model object or false if model file not exists.
     */
    public function loadModel($moduleName)
    {
        if(empty($moduleName)) return false;
        $modelFile = helper::setModelFile($moduleName);

        if(!helper::import($modelFile)) return false;
        $modelClass = class_exists('ext' . $moduleName. 'model') ? 'ext' . $moduleName . 'model' : $moduleName . 'model';
        if(!class_exists($modelClass)) $this->app->triggerError(" The model $modelClass not found", __FILE__, __LINE__, $exit = true);

        $this->$moduleName = new $modelClass();
        return $this->$moduleName;
    }

    /**
     * Load extension class of a model. Saved to $moduleName/ext/model/class/$extensionName.class.php.
     * 
     * @param  string $extensionName 
     * @param  string $moduleName 
     * @access public
     * @return void
     */
    public function loadExtension($extensionName, $moduleName = '') 
    {   
        if(empty($extensionName)) return false;

        /* Set extenson name and extension file. */
        $extensionName = strtolower($extensionName);
        $moduleName    = $moduleName ? $moduleName : $this->getModuleName();
        $moduleExtPath = $this->app->getModuleExtPath($moduleName, 'model');
        $extensionFile = $moduleExtPath['site'] . 'class/' . $extensionName . '.class.php';
        if(!file_exists($extensionFile)) $extensionFile = $moduleExtPath['common'] . 'class/' . $extensionName . '.class.php';

        /* Try to import parent model file auto and then import the extension file. */
        if(!class_exists($moduleName . 'Model')) helper::import($this->app->getModulePath($moduleName) . 'model.php');
        if(!helper::import($extensionFile)) return false;

        /* Set the extension class name. */
        $extensionClass = $extensionName . ucfirst($moduleName);
        if(!class_exists($extensionClass)) return false;

        /* Create an instance of the extension class and return it. */
        $extensionObject = new $extensionClass;
        $extensionClass  = str_replace('Model', '', $extensionClass);
        $this->$extensionClass = $extensionObject;
        return $extensionObject;
    }

    //-------------------- DAO related method s--------------------//

    /**
     * Load DAO.
     * 
     * @access private
     * @return void
     */
    private function loadDAO()
    {
        $this->dao = $this->app->loadClass('dao');
    }

    /**
     * Delete one record.
     * 
     * @param  string    $table  the table name
     * @param  string    $id     the id value of the record to be deleted
     * @access public
     * @return void
     */
    public function delete($table, $id)
    {
        $this->dao->delete()->from($table)->where('id')->eq($id)->exec();
    }
}    
