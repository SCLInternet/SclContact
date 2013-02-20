<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContact;

/**
 * Basic class for storing a phone number.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class PhoneNumber implements PhoneNumberInterface
{
    /**
     * @var string
     */
    protected $number;

    /**
     * Initialise the class.
     * 
     * @param string $number
     */
    public function __construct($number = '')
    {
        $this->number = (string) $number;
    }

    /**
     * Returns the phone number value.
     *
     * @return string
     */
    public function get()
    {
        return $this->number;
    }

    /**
     * Sets the value of the phone number.
     *
     * @param string $number
     */
    public function set($number)
    {
        $this->number = (string) $number;
    }

    /**
     * Returns the value of the phone number.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->number;
    }

    /**
     * Reads the contents of a PhoneNumberInterface object into this.
     *
     * @param PhoneNumberInterface $phoneNumber
     */
    public function import(PhoneNumberInterface $phoneNumber)
    {
        $this->number = $phoneNumber->get();
    }
}
