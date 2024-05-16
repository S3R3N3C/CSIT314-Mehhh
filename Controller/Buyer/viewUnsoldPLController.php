<?php
include_once("../../Entity/propertyListing.php");

class viewUnsoldPLController
{
    public function viewUnsoldPL(): array
    {
        $vpl = new propertyListing();
        $propertyListings = $vpl->viewUnsoldPL();
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