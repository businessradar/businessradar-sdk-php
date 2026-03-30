<?php

declare(strict_types=1);

namespace Businessradar\Companies\CompanyCreateFeedbackParams;

/**
 * * `NOT_ENOUGH_NEWS` - Not Enough News
 * * `COMPANY_NAME_OUTDATED` - Company Name Outdated
 * * `INCORRECT_COMPANY_WEBSITE` - Incorrect Company Website
 * * `MISSING_REGISTRATION_NUMBER` - Missing Registration Number
 * * `MISSING_TRADE_NAME` - Missing Trade Name
 * * `INCORRECT_TRADE_NAME` - Incorrect Trade Name
 * * `NOT_ENOUGH_REVIEWS` - Not Enough Reviews
 * * `OUTDATED_CORPORATE_LINKAGE` - Outdated Corporate Linkage
 * * `INCORRECT_CORPORATE_LINKAGE` - Incorrect Corporate Linkage
 * * `OTHER` - Other.
 */
enum FeedbackType: string
{
    case NOT_ENOUGH_NEWS = 'NOT_ENOUGH_NEWS';

    case COMPANY_NAME_OUTDATED = 'COMPANY_NAME_OUTDATED';

    case INCORRECT_COMPANY_WEBSITE = 'INCORRECT_COMPANY_WEBSITE';

    case MISSING_REGISTRATION_NUMBER = 'MISSING_REGISTRATION_NUMBER';

    case MISSING_TRADE_NAME = 'MISSING_TRADE_NAME';

    case INCORRECT_TRADE_NAME = 'INCORRECT_TRADE_NAME';

    case NOT_ENOUGH_REVIEWS = 'NOT_ENOUGH_REVIEWS';

    case OUTDATED_CORPORATE_LINKAGE = 'OUTDATED_CORPORATE_LINKAGE';

    case INCORRECT_CORPORATE_LINKAGE = 'INCORRECT_CORPORATE_LINKAGE';

    case OTHER = 'OTHER';
}
