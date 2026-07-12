<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\Export\ArticleExport;

/**
 * * `NEWS` - News
 * * `BINDER` - Binder
 * * `COMPANIES` - Companies
 * * `REGISTRATIONS` - Registrations
 * * `COMPLIANCE` - Compliance
 * * `COMPLIANCE_CHANGELOG` - Compliance changelog
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

    case COMPLIANCE_CHANGELOG = 'COMPLIANCE_CHANGELOG';

    case BILLING = 'BILLING';

    case KEY_EVENTS = 'KEY_EVENTS';
}
