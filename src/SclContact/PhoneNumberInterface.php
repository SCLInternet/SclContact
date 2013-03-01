<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContact;

/**
 * Interface for phone number classes.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
interface PhoneNumberInterface
{
    /**
     * Initialise the class.
     * 
     * @param string $number
     */
    public function __construct($number = '');

    /**
     * Returns the phone number value.
     *
     * @return string
     */
    public function get();

    /**
     * Sets the value of the phone number.
     *
     * @param  string $number
     * @return self
     */
    public function set($number);

    /**
     * Returns the value of the phone number.
     *
     * @return string
     */
    public function __toString();

    /**
     * Reads the contents of a PhoneNumberInterface object into this.
     *
     * @param  PhoneNumberInterface $phoneNumber
     * @return self
     */
    public function import(PhoneNumberInterface $phoneNumber);
}
