<?php

    namespace OmodingMike\PhoneNumberValidator\Exceptions;

    class InvalidPhoneNumberException extends \Exception
    {
        public function __construct(public string $phoneNumber)
        {
            parent::__construct( "Invalid phone number: {$phoneNumber}" );
        }
    }