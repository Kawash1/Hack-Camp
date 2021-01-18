<?php
require_once ("Models/Database.php");
require_once ("Models/PlacementSkillsData.php");

/**
 * Class PlacementSkills
 */
class PlacementSkills {
    protected $_dbInstance, $_dbHandle;

    /**
     * PlacementSkills constructor.
     */
    public function __construct()
    {
        // Creates Instance of Database class
        $this->_dbInstance = Database::getInstance();
        // Establish the connection to database
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    /**
     * Add skills and level for a placement
     * @param $placement
     * @param $skill
     * @param $level
     */

    public function addPlacementSkills($placement, $skill, $level)
    {
        // SQL query to insert placement and skill
        $sqlQuery = "INSERT INTO placement_skills VALUES (:placement, :skill, :skillLevel)";
        // Prepare PDO statement
        $statement = $this->_dbHandle->prepare($sqlQuery);
        // Assign value to SQL query statement
        $statement->bindParam(":placement", $placement, PDO::PARAM_INT);
        $statement->bindParam(":skill", $skill, PDO::PARAM_INT);
        $statement->bindParam(":skillLevel", $level, PDO::PARAM_INT);
        // Execute PDO statement
        $statement->execute();
    }

    /**
     * @param $idPlacement
     * @return array
     */
    public function listAllPlacementSkills($idPlacement)
    {
        $sqlQuery = "SELECT skill, placement_skills.level FROM placement, placement_skills, skills WHERE placementID = :id AND placement.placementID = placement_skills.placement_id AND skills.skillID = placement_skills.skill_id";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->bindParam(":id", $idPlacement, PDO::PARAM_INT);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch())
        {
            $dataSet[] = new PlacementSkillsData($row);
        }
        var_dump($dataSet);
        return $dataSet;
    }

    /**
     * @param $placement
     * @param $id
     * @return bool
     */
    public function checkSkill($placement, $id)
    {
        $sqlQuery = "SELECT skill_id FROM placement_skills WHERE placement_id = :placement AND skill_id = :id";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->bindParam(":placement", $placement, PDO::PARAM_INT);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        if ($statement->rowCount() > 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}