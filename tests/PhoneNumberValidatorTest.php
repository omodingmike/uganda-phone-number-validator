<?php

    use OmodingMike\PhoneNumberValidator\Constants\PhoneNumberFormat;
    use OmodingMike\PhoneNumberValidator\Exceptions\InvalidPhoneNumberException;
    use OmodingMike\PhoneNumberValidator\PhoneNumberValidator;

    it( 'validates correct phone numbers' , function () {
        $validNumbers = [
            '0701234567' ,
            '0712345678' ,
            '0723456789' ,
            '256701234567' ,
            '+256701234567' ,
            '+256712345678'
        ];

        foreach ( $validNumbers as $number ) {
            expect( PhoneNumberValidator::isValid( $number ) )->toBeTrue();
        }
    } );

    it( 'invalidates incorrect phone numbers' , function () {
        $invalidNumbers = [
            '0801234567' , // invalid second digit
            '1234567890' ,
            '256801234567' ,
            '+256901234567' ,
            '070123456' ,    // too short
            '07012345678' ,  // too long
            '070 123 4567' , // spaces
        ];

        foreach ( $invalidNumbers as $number ) {
            expect( PhoneNumberValidator::isValid( $number ) )->toBeFalse();
        }
    } );

    it( 'formats local numbers correctly' , function () {
        $number = '0701234567';

        expect( PhoneNumberValidator::format( $number , PhoneNumberFormat::E164 ) )
            ->toBe( '+256701234567' )
            ->and( PhoneNumberValidator::format( $number , PhoneNumberFormat::INTERNATIONAL ) )->toBe( '+256 701 234 567' )
            ->and( PhoneNumberValidator::format( $number , PhoneNumberFormat::NATIONAL ) )->toBe( '0701 234 567' )
            ->and( PhoneNumberValidator::format( $number , PhoneNumberFormat::LOCAL ) )->toBe( '0701234567' )
            ->and( PhoneNumberValidator::format( $number , PhoneNumberFormat::PARENS_DASH ) )->toBe( '(701) 234-567' )
            ->and( PhoneNumberValidator::format( $number , PhoneNumberFormat::INTL_DASHED ) )->toBe( '+256 701-234-567' );
    } );

    it( 'formats numbers starting with 256 correctly' , function () {
        $number = '256701234567';

        expect( PhoneNumberValidator::format( $number , PhoneNumberFormat::E164 ) )
            ->toBe( '+256701234567' )
            ->and( PhoneNumberValidator::format( $number , PhoneNumberFormat::LOCAL ) )->toBe( '0701234567' );
    } );

    it( 'formats numbers starting with +256 correctly' , function () {
        $number = '+256701234567';

        expect( PhoneNumberValidator::format( $number , PhoneNumberFormat::NATIONAL ) )
            ->toBe( '0701 234 567' )
            ->and( PhoneNumberValidator::format( $number , PhoneNumberFormat::PARENS_DASH ) )->toBe( '(701) 234-567' );
    } );

    it( 'throws exception for invalid numbers' , function () {
        $invalidNumber = '0801234567';

        $this->expectException( InvalidPhoneNumberException::class );
        PhoneNumberValidator::format( $invalidNumber , PhoneNumberFormat::LOCAL );
    } );