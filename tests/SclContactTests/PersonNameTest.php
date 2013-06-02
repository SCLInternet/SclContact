<?php

namespace SclContactTests;

use SclContact\PersonName;

/**
 * Unit tests for the {@see Contact} class.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class ContactTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The instance to be tested.
     *
     * @var PersonName
     */
    protected $name;

    /**
     * Prepare the object to be tested.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->name = new PersonName;
    }

    /**
     * Test all the getter and setters.
     *
     * @dataProvider getterSetterProvider
     * @covers SclContact\PersonName::getFirstName
     * @covers SclContact\PersonName::setFirstName
     * @covers SclContact\PersonName::getLastName
     * @covers SclContact\PersonName::setLastName
     *
     * @param  string $parameter The parameter to be tested
     * @param  mixed  $value     The value to use to test
     * @return void
     */
    public function testGetSet($parameter, $value)
    {
        $getter = 'get' . $parameter;
        $setter = 'set' . $parameter;

        $this->name->$setter($value);

        $this->assertEquals(
            $value,
            $this->name->$getter(),
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
            array('firstName', 'Tom'),
            array('lastName', 'Oram'),
        );
    }

    /**
     * Test the object is initialised properly.
     *
     * @depends testGetSet
     * @covers SclContact\PersonName::__construct
     *
     * @return void
     */
    public function testConstructor()
    {
        $name = new PersonName('Joe', 'Bloggs');

        $this->assertEquals('Joe', $name->getFirstName(), 'First name is wrong.');
        $this->assertEquals('Bloggs', $name->getLastName(), 'Last name is wrong.');
    }

    /**
     * testToString
     *
     * @depends testConstructor
     * @covers SclContact\PersonName::__toString
     *
     * @return void
     */
    public function testToString()
    {
        $name = new PersonName('John', 'Doe');

        $this->assertEquals('John Doe', (string) $name);
    }

    /**
     * Test the import function.
     *
     * @covers SclContact\PersonName::import
     *
     * @return void
     */
    public function testImport()
    {
        $source = new PersonName('Tom', 'Oram');

        $this->name->import($source);

        $this->assertEquals(
            'Tom',
            $this->name->getFirstName(),
            'First Name didn\'t match.'
        );
        $this->assertEquals(
            'Oram',
            $this->name->getLastName(),
            'Last Name didn\'t match.'
        );
    }
}
