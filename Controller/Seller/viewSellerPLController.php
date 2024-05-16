<?php
include_once("../../Entity/propertyListing.php");

class viewSellerPLController
{
    public function viewSellerPL($seller_id): array
    {
        $vsp = new propertyListing();
        $propertyListings = $vsp->viewSellerPL($seller_id);
        return $propertyListings;
    }
}