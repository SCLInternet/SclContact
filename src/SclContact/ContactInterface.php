<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContact;

/**
 * The interface for contact details.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
interface ContactInterface
{
    /**
     * Gets the value for name.
     *
     * @return PersonNameInterface
     */
    public function getName();

    /**
     * Sets the value for name.
     *
     * @param  PersonNameInterface $name
     * @return self
     */
    public function setName(PersonNameInterface $name);

    /**
     * Gets the value for company.
     *
     * @return string
     */
    public function getCompany();

    /**
     * Sets the value for company.
     *
     * @param  string $company
     * @return self
     */
    public function setCompany($company);

    /**
     * Gets the value for email.
     *
     * @return EmailInterface
     */
    public function getEmail();

    /**
     * Sets the value for email.
     *
     * @param  EmailInterface $email
     * @return self
     */
    public function setEmail(EmailInterface $email);

    /**
     * Gets the value for address.
     *
     * @return AddressInterface
     */
    public function getAddress();

    /**
     * Sets the value for address.
     *
     * @param  AddressInterface $address
     * @return self
     */
    public function setAddress(AddressInterface $address);

    /**
     * Gets the value for phone.
     *
     * @return PhoneNumberInterface
     */
    public function getPhone();

    /**
     * Sets the value for phone.
     *
     * @param  PhoneNumberInterface $phone
     * @return self
     */
    public function setPhone(PhoneNumberInterface $phone);

    /**
     * Gets the value for fax.
     *
     * @return PhoneNumberInterface
     */
    public function getFax();

    /**
     * Sets the value for fax.
     *
     * @param  PhoneNumberInterface $fax
     * @return self
     */
    public function setFax(PhoneNumberInterface $fax);

    /**
     * Reads the contents of a given contact object into this object.
     *
     * @param  ContactInterface $contact
     * @return self
     */
    public function import(ContactInterface $contact);
}
