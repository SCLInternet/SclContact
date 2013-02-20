<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContact;

/**
 * Basic class for storing a persons name.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class PersonName implements PersonNameInterface
{
    /**
     * The persons first names
     *
     * @var string
     */
    protected $firstName;

    /**
     * The persons last name
     *
     * @var string
     */
    protected $lastName;

    /**
     * Initialise the object.
     *
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct($firstName = '', $lastName = '')
    {
        $this->firstName = (string) $firstName;
        $this->lastName = (string) $lastName;
    }

    /**
     * Returns the persons name.
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * Gets the value for firstName.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Sets the value for first name.
     *
     * @param string $name
     */
    public function setFirstName($name)
    {
        $this->firstName = (string) $name;
    }

    /**
     * Gets the value for lastName.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Sets the value for last name.
     *
     * @param string $name
     */
    public function setLastName($name)
    {
        $this->lastName = (string) $name;
    }

    /**
     * Reads the contents of a PersonName object into this.
     *
     * @param PersonNameInterface $name
     */
    public function import(PersonNameInterface $name)
    {
        $this->firstName = $name->getFirstName();
        $this->lastName = $name->getLastName();
    }
}
