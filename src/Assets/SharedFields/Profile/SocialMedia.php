<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Profile;


use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class SocialMedia implements ComponentInterface{
    use ComponentTraits;

    //contents
    public readonly string $site;
    public readonly string $url;


    //identifiers
    public readonly string $identifierSite;
    public readonly string $identifierUrl;

    //nodes
    public DropdownNode $nodeSite;
    public TextInputNode $nodeUrl;

    public function __construct(string $site = '', string $url = '')
    {
        $this->site = $site;
        $this->url = $url;

        $this->finishConstructor();
    }


    /**
     * @return GroupNode
     */
    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeSite);
        $groupNode->addChild($this->nodeUrl);

        return $groupNode;
    }

    /**
     * @return void
     */
    public function constructChildrenNodes(): void
    {
        $this->nodeSite = new DropdownNode($this->identifierSite, $this->site);
        $this->nodeUrl = new TextInputNode($this->identifierUrl, $this->url);
    }

    /**
     * @return void
     */
    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'social-media-channel';
    }

    /**
     * @return void
     */
    public function setChildrenIdentifiers(): void
    {
        $this->identifierSite = 'site';
        $this->identifierUrl = 'url';
    }
}