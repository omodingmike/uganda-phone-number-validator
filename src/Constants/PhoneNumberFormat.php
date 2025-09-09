<?php

    namespace OmodingMike\PhoneNumberValidator\Constants;

    enum PhoneNumberFormat : string
    {
        case E164          = 'E164';          // +256701234567
        case INTERNATIONAL = 'INTERNATIONAL'; // +256 701 234 567
        case NATIONAL      = 'NATIONAL';      // 0701 234 567
        case LOCAL         = 'LOCAL';         // 0701234567
        case PARENS_DASH   = 'PARENS_DASH';   // (070) 123-4567
        case INTL_DASHED   = 'INTL_DASHED';   // +256 701-123-4567
    }
