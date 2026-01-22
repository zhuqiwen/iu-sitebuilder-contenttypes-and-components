<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Profile;


use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class ProfileInformation implements ComponentInterface{
    use ComponentTraits;

    //content
    public readonly string $phone;
    public readonly string $email;
    public readonly string $location;
    public readonly string $officeHours;
    public readonly string $pronouns;
    public array $socialMediaChannelsArray;

    //identifiers
    public readonly string $identifierPhone;
    public readonly string $identifierEmail;
    public readonly string $identifierLocation;
    public readonly string $identifierOfficeHours;
    public readonly string $identifierPronouns;


    //nodes
    public TextInputNode $nodePhone;
    public TextInputNode $nodeEmail;
    public TextInputNode $nodeLocation;
    public TextInputNode $nodeOfficeHours;
    public TextInputNode $nodePronouns;

    public function __construct(string $phone = '', string $email = '', string $location = '', string $officeHours = '', string $pronouns = '', array $socialMediaChannelsArray = [])
    {
        $this->phone = $phone;
        $this->email = $email;
        $this->location = $location;
        $this->officeHours = $officeHours;
        $this->pronouns = $pronouns;
        $this->socialMediaChannelsArray = $socialMediaChannelsArray;

        $this->finishConstructor();
    }

    /**
     * @return GroupNode
     */
    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodePhone);
        $groupNode->addChild($this->nodeEmail);
        $groupNode->addChild($this->nodeLocation);
        $groupNode->addChild($this->nodeOfficeHours);
        $groupNode->addChild($this->nodePronouns);
        foreach ($this->socialMediaChannelsArray as $socialMediaChannel) {
            if ($socialMediaChannel instanceof SocialMedia){
                $groupNode->addChild($socialMediaChannel->constructComponentGroupNode());
            }
        }


        return $groupNode;
    }

    /**
     * @return void
     */
    public function constructChildrenNodes(): void
    {
        $this->nodePhone = new TextInputNode($this->identifierPhone, $this->phone);
        $this->nodeEmail = new TextInputNode($this->identifierEmail, $this->email);
        $this->nodeLocation = new TextInputNode($this->identifierLocation, $this->location);
        $this->nodeOfficeHours = new TextInputNode($this->identifierOfficeHours, $this->officeHours);
        $this->nodePronouns = new TextInputNode($this->identifierPronouns);
    }

    /**
     * @return void
     */
    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'information';
    }

    /**
     * @return void
     */
    public function setChildrenIdentifiers(): void
    {
        $this->identifierPhone = 'phone';
        $this->identifierEmail = 'email';
        $this->identifierLocation = 'location';
        $this->identifierOfficeHours = 'office-hours';
        $this->identifierPronouns = 'pronouns';
    }
}