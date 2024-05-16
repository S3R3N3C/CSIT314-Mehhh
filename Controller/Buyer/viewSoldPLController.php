<?php
include_once("../../Entity/propertyListing.php");

class viewSoldPLController
{
    public function viewSoldPL(): array
    {
        $vpl = new propertyListing();
        $propertyListings = $vpl->viewSoldPL();
        return $propertyListings;
    }

    public function incrementPropertyViews($property_id): void
    {
        $vpl = new propertyListing();
        $vpl->incrementPropertyViews($property_id);
    }

    public function incrementNoOfShort($property_id): void
    {
        $vpl = new propertyListing();
        $vpl->incrementNoOfShort($property_id);
    }
    
    public function viewPropertyPage($property_id): array
    {
        $vap = new propertyListing();
        $results = $vap->viewPropertyPage($property_id);
        return $results;
    }

}