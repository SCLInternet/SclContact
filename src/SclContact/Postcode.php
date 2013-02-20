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
     * @var string
     */
    protected $postcode;

    /**
     * Initialise the class.
     * 
     * @param string $postcode
     */
    public function __construct($postcode = '')
    {
        $this->postcode = (string) $postcode;
    }

    /**
     * Returns the postcode value.
     *
     * @return string
     */
    public function get()
    {
        return $this->postcode;
    }

    /**
     * Sets the value of the postcode.
     *
     * @param unknown_type $postcode
     */
    public function set($postcode)
    {
        $this->postcode = (string) $postcode;
    }

    /**
     * Returns the value of the postcode.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->postcode;
    }

    /**
     * Reads the contents of a PostCodeInterface object into this.
     *
     * @param PostcodeInterface $postcode
     */
    public function import(PostcodeInterface $postcode)
    {
        $this->postcode = $postcode->get();
    }
}
