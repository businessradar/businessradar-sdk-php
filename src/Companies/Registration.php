<?php

declare(strict_types=1);

namespace Businessradar\Companies;

use Businessradar\Companies\Registration\Country;
use Businessradar\Companies\Registration\Status;
use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Company Registration.
 *
 * Handles the registration of companies for monitoring. New companies can be
 * identified by DUNS number, local registration number, or name and country.
 *
 * @phpstan-import-type PortfolioCompanyDetailShape from \Businessradar\Companies\PortfolioCompanyDetail
 *
 * @phpstan-type RegistrationShape = array{
 *   externalID: string,
 *   finishedAt: \DateTimeInterface|null,
 *   progress: float,
 *   status: Status|value-of<Status>,
 *   statusText: string,
 *   company?: null|PortfolioCompanyDetail|PortfolioCompanyDetailShape,
 *   country?: null|Country|value-of<Country>,
 *   customerReference?: string|null,
 *   dunsNumber?: string|null,
 *   primaryName?: string|null,
 *   registrationNumber?: string|null,
 * }
 */
final class Registration implements BaseModel
{
    /** @use SdkModel<RegistrationShape> */
    use SdkModel;

    #[Required('external_id')]
    public string $externalID;

    /**
     * Datestamp on when the registration was complete. If failed this is empty.
     */
    #[Required('finished_at')]
    public ?\DateTimeInterface $finishedAt;

    #[Required]
    public float $progress;

    /**
     * * `queued_search` - Queued for search
     * * `searching` - Searching for company in registry
     * * `queued_registration` - Queued for registration
     * * `registering` - Registering company
     * * `queued_website_search` - Queued for website search
     * * `searching_website` - Searching for company website
     * * `searching_activity_description` - Generating company activity description
     * * `searching_website_icon` - Searching for company website icon
     * * `searching_directors` - Searching for directors online
     * * `social_search` - Searching for social media websites
     * * `generating_company_description` - Generating company description
     * * `determine_trade_names` - Determining trade names
     * * `searching_news` - Searching for news articles
     * * `processing_news` - Processing news articles
     * * `registered` - Registered
     * * `invalid_input` - Invalid input, please check your input
     * * `permission_denied` - Permission denied, please contact support
     * * `company_not_found` - Company has not been found in Dun and Bradstreet registry
     * * `expired` - Registration has been pending for too long, expired.
     * * `cancelled` - Registration has been cancelled.
     * * `failed` - Registration has failed, please check the error message.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Get Registration Status text.
     */
    #[Required('status_text')]
    public string $statusText;

    /**
     * ### Portfolio Company Detail (Simplified).
     *
     * A lightweight data structure for company identification (UUID, DUNS, Name, Country).
     */
    #[Optional(nullable: true)]
    public ?PortfolioCompanyDetail $company;

    /** @var value-of<Country>|null $country */
    #[Optional(enum: Country::class, nullable: true)]
    public ?string $country;

    /**
     * Customer reference for the client to understand relationship.
     */
    #[Optional('customer_reference', nullable: true)]
    public ?string $customerReference;

    #[Optional('duns_number', nullable: true)]
    public ?string $dunsNumber;

    #[Optional('primary_name', nullable: true)]
    public ?string $primaryName;

    #[Optional('registration_number', nullable: true)]
    public ?string $registrationNumber;

    /**
     * `new Registration()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Registration::with(
     *   externalID: ..., finishedAt: ..., progress: ..., status: ..., statusText: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Registration)
     *   ->withExternalID(...)
     *   ->withFinishedAt(...)
     *   ->withProgress(...)
     *   ->withStatus(...)
     *   ->withStatusText(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status> $status
     * @param PortfolioCompanyDetail|PortfolioCompanyDetailShape|null $company
     * @param Country|value-of<Country>|null $country
     */
    public static function with(
        string $externalID,
        ?\DateTimeInterface $finishedAt,
        float $progress,
        Status|string $status,
        string $statusText,
        PortfolioCompanyDetail|array|null $company = null,
        Country|string|null $country = null,
        ?string $customerReference = null,
        ?string $dunsNumber = null,
        ?string $primaryName = null,
        ?string $registrationNumber = null,
    ): self {
        $self = new self;

        $self['externalID'] = $externalID;
        $self['finishedAt'] = $finishedAt;
        $self['progress'] = $progress;
        $self['status'] = $status;
        $self['statusText'] = $statusText;

        null !== $company && $self['company'] = $company;
        null !== $country && $self['country'] = $country;
        null !== $customerReference && $self['customerReference'] = $customerReference;
        null !== $dunsNumber && $self['dunsNumber'] = $dunsNumber;
        null !== $primaryName && $self['primaryName'] = $primaryName;
        null !== $registrationNumber && $self['registrationNumber'] = $registrationNumber;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }

    /**
     * Datestamp on when the registration was complete. If failed this is empty.
     */
    public function withFinishedAt(?\DateTimeInterface $finishedAt): self
    {
        $self = clone $this;
        $self['finishedAt'] = $finishedAt;

        return $self;
    }

    public function withProgress(float $progress): self
    {
        $self = clone $this;
        $self['progress'] = $progress;

        return $self;
    }

    /**
     * * `queued_search` - Queued for search
     * * `searching` - Searching for company in registry
     * * `queued_registration` - Queued for registration
     * * `registering` - Registering company
     * * `queued_website_search` - Queued for website search
     * * `searching_website` - Searching for company website
     * * `searching_activity_description` - Generating company activity description
     * * `searching_website_icon` - Searching for company website icon
     * * `searching_directors` - Searching for directors online
     * * `social_search` - Searching for social media websites
     * * `generating_company_description` - Generating company description
     * * `determine_trade_names` - Determining trade names
     * * `searching_news` - Searching for news articles
     * * `processing_news` - Processing news articles
     * * `registered` - Registered
     * * `invalid_input` - Invalid input, please check your input
     * * `permission_denied` - Permission denied, please contact support
     * * `company_not_found` - Company has not been found in Dun and Bradstreet registry
     * * `expired` - Registration has been pending for too long, expired.
     * * `cancelled` - Registration has been cancelled.
     * * `failed` - Registration has failed, please check the error message.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Get Registration Status text.
     */
    public function withStatusText(string $statusText): self
    {
        $self = clone $this;
        $self['statusText'] = $statusText;

        return $self;
    }

    /**
     * ### Portfolio Company Detail (Simplified).
     *
     * A lightweight data structure for company identification (UUID, DUNS, Name, Country).
     *
     * @param PortfolioCompanyDetail|PortfolioCompanyDetailShape|null $company
     */
    public function withCompany(
        PortfolioCompanyDetail|array|null $company
    ): self {
        $self = clone $this;
        $self['company'] = $company;

        return $self;
    }

    /**
     * @param Country|value-of<Country>|null $country
     */
    public function withCountry(Country|string|null $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Customer reference for the client to understand relationship.
     */
    public function withCustomerReference(?string $customerReference): self
    {
        $self = clone $this;
        $self['customerReference'] = $customerReference;

        return $self;
    }

    public function withDunsNumber(?string $dunsNumber): self
    {
        $self = clone $this;
        $self['dunsNumber'] = $dunsNumber;

        return $self;
    }

    public function withPrimaryName(?string $primaryName): self
    {
        $self = clone $this;
        $self['primaryName'] = $primaryName;

        return $self;
    }

    public function withRegistrationNumber(?string $registrationNumber): self
    {
        $self = clone $this;
        $self['registrationNumber'] = $registrationNumber;

        return $self;
    }
}
