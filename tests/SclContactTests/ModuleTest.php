<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContactTests;

use SclContact\Module;

/**
 * Unit tests for {@see Module}.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class ModuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The instance to test.
     *
     * @var Module
     */
    protected $module;

    /**
     * Setup the instance to be tested.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->module = new Module();
    }

    /**
     * testGetAutoloaderConfig
     *
     * @covers SclContact\Module::getAutoloaderConfig
     *
     * @return void
     */
    public function testGetAutoloaderConfig()
    {
        $config = $this->module->getAutoloaderConfig();

        $this->assertArrayHasKey(
            'Zend\Loader\ClassMapAutoloader',
            $config,
            'ClassMapAutoloader config not set.'
        );

        $this->assertFileExists(
            $config['Zend\Loader\ClassMapAutoloader'][0],
            'Class map file doesn\'t exist.'
        );

        $this->assertArrayHasKey(
            'Zend\Loader\StandardAutoloader',
            $config,
            'StandardAutoloader config not set.'
        );
    }
}
