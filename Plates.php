<?php
namespace Slim\Views;

use Slim\View;
use League\Plates\Engine;
use League\Plates\Template;

class Plates extends View
{
    /**
     * The Plates Engine instance.
     *
     * @var \League\Plates\Engine
     **/
    protected $engineInstance;

    /**
     * Template file extension.
     *
     * @var string
     **/
    public $fileExtension = '';

    /**
     * Templates path.
     *
     * @var string
     **/
    public $templatesPath = '';

    /**
     * Template folders.
     *
     * @var array
     **/
    public $templatesFolders = array();

    /**
     * Parser extensions.
     *
     * @var array
     **/
    public $parserExtensions = array();

    /**
     * Get the templates path.
     *
     * @return mixed
     **/
    protected function getTemplatesPath()
    {
        if ($this->templatesPath) {
            return $this->templatesPath;
        }

        return $this->getTemplatesDirectory();
    }

    /**
     * Get an instance of the Plates Engine
     *
     * @return \League\Plates\Engine
     */
    public function getEngineInstance()
    {
        if (! $this->engineInstance) {
            $engine = new Engine($this->getTemplatesDirectory());

            if ($this->fileExtension) {
                $engine->setFileExtension($this->fileExtension); 
            }

            if (count($this->templatesFolders) > 0) {
                foreach ($this->templatesFolders as $name => $path) {
                    $engine->addFolder($name, $path);
                }
            }

            if (count($this->parserExtensions) > 0) {
                foreach ($this->parserExtensions as $extension) {
                    $engine->loadExtension($extension);
                }
            }

            $this->engineInstance = $engine;
        }

        return $this->engineInstance;
    }

    /**
     * Render a template file
     *
     * @param  string $template  The template pathname, relative to the template base directory.
     * @param  array  $data      Any additonal data to be passed to the template.
     * @return string            The rendered template.
     */
    public function render($template, $data = null)
    {
        $plates = new Template($this->getEngineInstance());
        $plates->data($this->all());
        return $plates->render($template, $data);
    }
}