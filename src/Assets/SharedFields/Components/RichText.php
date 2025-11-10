<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\RSB\StructuredDataNodes\Text\WysiwygNode;

class RichText implements ComponentInterface{

    use ComponentTraits;

    public string $heading;
    public string $text;
    public string $headingLevel;
    public string $htmlId;

    public readonly string $identifierHeading;
    public readonly string $identifierHeadingLevel;
    public readonly string $identifierText;
    public readonly string $identifierHtmlId;

    public TextInputNode $nodeHeading;
    public DropdownNode $nodeHeadingLevel;
    public WysiwygNode $nodeText;
    public TextInputNode $nodeHtmlId;

    public function __construct(string $heading = '', string $headingLevel = 'h2', string $text = 'some default text', string $htmlId = '')
    {


        $this->heading = $heading;
        $this->headingLevel = $headingLevel;
        $this->htmlId = $htmlId;
        $this->text = $text;

        $this->finishConstructor();

    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierHeading = 'heading';
        $this->identifierHeadingLevel = 'heading-level';
        $this->identifierText = 'text';
        $this->identifierHtmlId = 'id';
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'rich-text';
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeHeading = new TextInputNode($this->identifierHeading, $this->heading);
        $this->nodeHeadingLevel = new DropdownNode($this->identifierHeadingLevel, $this->headingLevel);
        $this->nodeText = new WysiwygNode($this->identifierText, $this->text);
        $this->nodeHtmlId = new TextInputNode($this->identifierHtmlId, $this->htmlId);
    }

    public function constructComponentGroupNode(): GroupNode
    {


        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeHeading);
        $groupNode->addChild($this->nodeHeadingLevel);
        $groupNode->addChild($this->nodeText);
        $groupNode->addChild($this->nodeHtmlId);


        return $groupNode;
    }
}
