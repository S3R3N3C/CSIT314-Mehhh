<?php
include_once("../../Entity/propertyListing.php");


class updatePropertyListingController
{

    public function updatePropertyListing($propertyListing): bool
    {
        //$propertyListing = new propertyListing();
        $result = $propertyListing->updatePropertyListing($propertyListing);
        
        if ($result) {
            // Return true if the PL update was successful
            return true;
        } else {
            // Return false if the PL update failed
            return false;
        }
    }
    
    public function getSellerNameByID($seller_id)
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        
        if (!$conn) {
            // Handle connection error
            throw new Exception("Failed to connect to database: " . mysqli_connect_error());
        }
    
        $stmt = $conn->prepare("SELECT u.user_fullname 
                                FROM seller s 
                                INNER JOIN users u ON s.user_id = u.user_id 
                                WHERE s.seller_id = ?");
    
        if (!$stmt) {
            mysqli_close($conn);
            throw new Exception("Error preparing statement: " . mysqli_error($conn));
        }
    
        $stmt->bind_param("i", $seller_id);
    
        if (!$stmt->execute()) {
            $stmt->close();
            mysqli_close($conn);
            throw new Exception("Error executing statement: " . $stmt->error);
        }
    
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $sellerName = $row['user_fullname'];
            $stmt->close();
            mysqli_close($conn);
            return $sellerName;
        } else {
            // No seller found
            $stmt->close();
            mysqli_close($conn);
            return false;
        }
    }
    
}
?>
