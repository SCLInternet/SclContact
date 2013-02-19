<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContact;

/**
 * Interface for email address classes.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
interface EmailInterface
{
    /**
     * Initialise the class.
     * 
     * @param string $address
     */
    public function __construct($address = '');

    /**
     * Returns the email address value.
     *
     * @return string
     */
    public function get();

    /**
     * Sets the value of the email address.
     *
     * @param string $address
     */
    public function set($address);

    /**
     * Returns the value of the email address.
     *
     * @return string
     */
    public function __toString();

    /**
     * Reads the contents of a EmailAddressInterface object into this.
     *
     * @param EmailAddressInterface $phoneNumber
     */
    public function import(EmailAddressInterface $email);
}
