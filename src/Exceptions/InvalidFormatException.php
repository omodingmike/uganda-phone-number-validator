<?php

    namespace OmodingMike\PhoneNumberValidator\Exceptions;

    class InvalidFormatException extends \Exception
    {
        public function __construct(public string $format)
        {
            parent::__construct( "Invalid format: {$format}" );
        }
    }