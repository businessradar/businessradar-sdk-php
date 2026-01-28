<?php

declare(strict_types=1);

namespace Businessradar\Companies\Registration;

/**
 * * `queued_search` - Queued for search
 * * `searching` - Searching for company in registry
 * * `queued_registration` - Queued for registration
 * * `registering` - Registering company
 * * `queued_website_search` - Queued for website search
 * * `searching_website` - Searching for company website
 * * `searching_activity_description` - Generating company activity description
 * * `searching_website_icon` - Searching for company website icon
 * * `searching_directors` - Searching for directors online
 * * `social_search` - Searching for social media websites
 * * `generating_company_description` - Generating company description
 * * `determine_trade_names` - Determining trade names
 * * `searching_news` - Searching for news articles
 * * `processing_news` - Processing news articles
 * * `registered` - Registered
 * * `invalid_input` - Invalid input, please check your input
 * * `permission_denied` - Permission denied, please contact support
 * * `company_not_found` - Company has not been found in Dun and Bradstreet registry
 * * `expired` - Registration has been pending for too long, expired.
 * * `cancelled` - Registration has been cancelled.
 * * `failed` - Registration has failed, please check the error message.
 */
enum Status: string
{
    case QUEUED_SEARCH = 'queued_search';

    case SEARCHING = 'searching';

    case QUEUED_REGISTRATION = 'queued_registration';

    case REGISTERING = 'registering';

    case QUEUED_WEBSITE_SEARCH = 'queued_website_search';

    case SEARCHING_WEBSITE = 'searching_website';

    case SEARCHING_ACTIVITY_DESCRIPTION = 'searching_activity_description';

    case SEARCHING_WEBSITE_ICON = 'searching_website_icon';

    case SEARCHING_DIRECTORS = 'searching_directors';

    case SOCIAL_SEARCH = 'social_search';

    case GENERATING_COMPANY_DESCRIPTION = 'generating_company_description';

    case DETERMINE_TRADE_NAMES = 'determine_trade_names';

    case SEARCHING_NEWS = 'searching_news';

    case PROCESSING_NEWS = 'processing_news';

    case REGISTERED = 'registered';

    case INVALID_INPUT = 'invalid_input';

    case PERMISSION_DENIED = 'permission_denied';

    case COMPANY_NOT_FOUND = 'company_not_found';

    case EXPIRED = 'expired';

    case CANCELLED = 'cancelled';

    case FAILED = 'failed';
}
