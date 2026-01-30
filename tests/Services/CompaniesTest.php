<?php

namespace Tests\Services;

use Businessradar\Client;
use Businessradar\Companies\CompanyGetMissingCompanyInvestigationResponse;
use Businessradar\Companies\CompanyGetResponse;
use Businessradar\Companies\CompanyListAttributeChangesResponse;
use Businessradar\Companies\CompanyListMissingCompanyInvestigationsResponse;
use Businessradar\Companies\CompanyListResponse;
use Businessradar\Companies\CompanyNewMissingCompanyInvestigationResponse;
use Businessradar\Companies\CountryEnum;
use Businessradar\Companies\Registration;
use Businessradar\NextKey;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class CompaniesTest extends TestCase
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

        $result = $this->client->companies->create();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Registration::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->companies->retrieve(
            '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CompanyGetResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $page = $this->client->companies->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(NextKey::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(CompanyListResponse::class, $item);
        }
    }

    #[Test]
    public function testCreateMissingCompanyInvestigation(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->companies->createMissingCompanyInvestigation(
            country: CountryEnum::AF,
            legalName: 'x'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            CompanyNewMissingCompanyInvestigationResponse::class,
            $result
        );
    }

    #[Test]
    public function testCreateMissingCompanyInvestigationWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->companies->createMissingCompanyInvestigation(
            country: CountryEnum::AF,
            legalName: 'x',
            addressNumber: 'address_number',
            addressPhone: 'address_phone',
            addressPlace: 'address_place',
            addressPostal: 'address_postal',
            addressRegion: 'address_region',
            addressStreet: 'address_street',
            description: 'description',
            officerName: 'officer_name',
            officerTitle: 'officer_title',
            tradeName: 'trade_name',
            websiteURL: 'https://example.com',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            CompanyNewMissingCompanyInvestigationResponse::class,
            $result
        );
    }

    #[Test]
    public function testListAttributeChanges(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $page = $this->client->companies->listAttributeChanges();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(NextKey::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(
                CompanyListAttributeChangesResponse::class,
                $item
            );
        }
    }

    #[Test]
    public function testListMissingCompanyInvestigations(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $page = $this->client->companies->listMissingCompanyInvestigations();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(NextKey::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(
                CompanyListMissingCompanyInvestigationsResponse::class,
                $item
            );
        }
    }

    #[Test]
    public function testRetrieveMissingCompanyInvestigation(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->companies->retrieveMissingCompanyInvestigation(
            '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            CompanyGetMissingCompanyInvestigationResponse::class,
            $result
        );
    }

    #[Test]
    public function testRetrieveRegistration(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->companies->retrieveRegistration(
            '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Registration::class, $result);
    }
}
