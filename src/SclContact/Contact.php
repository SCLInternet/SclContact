<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContact;

/**
 * Basic class for storing a collection of contact details.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class Contact implements ContactInterface
{
    /**
     * The contacts name.
     *
     * @var PersonNameInterface
     */
    private $name;

    /**
     * The company the contact represents.
     *
     * @var string
     */
    private $company;

    /**
     * The email address of the contact.
     *
     * @var EmailInterface
     */
    private $email;

    /**
     * The address of the contact.
     *
     * @var AddressInterface
     */
    private $address;

    /**
     * The phone number of the contact.
     *
     * @var PhoneNumberInterface
     */
    private $phone;

    /**
     * The fax number of the contact.
     *
     * @todo Smash all fax machines left in the world.
     * @var PhoneNumberInterface
     */
    private $fax;

    /**
     * Initialise member variables.
     */
    public function __construct()
    {
        $this->name = new PersonName();
        $this->email = new Email();
        $this->address = new Address();
        $this->phone = new PhoneNumber();
        $this->fax = new PhoneNumber();
    }

    /**
     * Gets the value for name.
     *
     * @return PersonNameInterface
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the value for name.
     *
     * @param PersonNameInterface $name
     */
    public function setName(PersonNameInterface $name)
    {
        $this->name = $name;
    }

    /**
     * Gets the value for company.
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Sets the value for company.
     *
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->company = (string) $company;
    }

    /**
     * Gets the value for email.
     *
     * @return EmailInterface
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value for email.
     *
     * @param EmailInterface $email
     */
    public function setEmail(EmailInterface $email)
    {
        $this->email = $email;
    }

    /**
     * Gets the value for address.
     *
     * @return AddressInterface
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Sets the value for address.
     *
     * @param AddressInterface $address
     */
    public function setAddress(AddressInterface $address)
    {
        $this->address = $address;
    }

    /**
     * Gets the value for phone.
     *
     * @return PhoneNumberInterface
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Sets the value for phone.
     *
     * @param PhoneNumberInterface $phone
     */
    public function setPhone(PhoneNumberInterface $phone)
    {
        $this->phone = $phone;
    }

    /**
     * Gets the value for fax.
     *
     * @return PhoneNumberInterface
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Sets the value for fax.
     *
     * @param PhoneNumberInterface $fax
     */
    public function setFax(PhoneNumberInterface $fax)
    {
        $this->fax = $fax;
    }

    /**
     * Reads the contents of a given contact object into this object.
     *
     * @param ContactInterface $contact
     */
    public function import(ContactInterface $contact)
    {
        $this->name->import($contact->getName());
        $this->comapany = $contact->getCompany();
        $this->email->import($contact->getEmail());
        $this->address->import($contact->getAddress());
        $this->phone->import($contact->getPhone());
        $this->fax->import($contact->getFax());
    }
}
