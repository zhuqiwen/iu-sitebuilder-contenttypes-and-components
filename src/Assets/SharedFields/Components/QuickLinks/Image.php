<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\QuickLinks;


use Edu\IU\RSB\StructuredDataNodes\Asset\FileNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\RSB\StructuredDataNodes\Text\WysiwygNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class Image implements ComponentInterface {
    use ComponentTraits;

    //content
    public string $imageId;
    public string $imagePath;
    public string $alt;
    public string $caption;
    public string $attribution;

    //identifiers
    public readonly string $identifierImage;
    public readonly string $identifierAlt;
    public readonly string $identifierCaption;
    public readonly string $identifierAttribution;

    //nodes
    public FileNode $nodeImage;
    public TextInputNode $nodeAlt;
    public WysiwygNode $nodeCaption;
    public TextInputNode $nodeAttribution;

    public function __construct(string $imageId = '', string $imagePath = '', string $alt = '', string $caption = '', string $attribution = '')
    {
        $this->imageId = $imageId;
        $this->imagePath = $imagePath;
        $this->alt = $alt;
        $this->caption = $caption;
        $this->attribution = $attribution;

        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeImage);
        $groupNode->addChild($this->nodeAlt);
        $groupNode->addChild($this->nodeCaption);
        $groupNode->addChild($this->attribution);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeImage = new FileNode($this->identifierImage, $this->imageId, $this->imagePath);
        $this->nodeAlt = new TextInputNode($this->identifierAlt, $this->alt);
        $this->nodeCaption = new WysiwygNode($this->identifierCaption, $this->caption);
        $this->nodeAttribution = new TextInputNode($this->identifierAttribution, $this->attribution);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'single-image';
    }


    public function setChildrenIdentifiers(): void
    {
        $this->identifierImage = 'image';
        $this->identifierAlt = 'alt';
        $this->identifierCaption = 'caption';
        $this->identifierAttribution = 'attribution';
    }
}