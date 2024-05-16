<?php

include_once(__DIR__ . "/../config.php");

session_start();

class PropertyListing
{
    private $conn;

    private $property_id;
    private $agent_id;
    private $seller_id;
    private $price;
    private $type;
    private $location;
    private $noOfBedroom;
    private $noOfToilet;
    private $status;
    private $description;

    public function __construct($property_id = null, $agent_id = null, $seller_id = null, 
                                    $price = null, $type = null, $location = null, $noOfBedroom = null, $noOfToilet = null, $description=null)
    {
        $this->property_id = $property_id;
        $this->agent_id = $agent_id;
        $this->seller_id = $seller_id;
        $this->price = $price;
        $this->type = $type;
        $this->location = $location;
        $this->noOfBedroom = $noOfBedroom;
        $this->noOfToilet = $noOfToilet;
        $this->description = $description;
    }

    // Getter
    public function getPropertyId()
    {
        return $this->property_id;
    }

    public function getAgentId()
    {
        return $this->agent_id;
    }

    public function getSellerId()
    {
        return $this->seller_id;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getNoOfBedroom()
    {
        return $this->noOfBedroom;
    }

    public function getNoOfToilet()
    {
        return $this->noOfToilet;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getDescription()
    {
        return $this->description;
    }
    

    // Setter
    public function setPropertyId($property_id)
    {
        $this->property_id = $property_id;
    }

    public function setAgentId($agent_id)
    {
        $this->agent_id = $agent_id;
    }

    public function setSellerId($seller_id)
    {
        $this->seller_id = $seller_id;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function setNoOfBedroom($noOfBedroom)
    {
        $this->noOfBedroom = $noOfBedroom;
    }

    public function setNoOfToilet($noOfToilet)
    {
        $this->noOfToilet = $noOfToilet;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    // Method 1: View all property listings
    public function viewPropertyListings(): array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB); // connection
        $query = "SELECT * FROM property ORDER BY property_id ASC"; // SQL query statement
        $result = mysqli_query($conn, $query);
        $propertyListings = array();

        if ($result) {
            while ($res = mysqli_fetch_array($result)) {
                $property = array();
                $property['property_id'] = $res['property_id'];
                $property['agent_id'] = $res['agent_id'];
                $property['seller_id'] = $res['seller_id'];
                $property['buyer_id'] = $res['buyer_id'];
                $property['price'] = $res['price'];
                $property['type'] = $res['type'];
                $property['location'] = $res['location'];
                $property['noOfBedroom'] = $res['noOfBedroom'];
                $property['noOfToilet'] = $res['noOfToilet'];
                $property['noOfViews'] = $res['noOfViews'];
                $property['noOfShort'] = $res['noOfShort'];
                $property['status'] = $res['status'];
                $property['description'] = $res['description'];
                $propertyListings[] = $property;
            }
        }

        return $propertyListings;
    }


    // Method 2: VIEW seller propertyListing
    public function viewSellerPL($seller_id): array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("SELECT * FROM property 
                                WHERE seller_id = ?
                                ORDER BY property_id ASC;");

        $stmt->bind_param("i", $seller_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $propertyListing = array();

        while ($row = $result->fetch_assoc()) {
            $propertyListing[] = $row;
        }

        $stmt->close();

        // Return the propertyListing[]
        return $propertyListing;
    }

    // Method 3: VIEW agent propertyListing
    public function viewAgentPL($agent_id): array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("SELECT * FROM property 
                                WHERE agent_id = ?
                                ORDER BY property_id ASC;");

        $stmt->bind_param("i", $agent_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $propertyListing = array();

        while ($row = $result->fetch_assoc()) {
            $propertyListing[] = $row;
        }

        $stmt->close();

        // Return the propertyListing[]
        return $propertyListing;
    }

    // Method 4: CREATE property listing
    public function createPropertyListing($propertyListing): bool // obj
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);

        // Extract properties from the object
        $property_id = $propertyListing->property_id;
        $agent_id = $propertyListing->agent_id;
        $seller_id = $propertyListing->seller_id;
        $price = $propertyListing->price;
        $type = $propertyListing->type;
        $location = $propertyListing->location;
        $noOfBedroom = $propertyListing->noOfBedroom;
        $noOfToilet = $propertyListing->noOfToilet;
        $noOfToilet = $propertyListing->noOfToilet;
        $description = $propertyListing->description;

        // If the seller_id exists in the database
        $checkSeller = mysqli_query($conn, "SELECT seller_id FROM property WHERE seller_id = '$seller_id'");

        $sellerExists = mysqli_num_rows($checkSeller);

        if ($sellerExists > 0) {
            $stmt = $conn->prepare("INSERT INTO property (property_id, agent_id, seller_id, price, 
                                                            type, location, noOfBedroom, noOfToilet, description) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("iiisssiis", $property_id, $agent_id, $seller_id, $price, $type, $location, $noOfBedroom, $noOfToilet, $description);

            // Execute the prepared statement
            if ($stmt->execute()) {
                return true; // created successfully
            } else {
                return false; // failed
            }

            $stmt->close();
        } else {

            return false; // Invalid
        }
        mysqli_close($conn);
    }

    // Method: VIEW property listing details
    public function viewPropertyPage($property_id): array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("SELECT property_id, agent_id, seller_id, buyer_id, price, 
                                type, location, noOfBedroom, noOfToilet,description FROM property WHERE property_id = ?");
        $stmt->bind_param("i", $property_id);
        $stmt->execute();
        $stmt->bind_result($property_id, $agentId, $sellerId, $buyerId, $price, $type, $location, $noOfBedroom, $noOfToilet,$description);

        // Fetch result
        $stmt->fetch();

        // Close statement
        $stmt->close();

        // Return property information as an associative array
        return array(
            'property_id' => $property_id,
            'agent_id' => $agentId,
            'seller_id' => $sellerId,
            'buyer_id' => $buyerId,
            'price' => $price,
            'type' => $type,
            'location' => $location,
            'noOfBedroom' => $noOfBedroom,
            'noOfToilet' => $noOfToilet,
            'description' => $description
        );
    }

    // Method 6: DELETE Property Listing
    function deletePropertyListing($property_id): bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("DELETE FROM property WHERE property_id = ?");
        $stmt->bind_param("i", $property_id);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            return true;
        } 
        else {
            return false;
        }
    }

