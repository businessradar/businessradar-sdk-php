<?php

declare(strict_types=1);

namespace Businessradar\Services;

use Businessradar\Client;
use Businessradar\Companies\CompanyCreateFeedbackParams;
use Businessradar\Companies\CompanyCreateFeedbackParams\FeedbackType;
use Businessradar\Companies\CompanyCreateMissingCompanyInvestigationParams;
use Businessradar\Companies\CompanyCreateParams;
use Businessradar\Companies\CompanyCreateParams\Country;
use Businessradar\Companies\CompanyGetMissingCompanyInvestigationResponse;
use Businessradar\Companies\CompanyGetResponse;
use Businessradar\Companies\CompanyListAttributeChangesParams;
use Businessradar\Companies\CompanyListAttributeChangesResponse;
use Businessradar\Companies\CompanyListMissingCompanyInvestigationsParams;
use Businessradar\Companies\CompanyListMissingCompanyInvestigationsResponse;
use Businessradar\Companies\CompanyListParams;
use Businessradar\Companies\CompanyListResponse;
use Businessradar\Companies\CompanyNewFeedbackResponse;
use Businessradar\Companies\CompanyNewMissingCompanyInvestigationResponse;
use Businessradar\Companies\CountryEnum;
use Businessradar\Companies\Registration;
use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\NextKey;
use Businessradar\PortfolioCompanyDetailRequest;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\CompaniesRawContract;

