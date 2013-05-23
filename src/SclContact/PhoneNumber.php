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
     * The phone number string.
     *
     * @var string
     */
    protected $number = '';

    /**
     * {@inheritDoc}
     *
     * @param string $number
     */
    public function __construct($number = '')
    {
        $this->number = (string) $number;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function get()
    {
        return $this->number;
    }

    /**
     * {@inheritDoc}
     *
     * @param  string $number
     * @return self
     */
    public function set($number)
    {
        $this->number = (string) $number;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function __toString()
    {
        return $this->number;
    }

    /**
     * {@inheritDoc}
     *
     * @param  PhoneNumberInterface $phoneNumber
     * @return self
     */
    public function import(PhoneNumberInterface $phoneNumber)
    {
        $this->number = $phoneNumber->get();

        return $this;
    }
}
