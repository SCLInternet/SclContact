SclContact
==========

[![Build Status](https://travis-ci.org/SCLInternet/SclContact.png?branch=master)](https://travis-ci.org/SCLInternet/SclZfContact)
[![Coverage Status](https://coveralls.io/repos/SCLInternet/SclContact/badge.png)](https://coveralls.io/r/SCLInternet/SclContact)

This module's main purpose is to provide a set of common interfaces for a
persons contact details. It includes interfaces for

* Contact Objects : `SclContact\ContactInterface` (aggregates all other interfaces)
* A persons name : `SclContact\PersonNameInterface`
* Phone numbers : `SclContact\PhoneNumberInterface`
* Email address : `SclContact\EmailInterface`
* Postal address : `SclContact\AddressInterface`
* Postcode : `SclContact\PostcodeInterface`
* Country : `SclContact\CountryInterface`

This module also contains a basic implementation of each interface which can
be used or extend.

Limitations
-----------

The names of the address properties are based on addresses in the United Kingdom.
It will work fine for other countries but it has methods like `getCounty()`
where people from the USA might expect `getState()`.

The contact interface provides for 1 phone number and 1 fax number. A more
flexible approach might be to have a flexible number of phone numbers with
a type (mobile, fax, home, work, etc).

There are no social network fields, it might make sense to add these in the 
no so distant future.

Installation
============

Installation is easy via composer, simple run:

`php composer.phar require sclinternet/scl-contact:dev-master`

Then add `SclContact` to your ZF2 application's modules config.

Fieldsets
=========

2 fieldsets are provided, these are:

* `SclContact\Form\Fieldset\Contact`
* `SclContact\Form\Fieldset\Address`

To use these it is recommended that you use Zend Framework 2.2's
`FormElementManager` to build your forms.

Hydrators
=========

There are also 2 Hydrators

* `SclContact\Hydrator\ContactHydrator`
* `SclContact\Hydrator\AddressHydrator`

Again to use these it is recommended that you used Zend Framework 2.2's
`HydratorManager`.

InputFilters
============

Not yet implementated. Will be done by 0.1 release.

CountryManager
==============

Country objects are assigned to Address objects via a CountryMananger. There
is a default `SclContact\Country\CountryManager` provided which simply returns
country objects with with the provided 2 digit country code. However you can
implement your own country manager froom `SclContact\Country\CountryManagerInterface`
if you wish to do things like connect up address records with a country table
in your database.

Once you have created your own implementation of
`SclContact\Country\CountryManagerInterface` simply specify it in your config
like so to use it:

```php
return array(
    'scl_contact' => array(
        'country_manager' => 'MyApplication\MyCountryManager',
    ),
);
```

Contributing & Using
====================

Feel free to fork or make feature requests.
