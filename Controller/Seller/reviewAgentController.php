<?php
include_once("../../Entity/review.php");

class reviewAgentController
{
    public function reviewAgent($agent_id, $review, $writtenBy): bool
    {
        $var = new review();
        $results = $var->reviewAgent($agent_id, $review, $writtenBy);
        
        if ($results)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // Written info
    public function getUserFullName($userId): string
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("SELECT user_fullname FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($userFullName);
        $stmt->fetch();
        $stmt->close();
        return $userFullName;
    }

    // Agent info
    public function getAgentInfo($agent_id) {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("SELECT users.user_fullname, agent.yearJoined, agent.email
                                        FROM agent 
                                        JOIN users ON agent.user_id = users.user_id
                                        WHERE agent.agent_id = ?");
        $stmt->bind_param("i", $agent_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $agentInfo = $result->fetch_assoc();
        return $agentInfo;
    }
}