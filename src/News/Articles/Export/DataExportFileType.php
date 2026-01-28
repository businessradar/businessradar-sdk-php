<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\Export;

/**
 * * `PDF` - PDF
 * * `EXCEL` - Excel
 * * `JSONL` - JSONL.
 */
enum DataExportFileType: string
{
    case PDF = 'PDF';

    case EXCEL = 'EXCEL';

    case JSONL = 'JSONL';
}
