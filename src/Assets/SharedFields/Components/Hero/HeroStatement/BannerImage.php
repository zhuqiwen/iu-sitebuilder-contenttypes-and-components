<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero\HeroStatement;

use Edu\IU\RSB\StructuredDataNodes\Asset\FileNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero\HeroInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero\HeroTraits;

class BannerImage implements ComponentInterface, HeroInterface {
    use ComponentTraits;
    use HeroTraits;
    //content
    public string $imageId;
    public string $imagePath;
    public string $smallImageId;
    public string $smallImagePath;
    public string $alt;
    //identifiers

    public readonly string $identifierImage;
    public readonly string $identifierSmallImage;
    public readonly string $identifierAlt;

    //nodes

    public FileNode $nodeImage;
    public FileNode $nodeSmallImage;
    public TextInputNode $nodeAlt;





    public function __construct(string $imageId = '', string $imagePath = '', string $smallImageId = '', string $smallImagePath = '', string $alt = '')
    {
        $this->imageId = $imageId;
        $this->imagePath = $imagePath;
        $this->smallImageId = $smallImageId;
        $this->smallImagePath = $smallImagePath;
        $this->alt = $alt;

        $this->finishConstructor();;
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeImage);
        $groupNode->addChild($this->nodeSmallImage);
        $groupNode->addChild($this->nodeAlt);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeImage = new FileNode($this->identifierImage, $this->imageId, $this->imagePath);
        $this->nodeSmallImage = new FileNode($this->identifierSmallImage, $this->smallImageId, $this->smallImagePath);
        $this->nodeAlt = new TextInputNode($this->identifierAlt, $this->alt);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'banner-image';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierImage = 'image';
        $this->identifierSmallImage = 'small-image';
        $this->identifierAlt = 'alt';
    }
}
