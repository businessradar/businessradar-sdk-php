<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceGetResponse\Entity\Result;

/**
 * * `sanction` - Sanction
 * * `pep` - Politically Exposed Person
 * * `adverse_media` - Adverse media
 * * `enforcement` - Enforcement
 * * `govt_owned` - Government owned.
 */
enum ResultType: string
{
    case SANCTION = 'sanction';

    case PEP = 'pep';

    case ADVERSE_MEDIA = 'adverse_media';

    case ENFORCEMENT = 'enforcement';

    case GOVT_OWNED = 'govt_owned';
}
