<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\Asset\FileNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\RSB\StructuredDataNodes\Text\WysiwygNode;

class Audio implements ComponentInterface{

    use ComponentTraits;

    //content
    public string $mp3Id;
    public string $mp3Path;
    public string $vttId;
    public string $vttPath;

    public string $headingLevel;
    public string $caption;
    public string $attribution;
    public string $transcript;
    public string $htmlId;

    //identifiers
    public readonly string $identifierMp3;
    public readonly string $identifierVtt;
    public readonly string $identifierHeadingLevel;
    public readonly string $identifierCaption;
    public readonly string $identifierAttribution;
    public readonly string $identifierTranscript;
    public readonly string $identifierHtmlId;

    //nodes
    public FileNode $nodeMp3;
    public FileNode $nodeVtt;
    public DropdownNode $nodeHeadingLevel;
    public WysiwygNode $nodeCaption;
    public TextInputNode $nodeAttribution;
    public WysiwygNode $nodeTranscript;
    public TextInputNode $nodeHtmlId;


    public function __construct(string $mp3Id = '', string $mp3Path = '', string $vttId = '', string $vttPath = '', string $headingLevel = '', string $caption = '', string $attribution = '', string $transcript = '', string $htmlId = '')
    {

        $this->mp3Id = $mp3Id;
        $this->mp3Path = $mp3Path;
        $this->vttId = $vttId;
        $this->vttPath = $vttPath;
        $this->headingLevel = $headingLevel;
        $this->caption = $caption;
        $this->attribution = $attribution;
        $this->transcript = $transcript;
        $this->htmlId = $htmlId;


        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeMp3);
        $groupNode->addChild($this->nodeVtt);
        $groupNode->addChild($this->nodeHeadingLevel);
        $groupNode->addChild($this->nodeCaption);
        $groupNode->addChild($this->nodeAttribution);
        $groupNode->addChild($this->nodeTranscript);
        $groupNode->addChild($this->nodeHtmlId);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeMp3 = new FileNode($this->identifierMp3, $this->mp3Id, $this->mp3Path);
        $this->nodeVtt = new FileNode($this->identifierVtt, $this->vttId, $this->vttPath);
        $this->nodeHeadingLevel = new DropdownNode($this->identifierHeadingLevel, $this->headingLevel);
        $this->nodeCaption = new WysiwygNode($this->identifierCaption, $this->caption);
        $this->nodeAttribution = new TextInputNode($this->identifierAttribution, $this->attribution);
        $this->nodeTranscript = new WysiwygNode($this->identifierTranscript, $this->transcript);
        $this->nodeHtmlId = new TextInputNode($this->identifierHtmlId, $this->htmlId);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'audio';
    }


    public function setChildrenIdentifiers(): void
    {
        $this->identifierMp3 = 'mp3';
        $this->identifierVtt = 'vtt';
        $this->identifierHeadingLevel = 'heading-level';
        $this->identifierCaption = 'caption';
        $this->identifierAttribution = 'attribution';
        $this->identifierTranscript = 'transcript';
        $this->identifierHtmlId = 'id';
    }
}
