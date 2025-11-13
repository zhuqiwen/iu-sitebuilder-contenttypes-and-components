<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\QuickLinks\QuickLinksListHubInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\QuickLinks\SectionIntro;

class QuickLinksWithShortIntro implements ComponentInterface{

    use ComponentTraits;

    //content
    public string $introductionType;
    public SectionIntro $sectionIntro;
    public QuickLinksListHubInterface $listHub;


    //identifiers
    public readonly string $identifierIntroductionType;

    //nodes
    public DropdownNode $nodeIntroductionType;


    public function __construct(SectionIntro $sectionIntro, QuickLinksListHubInterface $listHub)
    {
        $this->introductionType = 'section-intro';
        $this->sectionIntro = $sectionIntro;
        $this->listHub = $listHub;

        $this->finishConstructor();

    }


    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeIntroductionType);
        $groupNode->addChild($this->sectionIntro->constructComponentGroupNode());
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
