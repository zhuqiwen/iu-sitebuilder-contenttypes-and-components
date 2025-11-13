<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\QuickLinks;


use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\CheckboxNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\RSB\StructuredDataNodes\Text\WysiwygNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class SectionIntro implements ComponentInterface{
    use ComponentTraits;

    //content
    public string $headingLevel;
    public string $title;
    public string $eyebrow;
    public string $teaser;
    public string $showCTAs;
    public array $ctaItemsArray;

    //identifiers
    public string $identifierHeadingLevel;
    public string $identifierTitle;
    public string $identifierEyebrow;
    public string $identifierTeaser;
    public string $identifierShowCTAs;


    //nodes
    public DropdownNode $nodeHeadingLevel;
    public TextInputNode $nodeTitle;
    public TextInputNode $nodeEyebrow;
    public WysiwygNode $nodeTeaser;
    public CheckboxNode $nodeShowCTAs;

    public function __construct(string $headingLevel = '', string $title = '', string $eyebrow = '', string $teaser = '', string $showCTAs = '', array $ctaItemsArray = [])
    {
        $this->headingLevel = $headingLevel;
        $this->title = $title;
        $this->eyebrow = $eyebrow;
        $this->teaser = $teaser;
        $this->showCTAs = $showCTAs;
        $this->ctaItemsArray = $ctaItemsArray;

        $this->finishConstructor();;
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeHeadingLevel);
        $groupNode->addChild($this->nodeTitle);
        $groupNode->addChild($this->nodeEyebrow);
        $groupNode->addChild($this->nodeTeaser);
        $groupNode->addChild($this->nodeShowCTAs);
        foreach ($this->ctaItemsArray as $ctaItem) {
            if (get_class($ctaItem) === CTA::class) {
                $groupNode->addChild($ctaItem->constructComponentGroupNode());
            }

        }

        return $groupNode;
    }
    public function constructChildrenNodes(): void
    {
        $this->nodeHeadingLevel = new DropdownNode($this->identifierHeadingLevel, $this->headingLevel);
        $this->nodeTitle = new TextInputNode($this->identifierTitle, $this->title);
        $this->nodeEyebrow = new TextInputNode($this->identifierEyebrow, $this->eyebrow);
        $this->nodeTeaser = new WysiwygNode($this->identifierTeaser, $this->teaser);
        $this->nodeShowCTAs = new CheckboxNode($this->identifierShowCTAs, [$this->showCTAs]);
        //cta items should be constructed outside and passed in here via constructor
    }
    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'section-intro';
    }
    public function setChildrenIdentifiers(): void
    {
        $this->identifierHeadingLevel = 'heading-level';
        $this->identifierTitle = 'title';
        $this->identifierEyebrow = 'eyebrow';
        $this->identifierTeaser = 'teaser';
        $this->identifierShowCTAs = 'show-ctas';

    }
}