/**
 * @phpstan-import-type PortfolioCompanyDetailRequestShape from \Businessradar\PortfolioCompanyDetailRequest
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
final class CompaniesRawService implements CompaniesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * ### Register Company (Asynchronous)
     *
     * Register a new company to Business Radar using its identification details. Once
     * posted, Business Radar processes the request in the background.
     *
     * To check the progress and/or retrieve the final result, you can use the [GET
     * /registrations/{registration_id}](/ext/v3/#/ext/ext_v3_registrations_retrieve)
     * endpoint.
     *
     * If the company is already registered, the existing registration will be
     * returned.
     *
     * @param array{
     *   company?: PortfolioCompanyDetailRequest|PortfolioCompanyDetailRequestShape|null,
     *   country?: value-of<Country>,
     *   customerReference?: string|null,
     *   dunsNumber?: string|null,
     *   primaryName?: string|null,
     *   registrationNumber?: string|null,
     * }|CompanyCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Registration>
     *
     * @throws APIException
     */
    public function create(
        array|CompanyCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CompanyCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'ext/v3/companies',
            body: (object) $parsed,
            options: $options,
            convert: Registration::class,
        );
    }

    /**
     * @api
     *
     * ### Retrieve Company Information
     *
     * Fetch detailed information about a specific company using its `external_id`.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CompanyGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $externalID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ext/v3/companies/%1$s', $externalID],
            options: $requestOptions,
            convert: CompanyGetResponse::class,
        );
    }

    /**
     * @api
     *
     * ### Search Companies
     *
     * Search for companies across internal and external databases.
     *
     * - If `query` and an optional `country` are provided, the search is primarily
     * conducted via Dun & Bradstreet.
     *
     * - If other filters (like `portfolio_id`) are provided, the search is limited to
     * our internal database.
     *
     * The results include an `external_id` if the company is already registered in
     * Business Radar.
     *
     * @param array{
     *   country?: list<string>,
     *   dunsNumber?: list<string>,
     *   nextKey?: string,
     *   portfolioID?: list<string>,
     *   query?: string,
     *   registrationNumber?: list<string>,
     *   websiteURL?: string,
     * }|CompanyListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<CompanyListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|CompanyListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CompanyListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'ext/v3/companies',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'dunsNumber' => 'duns_number',
                    'nextKey' => 'next_key',
                    'portfolioID' => 'portfolio_id',
                    'registrationNumber' => 'registration_number',
                    'websiteURL' => 'website_url',
                ],
            ),
            options: $options,
            convert: CompanyListResponse::class,
            page: NextKey::class,
        );
    }

    /**
     * @api
     *
     * ### Submit Company Feedback
     *
     * Submit feedback about a specific company. If feedback already exists for
     * the same company and profile, the existing record is updated.
     *
     * Optionally provide a `notification_email` to be notified when the feedback
     * is resolved.
     *
     * @param array{
     *   company: string,
     *   feedbackType: value-of<FeedbackType>,
     *   comment?: string|null,
     *   notificationEmail?: string|null,
     *   tradeName?: string|null,
     * }|CompanyCreateFeedbackParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CompanyNewFeedbackResponse>
     *
     * @throws APIException
     */
    public function createFeedback(
        array|CompanyCreateFeedbackParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CompanyCreateFeedbackParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'ext/v3/companies/feedback/',
            body: (object) $parsed,
            options: $options,
            convert: CompanyNewFeedbackResponse::class,
        );
    }

    /**
     * @api
     *
     * ### Submit Missing Company Investigation (Asynchronous)
     *
     * Submit a new investigation for a company that could not be found. Once
     * submitted, Business Radar processes the investigation in the background.
     *
     * To check the progress and/or retrieve the final result, you can use the GET
     * endpoint.
     *
     * @param array{
     *   country: value-of<CountryEnum>,
     *   legalName: string,
     *   addressNumber?: string|null,
     *   addressPhone?: string|null,
     *   addressPlace?: string|null,
     *   addressPostal?: string|null,
     *   addressRegion?: string|null,
     *   addressStreet?: string|null,
     *   description?: string|null,
     *   officerName?: string|null,
     *   officerTitle?: string|null,
     *   tradeName?: string|null,
     *   websiteURL?: string|null,
     * }|CompanyCreateMissingCompanyInvestigationParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CompanyNewMissingCompanyInvestigationResponse>
     *
     * @throws APIException
     */
    public function createMissingCompanyInvestigation(
        array|CompanyCreateMissingCompanyInvestigationParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CompanyCreateMissingCompanyInvestigationParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'ext/v3/companies/investigations',
            body: (object) $parsed,
            options: $options,
            convert: CompanyNewMissingCompanyInvestigationResponse::class,
        );
    }

    /**
     * @api
     *
     * ### List Company Updates
     *
     * Retrieve a list of attribute changes for companies. This allows monitoring how
     * company data has evolved over time.
     *
     * @param array{
     *   maxCreatedAt?: \DateTimeInterface,
     *   minCreatedAt?: \DateTimeInterface,
     *   nextKey?: string,
     * }|CompanyListAttributeChangesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<CompanyListAttributeChangesResponse>>
     *
     * @throws APIException
     */
    public function listAttributeChanges(
        array|CompanyListAttributeChangesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CompanyListAttributeChangesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'ext/v3/companies/attribute_changes',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'maxCreatedAt' => 'max_created_at',
                    'minCreatedAt' => 'min_created_at',
                    'nextKey' => 'next_key',
                ],
            ),
            options: $options,
            convert: CompanyListAttributeChangesResponse::class,
            page: NextKey::class,
        );
    }

    /**
     * @api
     *
     * ### Missing Company Investigations
     *
     * List existing investigations or submit a new one for a company that could not be
     * found.
     *
     * @param array{
     *   nextKey?: string
     * }|CompanyListMissingCompanyInvestigationsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<CompanyListMissingCompanyInvestigationsResponse>>
     *
     * @throws APIException
     */
    public function listMissingCompanyInvestigations(
        array|CompanyListMissingCompanyInvestigationsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CompanyListMissingCompanyInvestigationsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'ext/v3/companies/investigations',
            query: Util::array_transform_keys($parsed, ['nextKey' => 'next_key']),
            options: $options,
            convert: CompanyListMissingCompanyInvestigationsResponse::class,
            page: NextKey::class,
        );
    }

    /**
     * @api
     *
     * ### Retrieve Missing Company Investigation
     *
     * Fetch details about a specific missing company investigation using its
     * `external_id`.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CompanyGetMissingCompanyInvestigationResponse>
     *
     * @throws APIException
     */
    public function retrieveMissingCompanyInvestigation(
        string $externalID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ext/v3/companies/investigations/%1$s', $externalID],
            options: $requestOptions,
            convert: CompanyGetMissingCompanyInvestigationResponse::class,
        );
    }

    /**
     * @api
     *
     * ### Retrieve Registration Information
     *
     * Fetch details about a specific company registration request using its
     * `registration_id`.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Registration>
     *
     * @throws APIException
     */
    public function retrieveRegistration(
        string $registrationID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ext/v3/registrations/%1$s', $registrationID],
            options: $requestOptions,
            convert: Registration::class,
        );
    }
}
