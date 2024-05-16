<?php
include_once("../../Entity/rating.php");

class viewAgentRatingController
{
    public function viewAgentRating($agent_id): array
    {
        $var = new rating();
        $ratings = $var->viewAgentRating($agent_id);
        return $ratings;
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

    public function getRatingByUser($writtenBy, $agent_id) {
        $conn = mysqli_connect(HOST, USER, PASS, DB);

        $query = "SELECT rating FROM rating WHERE writtenBy = ? AND agent_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $writtenBy, $agent_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        // Check if a rating was found
        if ($result !== false && isset($result['rating'])) {
            return $result['rating'];
        } else {
            // Return null if no rating was found
            return null;
        }
    }
}