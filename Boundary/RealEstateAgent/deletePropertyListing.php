<?php
include_once("../../Controller/RealEstateAgent/deletePropertyListingController.php");

if (isset($_GET['property_id'])) {
    $property_id = $_GET['property_id'];

    $deletePropertyListingController = new deletePropertyListingController();
    $result = $deletePropertyListingController->deletePropertyListing($property_id);

    // Redirect based on the result of the deletion
    if ($result) {
        // Redirect to viewAgentPL page with delete success message
        header("Location: viewAgentPL.php?delete_success=true");
    } else {
        header("Location: viewAgentPL.php?delete_success=false");
    }
    exit();
}
?>
