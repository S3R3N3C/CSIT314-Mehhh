<?php
include_once("../../Entity/propertyListing.php");

class searchSoldPLController
{
    public function searchSoldPL($search): array
    {
        $s = new propertyListing();
        $propertyListings = $s->searchSoldPL($search);
        return $propertyListings;
    }
}
?>