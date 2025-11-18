<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\RSB\StructuredDataNodes\Text\WysiwygNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Image\ImageHub;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Image\SingleImage;

class ImageImageHub implements ComponentInterface{

    use ComponentTraits;

    //content
    public string $type;
    public ImageHub $imageHub;
    public string $caption;
    public string $attribution;
    public string $htmlId;

    //identifiers
    public readonly string $identifierType;
    public readonly string $identifierCaption;
    public readonly string $identifierAttribution;
    public readonly string $identifierHtmlId;

    //nodes
    public DropdownNode $nodeType;
    public WysiwygNode $nodeCaption;
    public TextInputNode $nodeAttribution;
    public TextInputNode $nodeHtmlId;

    public function __construct(ImageHub $imageHub, string $caption = '', string $attribution = '', string $htmlId = '')
    {
        $this->type = 'hub';
        $this->imageHub = $imageHub;
        $this->caption = $caption;
        $this->attribution = $attribution;
        $this->htmlId = $htmlId;
        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeType);
        $groupNode->addChild($this->imageHub->constructComponentGroupNode());
        $groupNode->addChild($this->nodeCaption);
        $groupNode->addChild($this->nodeAttribution);
        $groupNode->addChild($this->nodeHtmlId);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeType = new DropdownNode($this->identifierType, $this->type);
        $this->nodeCaption = new WysiwygNode($this->identifierCaption, $this->caption);
        $this->nodeAttribution = new TextInputNode($this->identifierAttribution, $this->attribution);
        $this->nodeHtmlId = new TextInputNode($this->identifierHtmlId, $this->htmlId);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'image';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierType = 'type';
        $this->identifierCaption = 'caption';
        $this->identifierAttribution = 'attribution';
        $this->identifierHtmlId = 'id';
    }
}