    // Method 7: UPDATE Property Listing
    public function updatePropertyListing($propertyListing): bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("UPDATE property SET seller_id = ?, price = ?, type = ?, location = ?, 
                                noOfBedroom = ?, noOfToilet = ?, status = ?, description = ? WHERE property_id = ?");
        
        // Set parameters using setter methods
        $stmt->bind_param("iisssissi", 
                            $propertyListing->getSellerId(), 
                            $propertyListing->getPrice(), 
                            $propertyListing->getType(), 
                            $propertyListing->getLocation(), 
                            $propertyListing->getNoOfBedroom(), 
                            $propertyListing->getNoOfToilet(), 
                            $propertyListing->getStatus(),
                            $propertyListing->getDescription(),
                            $propertyListing->getPropertyId()
                        );
        
        $result = $stmt->execute();

        $stmt->close();
        mysqli_close($conn);
        
        if ($result) {
            return true;
        } else {
            return false;
        }


    }

    
    public function incrementPropertyViews($property_id): bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("UPDATE property SET noOfViews = noOfViews + 1 WHERE property_id = ?");
        $stmt->bind_param("i", $property_id);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    public function incrementNoOfShort($property_id): bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("UPDATE property SET noOfShort = noOfShort + 1 WHERE property_id = ?");
        $stmt->bind_param("i", $property_id);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    // Method 8: VIEW all SOLD property listings
    public function viewSoldPL(): array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB); // connection
        $query = "SELECT * FROM property WHERE status='Sold' ORDER BY property_id ASC"; // SQL query statement
        $result = mysqli_query($conn, $query);
        $propertyListings = array();
    
        if ($result) {
            while ($res = mysqli_fetch_array($result)) {
                $property = array();
                $property['property_id'] = $res['property_id'];
                $property['agent_id'] = $res['agent_id'];
                $property['seller_id'] = $res['seller_id'];
                $property['buyer_id'] = $res['buyer_id'];
                $property['price'] = $res['price'];
                $property['type'] = $res['type'];
                $property['location'] = $res['location'];
                $property['noOfBedroom'] = $res['noOfBedroom'];
                $property['noOfToilet'] = $res['noOfToilet'];
                $property['noOfViews'] = $res['noOfViews'];
                $property['noOfShort'] = $res['noOfShort'];
                $property['status'] = $res['status'];
                $propertyListings[] = $property;
            }
        }
    
        return $propertyListings;
    }

    // Method 9: VIEW all UNSOLD property listings
    public function viewUnsoldPL(): array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB); // connection
        $query = "SELECT * FROM property WHERE status='Unsold' ORDER BY property_id ASC"; // SQL query statement
        $result = mysqli_query($conn, $query);
        $propertyListings = array();
        
        if ($result) {
            while ($res = mysqli_fetch_array($result)) {
                $property = array();
                $property['property_id'] = $res['property_id'];
                $property['agent_id'] = $res['agent_id'];
                $property['seller_id'] = $res['seller_id'];
                $property['buyer_id'] = $res['buyer_id'];
                $property['price'] = $res['price'];
                $property['type'] = $res['type'];
                $property['location'] = $res['location'];
                $property['noOfBedroom'] = $res['noOfBedroom'];
                $property['noOfToilet'] = $res['noOfToilet'];
                $property['noOfViews'] = $res['noOfViews'];
                $property['noOfShort'] = $res['noOfShort'];
                $property['status'] = $res['status'];
                $propertyListings[] = $property;
            }
        }
        
        return $propertyListings;
    }


    // Get seller ID based on property ID
    public function getSellerIdByProp($property_id)
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        
        $query = "SELECT seller_id FROM property WHERE property_id = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $property_id);
        $stmt->execute();
        $stmt->bind_result($seller_id);
        $stmt->fetch();

        $stmt->close();
        mysqli_close($conn);

        return $seller_id;
    } 

    // Method 10: search property listings
    function searchPropertyListing($search): array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $search = mysqli_real_escape_string($conn, $search);
        $query = "SELECT * FROM property WHERE location LIKE '%$search%' 
                    OR type LIKE '%$search%' OR status LIKE '%$search%'";
        $result = mysqli_query($conn, $query);
    
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
    
        $propertyListings = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_close($conn);
        return $propertyListings;
    }

    // Method 11: search AGENT property listings
    function searchAgengPL($search, $agent_id): array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $search = mysqli_real_escape_string($conn, $search);
        $query = "SELECT * FROM property WHERE (location LIKE '%$search%' 
                    OR type LIKE '%$search%' OR status LIKE '%$search%') 
                    AND agent_id = $agent_id";

        $result = mysqli_query($conn, $query);
    
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
    
        $propertyListings = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_close($conn);
        return $propertyListings;
    }
    
    // Method 11: search SOLD property listings
    function searchSoldPL($search): array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $search = mysqli_real_escape_string($conn, $search);
        $query = "SELECT * FROM property WHERE (location LIKE '%$search%' 
                    OR type LIKE '%$search%') 
                    AND status ='Sold'";

        $result = mysqli_query($conn, $query);
    
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
    
        $propertyListings = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_close($conn);
        return $propertyListings;
    }
    
    // Method 12: search UNSOLD property listings
    function searchUnsoldPL($search): array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $search = mysqli_real_escape_string($conn, $search);
        $query = "SELECT * FROM property WHERE (location LIKE '%$search%' 
                    OR type LIKE '%$search%') 
                    AND status ='Unsold'";

        $result = mysqli_query($conn, $query);
    
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
    
        $propertyListings = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_close($conn);
        return $propertyListings;
    }

}
?>
