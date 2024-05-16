<?php
include_once("../../Entity/propertyListing.php");

class viewAgentPLController
{
    public function viewAgentPL($agent_id): array
    {
        $vap = new propertyListing();
        $propertyListing = $vap->viewAgentPL($agent_id);
        return $propertyListing;
    }

    public function viewPropertyPage($property_id): array {
        $vap = new propertyListing();
        $results = $vap->viewPropertyPage($property_id);
        return $results;
    }
}