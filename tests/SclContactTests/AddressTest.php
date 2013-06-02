<?php

namespace SclContactTests;

use SclContact\Address;
use SclContact\Country;
use SclContact\Postcode;

/**
 * Unit tests for the {@see Address} class.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class AddressTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The instance to be tested.
     *
     * @var Address
     */
    protected $address;

    /**
     * Prepare the object to be tested.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->address = new Address;
    }

    /**
     * Test all the getter and setters.
     *
     * @dataProvider getterSetterProvider
     * @covers SclContact\Address::__construct
     * @covers SclContact\Address::getLine1
     * @covers SclContact\Address::setLine1
     * @covers SclContact\Address::getLine2
     * @covers SclContact\Address::setLine2
     * @covers SclContact\Address::getCity
     * @covers SclContact\Address::setCity
     * @covers SclContact\Address::getCounty
     * @covers SclContact\Address::setCounty
     * @covers SclContact\Address::getPostcode
     * @covers SclContact\Address::setPostcode
     * @covers SclContact\Address::getCountry
     * @covers SclContact\Address::setCountry
     *
     * @param  string $parameter The parameter to be tested
     * @param  mixed  $value     The value to use to test
     * @return void
     */
    public function testGetSet($parameter, $value)
    {
        $getter = 'get' . $parameter;
        $setter = 'set' . $parameter;

        $this->address->$setter($value);

        $this->assertEquals(
            $value,
            $this->address->$getter(),
            'Failed to test getters and setter for ' . $parameter
        );
    }

    /**
     * Provides values to test the getters & setters
     *
     * @return array
     */
    public function getterSetterProvider()
    {
        return array(
            array('line1', 'The House'),
            array('line2', 'The Street'),
            array('city', 'Town'),
            array('county', 'County'),
            array('postcode', new Postcode('SA12 2FC')),
            array('country', new Country('gb')),
        );
    }

    /**
     * Test the import function.
     *
     * @covers SclContact\Address::import
     *
     * @return void
     */
    public function testImport()
    {
        $line1    = 'My House';
        $line2    = 'My Street';
        $city     = 'Town';
        $county   = 'County';
        $postcode = new Postcode('SA12 3BC');
        $country  = new Country('gb');

        $source = new Address();

        $source->setLine1($line1)
               ->setLine2($line2)
               ->setCity($city)
               ->setCounty($county)
               ->setPostcode($postcode)
               ->setCountry($country);

        $this->address->import($source);

        $this->assertEquals($source->getLine1(), $this->address->getLine1(), 'Lin1 didn\'t match.');
        $this->assertEquals($source->getLine2(), $this->address->getLine2(), 'Line2 didn\'t match.');
        $this->assertEquals($source->getCity(), $this->address->getCity(), 'City didn\'t match.');
        $this->assertEquals($source->getCounty(), $this->address->getCounty(), 'County didn\'t match.');
        $this->assertEquals($source->getPostcode(), $this->address->getPostcode(), 'Postcode didn\'t match.');
        $this->assertEquals($source->getCountry(), $this->address->getCountry(), 'Country didn\'t match.');
    }
}
