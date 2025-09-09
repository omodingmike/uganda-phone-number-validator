<?php

    namespace OmodingMike\PhoneNumberValidator;

    use OmodingMike\PhoneNumberValidator\Constants\PhoneNumberFormat;
    use OmodingMike\PhoneNumberValidator\Exceptions\InvalidPhoneNumberException;

    class PhoneNumberValidatorClass
    {
        public static function isValid(string $phoneNumber) : bool
        {
            $pattern = '/^(07[012456789]\d{7}|2567[012456789]\d{7}|\+2567[012456789]\d{7})$/';
            return (bool) preg_match( $pattern , $phoneNumber );
        }


        /**
         * @throws InvalidPhoneNumberException
         */
        public static function format(string $phoneNumber , PhoneNumberFormat $format = PhoneNumberFormat::LOCAL) : ?string
        {
            if ( ! self::isValid( $phoneNumber ) ) {
                throw new InvalidPhoneNumberException( $phoneNumber );
            }

            // Normalize the number to +2567XXXXXXXX
            if ( str_starts_with( $phoneNumber , '0' ) ) {
                $normalized = '+256' . substr( $phoneNumber , 1 ); // 0702345672 -> +256702345672
            }
            elseif ( str_starts_with( $phoneNumber , '+256' ) ) {
                $normalized = $phoneNumber;
            }
            elseif ( str_starts_with( $phoneNumber , '256' ) ) {
                $normalized = '+' . $phoneNumber;
            }
            else {
                // fallback: keep unchanged (should not happen if isValid is correct)
                $normalized = $phoneNumber;
            }

            // Extract local part (7XXXXXXXX)
            $localPart = substr( $normalized , 4 );

            $area   = substr( $localPart , 0 , 3 ); // 702
            $prefix = substr( $localPart , 3 , 3 ); // 345
            $line   = substr( $localPart , 6 );     // 672

            return match ( $format ) {
                PhoneNumberFormat::E164          => $normalized ,
                PhoneNumberFormat::INTERNATIONAL => '+256 ' . $area . ' ' . $prefix . ' ' . $line ,
                PhoneNumberFormat::NATIONAL      => '0' . $area . ' ' . $prefix . ' ' . $line ,
                PhoneNumberFormat::LOCAL         => '0' . $localPart ,
                PhoneNumberFormat::PARENS_DASH   => '(' . $area . ') ' . $prefix . '-' . $line ,
                PhoneNumberFormat::INTL_DASHED   => '+256 ' . $area . '-' . $prefix . '-' . $line ,
            };
        }


    }
