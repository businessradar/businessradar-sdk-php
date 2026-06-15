<?php

declare(strict_types=1);

namespace Businessradar\Webhooks;

/**
 * * `pending` - Pending
 * * `in_progress` - In Progress
 * * `completed` - Completed
 * * `failed` - Failed.
 */
enum WebhookDeliveryStatusEnum: string
{
    case PENDING = 'pending';

    case IN_PROGRESS = 'in_progress';

    case COMPLETED = 'completed';

    case FAILED = 'failed';
}
