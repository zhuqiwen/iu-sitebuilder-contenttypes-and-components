<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Accordion\Panel;

class Accordion implements ComponentInterface{

    use ComponentTraits;

    //content
    public array $panelsArray;
    public string $headingLevel;
    public string $htmlId;

    //identifiers
    public string $identifierHeadingLevel;
    public string $identifierHtmlId;

    //nodes
    public DropdownNode $nodeHeadingLevel;
    public TextInputNode $nodeHtmlId;

    public function __construct(array $panelsArray = [], string $headingLevel = '', string $htmlId = '')
    {
        $this->panelsArray = $panelsArray;
        $this->headingLevel = $headingLevel;
        $this->htmlId = $htmlId;
        $this->finishConstructor();
    }

    /**
     * @return GroupNode
     */
    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        foreach($this->panelsArray as $panel){
            if ($panel instanceof Panel){
                $groupNode->addChild($panel->constructComponentGroupNode());
            }
        }

        $groupNode->addChild($this->nodeHeadingLevel);
        $groupNode->addChild($this->nodeHtmlId);

        return $groupNode;
    }

    /**
     * @return void
     */
    public function constructChildrenNodes(): void
    {
        $this->nodeHeadingLevel = new DropdownNode($this->identifierHeadingLevel, $this->headingLevel);
        $this->nodeHtmlId = new TextInputNode($this->identifierHtmlId, $this->htmlId);
    }

    /**
     * @return void
     */
    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'accordion';
    }

    /**
     * @return void
     */
    public function setChildrenIdentifiers(): void
    {
        $this->identifierHeadingLevel = 'heading-level';
        $this->identifierHtmlId = 'id';
    }
}
