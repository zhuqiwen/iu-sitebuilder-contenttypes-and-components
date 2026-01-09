<?php


namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero\HeroFeature;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero\HeroInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero\HeroTraits;
use SebastianBergmann\CodeCoverage\Report\Text;

class ListHub implements ComponentInterface, HeroInterface{

    use ComponentTraits;
    use HeroTraits;

    //contents
    public string $title;
    public string $headingLevel;
    public string $id;
    public array $listItemsArray;
    //identifiers
    public readonly string $identifierTitle;
    public readonly string $identifierHeadingLevel;
    public readonly string $identifierId;

    //nodes
    public TextInputNode $nodeTitle;
    public DropdownNode $nodeHeadingLevel;
    public TextInputNode $nodeId;


    public function __construct(string $title = '', array $listItemsArray = [], string $headingLevel = '', string $id = '')
    {
        $this->title = $title;
        $this->listItemsArray = $listItemsArray;
        $this->headingLevel = $headingLevel;
        $this->id = $id;

        $this->finishConstructor();
    }

    /**
     * @return GroupNode
     */
    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeTitle);
        $groupNode->addChild($this->nodeHeadingLevel);
        $groupNode->addChild($this->nodeId);
        foreach ($this->listItemsArray as $listItem) {
            if ($listItem instanceof  ListItem){
                $groupNode->addChild($listItem->constructComponentGroupNode());
            }
        }

        return $groupNode;
    }

    /**
     * @return void
     */
    public function constructChildrenNodes(): void
    {
        $this->nodeTitle = new TextInputNode($this->identifierTitle, $this->title);
        $this->nodeHeadingLevel = new DropdownNode($this->identifierHeadingLevel, $this->headingLevel);
        $this->nodeId = new TextInputNode($this->identifierId);
    }

    /**
     * @return void
     */
    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'list-item';
    }

    /**
     * @return void
     */
    public function setChildrenIdentifiers(): void
    {
        $this->identifierTitle = 'title';
        $this->identifierHeadingLevel = 'heading-level';
        $this->identifierId = 'id';
    }
}