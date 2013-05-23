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
     * The email address
     *
     * @var string
     */
    protected $address = '';

    /**
     * {@inheritDoc}
     *
     * @param string $address
     */
    public function __construct($address = '')
    {
        $this->address = (string) $address;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function get()
    {
        return $this->address;
    }

    /**
     * {@inheritDoc}
     *
     * @param  string $address
     * @return self
     */
    public function set($address)
    {
        $this->address = (string) $address;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function __toString()
    {
        return $this->address;
    }

    /**
     * {@inheritDoc}
     *
     * @param  EmailInterface $email
     * @return self
     */
    public function import(EmailInterface $email)
    {
        $this->address = $email->get();

        return $this;
    }
}
