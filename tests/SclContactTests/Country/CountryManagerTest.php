<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContactTests\Country;

use SclContact\Country\CountryManager;

class CountryManagerTest extends \PHPUnit_Framework_TestCase
{
    protected $manager;

    protected $options;

    protected $serviceLocator;

    public function setUp()
    {
        $this->options = $this->getMock('SclContact\Options\ContactOptionsInterface');

        $this->serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');

        $this->manager = new CountryManager($this->options, $this->serviceLocator);
    }

    /**
     * Test countryList loads the countries properly.
     *
     * @covers            SclContact\Country\CountryManager::__construct
     * @covers            SclContact\Country\CountryManager::countryList
     * @expectedException SclContact\Exception\RuntimeException
     *
     * @return void
     */
    public function testCountryListWithBadFilePath()
    {
        $configPath = __DIR__ . '/file-that-does-not-exist';

        $this->options
             ->expects($this->once())
             ->method('getCountryFilePath')
             ->will($this->returnValue($configPath));

        $this->manager->countryList();
    }

    /**
     * Test countryList loads the countries properly.
     *
     * @covers            SclContact\Country\CountryManager::__construct
     * @covers            SclContact\Country\CountryManager::countryList
     * @expectedException SclContact\Exception\RuntimeException
     *
     * @return void
     */
    public function testCountryListWithBadConfigFileResults()
    {
        $configPath = __DIR__ . '/../../bad-config-file.php';

        $this->options
             ->expects($this->once())
             ->method('getCountryFilePath')
             ->will($this->returnValue($configPath));

        $this->manager->countryList();
    }

    /**
     * Test countryList loads the countries properly.
     *
     * @covers SclContact\Country\CountryManager::__construct
     * @covers SclContact\Country\CountryManager::countryList
     *
     * @return void
     */
    public function testCountryList()
    {
        $configPath = __DIR__ . '/../../../config/countries.config.php';

        $list = include $configPath;

        $this->options
             ->expects($this->once())
             ->method('getCountryFilePath')
             ->will($this->returnValue($configPath));

        $this->assertEquals(
            $list,
            $this->manager->countryList()
        );
    }

    /**
     * Test load country with invalid identifier return null.
     *
     * @covers SclContact\Country\CountryManager::__construct
     * @covers SclContact\Country\CountryManager::loadCountry
     *
     * @return void
     */
    public function testLoadCountryWithBadIdentifier()
    {
        $configPath = __DIR__ . '/../../../config/countries.config.php';

        $this->options
             ->expects($this->once())
             ->method('getCountryFilePath')
             ->will($this->returnValue($configPath));

        $this->assertNull($this->manager->loadCountry('bad-identifier'));
    }

    /**
     * Test load country by class name with a class which isn't an instance of CountryInterface.
     *
     * @covers            SclContact\Country\CountryManager::__construct
     * @covers            SclContact\Country\CountryManager::loadCountry
     * @expectedException SclContact\Exception\RuntimeException
     *
     * @return void
     */
    public function testLoadCountryByClassNameWithBadClass()
    {
        $configPath = __DIR__ . '/../../../config/countries.config.php';
        $className = '\stdClass';

        $this->options
             ->expects($this->once())
             ->method('getCountryFilePath')
             ->will($this->returnValue($configPath));

        $this->options
             ->expects($this->any())
             ->method('getSharedCountries')
             ->will($this->returnValue(true));

        $this->options
             ->expects($this->atLeastOnce())
             ->method('getCountryClass')
             ->will($this->returnValue($className));

        $this->serviceLocator
             ->expects($this->once())
             ->method('has')
             ->with($this->equalTo($className))
             ->will($this->returnValue(false));

        $country = $this->manager->loadCountry('gb');
    }

    /**
     * Test load country by class name
     *
     * @covers SclContact\Country\CountryManager::__construct
     * @covers SclContact\Country\CountryManager::loadCountry
     *
     * @return void
     */
    public function testLoadCountrySharedByClassName()
    {
        $configPath = __DIR__ . '/../../../config/countries.config.php';
        $className = '\SclContact\Country';

        $this->options
             ->expects($this->once())
             ->method('getCountryFilePath')
             ->will($this->returnValue($configPath));

        $this->options
             ->expects($this->any())
             ->method('getSharedCountries')
             ->will($this->returnValue(true));

        $this->options
             ->expects($this->atLeastOnce())
             ->method('getCountryClass')
             ->will($this->returnValue($className));

        $this->serviceLocator
             ->expects($this->once())
             ->method('has')
             ->with($this->equalTo($className))
             ->will($this->returnValue(false));

        $country1 = $this->manager->loadCountry('gb');

        $this->assertEquals('gb', $country1->getCode(), 'Country code was incorrect');

        // Test the second call is shared

        $country2 = $this->manager->loadCountry('gb');

        $this->assertSame($country1, $country2, 'Instance returned was not shared.');
    }

