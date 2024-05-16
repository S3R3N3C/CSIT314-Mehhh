<?php
include_once("../../Entity/propertyListing.php");
include_once("../../Entity/fav.php");

class deletePropertyListingController
{
    public function deletePropertyListing($property_id): bool
    {
        $propertyListing = new propertyListing();
        $fav = new fav(); // Delete from fav (CHILD) then propertyListing (PARENT)

        $favresult = $fav->deleteFav($property_id);
        $result = $propertyListing->deletePropertyListing($property_id);

        if ($result)
        {
            return true;
        }
        else
        {
            return false;
        }

    }
}
?>
