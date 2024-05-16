<?php

include_once(__DIR__ . "/../config.php");

session_start();

class agent
{
    private $conn;

    public function __construct()
    {
        $db = new DB;
    }

    // Method 1: VIEW all agents
    public function viewAgents(): array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $query = "SELECT agent_id, agent.user_id, email, user_fullname AS agent_name, yearJoined  
                    FROM agent 
                    JOIN users ON agent.user_id = users.user_id 
                    ORDER BY user_fullname ASC";

        $result = mysqli_query($conn, $query);
        if (!$result) {
            die('Error executing query: ' . mysqli_error($conn));
        }
        $agents = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $agents[] = $row;
        }
        mysqli_close($conn);
        return $agents;
    }

}