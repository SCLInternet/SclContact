<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContact;

/**
 * Basic class for storing an email address.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class Email implements EmailInterface
{
    /**
     * @var string
     */
    private $address;

    /**
     * Initialise the class.
     * 
     * @param string $address
     */
    public function __construct($address = '')
    {
        $this->address = (string) $address;
    }

    /**
     * Returns the email address value.
     *
     * @return string
     */
    public function get()
    {
        return $this->address;
    }

    /**
     * Sets the value of the email address.
     *
     * @param string $address
     */
    public function set($address)
    {
        $this->$address = (string) $address;
    }

    /**
     * Returns the value of the email address.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->address;
    }

    /**
     * Reads the contents of a EmailAddressInterface object into this.
     *
     * @param EmailAddressInterface $phoneNumber
     */
    public function import(EmailAddressInterface $email)
    {
        $this->address = $email->get();
    }
}
