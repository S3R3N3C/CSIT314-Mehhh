<?php
include_once("../../Entity/agent.php");

class viewAgentsController
{
    public function viewAgents(): array
    {
        $va = new agent();
        $agents = $va->viewAgents();
        return $agents;
    }

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