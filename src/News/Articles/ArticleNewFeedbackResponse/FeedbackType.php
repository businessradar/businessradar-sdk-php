<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\ArticleNewFeedbackResponse;

/**
 * * `false_positive` - False Positive
 * * `no_risk` - No Risk
 * * `risk_confirmed` - Risk Confirmed.
 */
enum FeedbackType: string
{
    case FALSE_POSITIVE = 'false_positive';

    case NO_RISK = 'no_risk';

    case RISK_CONFIRMED = 'risk_confirmed';
}
