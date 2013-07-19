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

    /**
     * Test getFormElementConfig().
     *
     * @covers SclContact\Module::getFormElementConfig
     *
     * @return void
     */
    public function testGetFormElementConfig()
    {
        $config = $this->module->getFormElementConfig();

        $this->checkInvokableService(
            $config,
            'SclContact\Form\Fieldset\Contact',
            'SclContact\Form\Fieldset\Contact'
        );
    }

    /**
     * Test getFormElementConfig().
     *
     * @covers SclContact\Module::getFormElementConfig
     *
     * @return void
     */
    public function testAddressHydratorConfigFormElementConfig()
    {
        $config = $this->module->getFormElementConfig();

        $countryManager = $this->getMockBuilder('SclContact\Country\CountryManager')
                               ->disableOriginalConstructor()
                               ->getMock();

        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');

        $serviceLocator->expects($this->once())
                       ->method('get')
                       ->with($this->equalTo('SclContact\Country\CountryManagerInterface'))
                       ->will($this->returnValue($countryManager));

        $elementManager = $this->getMock('Zend\Form\FormElementManager');

        $elementManager->expects($this->any())
                        ->method('getServiceLocator')
                        ->will($this->returnValue($serviceLocator));

        $this->checkFactoryCallbackService(
            $config,
            'SclContact\Form\Fieldset\Address',
            'SclContact\Form\Fieldset\Address',
            $elementManager
        );
    }

    /**
     * Test getHydratorConfig().
     *
     * @covers SclContact\Module::getHydratorConfig
     *
     * @return void
     */
    public function testAddressHydratorConfig()
    {
        $config = $this->module->getHydratorConfig();

        $countryManager = $this->getMockBuilder('SclContact\Country\CountryManager')
                               ->disableOriginalConstructor()
                               ->getMock();

        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');

        $serviceLocator->expects($this->once())
                       ->method('get')
                       ->with($this->equalTo('SclContact\Country\CountryManagerInterface'))
                       ->will($this->returnValue($countryManager));

        $hydratorManager = $this->getMock('Zend\Stdlib\Hydrator\HydratorPluginManager');

        $hydratorManager->expects($this->any())
                        ->method('getServiceLocator')
                        ->will($this->returnValue($serviceLocator));

        $this->checkFactoryCallbackService(
            $config,
            'SclContact\Hydrator\AddressHydrator',
            'SclContact\Hydrator\AddressHydrator',
            $hydratorManager
        );
    }

    /**
     * Test getHydratorConfig().
     *
     * @covers SclContact\Module::getHydratorConfig
     *
     * @return void
     */
    public function testContactHydratorConfig()
    {
        $config = $this->module->getHydratorConfig();

        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');

        $hydrator = $this->getMock('SclContact\Hydrator\AddressHydrator');

        $serviceLocator->expects($this->once())
                       ->method('get')
                       ->with($this->equalTo('SclContact\Hydrator\AddressHydrator'))
                       ->will($this->returnValue($hydrator));

        $this->checkFactoryCallbackService(
            $config,
            'SclContact\Hydrator\ContactHydrator',
            'SclContact\Hydrator\ContactHydrator',
            $serviceLocator
        );
    }

    /**
     * Check the service config for the ContactOptionsInterface.
     *
     * @covers SclContact\Module::getServiceConfig
     *
     * @return void
     */
    public function testContactOptionsServiceConfig()
    {
        $configArray = array('scl_contact' => array());

        $config = $this->module->getServiceConfig();

        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');

        $serviceLocator->expects($this->once())
                       ->method('get')
                       ->with($this->equalTo('Config'))
                       ->will($this->returnValue($configArray));

        $this->checkFactoryCallbackService(
            $config,
            'SclContact\Options\ContactOptionsInterface',
            'SclContact\Options\ContactOptions',
            $serviceLocator
        );
    }

    /**
     * Check the service config for the CountryManager.
     *
     * @covers SclContact\Module::getServiceConfig
     *
     * @return void
     */
    public function testCountryManagerServiceConfig()
    {
        $config = $this->module->getServiceConfig();

        $options = $this->getMock('SclContact\Options\ContactOptionsInterface');

        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');

        $serviceLocator->expects($this->once())
                       ->method('get')
                       ->with($this->equalTo('SclContact\Options\ContactOptionsInterface'))
                       ->will($this->returnValue($options));

        $this->checkFactoryCallbackService(
            $config,
            'SclContact\Country\CountryManager',
            'SclContact\Country\CountryManager',
            $serviceLocator
        );
    }

    /**
     * Check the service config for the CountryManagerInterface.
     *
     * @covers SclContact\Module::getServiceConfig
     *
     * @return void
     */
    public function testCountryManagerInterfaceServiceConfig()
    {
        $dummyManager = new \stdClass();

        $config = $this->module->getServiceConfig();

        $options = $this->getMock('SclContact\Options\ContactOptionsInterface');

        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');

        $serviceLocator->expects($this->at(0))
                       ->method('get')
                       ->with($this->equalTo('SclContact\Options\ContactOptionsInterface'))
                       ->will($this->returnValue($options));

        $options->expects($this->once())
                ->method('getCountryManager')
                ->will($this->returnValue('ManagerClass'));

        $serviceLocator->expects($this->at(1))
                       ->method('get')
                       ->with($this->equalTo('ManagerClass'))
                       ->will($this->returnValue($dummyManager));

        $manager = $this->checkFactoryCallbackService(
            $config,
            'SclContact\Country\CountryManagerInterface',
            'stdClass',
            $serviceLocator
        );

        $this->assertSame($dummyManager, $manager);
    }

    /**
     * Check the value in an invokables section of the config.
     *
     * @param  array  $config
     * @param  string $key
     * @param  string $value
     *
     * @return void
     * @todo   Move to abstract module test library.
     */
    protected function checkInvokableService(array $config, $key, $value)
    {
        $this->assertArrayHasKey(
            'invokables',
            $config,
            'Config doesn\'t have invokables section.'
        );

        $invokables = $config['invokables'];

        $this->assertInternalType(
            'array',
            $invokables,
            'Invokables section is not an array.'
        );

        $this->assertArrayHasKey(
            $key,
            $invokables,
            "$key not found in invokables section."
        );

        $this->assertEquals(
            $value,
            $invokables[$key],
            "Values don't match for $key."
        );
    }

    /**
     * Check the value in an factories section of the config.
     *
     * @param  array                   $config
     * @param  string                  $key
     * @param  string                  $returnType
     * @param  serviceLocatorInterface $serviceLocator
     *
     * @return void
     * @todo   Move to abstract module test library.
     */
    protected function checkFactoryCallbackService(
        array $config,
        $key,
        $returnType,
        $serviceLocator = null
    ) {
        $this->assertArrayHasKey(
            'factories',
            $config,
            'Config doesn\'t have factories section.'
        );

        $factories = $config['factories'];

        $this->assertInternalType(
            'array',
            $factories,
            'Factories section is not an array.'
        );

        $this->assertArrayHasKey(
            $key,
            $factories,
            "$key not found in factories section."
        );

        $factory = $factories[$key];

        $this->assertInternalType(
            'callable',
            $factory,
            "Factory for $key is not callable."
        );

        if (null === $serviceLocator) {
            $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        }

        $result = $factory($serviceLocator);

        $this->assertInstanceOf(
            $returnType,
            $result,
            "Return type for $key must be $returnType"
        );

        return $result;
    }
}
