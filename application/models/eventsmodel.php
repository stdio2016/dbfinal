<?php

class EventsModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function getAllEvents()
    {
        $sql = "SELECT * FROM events";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    public function getEvent($event_id)
    {
        $sql = "SELECT * FROM events Where id=:event_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':event_id' => $event_id));

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetch();
    }

    public function getAllTeams($event_id)
    {
        $sql = "SELECT * FROM teams Where event_id=:event_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':event_id' => $event_id));

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    public function getAllTeamMembers($team_id)
    {
        $sql = "SELECT * FROM team_members ,account Where team_id=:team_id and user_id=id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':team_id' => $team_id));

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    public function getAccount($user_id)
    {
        $sql = "SELECT * FROM account Where id=:user_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':$user_id' => $user_id));

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetch();
    }

    public function addEvent($name, $date, $team_limit,$team_size_limit)
    {
        // clean the input from javascript code for example

        $sql = "INSERT INTO events (name, `date`, team_limit,team_size_limit ) VALUES (:name, :date, :team_limit,:team_size_limit)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':name' => $name, ':date' => $date, ':team_limit' => $team_limit,':team_size_limit' => $team_size_limit));
    }

    public function editEvent($id,$name, $date, $team_limit,$team_size_limit)
    {
        // clean the input from javascript code for example

        $sql = "UPDATE events SET name=:name, `date`=:date, team_limit=:team_limit, team_size_limit=:team_size_limit where id=:id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id'=> $id ,':name' => $name, ':date' => $date, ':team_limit' => $team_limit,':team_size_limit' => $team_size_limit));
    }

    public function deleteEvent($event_id)
    {
        $sql = "DELETE FROM events WHERE id = :event_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':event_id' => $event_id));
    }
}
