<?php // 
/**
 * 
 * Super class for templating interface of Aether
 * 
 * Created: 2009-04-23
 * @author Raymond Julin
 * @package aether
 */
abstract class AetherTemplate {
    private $sl = null;
    
    /**
     * Return template object for selected engine
     *
     * @return AetherTemplate
     * @param string $engine Name of engine to use
     * @param string AetherServiceLocator $sl
     */
    public static function get($engine, AetherServiceLocator $sl) {
        if ($engine == 'smarty') {
            $class = 'AetherTemplateSmarty';
        }
        else {
            // Default template engine
            $class = 'AetherTemplateSmarty';
        }
        return new $class($sl);
    }
    
    /**
     * Set a template variable 
     *
     * @return void
     * @param string $key
     * @param mixed $value
     */
    abstract public function set($key, $value);

    abstract public function setAll($keyValues);

    /**
     * Fetch rendered template
     *
     * @return string
     * @param string $name
     */
    abstract public function fetch($name);

    /**
     * Check if template exists
     *
     * @return bool
     * @param string $name
     */
    abstract public function templateExists($name);
}
