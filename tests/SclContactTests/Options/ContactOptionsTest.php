<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContactTests\Options;

use SclContact\Options\ContactOptions;

/**
 * Unit tests for {@see ContactOptions}.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class ContactOptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * options
     *
     * @var ContactOptions
     */
    protected $options;

    /**
     * Setup the instance to be tested.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->options = new ContactOptions();
    }

    /**
     * Test that ContactOptions implements the required classes.
     *
     * @return void
     */
    public function testType()
    {
        $this->assertInstanceOf(
            'Zend\Stdlib\AbstractOptions',
            $this->options,
            'Does not extend AbstractOptions'
        );

        $this->assertInstanceOf(
            'SclContact\Options\ContactOptionsInterface',
            $this->options,
            'Does not implement ContactOptionsInterface'
        );
    }

    /**
     * The the getters and setters.
     *
     * @dataProvider getterSetterProvider
     * @covers       SclContact\Options\ContactOptions::getCountryManager
     * @covers       SclContact\Options\ContactOptions::setCountryManager
     * @covers       SclContact\Options\ContactOptions::getCountryClass
     * @covers       SclContact\Options\ContactOptions::setCountryClass
     * @covers       SclContact\Options\ContactOptions::getSharedCountries
     * @covers       SclContact\Options\ContactOptions::setSharedCountries
     * @covers       SclContact\Options\ContactOptions::getDefaultCountry
     * @covers       SclContact\Options\ContactOptions::setDefaultCountry
     * @covers       SclContact\Options\ContactOptions::getCountryFilePath
     * @covers       SclContact\Options\ContactOptions::setCountryFilePath
     *
     * @param  string $property
     * @param  mixed $value
     * @return void
     */
    public function testGetSet($property, $value)
    {
        $getter = 'get' . ucfirst($property);
        $setter = 'set' . ucfirst($property);

        $result = $this->options->$setter($value);

        $this->assertSame($this->options, $result, "$setter() did not return \$this.");

        $result = $this->options->$getter();

        $this->assertEquals($value, $result, "$getter() returned incorrect value.");
    }

    /**
     * Provides test data for testGetSet.
     *
     * @return array
     */
    public function getterSetterProvider()
    {
        return array(
            array('countryManager', 'SclContact\Country\CountryManager'),
            array('countryClass', 'SclContact\Country'),
            array('sharedCountries', true),
            array('sharedCountries', false),
            array('defaultCountry', 'gb'),
            array('countryFilePath', 'path/to/country/file'),
        );
    }
}
