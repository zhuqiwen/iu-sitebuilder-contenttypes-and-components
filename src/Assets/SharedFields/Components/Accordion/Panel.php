<?php


namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Accordion;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\CheckboxNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\RSB\StructuredDataNodes\Text\WysiwygNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class Panel implements ComponentInterface{

    use ComponentTraits;

    //content
    public string $open;
    public string $title;
    public string $content;

    //identifiers
    public string $identifierOpen;
    public string $identifierTitle;
    public string $identifierContent;


    //nodes
    public CheckboxNode $nodeOpen;
    public TextInputNode $nodeTitle;
    public WysiwygNode $nodeContent;




    public function __construct(string $open = '', string $title = '', string $content = '')
    {
        $this->open = $open;
        $this->title = $title;
        $this->content = $content;
        $this->finishConstructor();
    }


    /**
     * @return GroupNode
     */
    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeOpen);
        $groupNode->addChild($this->nodeTitle);
        $groupNode->addChild($this->nodeContent);

        return $groupNode;
    }

    /**
     * @return void
     */
    public function constructChildrenNodes(): void
    {
        $this->nodeOpen = new CheckboxNode($this->identifierOpen, [$this->open]);
        $this->nodeTitle = new TextInputNode($this->identifierTitle, $this->title);
        $this->nodeContent = new WysiwygNode($this->identifierContent, $this->content);
    }

    /**
     * @return void
     */
    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'panel';
    }

    /**
     * @return void
     */
    public function setChildrenIdentifiers(): void
    {
        $this->identifierOpen = 'open';
        $this->identifierTitle = 'title';
        $this->identifierContent = 'content';
    }
}
