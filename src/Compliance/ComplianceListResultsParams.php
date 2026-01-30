<?php

declare(strict_types=1);

namespace Businessradar\Compliance;

use Businessradar\Compliance\ComplianceListResultsParams\Order;
use Businessradar\Compliance\ComplianceListResultsParams\ResultType;
use Businessradar\Compliance\ComplianceListResultsParams\Sorting;
use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### List Compliance Results.
 *
 * Retrieve all findings for a compliance check. Results can be filtered by entity,
 * type of finding (e.g., Sanction, PEP), and confidence score.
 *
 * @see Businessradar\Services\ComplianceService::listResults()
 *
 * @phpstan-type ComplianceListResultsParamsShape = array{
 *   entity?: string|null,
 *   minConfidence?: float|null,
 *   nextKey?: string|null,
 *   order?: null|Order|value-of<Order>,
 *   resultType?: null|ResultType|value-of<ResultType>,
 *   sorting?: null|Sorting|value-of<Sorting>,
 * }
 */
final class ComplianceListResultsParams implements BaseModel
{
    /** @use SdkModel<ComplianceListResultsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by entity external ID.
     */
    #[Optional]
    public ?string $entity;

    /**
     * Filter by minimum confidence score (0.0 - 1.0).
     */
    #[Optional]
    public ?float $minConfidence;

    /**
     * An opaque cursor value used for pagination. Pass the `next_key` received from a previous response to retrieve the next set of results.
     */
    #[Optional]
    public ?string $nextKey;

    /**
     * Sorting order.
     *
     * @var value-of<Order>|null $order
     */
    #[Optional(enum: Order::class)]
    public ?string $order;

    /**
     * Filter by result type.
     *
     * @var value-of<ResultType>|null $resultType
     */
    #[Optional(enum: ResultType::class)]
    public ?string $resultType;

    /**
     * Sorting field.
     *
     * @var value-of<Sorting>|null $sorting
     */
    #[Optional(enum: Sorting::class)]
    public ?string $sorting;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Order|value-of<Order>|null $order
     * @param ResultType|value-of<ResultType>|null $resultType
     * @param Sorting|value-of<Sorting>|null $sorting
     */
    public static function with(
        ?string $entity = null,
        ?float $minConfidence = null,
        ?string $nextKey = null,
        Order|string|null $order = null,
        ResultType|string|null $resultType = null,
        Sorting|string|null $sorting = null,
    ): self {
        $self = new self;

        null !== $entity && $self['entity'] = $entity;
        null !== $minConfidence && $self['minConfidence'] = $minConfidence;
        null !== $nextKey && $self['nextKey'] = $nextKey;
        null !== $order && $self['order'] = $order;
        null !== $resultType && $self['resultType'] = $resultType;
        null !== $sorting && $self['sorting'] = $sorting;

        return $self;
    }

    /**
     * Filter by entity external ID.
     */
    public function withEntity(string $entity): self
    {
        $self = clone $this;
        $self['entity'] = $entity;

        return $self;
    }

    /**
     * Filter by minimum confidence score (0.0 - 1.0).
     */
    public function withMinConfidence(float $minConfidence): self
    {
        $self = clone $this;
        $self['minConfidence'] = $minConfidence;

        return $self;
    }

    /**
     * An opaque cursor value used for pagination. Pass the `next_key` received from a previous response to retrieve the next set of results.
     */
    public function withNextKey(string $nextKey): self
    {
        $self = clone $this;
        $self['nextKey'] = $nextKey;

        return $self;
    }

    /**
     * Sorting order.
     *
     * @param Order|value-of<Order> $order
     */
    public function withOrder(Order|string $order): self
    {
        $self = clone $this;
        $self['order'] = $order;

        return $self;
    }

    /**
     * Filter by result type.
     *
     * @param ResultType|value-of<ResultType> $resultType
     */
    public function withResultType(ResultType|string $resultType): self
    {
        $self = clone $this;
        $self['resultType'] = $resultType;

        return $self;
    }

    /**
     * Sorting field.
     *
     * @param Sorting|value-of<Sorting> $sorting
     */
    public function withSorting(Sorting|string $sorting): self
    {
        $self = clone $this;
        $self['sorting'] = $sorting;

        return $self;
    }
}
