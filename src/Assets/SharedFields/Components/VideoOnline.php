<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\Asset\FileNode;
use Edu\IU\RSB\StructuredDataNodes\Asset\SymlinkNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextNode;
use Edu\IU\RSB\StructuredDataNodes\Text\WysiwygNode;

class VideoOnline implements ComponentInterface{

    use ComponentTraits;

    //content
    public string $videoType;
    public string $headingLevel;
    public string $vttId;
    public string $vttPath;
    public string $descriptionsFileId;
    public string $descriptionsFilePath;
    public string $urlId;
    public string $urlPath;
    public string $videoIdDescribedId;
    public string $videoIdDescribedPath;
    public string $title;
    public string $transcript;
    public string $caption;

    //identifiers
    public readonly string $identifierVideoType;
    public readonly string $identifierHeadingLevel;
    public readonly string $identifierVtt;
    public readonly string $identifierDescriptionsFile;
    public readonly string $identifierUrl;
    public readonly string $identifierVideoIdDescribed;
    public readonly string $identifierTitle;
    public readonly string $identifierTranscript;
    public readonly string $identifierCaption;


    //nodes
    public DropdownNode $nodeHeadingLevel;
    public FileNode $nodeVtt;
    public FileNode $nodeDescriptionsFile;
    public SymlinkNode $nodeUrl;
    public SymlinkNode $nodeVideoIdDescribed;
    public TextInputNode $nodeTitle;
    public WysiwygNode $nodeTranscript;
    public WysiwygNode $nodeCaption;

    public function __construct(
        string $headingLevel = '2',
        string $vttId = '',
        string $vttPath = '',
        string $descriptionsFileId = '',
        string $descriptionsFilePath = '',
        string $title = '',
        string $transcript = '',
        string $caption = '',
    )
    {
        $this->videoType = 'online';
        $this->headingLevel = $headingLevel;
        $this->vttId = $vttId;
        $this->vttPath = $vttPath;
        $this->descriptionsFileId = $descriptionsFileId;
        $this->descriptionsFilePath = $descriptionsFilePath;
        $this->title = $title;
        $this->transcript = $transcript;
        $this->caption = $caption;

        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild(new DropdownNode($this->identifierVideoType, $this->videoType));
        $groupNode->addChild($this->nodeHeadingLevel);
        $groupNode->addChild($this->nodeVtt);
        $groupNode->addChild($this->nodeDescriptionsFile);
        $groupNode->addChild($this->nodeUrl);
        $groupNode->addChild($this->nodeVideoIdDescribed);
        $groupNode->addChild($this->nodeTitle);
        $groupNode->addChild($this->nodeTranscript);
        $groupNode->addChild($this->nodeCaption);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeHeadingLevel = new DropdownNode($this->identifierHeadingLevel, $this->headingLevel);
        $this->nodeVtt = new FileNode($this->identifierVtt, $this->vttId, $this->vttPath);
        $this->nodeDescriptionsFile = new FileNode($this->identifierDescriptionsFile, $this->descriptionsFileId, $this->descriptionsFilePath);
        $this->nodeUrl = new SymlinkNode($this->identifierUrl,$this->urlId, $this->urlPath);
        $this->nodeVideoIdDescribed = new SymlinkNode($this->identifierVideoIdDescribed, $this->videoIdDescribedId, $this->videoIdDescribedPath);
        $this->nodeTitle = new TextInputNode($this->identifierTitle, $this->title);
        $this->nodeTranscript = new WysiwygNode($this->identifierTranscript, $this->transcript);
        $this->nodeCaption = new WysiwygNode($this->identifierCaption, $this->caption);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'video';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierVideoType = 'video-type';
        $this->identifierHeadingLevel = 'heading-level';
        $this->identifierVtt = 'vtt';
        $this->identifierDescriptionsFile = 'descriptions-file';
        $this->identifierUrl = 'url';
        $this->identifierVideoIdDescribed = 'video-id-described';
        $this->identifierTitle = 'title';
        $this->identifierTranscript = 'transcript';
        $this->identifierCaption = 'caption';
    }
}
