<?php

    include_once("/xampp/htdocs/OnlineQuiz/Models/BaseModel.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Chat.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GamePoint.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameQuestion.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameRoom.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameUser.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/IsTutor.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Module.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Question.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Role.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/User.php");

    /**
     * Connection variables.
     */
    $dbhost = "localhost";
    $dbname = "quizsystem";
    $dbuser = "root";
    $dbpass = "";


    
    /**
     * Methode to Connect to Database.
     */
    try
    {
        $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    }
    catch(Exception $e)
    {
        die("Error : " . $e->getMessage());
    }



    // User
    /**
     * Methode getUser.
     * Gets a User by Id.
     * 
     * @param int $IdUser
     * 
     * @return User $User
     */
    function getUser(int $IdUser): User
    {
        global $mysqli;
        $sql = "SELECT * FROM users WHERE IdUser='$IdUser'";
        $result = $mysqli->query($sql);
        
        if($result->num_rows == 1){
            while($row = $result->fetch_assoc()){
                $user = new User($row['IdUser'], $row['Username'], $row['Email'], $row['Password'], $row['IdRole'], false, "", true);
            }
        }else{
            $user = new User(0, "", "", "", 0, true, "Error!", false);
        }

        return $user;
    }
    /**
     * Methode getUserForLogin.
     * Gets a User by Username and Password.
     * 
     * @param string $Username
     * @param string $Password
     * 
     * @return User $User
     */
    function getUserForLogin(string $Username, string $Password): User
    {
        global $mysqli;
        $sql = "SELECT * FROM users WHERE Username='$Username' AND Password='$Password'";
        $result = $mysqli->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $user = new User($row['IdUser'], $row['Username'], $row['Email'], $row['Password'], $row['IdRole'], false, "", true);
            }
        }else{
            $user = new User(0, "", "", "", 0, true, "Error!", false);
        }

        return $user;
    }
    /**
     * Methode getUsers.
     * Gets all Users.
     * 
     * @return array $Users
     */
    function getUsers(): array
    {
        global $mysqli;
        $usersArray = array();
        $sql = "SELECT * FROM users";
        $result = $mysqli->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $user = new User($row['IdUser'], $row['Username'], $row['Email'], $row['Password'], $row['IdRole'], false, "", true);
                $usersArray[] = $user;
            }
        }else{
            $user = new User(0, "", "", "", 0, true, "Error!", false);
            $usersArray[] = $user;
        }

        return $usersArray;
    }
    /**
     * Methode getUsers.
     * Gets Users by Role.
     * 
     * @param string $Role
     * 
     * @return array $Users
     */
    function getUsersByRole(int $IdRole): array
    {
        global $mysqli;
        $usersArray = array();
        $sql = "SELECT * FROM users WHERE IdRole='$IdRole'";
        $result = $mysqli->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $user = new User($row['IdUser'], $row['Username'], $row['Email'], $row['Password'], $row['IdRole'], false, "", true);
                $usersArray[] = $user;
            }
        }else{
            $user = new User(0, "", "", "", 0, true, "Error!", false);
            $usersArray[] = $user;
        }

        return $usersArray;
    }
    /**
     * Methode postUser.
     * Posts a User.
     * 
     * @param string $Username
     * @param string $Email
     * @param string $Password
     * @param string $Role
     * 
     * @return User $User
     */
    function postUser(string $Username, string $Email, string $Password, int $IdRole): User
    {
        global $mysqli;
        $sql = "INSERT INTO users(Username, Email, Password, IdRole) VALUES ('$Username', '$Email', '$Password', '$IdRole')";
        $mysqli->query($sql);

        $result = getUser($mysqli->insert_id);
        
        return $result;
    }
    /**
     * Methode updateUser.
     * Updates a User.
     * 
     * @param User $User
     * 
     * @return User $User
     */
    function updateUser(User $User): User
    {

        global $mysqli;

        $IdUser = $User->getIdUser();
        $Username = $User->getUsername();
        $Email = $User->getEmail();
        $Password = $User->getPassword();
        $IdRole = $User->getIdRole();

        $sql = "UPDATE users SET Username='$Username', Email='$Email', Password='$Password', IdRole='$IdRole' WHERE IdUser='$IdUser'";
        $mysqli->query($sql);

        $result = getUser($IdUser);

        return $result;
    }
    /**
     * Methode deleteUser.
     * Deletes a User.
     * 
     * @param int $IdUser
     * 
     * @return User $User
     */
    function deleteUser(int $IdUser): User
    {
        global $mysqli;
        $sql = "DELETE FROM users WHERE IdUser='$IdUser'";
        $mysqli->query($sql);

        $result = getUser($IdUser);

        return $result;
    }
    


    // Role
    /**
     * Methode getRole.
     * Gets a Role by Id.
     * 
     * @param int $IdRole
     * 
     * @return Role $Role
     */
    function getRole(int $IdRole): Role
    {
        global $mysqli;
        $sql = "SELECT IdRole, Role FROM roles WHERE IdRole='$IdRole'";
        $result = $mysqli->query($sql);
        
        if($result->num_rows == 1){
            while($row = $result->fetch_assoc()){
                $role = new Role($row['IdRole'], $row['Role'], false, "", true);
            }
        }else{
            $role = new Role(0, "", true, "Error!", false);
        }

        return $role;
    }
    /**
     * Methode getRoleByName.
     * Gets a Role by Name.
     * 
     * @param string $Role
     * 
     * @return Role $Role
     */
    function getRoleByName(string $Role): Role
    {
        global $mysqli;
        $sql = "SELECT IdRole, Role FROM roles WHERE Role='$Role'";
        $result = $mysqli->query($sql);
        
        if($result->num_rows == 1){
            while($row = $result->fetch_assoc()){
                $role = new Role($row['IdRole'], $row['Role'], false, "", true);
            }
        }else{
            $role = new Role(0, "", true, "Error!", false);
        }

        return $role;
    }
    /**
     * Methode getRoles.
     * Gets all Roles.
     * 
     * @return array $Roles
     */
    function getRoles(): array
    {
        global $mysqli;
        $rolesArray = array();
        $sql = "SELECT * FROM roles";
        $result = $mysqli->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $role = new Role($row['IdRole'], $row['Role'], false, "", true);
                $rolesArray[] = $role;
            }
        }else{
            $role = new Role(0, "", true, "Error!", false);
            $rolesArray[] = $role;
        }

        return $rolesArray;
    }
    /**
     * Methode postRole.
     * Posts a Role.
     * 
     * @param string $Role
     * 
     * @return Role $Role
     */
    function postRole(string $Role): Role
    {
        global $mysqli;
        $sql = "INSERT INTO roles(Role) VALUES ('$Role')";
        $mysqli->query($sql);

        $result = getRole($mysqli->insert_id);
        
        return $result;
    }
    /**
     * Methode updateRole.
     * Updates a Role.
     * 
     * @param Role $Role
     * 
     * @return Role $Role
     */
    function updateRole(Role $Role): Role
    {
        global $mysqli;

        $IdRole = $Role->getIdRole();
        $RoleName = $Role->getRole();

        $sql = "UPDATE roles SET Role='$RoleName' WHERE IdRole='$IdRole'";
        $mysqli->query($sql);

        $result = getRole($IdRole);

        return $result;
    }
    /**
     * Methode deleteRole.
     * Deletes a Role.
     * 
     * @param int $IdRole
     * 
     * @return Role $Role
     */
    function deleteRole(int $IdRole): Role
    {
        global $mysqli;
        $sql = "DELETE FROM roles WHERE IdRole='$IdRole'";
        $mysqli->query($sql);

        $result = getRole($IdRole);

        return $result;
    }

?>