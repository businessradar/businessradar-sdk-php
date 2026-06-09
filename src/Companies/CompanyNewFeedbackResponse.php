<?php

declare(strict_types=1);

namespace Businessradar\Companies;

use Businessradar\Companies\CompanyNewFeedbackResponse\FeedbackType;
use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Company Feedback.
 *
 * Submit feedback about a specific company, such as outdated information,
 * missing data, or incorrect details.
 *
 * @phpstan-type CompanyNewFeedbackResponseShape = array{
 *   company: string,
 *   feedbackType: FeedbackType|value-of<FeedbackType>,
 *   comment?: string|null,
 *   notificationEmail?: string|null,
 *   tradeName?: string|null,
 * }
 */
final class CompanyNewFeedbackResponse implements BaseModel
{
    /** @use SdkModel<CompanyNewFeedbackResponseShape> */
    use SdkModel;

    #[Required]
    public string $company;

    /**
     * * `NOT_ENOUGH_NEWS` - Not Enough News
     * * `COMPANY_NAME_OUTDATED` - Company Name Outdated
     * * `INCORRECT_COMPANY_WEBSITE` - Incorrect Company Website
     * * `MISSING_REGISTRATION_NUMBER` - Missing Registration Number
     * * `MISSING_TRADE_NAME` - Missing Trade Name
     * * `INCORRECT_TRADE_NAME` - Incorrect Trade Name
     * * `NOT_ENOUGH_REVIEWS` - Not Enough Reviews
     * * `OUTDATED_CORPORATE_LINKAGE` - Outdated Corporate Linkage
     * * `INCORRECT_CORPORATE_LINKAGE` - Incorrect Corporate Linkage
     * * `OTHER` - Other.
     *
     * @var value-of<FeedbackType> $feedbackType
     */
    #[Required('feedback_type', enum: FeedbackType::class)]
    public string $feedbackType;

    #[Optional(nullable: true)]
    public ?string $comment;

    /**
     * Email address to notify when feedback is resolved.
     */
    #[Optional('notification_email', nullable: true)]
    public ?string $notificationEmail;

    #[Optional('trade_name', nullable: true)]
    public ?string $tradeName;

    /**
     * `new CompanyNewFeedbackResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CompanyNewFeedbackResponse::with(company: ..., feedbackType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CompanyNewFeedbackResponse)->withCompany(...)->withFeedbackType(...)
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
     * @param FeedbackType|value-of<FeedbackType> $feedbackType
     */
    public static function with(
        string $company,
        FeedbackType|string $feedbackType,
        ?string $comment = null,
        ?string $notificationEmail = null,
        ?string $tradeName = null,
    ): self {
        $self = new self;

        $self['company'] = $company;
        $self['feedbackType'] = $feedbackType;

        null !== $comment && $self['comment'] = $comment;
        null !== $notificationEmail && $self['notificationEmail'] = $notificationEmail;
        null !== $tradeName && $self['tradeName'] = $tradeName;

        return $self;
    }

    public function withCompany(string $company): self
    {
        $self = clone $this;
        $self['company'] = $company;

        return $self;
    }

    /**
     * * `NOT_ENOUGH_NEWS` - Not Enough News
     * * `COMPANY_NAME_OUTDATED` - Company Name Outdated
     * * `INCORRECT_COMPANY_WEBSITE` - Incorrect Company Website
     * * `MISSING_REGISTRATION_NUMBER` - Missing Registration Number
     * * `MISSING_TRADE_NAME` - Missing Trade Name
     * * `INCORRECT_TRADE_NAME` - Incorrect Trade Name
     * * `NOT_ENOUGH_REVIEWS` - Not Enough Reviews
     * * `OUTDATED_CORPORATE_LINKAGE` - Outdated Corporate Linkage
     * * `INCORRECT_CORPORATE_LINKAGE` - Incorrect Corporate Linkage
     * * `OTHER` - Other.
     *
     * @param FeedbackType|value-of<FeedbackType> $feedbackType
     */
    public function withFeedbackType(FeedbackType|string $feedbackType): self
    {
        $self = clone $this;
        $self['feedbackType'] = $feedbackType;

        return $self;
    }

    public function withComment(?string $comment): self
    {
        $self = clone $this;
        $self['comment'] = $comment;

        return $self;
    }

    /**
     * Email address to notify when feedback is resolved.
     */
    public function withNotificationEmail(?string $notificationEmail): self
    {
        $self = clone $this;
        $self['notificationEmail'] = $notificationEmail;

        return $self;
    }

    public function withTradeName(?string $tradeName): self
    {
        $self = clone $this;
        $self['tradeName'] = $tradeName;

        return $self;
    }
}
