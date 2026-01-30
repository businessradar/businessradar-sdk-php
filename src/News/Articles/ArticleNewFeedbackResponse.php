<?php

declare(strict_types=1);

namespace Businessradar\News\Articles;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### External Article Feedback.
 *
 * Allows users to provide feedback on specific articles, including feedback type,
 * comments, and contact information.
 *
 * @phpstan-type ArticleNewFeedbackResponseShape = array{
 *   article: string,
 *   externalID: string,
 *   comment?: string|null,
 *   email?: string|null,
 *   feedbackType?: null|FeedbackTypeEnum|value-of<FeedbackTypeEnum>,
 * }
 */
final class ArticleNewFeedbackResponse implements BaseModel
{
    /** @use SdkModel<ArticleNewFeedbackResponseShape> */
    use SdkModel;

    #[Required]
    public string $article;

    #[Required('external_id')]
    public string $externalID;

    #[Optional(nullable: true)]
    public ?string $comment;

    #[Optional(nullable: true)]
    public ?string $email;

    /**
     * * `false_positive` - False Positive
     * * `no_risk` - No Risk
     * * `risk_confirmed` - Risk Confirmed.
     *
     * @var value-of<FeedbackTypeEnum>|null $feedbackType
     */
    #[Optional('feedback_type', enum: FeedbackTypeEnum::class)]
    public ?string $feedbackType;

    /**
     * `new ArticleNewFeedbackResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ArticleNewFeedbackResponse::with(article: ..., externalID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ArticleNewFeedbackResponse)->withArticle(...)->withExternalID(...)
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
     * @param FeedbackTypeEnum|value-of<FeedbackTypeEnum>|null $feedbackType
     */
    public static function with(
        string $article,
        string $externalID,
        ?string $comment = null,
        ?string $email = null,
        FeedbackTypeEnum|string|null $feedbackType = null,
    ): self {
        $self = new self;

        $self['article'] = $article;
        $self['externalID'] = $externalID;

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

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

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
     * @param FeedbackTypeEnum|value-of<FeedbackTypeEnum> $feedbackType
     */
    public function withFeedbackType(
        FeedbackTypeEnum|string $feedbackType
    ): self {
        $self = clone $this;
        $self['feedbackType'] = $feedbackType;

        return $self;
    }
}
