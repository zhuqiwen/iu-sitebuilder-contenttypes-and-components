<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\RSB\StructuredDataNodes\Text\WysiwygNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Billboard\CTA;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Billboard\Media;

class Billboard implements ComponentInterface{

    use ComponentTraits;
    //content
    public string $headingLevel;
    public string $alignment;
    public string $title;
    public string $eyebrow;
    public string $teaser;
    public array $ctasArray;
    public Media $media;

    //identifiers
    public readonly string $identifierHeadingLevel;
    public readonly string $identifierAlignment;
    public readonly string $identifierTitle;
    public readonly string $identifierEyebrow;
    public readonly string $identifierTeaser;


    //nodes
    public DropdownNode $nodeHeadingLevel;
    public DropdownNode $nodeAlignment;
    public TextInputNode $nodeTitle;
    public TextInputNode $nodeEyebrow;
    public WysiwygNode $nodeTeaser;

    public function __construct(
        string $headingLevel = 'h2',
        string $alignment = 'left',
        string $title = '',
        string $eyebrow = '',
        string $teaser = '',
        array $ctasArray = [],
        ?Media $media = null
    )
    {
        $this->headingLevel = $headingLevel;
        $this->alignment = $alignment;
        $this->title = $title;
        $this->eyebrow = $eyebrow;
        $this->teaser = $teaser;
        $this->ctasArray = $ctasArray;
        $this->media = $media;

        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeHeadingLevel);
        $groupNode->addChild($this->nodeAlignment);
        $groupNode->addChild($this->nodeTitle);
        $groupNode->addChild($this->nodeEyebrow);
        $groupNode->addChild($this->nodeTeaser);
        foreach ($this->ctasArray as $cta) {
            if ($cta instanceof CTA) {
                $groupNode->addChild($cta->constructComponentGroupNode());
            }
        }
        $groupNode->addChild($this->media->constructComponentGroupNode());

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeHeadingLevel = new DropdownNode($this->identifierHeadingLevel, $this->headingLevel);
        $this->nodeAlignment = new DropdownNode($this->identifierAlignment, $this->alignment);
        $this->nodeTitle = new TextInputNode($this->identifierTitle, $this->title);
        $this->nodeEyebrow = new TextInputNode($this->identifierEyebrow, $this->eyebrow);
        $this->nodeTeaser = new WysiwygNode($this->identifierTeaser, $this->teaser);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'billboard';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierHeadingLevel = 'heading-level';
        $this->identifierAlignment = 'alignment';
        $this->identifierTitle = 'title';
        $this->identifierEyebrow = 'eyebrow';
        $this->identifierTeaser = 'teaser';
    }
}
