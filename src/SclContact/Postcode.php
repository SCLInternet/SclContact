<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContact;

/**
 * Basic class for storing a postal code.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class Postcode implements PostcodeInterface
{
    /**
     * The postcode string.
     *
     * @var string
     */
    protected $postcode;

    /**
     * {@inheritDoc}
     * 
     * @param string $postcode
     */
    public function __construct($postcode = '')
    {
        $this->postcode = (string) $postcode;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function get()
    {
        return $this->postcode;
    }

    /**
     * {@inheritDoc}
     *
     * @param string $postcode
     * @return self
     */
    public function set($postcode)
    {
        $this->postcode = (string) $postcode;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function __toString()
    {
        return $this->postcode;
    }

    /**
     * {@inheritDoc}
     *
     * @param PostcodeInterface $postcode
     * @return self
     */
    public function import(PostcodeInterface $postcode)
    {
        $this->postcode = $postcode->get();

        return $this;
    }
}
