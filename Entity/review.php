<?php

include_once(__DIR__ . "/../config.php");

session_start();

class review
{
    private $conn;

    public function __construct()
    {
        $db = new DB;
    }

    // Method 1: Get reviews of one agent 
    public function viewAgentReview($agent_id): array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("SELECT review.review_id, review.agent_id, review.review, review.writtenBy, 
                                users.user_fullname AS agent_name, agent.yearJoined, email
                                FROM review 
                                JOIN agent ON review.agent_id = agent.agent_id
                                JOIN users ON review.agent_id = users.user_id
                                WHERE review.agent_id = ?
                                ORDER BY review.review_id ASC;");
                    
        $stmt->bind_param("i", $agent_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $reviews = array();

        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }
        
        $stmt->close();
    
        // Return the review[]
        return $reviews;
    }

    // Method 2: Add review
    public function reviewAgent($agent_id, $review, $writtenBy): bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("INSERT INTO review (review, agent_id, writtenBy) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $review, $agent_id, $writtenBy);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    
}