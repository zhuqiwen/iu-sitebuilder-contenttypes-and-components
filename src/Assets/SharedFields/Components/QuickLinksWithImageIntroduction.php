<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\QuickLinks\QuickLinksListHubInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\QuickLinks\Image;

class QuickLinksWithImageIntroduction implements ComponentInterface{

    use ComponentTraits;

    //content
    public string $introductionType;
    public Image $image;
    public QuickLinksListHubInterface $listHub;


    //identifiers
    public readonly string $identifierIntroductionType;

    //nodes
    public DropdownNode $nodeIntroductionType;


    public function __construct(Image $image, QuickLinksListHubInterface $listHub)
    {
        $this->introductionType = 'image';
        $this->image = $image;
        $this->listHub = $listHub;

        $this->finishConstructor();

    }


    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeIntroductionType);
        $groupNode->addChild($this->image->constructComponentGroupNode());
        $groupNode->addChild($this->listHub->constructComponentGroupNode());

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeIntroductionType = new DropdownNode($this->identifierIntroductionType, $this->introductionType);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'quick-links';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierIntroductionType = 'intro-type';
    }
}
