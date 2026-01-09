<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\CheckboxNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero\HeroFeature\CTA;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero\HeroFeature\HeroBanner;

class HeroFeature implements ComponentInterface, HeroInterface {

    use ComponentTraits;
    use HeroTraits;

    //content
    public string $showCTAs;
    public string $showHeroBanner;
    public array $ctasArray;
    public ?HeroBanner $banner;

    //identifiers
    public readonly string $identifierShowCTAs;
    public readonly string $identifierShowHeroBanner;

    //nodes
    public CheckboxNode $nodeShowCTAs;
    public CheckboxNode $nodeShowBanner;


    public function __construct(string $showCTAs = '', array $ctasArray = [], string $showHeroBanner = '', ?HeroBanner $banner = null)
    {
        $this->showCTAs = $showCTAs;
        $this->ctasArray = $ctasArray;
        $this->showHeroBanner = $showHeroBanner;
        $this->banner = $banner;

        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeShowCTAs);
        $groupNode->addChild($this->nodeShowBanner);
        $groupNode->addChild($this->banner->constructComponentGroupNode());
        foreach ($this->ctasArray as $cta) {
            if ($cta instanceof CTA){
                $groupNode->addChild($cta->constructComponentGroupNode());
            }
        }

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeShowCTAs = new CheckboxNode($this->identifierShowCTAs, [$this->showCTAs]);
        $this->nodeShowBanner = new CheckboxNode($this->identifierShowHeroBanner, [$this->showHeroBanner]);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'hero-feature';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierShowCTAs = 'show-ctas';
        $this->identifierShowHeroBanner = 'show-banner';
    }
}
