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
     * Gets the value for firstName.
     *
     * @return string
     */
    public function getFirstName();

    /**
     * Sets the value for first name.
     *
     * @param string $name
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
     * @param string $name
     */
    public function setLastName($name);

    /**
     * Reads the contents of a PersonName object into this.
     *
     * @param PersonNameInterface $name
     */
    public function import(PersonNameInterface $name);
}
