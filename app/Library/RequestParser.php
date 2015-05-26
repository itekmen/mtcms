<?php
/**
 * Created by PhpStorm.
 * User: muratt
 * Date: 10.04.2015
 * Time: 11:51
 */

namespace App\Library;


class RequestParser {

    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * The name of the controller
     * @var string
     */
    private $controller;

    /**
     * The method of the controller that is going to be called by this request
     * @var string
     */
    private $controllerMethod;

    /**
     * Namespaced path to controller class
     * @var string
     */
    private $controllerPath;

    /**
     * Controller path includeing @methodname
     * @var string
     */
    private $controllerMethodPath;


    /**
     * @param \Illuminate\Http\Request  $request
     * @param \Illuminate\Http\Route  $route
     */
    public function __construct($request,$route) {
        $this->request = $request;
        $this->controllerMethodPath = $route->getAction()['uses'];
        $this->analyseRequestAndSetVars();
    }

    /**
     * Analyse request and set vars
     */
    private function analyseRequestAndSetVars() {
        $this->extractControllerName();
        $this->extractControllerPathAndMethod();
    }

    /**
     * Determine model from controlerMethodPath
     */
    private function extractControllerName() {
        // Regex to get intended model and action from request
        //$modelActionRegex = '/^.+\\\\Http\\\\Controllers\\\\(?<controller>.+)Controller@.+$/';
        $modelActionRegex = '/^.+\\\\Http\\\\Controllers\\\\(?<controller>.+)@.+$/';
        preg_match($modelActionRegex, $this->controllerMethodPath, $result);
        $this->controller = $result['controller'];
    }

    /**
     * Determine controllerPath and intended controller method
     */
    private function extractControllerPathAndMethod() {
        list($this->controllerPath, $this->controllerMethod) = explode('@', $this->controllerMethodPath);
    }

    /**
     * Check controller for permission denied method
     *
     * @return bool
     */
    public function hasControllerPermissionDeniedMethod() {
        try {
            $controllerClass = new \ReflectionClass($this->controllerPath);
            return $controllerClass->hasMethod('permissionDenied');
        } catch(Exception $e) {
            return false;
        }
    }

    /**
     * @return string
     */
    public function getControllerName() {
        return strtolower($this->controller);
    }

    /**
     * @return string
     */
    public function getControllerMethod() {
        return strtolower($this->controllerMethod);
    }

    /**
     * @return string
     */
    public function getControllerPath() {
        return $this->controllerPath;
    }

    /**
     * @return string
     */
    public function getControllerMethodPath() {
        return $this->controllerMethodPath;
    }


}