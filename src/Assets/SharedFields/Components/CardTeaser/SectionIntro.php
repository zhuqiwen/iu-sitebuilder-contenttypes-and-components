<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\CardTeaser;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\CheckboxNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\RSB\StructuredDataNodes\Text\RadioNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\RSB\StructuredDataNodes\Text\WysiwygNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Statement\CTA;

class SectionIntro implements ComponentInterface {

    use ComponentTraits;

    //content
    public string $alignment;
    public string $headingLevel;
    public string $title;
    public string $eyebrow;
    public string $teaser;
    public string $showCTAs;
    public array $sectionIntroCTAObjsArray;

    //identifiers
    public readonly string $identifierAlignment;
    public readonly string $identifierHeadingLevel;
    public readonly string $identifierTitle;
    public readonly string $identifierEyebrow;
    public readonly string $identifierTeaser;
    public readonly string $identifierShowCTAs;


    //nodes
    public RadioNode $nodeAlignment;
    public DropdownNode $nodeHeadingLevel;
    public TextInputNode $nodeTitle;
    public TextInputNode $nodeEyebrow;
    public WysiwygNode $nodeTeaser;
    public CheckboxNode $nodeShowCTAs;

    public function __construct(string $alignment = 'center', string $headingLevel = 'h2', string $title = '', string $eyebrow = '', string $teaser = '', string $showCTAs = '', array $ctasArray = [])
    {
        $this->alignment = $alignment;
        $this->headingLevel = $headingLevel;
        $this->title = $title;
        $this->eyebrow = $eyebrow;
        $this->teaser = $teaser;
        $this->showCTAs = $showCTAs;
        $this->sectionIntroCTAObjsArray = $ctasArray;
        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeAlignment);
        $groupNode->addChild($this->nodeHeadingLevel);
        $groupNode->addChild($this->nodeTitle);
        $groupNode->addChild($this->nodeEyebrow);
        $groupNode->addChild($this->nodeTeaser);
        $groupNode->addChild($this->nodeShowCTAs);
        foreach ($this->sectionIntroCTAObjsArray as $sectionIntroCTAObj) {
            if ($sectionIntroCTAObj instanceof SectionIntroCTA) {
                $groupNode->addChild($sectionIntroCTAObj->constructComponentGroupNode());
            }
        }

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeAlignment = new RadioNode($this->identifierAlignment, $this->alignment);
        $this->nodeHeadingLevel = new DropdownNode($this->identifierHeadingLevel, $this->headingLevel);
        $this->nodeTitle = new TextInputNode($this->identifierTitle, $this->title);
        $this->nodeEyebrow = new TextInputNode($this->identifierEyebrow, $this->eyebrow);
        $this->nodeTeaser = new WysiwygNode($this->identifierTeaser, $this->teaser);
        $this->nodeShowCTAs = new CheckboxNode($this->identifierShowCTAs, [$this->showCTAs]);

    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'section-intro';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierAlignment = 'alignment';
        $this->headingLevel = 'heading-level';
        $this->title = 'title';
        $this->eyebrow = 'eyebrow';
        $this->teaser = 'teaser';
        $this->showCTAs = 'show-ctas';
    }
}
