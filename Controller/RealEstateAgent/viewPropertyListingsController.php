<?php
include_once("../../Entity/propertyListing.php");

class viewPropertyListingsController
{
    public function viewPropertyListings(): array
    {
        $vpl = new propertyListing();
        $propertyListings = $vpl->viewPropertyListings();
        return $propertyListings;
    }

    public function viewPropertyPage($property_id): array
    {
        $vap = new propertyListing();
        $results = $vap->viewPropertyPage($property_id);
        return $results;
    }
}