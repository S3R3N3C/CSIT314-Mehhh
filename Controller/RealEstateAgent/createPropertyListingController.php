<?php

include_once("../../Entity/propertyListing.php");

class CreatePropertyListingController
{
    public function createPropertyListing($property): bool
    {
        // Get the seller ID based on their name
        $sellerName = $_POST['user_fullname'];
        $sellerId = $this->getSellerIdByName($sellerName);

        if ($sellerId !== false) {
            $property->setSellerId($sellerId); // setter method to set seller ID

            $propertyListing = new PropertyListing(); // Create a new property listing object

            try {
                $result = $propertyListing->createPropertyListing($property);
                return $result;
            } catch (Exception $e) {
                return false;
            }
        } else {
            return false; // Seller not found
        }
    }

    // Get the seller ID based on their name
    public function getSellerIdByName($sellerName)
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        
        if (!$conn) {
            // Handle connection error
            throw new Exception("Failed to connect to database: " . mysqli_connect_error());
        }

        $stmt = $conn->prepare("SELECT s.seller_id 
                                FROM seller s 
                                INNER JOIN users u ON s.user_id = u.user_id 
                                WHERE u.user_fullname = ?");

        if (!$stmt) {
            mysqli_close($conn);
            throw new Exception("Error preparing statement: " . mysqli_error($conn));
        }

        $stmt->bind_param("s", $sellerName);

        if (!$stmt->execute()) {
            $stmt->close();
            mysqli_close($conn);
            throw new Exception("Error executing statement: " . $stmt->error);
        }

        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $sellerId = $row['seller_id'];
            $stmt->close();
            mysqli_close($conn);
            return $sellerId;
        } else {
            // No seller found
            $stmt->close();
            mysqli_close($conn);
            return false;
        }
    }
}
?>
