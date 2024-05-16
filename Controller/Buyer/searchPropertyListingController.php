<?php
include_once("../../Entity/propertyListing.php");

class searchPropertyListingController
{
    public function searchPropertyListing($search): array
    {
        $s = new PropertyListing();
        $propertyListings = $s->searchPropertyListing($search);
        return $propertyListings;
    }
}
?>