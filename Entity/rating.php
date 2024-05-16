<?php

include_once(__DIR__ . "/../config.php");

//session_start();

class rating
{
    private $conn;

    public function __construct()
    {
        $db = new DB;
    }

    // Method 1: Get ratings of one agent 
    public function viewAgentRating($agent_id): array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("SELECT rating.rating_id, rating.agent_id, rating.rating, rating.writtenBy, 
                                users.user_fullname AS agent_name, agent.yearJoined, email
                                FROM rating 
                                JOIN agent ON rating.agent_id = agent.agent_id
                                JOIN users ON rating.agent_id = users.user_id
                                WHERE rating.agent_id = ?
                                ORDER BY rating.rating_id ASC;");
                    
        $stmt->bind_param("i", $agent_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $ratings = array();

        while ($row = $result->fetch_assoc()) {
            $ratings[] = $row;
        }
        
        $stmt->close();
    
        // Return the rating[]
        return $ratings;
    }
    
    // Method 2: Rate agent
    public function rateAgent($agent_id, $rating, $writtenBy): bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("INSERT INTO rating (rating, agent_id, writtenBy) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $rating, $agent_id, $writtenBy);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }



}