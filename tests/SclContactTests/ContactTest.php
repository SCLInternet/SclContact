<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SclContactTests;

use SclContact\Address;
use SclContact\Contact;
use SclContact\Country;
use SclContact\Email;
use SclContact\PersonName;
use SclContact\PhoneNumber;

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
     * @var Contact
     */
    protected $contact;

    /**
     * Prepare the object to be tested.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->contact = new Contact;
    }

    /**
     * Test the object is initialised properly.
     *
     * @covers SclContact\Contact::__construct
     *
     * @return void
     */
    public function testConstructor()
    {
        $this->assertInstanceOf('SclContact\PersonNameInterface', $this->contact->getName());
        $this->assertInstanceOf('SclContact\EmailInterface', $this->contact->getEmail());
        $this->assertInstanceOf('SclContact\AddressInterface', $this->contact->getAddress());
        $this->assertInstanceOf('SclContact\PhoneNumberInterface', $this->contact->getPhone());
        $this->assertInstanceOf('SclContact\PhoneNumberInterface', $this->contact->getFax());
    }

    /**
     * Test all the getter and setters.
     *
     * @dataProvider getterSetterProvider
     * @covers SclContact\Contact::getName
     * @covers SclContact\Contact::setName
     * @covers SclContact\Contact::getCompany
     * @covers SclContact\Contact::setCompany
     * @covers SclContact\Contact::getEmail
     * @covers SclContact\Contact::setEmail
     * @covers SclContact\Contact::getAddress
     * @covers SclContact\Contact::setAddress
     * @covers SclContact\Contact::getPhone
     * @covers SclContact\Contact::setPhone
     * @covers SclContact\Contact::getFax
     * @covers SclContact\Contact::setFax
     *
     * @param  string $parameter The parameter to be tested
     * @param  mixed  $value     The value to use to test
     * @return void
     */
    public function testGetSet($parameter, $value)
    {
        $getter = 'get' . $parameter;
        $setter = 'set' . $parameter;

        $this->contact->$setter($value);

        $this->assertEquals(
            $value,
            $this->contact->$getter(),
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
        $address = new Address;
        $address->setLine1('Something Unique');

        return array(
            array('name', new PersonName('Tom', 'Oram')),
            array('company', 'SCL'),
            array('email', new Email('tom@scl.co.uk')),
            array('address', $address),
            array('phone', new PhoneNumber('01234567890')),
            array('fax', new PhoneNumber('09876543210')),
        );
    }

    /**
     * Test the import function.
     *
     * @covers SclContact\Contact::import
     *
     * @return void
     */
    public function testImport()
    {
        $firstName = 'Tom';
        $lastName = 'Oram';
        $company = 'SCL';
        $email = 'tom@scl.co.uk';
        $address = new Address();
        $phone = '0123456789';
        $fax = '0987654321';

        $address->setLine1('Blah')
                ->setCountry(new Country('gb'));

        $source = new Contact();

        $source->setName(new PersonName($firstName, $lastName))
               ->setCompany($company)
               ->setEmail(new Email($email))
               ->setAddress($address)
               ->setPhone(new PhoneNumber($phone))
               ->setFax(new PhoneNumber($fax));

        $this->contact->import($source);

        $this->assertEquals(
            $firstName,
            $this->contact->getName()->getFirstName(),
            'First Name didn\'t match.'
        );
        $this->assertEquals(
            $lastName,
            $this->contact->getName()->getLastName(),
            'Last Name didn\'t match.'
        );
        $this->assertEquals(
            $company,
            $this->contact->getCompany(),
            'Company didn\'t match.'
        );
        $this->assertEquals(
            $email,
            $this->contact->getEmail(),
            'Email didn\'t match.'
        );
        $this->assertEquals(
            $address->getLine1(),
            $this->contact->getAddress()->getLine1(),
            'Address didn\'t match.'
        );
        $this->assertEquals(
            $phone,
            $this->contact->getPhone()->get(),
            'Phone didn\'t match.'
        );
        $this->assertEquals(
            $fax,
            $this->contact->getFax()->get(),
            'Fax didn\'t match.'
        );
    }
}
