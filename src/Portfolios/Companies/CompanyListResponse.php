<?php

declare(strict_types=1);

namespace Businessradar\Portfolios\Companies;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;
use Businessradar\Portfolios\Companies\CompanyListResponse\Company;

/**
 * ### Portfolio-Company.
 *
 * Represents the association between a company and a portfolio, including portfolio-
 * specific data such as `customer_reference`.
 *
 * @phpstan-import-type CompanyShape from \Businessradar\Portfolios\Companies\CompanyListResponse\Company
 *
 * @phpstan-type CompanyListResponseShape = array{
 *   company: Company|CompanyShape,
 *   createdAt: \DateTimeInterface,
 *   customerReference?: string|null,
 * }
 */
final class CompanyListResponse implements BaseModel
{
    /** @use SdkModel<CompanyListResponseShape> */
    use SdkModel;

    /**
     * ### Company List.
     *
     * Provides a detailed overview of a company, including identification, contact info,
     * and aggregated news/review metrics.
     */
    #[Required]
    public Company $company;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Customer reference for the client to understand relationship.
     */
    #[Optional('customer_reference', nullable: true)]
    public ?string $customerReference;

    /**
     * `new CompanyListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CompanyListResponse::with(company: ..., createdAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CompanyListResponse)->withCompany(...)->withCreatedAt(...)
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
     * @param Company|CompanyShape $company
     */
    public static function with(
        Company|array $company,
        \DateTimeInterface $createdAt,
        ?string $customerReference = null,
    ): self {
        $self = new self;

        $self['company'] = $company;
        $self['createdAt'] = $createdAt;

        null !== $customerReference && $self['customerReference'] = $customerReference;

        return $self;
    }

    /**
     * ### Company List.
     *
     * Provides a detailed overview of a company, including identification, contact info,
     * and aggregated news/review metrics.
     *
     * @param Company|CompanyShape $company
     */
    public function withCompany(Company|array $company): self
    {
        $self = clone $this;
        $self['company'] = $company;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

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
}
