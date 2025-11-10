<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero;

use Edu\IU\RSB\StructuredDataNodes\Asset\LinkableNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\CheckboxNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\RSB\StructuredDataNodes\Text\WysiwygNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class HeroDefault implements ComponentInterface{

    use ComponentTraits;

    //content
    public string $eyebrow;
    public string $title;
    public string $teaser;
    public string $showCtas;
    public array $ctasArray;
    public string $showCalloutCard;
    public string $calloutEyebrow;
    public string $calloutTitle;
    public string $calloutTeaser;

    public string $calloutLinkType;
    public string $calloutLinkId;
    public string $calloutLinkPath;
    public string $calloutLinkParameters;

    //identifier
    public string $identifierEyebrow;
    public string $identifierTitle;
    public string $identifierTeaser;
    public string $identifierShowCtas;
    public string $identifierCta;
    public string $identifierCtaText;
    public string $identifierCtaLink;
    public string $identifierCtaLinkParameters;
    public string $identifierShowCalloutCard;
    public string $identifierCallout;
    public string $identifierCalloutEyebrow;
    public string $identifierCalloutTitle;
    public string $identifierCalloutTeaser;
    public string $identifierCalloutLink;
    public string $identifierCalloutLinkParameters;

    //node
    public TextInputNode $nodeEyebrow;
    public TextInputNode $nodeTitle;
    public WysiwygNode $nodeTeaser;
    public CheckboxNode $nodeShowCtas;
    public array $nodeCtaGroupNodesArray;
    public CheckboxNode $nodeShowCalloutCard;
    public GroupNode $nodeCalloutCard;



    public function __construct(string $eyebrow = '', string $title = '', string $teaser = '', string $showCtas = 'no', array $ctasArray = [], string $showCalloutCard = 'no', string $calloutEyebrow = '', string $calloutTitle = '', string $calloutTeaser = '', string $calloutLinkId = '', string $calloutLinkPath = '', string $calloutLinkType = '', string $calloutLinkParameters = '')
    {
        $this->eyebrow = $eyebrow;
        $this->title = $title;
        $this->teaser = $teaser;
        $this->showCtas = $showCtas;
        $this->ctasArray = $ctasArray;
        $this->showCalloutCard = $showCalloutCard;
        $this->calloutEyebrow = $calloutEyebrow;
        $this->calloutTitle = $calloutTitle;
        $this->calloutTeaser = $calloutTeaser;
        $this->calloutLinkType = $calloutLinkType;
        $this->calloutLinkId = $calloutLinkId;
        $this->calloutLinkPath = $calloutLinkPath;
        $this->calloutLinkParameters = $calloutLinkParameters;

        $this->finishConstructor();

    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeEyebrow);
        $groupNode->addChild($this->nodeTitle);
        $groupNode->addChild($this->nodeTeaser);
        $groupNode->addChild($this->nodeShowCtas);

        foreach ($this->nodeCtaGroupNodesArray as $nodeCtaGroupNode) {
            $groupNode->addChild($nodeCtaGroupNode);
        }
        $groupNode->addChild($this->nodeShowCalloutCard);

        $groupNode->addChild($this->nodeCalloutCard);


        return $groupNode;

    }

    public function constructChildrenNodes(): void
    {
        $this->nodeEyebrow = new TextInputNode($this->identifierEyebrow, $this->eyebrow);
        $this->nodeTitle = new TextInputNode($this->identifierTitle, $this->title);
        $this->nodeTeaser = new WysiwygNode($this->identifierTeaser, $this->teaser);
        $this->nodeShowCtas = new CheckboxNode($this->identifierShowCtas, [$this->showCtas]);
        $this->nodeShowCalloutCard = new CheckboxNode($this->identifierShowCalloutCard, [$this->showCalloutCard]);

        $this->nodeCtaGroupNodesArray = $this->constructCtaGroupNodesArray();
        $this->nodeCalloutCard = $this->constructCalloutCardGroupNode();


    }

    public function constructCtaGroupNodesArray():array
    {
        $result = [];
        foreach($this->ctasArray as $ctaInfo){
            $groupNode = new GroupNode($this->identifierCta);
            $groupNode->addChild(new TextInputNode($this->identifierCtaText, $ctaInfo[$this->identifierCtaText]));
            $groupNode->addChild(new LinkableNode($this->identifierCtaLink, $ctaInfo['linkId'], $ctaInfo['linkPath'], $ctaInfo['linkType']));
            $groupNode->addChild(new TextInputNode($this->identifierCtaLinkParameters, $ctaInfo[$this->identifierCtaLinkParameters]));
            $result[] = $groupNode;
        }

        return $result;
    }

    public function constructCalloutCardGroupNode():GroupNode
    {
        $groupNode = new GroupNode($this->identifierCallout);
        $groupNode->addChild(new TextInputNode($this->identifierCalloutEyebrow, $this->calloutEyebrow));
        $groupNode->addChild(new TextInputNode($this->identifierCalloutTitle, $this->calloutTitle));
        $groupNode->addChild(new WysiwygNode($this->identifierCalloutTeaser, $this->calloutTeaser));
        $groupNode->addChild(new LinkableNode($this->identifierCalloutLink, $this->calloutLinkId, $this->calloutLinkPath, $this->calloutLinkType));
        $groupNode->addChild(new TextInputNode($this->identifierCalloutLinkParameters, $this->calloutLinkParameters));

        return $groupNode;
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'hero';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierEyebrow = 'eyebrow';
        $this->identifierTitle = 'title';
        $this->identifierTeaser = 'teaser';
        $this->identifierShowCtas = 'show-ctas';
        $this->identifierCta = 'cta';
        $this->identifierCtaText = 'text';
        $this->identifierCtaLink = 'link';
        $this->identifierCtaLinkParameters = 'link-parameters';
        $this->identifierShowCalloutCard = 'show-callout-card';
        $this->identifierCallout = 'callout-card';
        $this->identifierCalloutEyebrow = 'eyebrow';
        $this->identifierCalloutTitle = 'title';
        $this->identifierCalloutTeaser = 'teaser';
        $this->identifierCalloutLink = 'link';
        $this->identifierCalloutLinkParameters = 'link-parameters';
    }
}
