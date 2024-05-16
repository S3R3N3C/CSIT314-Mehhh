<?php
include_once("../../Entity/propertyListing.php");

class searchUnsoldPLController
{
    public function searchUnsoldPL($search): array
    {
        $s = new propertyListing();
        $propertyListings = $s->searchUnsoldPL($search);
        return $propertyListings;
    }
}
?>