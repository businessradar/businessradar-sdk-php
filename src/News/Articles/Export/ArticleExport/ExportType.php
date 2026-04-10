<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\Export\ArticleExport;

/**
 * * `NEWS` - News
 * * `BINDER` - Binder
 * * `COMPANIES` - Companies
 * * `REGISTRATIONS` - Registrations
 * * `COMPLIANCE` - Compliance
 * * `BILLING` - Billing
 * * `KEY_EVENTS` - Key Events.
 */
enum ExportType: string
{
    case NEWS = 'NEWS';

    case BINDER = 'BINDER';

    case COMPANIES = 'COMPANIES';

    case REGISTRATIONS = 'REGISTRATIONS';

    case COMPLIANCE = 'COMPLIANCE';

    case BILLING = 'BILLING';

    case KEY_EVENTS = 'KEY_EVENTS';
}
