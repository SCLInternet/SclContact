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
    protected $name;

    /**
     * The company the contact represents.
     *
     * @var string
     */
    protected $company = '';

    /**
     * The email address of the contact.
     *
     * @var EmailInterface
     */
    protected $email;

    /**
     * The address of the contact.
     *
     * @var AddressInterface
     */
    protected $address;

    /**
     * The phone number of the contact.
     *
     * @var PhoneNumberInterface
     */
    protected $phone;

    /**
     * The fax number of the contact.
     *
     * @todo Smash all fax machines left in the world.
     * @var PhoneNumberInterface
     */
    protected $fax;

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
     * {@inheritDoc}
     *
     * @return PersonNameInterface
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     *
     * @param  PersonNameInterface $name
     * @return self
     */
    public function setName(PersonNameInterface $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * {@inheritDoc}
     *
     * @param  string $company
     * @return self
     */
    public function setCompany($company)
    {
        $this->company = (string) $company;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return EmailInterface
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * {@inheritDoc}
     *
     * @param  EmailInterface $email
     * @return self
     */
    public function setEmail(EmailInterface $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return AddressInterface
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * {@inheritDoc}
     *
     * @param  AddressInterface $address
     * @return self
     */
    public function setAddress(AddressInterface $address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return PhoneNumberInterface
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * {@inheritDoc}
     *
     * @param  PhoneNumberInterface $phone
     * @return self
     */
    public function setPhone(PhoneNumberInterface $phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return PhoneNumberInterface
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * {@inheritDoc}
     *
     * @param  PhoneNumberInterface $fax
     * @return self
     */
    public function setFax(PhoneNumberInterface $fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @param  ContactInterface $contact
     * @return self
     */
    public function import(ContactInterface $contact)
    {
        $this->name->import($contact->getName());
        $this->comapany = $contact->getCompany();
        $this->email->import($contact->getEmail());
        $this->address->import($contact->getAddress());
        $this->phone->import($contact->getPhone());
        $this->fax->import($contact->getFax());

        return $this;
    }
}
