<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\CardTeaser;

use Edu\IU\RSB\StructuredDataNodes\Asset\FileNode;
use Edu\IU\RSB\StructuredDataNodes\Asset\LinkableNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\RSB\StructuredDataNodes\Text\WysiwygNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class Card implements ComponentInterface {

    use ComponentTraits;

    //content
    public string $title;
    public string $eyebrow;
    public string $teaser;
    public string $cardBadge;
    public string $cardVisualType;
    public string $imageId;
    public string $imagePath;
    public string $altText;
    public string $stickerId;
    public string $linkId;
    public string $linkPath;
    public string $linkType;

    //identifiers
    public readonly string $identifierTitle;
    public readonly string $identifierEyebrow;
    public readonly string $identifierTeaser;
    public readonly string $identifierCardBadge;
    public readonly string $identifierCardVisualType;
    public readonly string $identifierImage;
    public readonly string $identifierAltText;
    public readonly string $identifierStickerId;
    public readonly string $identifierLink;

    //nodes
    public TextInputNode $nodeTitle;
    public TextInputNode $nodeEyebrow;
    public WysiwygNode $nodeTeaser;
    public TextInputNode $nodeCardBadge;
    public DropdownNode $nodeVisualType;
    public FileNode $nodeImage;
    public TextInputNode $nodeAltText;
    public TextInputNode $nodeStickerId;
    public LinkableNode $nodeLink;

    public function __construct(string $title = '', string $eyebrow = '', string $teaser = '', string $cardBadge = '', string $cardVisualType = 'none', string $imageId = '', string $imagePath = '', string $altText = '', string $stickerId = '', string $linkId = '', string $linkPath = '', string $linkType = '')
    {
        $this->title = $title;
        $this->eyebrow = $eyebrow;
        $this->teaser = $teaser;
        $this->cardBadge = $cardBadge;
        $this->cardVisualType = $cardVisualType;
        $this->imageId = $imageId;
        $this->imagePath = $imagePath;
        $this->altText = $altText;
        $this->stickerId = $stickerId;
        $this->linkId = $linkId;
        $this->linkPath = $linkPath;
        $this->linkType = $linkType;

        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeTitle);
        $groupNode->addChild($this->nodeEyebrow);
        $groupNode->addChild($this->nodeTeaser);
        $groupNode->addChild($this->nodeCardBadge);
        $groupNode->addChild($this->nodeVisualType);
        $groupNode->addChild($this->nodeImage);
        $groupNode->addChild($this->nodeAltText);
        $groupNode->addChild($this->nodeStickerId);
        $groupNode->addChild($this->nodeLink);

        return $groupNode;

    }

    public function constructChildrenNodes(): void
    {
        $this->nodeTitle = new TextInputNode($this->identifierTitle, $this->title);
        $this->nodeEyebrow = new TextInputNode($this->identifierEyebrow, $this->eyebrow);
        $this->nodeTeaser = new WysiwygNode($this->identifierTeaser, $this->teaser);
        $this->nodeCardBadge = new TextInputNode($this->identifierCardBadge, $this->cardBadge);
        $this->nodeVisualType = new DropdownNode($this->identifierCardVisualType, $this->cardVisualType);
        $this->nodeImage = new FileNode($this->identifierImage, $this->imageId, $this->imagePath);
        $this->nodeAltText = new TextInputNode($this->identifierAltText, $this->altText);
        $this->nodeStickerId = new TextInputNode($this->identifierStickerId, $this->stickerId);
        $this->nodeLink = new LinkableNode($this->identifierLink, $this->linkId, $this->linkPath, $this->linkType);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'card';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierTitle = 'title';
        $this->identifierEyebrow = 'eyebrow';
        $this->identifierTeaser = 'teaser';
        $this->identifierCardBadge = 'card-badge';
        $this->identifierCardVisualType = 'type';
        $this->identifierImage = 'image';
        $this->identifierAltText = 'alt-text';
        $this->identifierStickerId = 'sticker-id';
        $this->identifierLink = 'link';
    }
}
