<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\CheckboxNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Table\Header;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Table\Row;

class Table implements ComponentInterface{

    use ComponentTraits;

    //content
    public string $title;
    public string $showTitle;
    public array $variants;
    public Header $headerObj;
    public array $rowObjsArray;

    //identifiers
    public readonly string $identifierTitle;
    public readonly string $identifierShowTitle;
    public readonly string $identifierVariants;

    //nodes
    public TextInputNode $nodeTitle;
    public CheckboxNode $nodeShowTitle;
    public CheckboxNode $nodeVariants;

    public function __construct(string $title = '', string $showTitle = '', array $variants = [], ?Header $headerObj = null , array $rowObjsArray = [])
    {
        $this->title = $title;
        $this->showTitle = $showTitle;
        $this->variants = $variants;
        $this->headerObj = $headerObj;
        $this->rowObjsArray = $rowObjsArray;

        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeTitle);
        $groupNode->addChild($this->nodeShowTitle);
        $groupNode->addChild($this->nodeVariants);
        $groupNode->addChild($this->headerObj->constructComponentGroupNode());

        foreach ($this->rowObjsArray as $rowObj) {
            if ($rowObj instanceof Row){
                $groupNode->addChild($rowObj->constructComponentGroupNode());
            }
        }

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeTitle = new TextInputNode($this->identifierTitle, $this->title);
        $this->nodeShowTitle = new CheckboxNode($this->identifierShowTitle, [$this->showTitle]);
        $this->nodeVariants = new CheckboxNode($this->identifierVariants, [$this->variants]);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'table';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierTitle = 'title';
        $this->identifierShowTitle = 'show-title';
        $this->identifierVariants = 'variants';
    }
}
