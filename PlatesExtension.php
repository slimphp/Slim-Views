<?php
namespace Slim\Views;

use League\Plates\Extension\ExtensionInterface;
use Slim\Slim;

class PlatesExtension implements ExtensionInterface
{
    /**
     * Instance of the parent engine.
     * @var \League\Plates\Engine
     */
    public $engine;

    /**
     * Instance of the current template.
     * @var \League\Plates\Template
     */
    public $template;

    /**
     * Get Functions.
     *
     * @var array
     **/
    public function getFunctions()
    {
        return array(
            'slim'    => 'getSlimInstance',
            'urlFor'  => 'urlFor',
            'baseUrl' => 'baseUrl',
            'siteUrl' => 'siteUrl',
        );
    }

    /**
     * Get a Slim instance.
     *
     * @param string $appName The name of the Slim instance to retrieve.
     * @return \Slim\Slim     The Slim instance.
     **/
    public function getSlimInstance($appName = null)
    {
        if (! empty($appName)) {
            return Slim::getInstance($appName);
        }

        return Slim::getInstance();
    }

    /**
     * Generate a URL from a slim route.
     *
     * @param string $appName The name of the Slim instance to retrieve.
     * @param string $route   The Slim route name.
     * @param array  $param   The route parameters.
     * @return string         The route URI.
     **/
    public function urlFor($route = null, $params = array(), $appName = 'default')
    {
        return Slim::getInstance($appName)->urlFor($route, $params);
    }

    /**
     * Get the base URL.
     *
     * @param string $withUri Include the URI.
     * @param array  $appName The Slim application name.
     * @return string         The base path.
     **/
    public function baseUrl($withUri = true, $appName = 'default')
    {
        $req = Slim::getInstance($appName)->request();
        $uri = $req->getUrl();

        if ($withUri) {
            $uri .= $req->getRootUri();
        }

        return $uri;
    }

    /**
     * Get the site URL.
     * 
     * @param string $url     The URL.
     * @param string $withUri Include the URI.
     * @param array  $appName The Slim application name.
     * @return string         The base path.
     **/    
    public function siteUrl($url, $withUri = true, $appName = 'default')
    {
        return $this->baseUrl($withUri, $appName) . '/' . ltrim($url, '/');
    }    
}