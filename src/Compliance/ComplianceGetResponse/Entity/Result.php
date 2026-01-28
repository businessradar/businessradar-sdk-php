<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceGetResponse\Entity;

use Businessradar\Compliance\ComplianceGetResponse\Entity\Result\Address;
use Businessradar\Compliance\ComplianceGetResponse\Entity\Result\Language;
use Businessradar\Compliance\ComplianceGetResponse\Entity\Result\ResultType;
use Businessradar\Compliance\ComplianceGetResponse\Entity\Result\Source;
use Businessradar\Compliance\ComplianceGetResponse\Entity\Result\Tag;
use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * Compliance entity result serializer.
 *
 * @phpstan-import-type AddressShape from \Businessradar\Compliance\ComplianceGetResponse\Entity\Result\Address
 * @phpstan-import-type SourceShape from \Businessradar\Compliance\ComplianceGetResponse\Entity\Result\Source
 * @phpstan-import-type TagShape from \Businessradar\Compliance\ComplianceGetResponse\Entity\Result\Tag
 *
 * @phpstan-type ResultShape = array{
 *   addresses: list<Address|AddressShape>,
 *   createdAt: \DateTimeInterface,
 *   externalID: string,
 *   name: string,
 *   resultType: ResultType|value-of<ResultType>,
 *   sources: list<Source|SourceShape>,
 *   tags: list<Tag|TagShape>,
 *   confidence?: float|null,
 *   formattedText?: string|null,
 *   formattedTextEn?: string|null,
 *   formattedTitle?: string|null,
 *   formattedTitleEn?: string|null,
 *   image?: string|null,
 *   language?: null|Language|value-of<Language>,
 *   sourceDate?: \DateTimeInterface|null,
 *   sourceName?: string|null,
 *   text?: string|null,
 *   textEn?: string|null,
 *   title?: string|null,
 *   titleEn?: string|null,
 *   url?: string|null,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /** @var list<Address> $addresses */
    #[Required(list: Address::class)]
    public array $addresses;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('external_id')]
    public string $externalID;

    #[Required]
    public string $name;

    /**
     * * `sanction` - Sanction
     * * `pep` - Politically Exposed Person
     * * `adverse_media` - Adverse media
     * * `enforcement` - Enforcement
     * * `govt_owned` - Government owned.
     *
     * @var value-of<ResultType> $resultType
     */
    #[Required('result_type', enum: ResultType::class)]
    public string $resultType;

    /** @var list<Source> $sources */
    #[Required(list: Source::class)]
    public array $sources;

    /** @var list<Tag> $tags */
    #[Required(list: Tag::class)]
    public array $tags;

    #[Optional(nullable: true)]
    public ?float $confidence;

    #[Optional('formatted_text', nullable: true)]
    public ?string $formattedText;

    #[Optional('formatted_text_en', nullable: true)]
    public ?string $formattedTextEn;

    #[Optional('formatted_title', nullable: true)]
    public ?string $formattedTitle;

    #[Optional('formatted_title_en', nullable: true)]
    public ?string $formattedTitleEn;

    #[Optional(nullable: true)]
    public ?string $image;

    /** @var value-of<Language>|null $language */
    #[Optional(enum: Language::class, nullable: true)]
    public ?string $language;

    #[Optional('source_date', nullable: true)]
    public ?\DateTimeInterface $sourceDate;

    #[Optional('source_name', nullable: true)]
    public ?string $sourceName;

    #[Optional(nullable: true)]
    public ?string $text;

    #[Optional('text_en', nullable: true)]
    public ?string $textEn;

    #[Optional(nullable: true)]
    public ?string $title;

    #[Optional('title_en', nullable: true)]
    public ?string $titleEn;

    #[Optional(nullable: true)]
    public ?string $url;

    /**
     * `new Result()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Result::with(
     *   addresses: ...,
     *   createdAt: ...,
     *   externalID: ...,
     *   name: ...,
     *   resultType: ...,
     *   sources: ...,
     *   tags: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Result)
     *   ->withAddresses(...)
     *   ->withCreatedAt(...)
     *   ->withExternalID(...)
     *   ->withName(...)
     *   ->withResultType(...)
     *   ->withSources(...)
     *   ->withTags(...)
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
     * @param list<Address|AddressShape> $addresses
     * @param ResultType|value-of<ResultType> $resultType
     * @param list<Source|SourceShape> $sources
     * @param list<Tag|TagShape> $tags
     * @param Language|value-of<Language>|null $language
     */
    public static function with(
        array $addresses,
        \DateTimeInterface $createdAt,
        string $externalID,
        string $name,
        ResultType|string $resultType,
        array $sources,
        array $tags,
        ?float $confidence = null,
        ?string $formattedText = null,
        ?string $formattedTextEn = null,
        ?string $formattedTitle = null,
        ?string $formattedTitleEn = null,
        ?string $image = null,
        Language|string|null $language = null,
        ?\DateTimeInterface $sourceDate = null,
        ?string $sourceName = null,
        ?string $text = null,
        ?string $textEn = null,
        ?string $title = null,
        ?string $titleEn = null,
        ?string $url = null,
    ): self {
        $self = new self;

        $self['addresses'] = $addresses;
        $self['createdAt'] = $createdAt;
        $self['externalID'] = $externalID;
        $self['name'] = $name;
        $self['resultType'] = $resultType;
        $self['sources'] = $sources;
        $self['tags'] = $tags;

        null !== $confidence && $self['confidence'] = $confidence;
        null !== $formattedText && $self['formattedText'] = $formattedText;
        null !== $formattedTextEn && $self['formattedTextEn'] = $formattedTextEn;
        null !== $formattedTitle && $self['formattedTitle'] = $formattedTitle;
        null !== $formattedTitleEn && $self['formattedTitleEn'] = $formattedTitleEn;
        null !== $image && $self['image'] = $image;
        null !== $language && $self['language'] = $language;
        null !== $sourceDate && $self['sourceDate'] = $sourceDate;
        null !== $sourceName && $self['sourceName'] = $sourceName;
        null !== $text && $self['text'] = $text;
        null !== $textEn && $self['textEn'] = $textEn;
        null !== $title && $self['title'] = $title;
        null !== $titleEn && $self['titleEn'] = $titleEn;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * @param list<Address|AddressShape> $addresses
     */
    public function withAddresses(array $addresses): self
    {
        $self = clone $this;
        $self['addresses'] = $addresses;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * * `sanction` - Sanction
     * * `pep` - Politically Exposed Person
     * * `adverse_media` - Adverse media
     * * `enforcement` - Enforcement
     * * `govt_owned` - Government owned.
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
     * @param list<Source|SourceShape> $sources
     */
    public function withSources(array $sources): self
    {
        $self = clone $this;
        $self['sources'] = $sources;

        return $self;
    }

    /**
     * @param list<Tag|TagShape> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    public function withConfidence(?float $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    public function withFormattedText(?string $formattedText): self
    {
        $self = clone $this;
        $self['formattedText'] = $formattedText;

        return $self;
    }

    public function withFormattedTextEn(?string $formattedTextEn): self
    {
        $self = clone $this;
        $self['formattedTextEn'] = $formattedTextEn;

        return $self;
    }

    public function withFormattedTitle(?string $formattedTitle): self
    {
        $self = clone $this;
        $self['formattedTitle'] = $formattedTitle;

        return $self;
    }

    public function withFormattedTitleEn(?string $formattedTitleEn): self
    {
        $self = clone $this;
        $self['formattedTitleEn'] = $formattedTitleEn;

        return $self;
    }

    public function withImage(?string $image): self
    {
        $self = clone $this;
        $self['image'] = $image;

        return $self;
    }

    /**
     * @param Language|value-of<Language>|null $language
     */
    public function withLanguage(Language|string|null $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }

    public function withSourceDate(?\DateTimeInterface $sourceDate): self
    {
        $self = clone $this;
        $self['sourceDate'] = $sourceDate;

        return $self;
    }

    public function withSourceName(?string $sourceName): self
    {
        $self = clone $this;
        $self['sourceName'] = $sourceName;

        return $self;
    }

    public function withText(?string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    public function withTextEn(?string $textEn): self
    {
        $self = clone $this;
        $self['textEn'] = $textEn;

        return $self;
    }

    public function withTitle(?string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    public function withTitleEn(?string $titleEn): self
    {
        $self = clone $this;
        $self['titleEn'] = $titleEn;

        return $self;
    }

    public function withURL(?string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
