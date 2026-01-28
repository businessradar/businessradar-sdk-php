<?php

declare(strict_types=1);

namespace Businessradar\Services;

use Businessradar\Client;
use Businessradar\ServiceContracts\NewsContract;
use Businessradar\Services\News\ArticlesService;

final class NewsService implements NewsContract
{
    /**
     * @api
     */
    public NewsRawService $raw;

    /**
     * @api
     */
    public ArticlesService $articles;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new NewsRawService($client);
        $this->articles = new ArticlesService($client);
    }
}
