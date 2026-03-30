<?php

declare(strict_types=1);

namespace Businessradar\News\Articles;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;
use Businessradar\News\Articles\ArticleCreateFeedbackParams\FeedbackType;

/**
 * ### Submit Article Feedback.
 *
 * Submit feedback for a specific article. This helps improve our analysis and
 * relevance.
 *
 * @see Businessradar\Services\News\ArticlesService::createFeedback()
 *
 * @phpstan-type ArticleCreateFeedbackParamsShape = array{
 *   article: string,
 *   comment?: string|null,
 *   email?: string|null,
 *   feedbackType?: null|FeedbackType|value-of<FeedbackType>,
 * }
 */
final class ArticleCreateFeedbackParams implements BaseModel
{
    /** @use SdkModel<ArticleCreateFeedbackParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $article;

    #[Optional(nullable: true)]
    public ?string $comment;

    #[Optional(nullable: true)]
    public ?string $email;

    /**
     * * `false_positive` - False Positive
     * * `no_risk` - No Risk
     * * `risk_confirmed` - Risk Confirmed.
     *
     * @var value-of<FeedbackType>|null $feedbackType
     */
    #[Optional('feedback_type', enum: FeedbackType::class)]
    public ?string $feedbackType;

    /**
     * `new ArticleCreateFeedbackParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ArticleCreateFeedbackParams::with(article: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ArticleCreateFeedbackParams)->withArticle(...)
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
     * @param FeedbackType|value-of<FeedbackType>|null $feedbackType
     */
    public static function with(
        string $article,
        ?string $comment = null,
        ?string $email = null,
        FeedbackType|string|null $feedbackType = null,
    ): self {
        $self = new self;

        $self['article'] = $article;

        null !== $comment && $self['comment'] = $comment;
        null !== $email && $self['email'] = $email;
        null !== $feedbackType && $self['feedbackType'] = $feedbackType;

        return $self;
    }

    public function withArticle(string $article): self
    {
        $self = clone $this;
        $self['article'] = $article;

        return $self;
    }

    public function withComment(?string $comment): self
    {
        $self = clone $this;
        $self['comment'] = $comment;

        return $self;
    }

    public function withEmail(?string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * * `false_positive` - False Positive
     * * `no_risk` - No Risk
     * * `risk_confirmed` - Risk Confirmed.
     *
     * @param FeedbackType|value-of<FeedbackType> $feedbackType
     */
    public function withFeedbackType(FeedbackType|string $feedbackType): self
    {
        $self = clone $this;
        $self['feedbackType'] = $feedbackType;

        return $self;
    }
}
