<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\CheckboxNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\RSB\StructuredDataNodes\Text\RadioNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\RSB\StructuredDataNodes\Text\WysiwygNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Statement\CTA;

class Statement implements ComponentInterface{
    use ComponentTraits;

    //content
    public string $headingLevel;
    public string $title;
    public string $eyebrow;
    public string $teaser;
    public string $showCTAs;
    public string $alignment;
    public array $ctaObjsArray;

    //identifiers
    public readonly string $identifierHeadingLevel;
    public readonly string $identifierTitle;
    public readonly string $identifierEyebrow;
    public readonly string $identifierTeaser;
    public readonly string $identifierShowCTAs;
    public readonly string $identifierAlignment;

    //nodes
    public DropdownNode $nodeHeadingLevel;
    public TextInputNode $nodeTitle;
    public TextInputNode $nodeEyebrow;
    public WysiwygNode $nodeTeaser;
    public CheckboxNode $nodeShowCTAs;
    public RadioNode $nodeAlignment;

    public function __construct(string $headingLevel = 'h2', string $title = '', string $eyebrow = '', string $teaser = '', string $showCTAs = '', string $alignment = 'left', array $ctaObjsArray = [])
    {
        $this->headingLevel = $headingLevel;
        $this->title = $title;
        $this->eyebrow = $eyebrow;
        $this->teaser = $teaser;
        $this->showCTAs = $showCTAs;
        $this->alignment = $alignment;
        $this->ctaObjsArray = $ctaObjsArray;

        $this->finishConstructor();

    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeHeadingLevel);
        $groupNode->addChild($this->nodeTitle);
        $groupNode->addChild($this->nodeEyebrow);
        $groupNode->addChild($this->nodeTeaser);
        $groupNode->addChild($this->nodeShowCTAs);
        foreach ($this->ctaObjsArray as $ctaObj) {
            if ($ctaObj instanceof CTA){
                $groupNode->addChild($ctaObj->constructComponentGroupNode());
            }
        }
        $groupNode->addChild($this->nodeAlignment);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeHeadingLevel = new DropdownNode($this->identifierHeadingLevel, $this->headingLevel);
        $this->nodeTitle = new TextInputNode($this->identifierTitle, $this->title);
        $this->nodeEyebrow = new TextInputNode($this->identifierEyebrow, $this->eyebrow);
        $this->nodeTeaser = new WysiwygNode($this->identifierTeaser, $this->teaser);
        $this->nodeShowCTAs = new CheckboxNode($this->identifierShowCTAs, [$this->showCTAs]);
        $this->nodeAlignment = new RadioNode($this->identifierAlignment, $this->alignment);

    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'statement';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierHeadingLevel = 'heading-level';
        $this->identifierTitle = 'title';
        $this->identifierEyebrow = 'eyebrow';
        $this->identifierTeaser = 'teaser';
        $this->identifierShowCTAs = 'show-ctas';
        $this->identifierAlignment = 'alignment';    }
}