<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\Analytics;

use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Article Date Aggregation.
 *
 * Provides aggregated metrics for articles on a per-date basis. - **count**: Total
 * articles found for the given date. - **average_sentiment**: Average sentiment score
 * of these articles. - **date**: The specific date of the aggregation.
 *
 * @phpstan-type AnalyticsGetCountByDateResponseItemShape = array{
 *   averageSentiment: float, count: int, date: string
 * }
 */
final class AnalyticsGetCountByDateResponseItem implements BaseModel
{
    /** @use SdkModel<AnalyticsGetCountByDateResponseItemShape> */
    use SdkModel;

    #[Required('average_sentiment')]
    public float $averageSentiment;

    #[Required]
    public int $count;

    #[Required]
    public string $date;

    /**
     * `new AnalyticsGetCountByDateResponseItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AnalyticsGetCountByDateResponseItem::with(
     *   averageSentiment: ..., count: ..., date: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AnalyticsGetCountByDateResponseItem)
     *   ->withAverageSentiment(...)
     *   ->withCount(...)
     *   ->withDate(...)
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
     */
    public static function with(
        float $averageSentiment,
        int $count,
        string $date
    ): self {
        $self = new self;

        $self['averageSentiment'] = $averageSentiment;
        $self['count'] = $count;
        $self['date'] = $date;

        return $self;
    }

    public function withAverageSentiment(float $averageSentiment): self
    {
        $self = clone $this;
        $self['averageSentiment'] = $averageSentiment;

        return $self;
    }

    public function withCount(int $count): self
    {
        $self = clone $this;
        $self['count'] = $count;

        return $self;
    }

    public function withDate(string $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }
}
