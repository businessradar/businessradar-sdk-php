<?php

namespace Tests\Services\News\Articles;

use Businessradar\Client;
use Businessradar\News\Articles\Export\ArticleExport;
use Businessradar\News\Articles\Export\DataExportFileType;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class ExportTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->news->articles->export->create(
            fileType: DataExportFileType::PDF,
            filters: []
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ArticleExport::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->news->articles->export->create(
            fileType: DataExportFileType::PDF,
            filters: [
                'categories' => ['182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e'],
                'companies' => ['182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e'],
                'countries' => ['xx'],
                'disableCompanyArticleDeduplication' => true,
                'dunsNumbers' => ['xxxxxxxx'],
                'globalUltimates' => ['xxxxxxxx'],
                'includeClusteredArticles' => true,
                'industries' => ['x'],
                'isMaterial' => true,
                'languages' => ['xx'],
                'maxCreationDate' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                'maxPublicationDate' => new \DateTimeImmutable(
                    '2019-12-27T18:11:19.117Z'
                ),
                'mediaType' => 'GAZETTE',
                'minCreationDate' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                'minPublicationDate' => new \DateTimeImmutable(
                    '2019-12-27T18:11:19.117Z'
                ),
                'parentCategory' => '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e',
                'portfolios' => ['182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e'],
                'query' => 'query',
                'registrationNumbers' => ['x'],
                'sentiment' => true,
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ArticleExport::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->news->articles->export->retrieve(
            '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ArticleExport::class, $result);
    }
}
