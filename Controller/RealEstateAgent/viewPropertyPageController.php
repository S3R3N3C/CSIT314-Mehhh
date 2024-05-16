<?php
include_once("../../Entity/propertyListing.php");

class viewPropertyPageController
{
    public function viewPropertyPage($property_id): array
    {
        $vap = new propertyListing();
        $results = $vap->viewPropertyPage($property_id);
        return $results;
    }
}