    /**
     * Test load country by class name
     *
     * @covers SclContact\Country\CountryManager::__construct
     * @covers SclContact\Country\CountryManager::loadCountry
     *
     * @return void
     */
    public function testLoadCountryNotSharedByClassName()
    {
        $configPath = __DIR__ . '/../../../config/countries.config.php';
        $className = '\SclContact\Country';

        $this->options
             ->expects($this->atLeastOnce())
             ->method('getCountryFilePath')
             ->will($this->returnValue($configPath));

        $this->options
             ->expects($this->any())
             ->method('getSharedCountries')
             ->will($this->returnValue(false));

        $this->options
             ->expects($this->atLeastOnce())
             ->method('getCountryClass')
             ->will($this->returnValue($className));

        $this->serviceLocator
             ->expects($this->atLeastOnce())
             ->method('has')
             ->with($this->equalTo($className))
             ->will($this->returnValue(false));

        $country1 = $this->manager->loadCountry('gb');

        $this->assertEquals('gb', $country1->getCode(), 'Country code was incorrect');

        // Test the second call is shared

        $country2 = $this->manager->loadCountry('gb');

        $this->assertNotSame($country1, $country2, 'Instance returned was not shared.');
    }

    /**
     * Test load country by service locator
     *
     * @covers            SclContact\Country\CountryManager::__construct
     * @covers            SclContact\Country\CountryManager::loadCountry
     * @expectedException SclContact\Exception\RuntimeException
     *
     * @return void
     */
    public function testLoadCountryByServiceWithBadClass()
    {
        $configPath = __DIR__ . '/../../../config/countries.config.php';
        $className = '\stdClass';

        $this->options
             ->expects($this->once())
             ->method('getCountryFilePath')
             ->will($this->returnValue($configPath));

        $this->options
             ->expects($this->any())
             ->method('getSharedCountries')
             ->will($this->returnValue(true));

        $this->options
             ->expects($this->atLeastOnce())
             ->method('getCountryClass')
             ->will($this->returnValue($className));

        $this->serviceLocator
             ->expects($this->once())
             ->method('has')
             ->with($this->equalTo($className))
             ->will($this->returnValue(true));

        $this->serviceLocator
             ->expects($this->once())
             ->method('get')
             ->with($this->equalTo($className))
             ->will($this->returnValue(new $className));

        $country = $this->manager->loadCountry('gb');
    }

    /**
     * Test load country by service locator with system set to return a shared result.
     *
     * @covers            SclContact\Country\CountryManager::__construct
     * @covers            SclContact\Country\CountryManager::loadCountry
     *
     * @return void
     */
    public function testLoadCountrySharedByService()
    {
        $configPath = __DIR__ . '/../../../config/countries.config.php';
        $className = '\SclContact\Country';

        $this->options
             ->expects($this->atLeastOnce())
             ->method('getCountryFilePath')
             ->will($this->returnValue($configPath));

        $this->options
             ->expects($this->any())
             ->method('getSharedCountries')
             ->will($this->returnValue(true));

        $this->options
             ->expects($this->atLeastOnce())
             ->method('getCountryClass')
             ->will($this->returnValue($className));

        $this->serviceLocator
             ->expects($this->once())
             ->method('has')
             ->with($this->equalTo($className))
             ->will($this->returnValue(true));

        $this->serviceLocator
             ->expects($this->once())
             ->method('get')
             ->with($this->equalTo($className))
             ->will($this->returnValue(new $className));

        $country1 = $this->manager->loadCountry('gb');

        $this->assertEquals('gb', $country1->getCode(), 'Country code was incorrect');

        // Test the second call is shared

        $country2 = $this->manager->loadCountry('gb');

        $this->assertSame($country1, $country2, 'Instance returned was not shared.');
    }

    /**
     * testDefaultCountry
     *
     * @covers SclContact\Country\CountryManager::__construct
     * @covers SclContact\Country\CountryManager::defaultCountry
     *
     * @return void
     */
    public function testDefaultCountry()
    {
        $countryCode = 'gb';

        $this->options
             ->expects($this->once())
             ->method('getDefaultCountry')
             ->will($this->returnValue($countryCode));

        $this->assertEquals(
            $countryCode,
            $this->manager->defaultCountry()
        );
    }
}
