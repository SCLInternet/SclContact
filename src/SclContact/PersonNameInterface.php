<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContact;

/**
 * Interface for person name classes.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
interface PersonNameInterface
{
    /**
     * Initialise the object.
     *
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct($firstName = '', $lastName = '');

    /**
     * Returns the persons name.
     * 
     * @return string
     */
    public function __toString();

    /**
     * Gets the value for firstName.
     *
     * @return string
     */
    public function getFirstName();

    /**
     * Sets the value for first name.
     *
     * @param  string $name
     * @return self
     */
    public function setFirstName($name);

    /**
     * Gets the value for lastName.
     *
     * @return string
     */
    public function getLastName();

    /**
     * Sets the value for last name.
     *
     * @param  string $name
     * @return self
     */
    public function setLastName($name);

    /**
     * Reads the contents of a PersonName object into this.
     *
     * @param  PersonNameInterface $name
     * @return self
     */
    public function import(PersonNameInterface $name);
}
