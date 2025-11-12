<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Traits;


trait PageWithSideNavTraits{

    public string $hideSidebarNavigation;


    public function setHideSidebarNavigation(string $hideSidebarNavigation): void
    {
        $this->hideSidebarNavigation = $hideSidebarNavigation;
    }
}