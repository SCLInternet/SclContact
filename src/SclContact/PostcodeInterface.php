<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContact;

/**
 * Interface for storing a postal code.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
interface PostcodeInterface
{
    /**
     * Initialise the class.
     *
     * @param string $postcode
     */
    public function __construct($postcode = '');

    /**
     * Returns the postcode value.
     *
     * @return string
     */
    public function get();

    /**
     * Sets the value of the postcode.
     *
     * @param unknown_type $postcode
     */
    public function set($postcode);

    /**
     * Returns the value of the postcode.
     *
     * @return string
     */
    public function __toString();

    /**
     * Reads the contents of a PostCodeInterface object into this.
     *
     * @param PostcodeInterface $postcode
     */
    public function import(PostcodeInterface $postcode);
}
