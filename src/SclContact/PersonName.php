<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContact;

/**
 * Basic class for storing a persons name.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class PersonName implements PersonNameInterface
{
    /**
     * The persons first names
     *
     * @var string
     */
    protected $firstName;

    /**
     * The persons last name
     *
     * @var string
     */
    protected $lastName;

    /**
     * {@inheritDoc}
     *
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct($firstName = '', $lastName = '')
    {
        $this->firstName = (string) $firstName;
        $this->lastName = (string) $lastName;
    }

    /**
     * {@inheritDoc}
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * {@inheritDoc}
     *
     * @param  string $name
     * @return self
     */
    public function setFirstName($name)
    {
        $this->firstName = (string) $name;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * {@inheritDoc}
     *
     * @param  string $name
     * @return self
     */
    public function setLastName($name)
    {
        $this->lastName = (string) $name;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @param  PersonNameInterface $name
     * @return self
     */
    public function import(PersonNameInterface $name)
    {
        $this->firstName = $name->getFirstName();
        $this->lastName = $name->getLastName();

        return $this;
    }
}
