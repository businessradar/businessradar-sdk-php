<?php

declare(strict_types=1);

namespace Businessradar\Webhooks\WebhookSubscription;

/**
 * * `compliance_check.status_changed` - Compliance Check Status Changed
 * * `compliance_check.status_completed` - Compliance Check Status Completed
 * * `company_registration.status_changed` - Company Registration Status Changed
 * * `company_registration.status_registered` - Company Registration Status Registered.
 */
enum EventType: string
{
    case COMPLIANCE_CHECK_STATUS_CHANGED = 'compliance_check.status_changed';

    case COMPLIANCE_CHECK_STATUS_COMPLETED = 'compliance_check.status_completed';

    case COMPANY_REGISTRATION_STATUS_CHANGED = 'company_registration.status_changed';

    case COMPANY_REGISTRATION_STATUS_REGISTERED = 'company_registration.status_registered';
}
