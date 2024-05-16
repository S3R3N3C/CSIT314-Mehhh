<?php
include_once("../../Entity/fav.php");

class addFavListController
{
    public function addFavList($buyer_id, $property_id): bool
    {
        $favEntity = new fav();
        // Check if the combo already exists
        $isExisting = $this->checkFavExist($buyer_id, $property_id);

        if ($isExisting) {
            // If the combo already exists, return false
            return false;
        }

        // If no, add it to the favorite list
        return $favEntity->addFavList($buyer_id, $property_id);
    }

    // Check if the combo of buyer_id and property_id already exists in the fav list
    public function checkFavExist($buyer_id, $property_id): bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        
        $stmt = $conn->prepare("SELECT * FROM fav WHERE buyer_id = ? AND property_id = ?");
        $stmt->bind_param("ii", $buyer_id, $property_id);
        $stmt->execute();
        $result = $stmt->get_result();
                
        // Return true if the combo exists,
        return $result->num_rows > 0;
    }

}
?>
