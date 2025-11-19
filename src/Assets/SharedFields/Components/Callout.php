<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\CheckboxNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\RSB\StructuredDataNodes\Text\WysiwygNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Callout\CTA;

class Callout implements ComponentInterface{

    use ComponentTraits;
    //content
    public string $headingLevel;
    public string $stickerId;
    public string $eyebrow;
    public string $title;
    public string $teaser;
    public string $showCTA;
    public string $htmlId;
    public CTA $cta;

    //identifiers
    public readonly string $identifierHeadingLevel;
    public readonly string $identifierStickerId;
    public readonly string $identifierEyebrow;
    public readonly string $identifierTitle;
    public readonly string $identifierTeaser;
    public readonly string $identifierShowCTA;
    public readonly string $identifierHtmlId;

    //nodes
    public DropdownNode $nodeHeadingLevel;
    public TextInputNode $nodeStickerId;
    public TextInputNode $nodeEyebrow;
    public TextInputNode $nodeTitle;
    public WysiwygNode $nodeTeaser;
    public CheckboxNode $nodeShowCTA;
    public TextInputNode $nodeHtmlId;

    public function __construct(string $headingLevel = '', string $stickerId = '', string $eyebrow = '', string $title = '', string $teaser = '',string $showCTA = '', CTA | null $cta = null, string $htmlId = '')
    {
        $this->headingLevel = $headingLevel;
        $this->stickerId = $stickerId;
        $this->eyebrow = $eyebrow;
        $this->title = $title;
        $this->teaser = $teaser;
        $this->showCTA = $showCTA;
        $this->cta = $cta;
        $this->htmlId = $htmlId;

        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeHeadingLevel);
        $groupNode->addChild($this->nodeStickerId);
        $groupNode->addChild($this->nodeEyebrow);
        $groupNode->addChild($this->nodeTitle);
        $groupNode->addChild($this->nodeTeaser);
        $groupNode->addChild($this->nodeShowCTA);
        $groupNode->addChild($this->cta->constructComponentGroupNode());
        $groupNode->addChild($this->nodeHtmlId);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeHeadingLevel = new DropdownNode($this->identifierHeadingLevel, $this->headingLevel);
        $this->nodeStickerId = new TextInputNode($this->identifierStickerId, $this->stickerId);
        $this->nodeEyebrow = new TextInputNode($this->identifierEyebrow, $this->eyebrow);
        $this->nodeTitle = new TextInputNode($this->identifierTitle, $this->title);
        $this->nodeTeaser = new WysiwygNode($this->identifierTeaser, $this->teaser);
        $this->nodeShowCTA = new CheckboxNode($this->identifierShowCTA, [$this->showCTA]);
        $this->nodeHtmlId = new TextInputNode($this->identifierHtmlId, $this->htmlId);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'callout';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierHeadingLevel = 'heading-level';
        $this->identifierStickerId = 'sticker-id';
        $this->identifierEyebrow = 'eyebrow';
        $this->identifierTitle = 'title';
        $this->identifierTeaser = 'teaser';
        $this->identifierShowCTA = 'show-cta';
        $this->identifierHtmlId = 'id';
    }
}
