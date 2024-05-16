<?php

include_once(__DIR__ . "/../config.php");

//session_start();

// Check if session is not already active
if (session_status() == PHP_SESSION_NONE) {
    @session_start();
}


class fav
{
    private $conn;

    public function __construct()
    {
        $db = new DB;
    }

    // Method 1: Get fav of one buyer 
    public function viewFavList($buyer_id): array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("SELECT f.fav_id, f.buyer_id, f.property_id, p.price, 
                                        p.type, p.location, p.noOfBedroom, p.noOfToilet, p.status
                                FROM fav f
                                JOIN buyer b ON f.buyer_id = b.buyer_id
                                JOIN property p ON f.property_id = p.property_id
                                WHERE f.buyer_id = ?
                                ORDER BY f.fav_id ASC;");
                    
        $stmt->bind_param("i", $buyer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $fav = array();

        while ($row = $result->fetch_assoc()) {
            $fav[] = $row;
        }
        
        $stmt->close();
    
        // Return the fav[]
        return $fav;
    }
    
    // Method 2: Add to favList
    public function addFavList($buyer_id, $property_id): bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
    
        // Check if the combo of buyer_id and property_id already exists
        $isExisting = $this->checkFavExist($buyer_id, $property_id);
        
        if ($isExisting) {
            // Close the connection
            $conn->close();
            
            // Return false to indicate that the addition was not successful
            return false;
        }
        
        // If the combination doesn't exist, proceed with adding it to the favList
        $stmt = $conn->prepare("INSERT INTO fav (buyer_id, property_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $buyer_id, $property_id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        
        // Check if the operation was successful
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // Check if the combo of buyer_id and property_id already exists in the fav list
    private function checkFavExist($buyer_id, $property_id): bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
    
        $stmt = $conn->prepare("SELECT * FROM fav WHERE buyer_id = ? AND property_id = ?");
        $stmt->bind_param("ii", $buyer_id, $property_id);
        $stmt->execute();
        $result = $stmt->get_result();
            
        // Return true if the combo exists,
        return $result->num_rows > 0;
    }

    // DELETE fav in order to delete Property Listing
    public function deleteFav($property_id): bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("DELETE FROM fav WHERE property_id = ?");
        $stmt->bind_param("i", $property_id);
        $stmt->execute();
        $affectedRows = $stmt->affected_rows; // affected_rows
        $stmt->close();
        mysqli_close($conn);

        return $affectedRows > 0; // Return true if any rows were deleted
    }
}

?>
