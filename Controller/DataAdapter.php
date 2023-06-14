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



    // Chat
    /**
     * Methode getChat.
     * Get a ChatMessage by Id.
     * 
     * @param int $IdChat
     * 
     * @return Chat $Chat
     */
    function getChat(int $IdChat): Chat
    {
        global $mysqli;
        $sql = "SELECT * FROM chat WHERE IdChat='$IdChat'";
        $result = $mysqli->query($sql);
        
        if($result->num_rows == 1){
            while($row = $result->fetch_assoc()){
                $chat = new Chat($row['IdMessage'], $row['Username'], $row['Message'], false, "", true);
            }
        }else{
            $chat = new Chat(0, "", "", true, "Error!", false);
        }

        return $chat;
    }
    /**
     * Methode getChats.
     * Get all ChatMessages.
     * 
     * @return array $Chats
     */
    function getChats(): array
    {
        global $mysqli;
        $chatArray = array();
        $sql = "SELECT * FROM chat";
        $result = $mysqli->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $chat = new Chat($row['IdMessage'], $row['Username'], $row['Message'], false, "", true);
                $chatArray[] = $chat;
            }
        }else{
            $chat = new Chat(0, "", "", true, "Error!", false);
            $chatArray[] = $chat;
        }

        return $chatArray;
    }
    /**
     * Methode postChat.
     * Posts a new ChatMessage.
     * 
     * @param string $Username
     * @param string $Message
     * 
     * @return Chat $Chat
     */
    function postChat(string $Username, string $Message): Chat
    {
        global $mysqli;
        $sql = "INSERT INTO chat(Username, Message) VALUES ('$Username', '$Message')";
        $mysqli->query($sql);
        $IdChat = $mysqli->insert_id;

        $result = getChat($IdChat);

        return $result;
    }
    /**
     * Methode updateChat.
     * Updates a ChatMessage.
     * 
     * @param Chat $Chat
     * 
     * @return Chat $Chat
     */
    function updateChat(Chat $Chat): Chat
    {
        global $mysqli;

        $IdChat = $Chat->getIdMessage();
        $Username = $Chat->getUsername();
        $Message = $Chat->getMessage();

        $sql = "UPDATE chat SET Username='$Username', Message='$Message' WHERE IdChat='$IdChat'";
        $mysqli->query($sql);

        $result = getChat($IdChat);

        return $result;
    }
    /**
     * Methode deleteChat.
     * Deletes a ChatMessage.
     * 
     * @param int $IdChat
     * 
     * @return Chat $Chat
     */
    function deleteChat(int $IdChat): Chat
    {
        global $mysqli;
        $sql = "DELETE FROM chat WHERE IdChat='$IdChat'";
        $mysqli->query($sql);

        $result = getChat($IdChat);

        return $result;
    }



    // IsTutor
    /**
     * Methode getIsTutorByUser.
     * Gets User if he is Tutor by IdUser.
     * 
     * @param int $IdUser
     * 
     * @return array $IsTutorArray
     */
    function getIsTutorByUser(int $IdUser): array
    {
        global $mysqli;
        $isTutorArray = array();
        $sql = "SELECT * FROM istutor WHERE IdUser='$IdUser'";
        $result = $mysqli->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $istutor = new IsTutor($row['IdUser'], $row['IdModule'], false, "", true);
                $isTutorArray[] = $istutor;
            }
        }else{
            $istutor = new IsTutor(0, 0, true, "Error!", false);
            $isTutorArray[] = $istutor;
        }

        return $isTutorArray;
    }
    /**
     * Methode getIsTutorByModule.
     * Gets User if he is Tutor by IdModule.
     * 
     * @param int $IdModule
     * 
     * @return array $IsTutorArray
     */
    function getIsTutorByModule(int $IdModule): array
    {
        global $mysqli;
        $isTutorArray = array();
        $sql = "SELECT * FROM istutor WHERE IdModule='$IdModule'";
        $result = $mysqli->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $istutor = new IsTutor($row['IdUser'], $row['IdModule'], false, "", true);
                $isTutorArray[] = $istutor;
            }
        }else{
            $istutor = new IsTutor(0, 0, true, "Error!", false);
            $isTutorArray[] = $istutor;
        }

        return $isTutorArray;
    }
    /**
     * Methode getIsTutorByUserAndModule.
     * Gets User if he is Tutor by IdUser and IdModule.
     * 
     * @param int $IdModule
     * 
     * @return IsTutor $IsTutor
     */
    function getIsTutorByUserAndModule(int $IdUser, int $IdModule): IsTutor
    {
        global $mysqli;
        $sql = "SELECT * FROM istutor WHERE IdUser='$IdUser' AND IdModule='$IdModule'";
        $result = $mysqli->query($sql);
        
        if($result->num_rows == 1)
        {
            while($row = $result->fetch_assoc())
            {
                $istutor = new IsTutor($row['IdUser'], $row['IdModule'], false, "", true);
            }
        }
        else
        {
            $istutor = new IsTutor(0, 0, true, "Error!", false);
        }

        return $istutor;
    }
    /**
     * Methode postIsTutor.
     * Posts a new Tutor to a Module.
     * 
     * @param IsTutor $IsTutor
     * 
     * @return IsTutor $IsTutor
     */
    function postIsTutor(IsTutor $IsTutor): IsTutor
    {
        global $mysqli;

        $IdUser = $IsTutor->getIdUser();
        $IdModule = $IsTutor->getIdModule();

        $sql = "INSERT INTO istutor(IdUser, IdModule) VALUES ('$IdUser', '$IdModule')";
        $mysqli->query($sql);

        $result = getIsTutorByUserAndModule($IdUser, $IdModule);
        
        return $result;
    }
    /**
     * Methode updateIsTutor.
     * Updates User which is Tutor in a Module.
     * 
     * @param IsTutor $IsTutor
     * 
     * @return IsTutor $IsTutor
     */
    function updateIsTutor(IsTutor $IsTutor): IsTutor
    {
        global $mysqli;

        $IdUser = $IsTutor->getIdUser();
        $IdModule = $IsTutor->getIdModule();

        $sql = "UPDATE istutor SET IdUser='$IdUser', IdModule='$IdModule' WHERE IdUser='$IdUser' AND IdModule='$IdModule'";
        $mysqli->query($sql);

        $result = getIsTutorByUserAndModule($IdUser, $IdModule);

        return $result;
    }
    /**
     * Methode deleteIsTutor.
     * Deletes User which is Tutor in a Module.
     * 
     * @param IsTutor $IsTutor
     * 
     * @return IsTutor $IsTutor
     */
    function deleteIsTutor(IsTutor $IsTutor): IsTutor
    {
        global $mysqli;

        $IdUser = $IsTutor->getIdUser();
        $IdModule = $IsTutor->getIdModule();

        $sql = "DELETE FROM istutor WHERE IdUser='$IdUser' AND IdModule='$IdModule'";
        $mysqli->query($sql);

        $result = getIsTutorByUserAndModule($IdUser, $IdModule);

        return $result;
    }
    


    // Module
    /**
     * Methode getModule.
     * Gets a Module by Id.
     * 
     * @param int $IdModule
     * 
     * @return Module $Module
     */
    function getModule(int $IdModule): Module
    {
        global $mysqli;
        $sql = "SELECT * FROM modules WHERE IdModule='$IdModule'";
        $result = $mysqli->query($sql);
        
        if($result->num_rows == 1){
            while($row = $result->fetch_assoc()){
                $module = new Module($row['IdModule'], $row['Abbreviation'], $row['FullDesignation'], false, "", true);
            }
        }else{
            $module = new Module(0, "", "", true, "Error!", false);
        }

        return $module;
    }
    /**
     * Methode getModules.
     * Gets all Modules.
     * 
     * @return array $Modules
     */
    function getModules(): array
    {
        global $mysqli;
        $modulesArray = array();
        $sql = "SELECT * FROM modules";
        $result = $mysqli->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $module = new Module($row['IdModule'], $row['Abbreviation'], $row['FullDesignation'], false, "", true);
                $modulesArray[] = $module;
            }
        }else{
            $module = new Module(0, "", "", true, "Error!", false);
            $modulesArray[] = $module;
        }

        return $modulesArray;
    }
    /**
     * Methode postModule.
     * Posts a Module.
     * 
     * @param string $Abbreviation
     * @param string $FullDesignation
     * 
     * @return Module $Module
     */
    function postModule(string $Abbreviation, string $FullDesignation): Module
    {
        global $mysqli;
        $sql = "INSERT INTO modules(Abbreviation, FullDesignation) VALUES ('$Abbreviation', '$FullDesignation')";
        $mysqli->query($sql);

        $result = getModule($mysqli->insert_id);
        
        return $result;
    }
    /**
     * Methode updateModule.
     * Updates a Module.
     * 
     * @param Module $Module
     * 
     * @return Module $Module
     */
    function updateModule(Module $Module): Module
    {
        global $mysqli;

        $IdModule = $Module->getIdModule();
        $Abbreviation = $Module->getAbbreviation();
        $FullDesignation = $Module->getFullDesignation();

        $sql = "UPDATE modules SET Abbreviation='$Abbreviation', FullDesignation='$FullDesignation' WHERE IdModule='$IdModule'";
        $mysqli->query($sql);

        $result = getModule($IdModule);

        return $result;
    }
    /**
     * Methode deleteModule.
     * Deletes a Module.
     * 
     * @param int $IdModule
     * 
     * @return Module $Module
     */
    function deleteModule(int $IdModule): Module
    {
        global $mysqli;
        $sql = "DELETE FROM modules WHERE IdModule='$IdModule'";
        $mysqli->query($sql);

        $result = getModule($IdModule);

        return $result;
    }
    


    // Question
    /**
     * Methode getQuestion.
     * Gets a Question by Id.
     * 
     * @param int $IdQuestion
     * 
     * @return Question $Question
     */
    function getQuestion(int $IdQuestion): Question
    {
        global $mysqli;
        $sql = "SELECT * FROM questions WHERE IdQuestion='$IdQuestion'";
        $result = $mysqli->query($sql);

        if($result->num_rows == 1){
            while($row = $result->fetch_assoc()){
                $question = new Question($row['IdQuestion'], $row['Question'], $row['CorrectAnswer'], $row['WrongAnswer1'], $row['WrongAnswer2'], $row['WrongAnswer3'], $row['IsApproved'], intval($row['IdModule']), $row['IdUser'], false, "", true);
            }
        }else{
            $question = new Question(0, "", "", "", "", "", false, 0, 0, true, "Error!", false);
        }

        return $question;
    }
    /**
     * Methode getQuestions.
     * Gets all Question.
     * 
     * @return array $Questions
     */
    function getQuestions(): array
    {

        global $mysqli;
        $questionsArray = array();
        $sql = "SELECT * FROM questions";
        
        $resultQuestions = $mysqli->query($sql);
        
        if($resultQuestions->num_rows > 0)
        {
            while($questionRow = $resultQuestions->fetch_assoc())
            {
                $IdModule = $questionRow['IdModule'];

                $sql = "SELECT * FROM modules WHERE IdModule='$IdModule'";
                $resultModule = $mysqli->query($sql);
                if($resultModule->num_rows > 0)
                {
                    while($moduleRow = $resultModule->fetch_assoc())
                    {
                        $Module = new Module(intval($moduleRow['IdModule']), $moduleRow['Abbreviation'], $moduleRow['FullDesignation'], false, "", true);
                    }
                }

                $question = new Question($questionRow['IdQuestion'], $questionRow['Question'], $questionRow['CorrectAnswer'], $questionRow['WrongAnswer1'], $questionRow['WrongAnswer2'], $questionRow['WrongAnswer3'], $questionRow['IsApproved'], intval($questionRow['IdModule']), intval($questionRow['IdUser']), false, "", true);
                $question->setModule($Module);
                $questionsArray[] = $question;
            }
        }
        else
        {
            $question = new Question(0, "", "", "", "", "", false, 0, 0, true, "Error!", false);
            $questionsArray[] = $question;
        }

        return $questionsArray;
    }
    /**
     * Methode getQuestionByModule.
     * Gets Questions by Modules.
     * 
     * @param int $IdModule
     * 
     * @return array $Questions
     */
    function getQuestionByModule(int $IdModule): array
    {
        global $mysqli;
        $questionsArray = array();
        $sql = "SELECT * FROM questions WHERE IdModule='$IdModule'";
        $result = $mysqli->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $question = new Question($row['IdQuestion'], $row['Question'], $row['CorrectAnswer'], $row['WrongAnswer1'], $row['WrongAnswer2'], $row['WrongAnswer3'], $row['IsApproved'], $row['IdModule'], $row['IdUser'], false, "", true);
                $questionsArray[] = $question;
            }
        }else{
            $question = new Question(0, "", "", "", "", "", false, 0, 0, true, "Error!", false);
            $questionsArray[] = $question;
        }

        return $questionsArray;
    }
    /**
     * Methode getQuestionByModule.
     * Gets Questions by Modules.
     * 
     * @param int $IdModule
     * 
     * @return array $Questions
     */
    function getQuestionByModuleAndIsApproved(int $IdModule): array
    {
        global $mysqli;
        $questionsArray = array();
        $sql = "SELECT * FROM questions WHERE IdModule='$IdModule' AND IsApproved=1";
        $result = $mysqli->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $question = new Question($row['IdQuestion'], $row['Question'], $row['CorrectAnswer'], $row['WrongAnswer1'], $row['WrongAnswer2'], $row['WrongAnswer3'], $row['IsApproved'], $row['IdModule'], $row['IdUser'], false, "", true);
                $questionsArray[] = $question;
            }
        }else{
            $question = new Question(0, "", "", "", "", "", false, 0, 0, true, "Error!", false);
            $questionsArray[] = $question;
        }

        return $questionsArray;
    }
    /**
     * Methode postQuestion.
     * Posts a Question.
     * 
     * @param string $Question
     * @param string $CorrectAnswer
     * @param string $WrongAnswer1
     * @param string $WrongAnswer2
     * @param string $WrongAnswer3
     * @param bool $IsApproved
     * @param int $IdModule
     * 
     * @return Question $Questions
     */
    function postQuestion(string $Question, string $CorrectAnswer, string $WrongAnswer1, string $WrongAnswer2, string $WrongAnswer3, bool $IsApproved, int $IdModule, int $IdUser): Question
    {
        global $mysqli;
        $sql = "INSERT INTO questions(Question, CorrectAnswer, WrongAnswer1, WrongAnswer2, WrongAnswer3, IsApproved, IdModule, IdUser) VALUES ('$Question', '$CorrectAnswer', '$WrongAnswer1', '$WrongAnswer2', '$WrongAnswer3', '$IsApproved', '$IdModule', '$IdUser')";
        $mysqli->query($sql);

        $result = getQuestion($mysqli->insert_id);
        
        return $result;
    }
    /**
     * Methode updateQuestion.
     * Updates a Question.
     * 
     * @param Question $Question
     * 
     * @return Question $Question
     */
    function updateQuestion(Question $Question): Question
    {
        global $mysqli;

        $IdQuestion = $Question->getIdQuestion();
        $QuestionText = $Question->getQuestion();
        $CorrectAnswer = $Question->getCorrectAnswer();
        $WrongAnswer1 = $Question->getWrongAnswer1();
        $WrongAnswer2 = $Question->getWrongAnswer2();
        $WrongAnswer3 = $Question->getWrongAnswer3();
        $IsApproved = $Question->getIsApproved();
        $IdModule = $Question->getIdModule();
        $IdUser = $Question->getIdUser();

        $sql = "UPDATE questions SET Question='$QuestionText', CorrectAnswer='$CorrectAnswer', WrongAnswer1='$WrongAnswer1', WrongAnswer2='$WrongAnswer2', WrongAnswer3='$WrongAnswer3', IsApproved='$IsApproved', IdModule='$IdModule', IdUser='$IdUser' WHERE IdQuestion='$IdQuestion'";
        $mysqli->query($sql);

        $result = getQuestion($IdQuestion);

        return $result;
    }
    /**
     * Methode deleteQuestion.
     * Deletes a Question.
     * 
     * @param int $IdQuestion
     * 
     * @return Question $Question
     */
    function deleteQuestion(int $IdQuestion): Question
    {
        global $mysqli;
        $sql = "DELETE FROM questions WHERE IdQuestion='$IdQuestion'";
        $mysqli->query($sql);

        $result = getQuestion($IdQuestion);

        return $result;
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



    // GameRoom
    /**
     * Methode getGameRoom.
     * Gets a GameRoom by Id.
     * 
     * @param int $IdGameRoom
     * 
     * @return GameRoom $GameRoom
     */
    function getGameRoom(int $IdGameRoom): GameRoom
    {
        global $mysqli;
        $sql = "SELECT * FROM gamerooms WHERE IdGameRoom='$IdGameRoom'";
        $result = $mysqli->query($sql);
        
        if($result->num_rows == 1){
            while($row = $result->fetch_assoc()){
                $gameRoom = new GameRoom($row['IdGameRoom'], $row['IdModule'], $row['IsSingleplayer'], false, "", true);
            }
        }else{
            $gameRoom = new GameRoom(0, 0, true, true, "Error!", false);
        }

        return $gameRoom;
    }
    /**
     * Methode getGameRooms.
     * Gets all GameRooms.
     * 
     * @return array $GameRooms
     */
    function getGameRooms(): array
    {
        global $mysqli;
        $gameRoomArray = array();
        $sql = "SELECT * FROM gamerooms";
        $result = $mysqli->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $gameRoom = new GameRoom($row['IdGameRoom'], intval($row['IdModule']), $row['IsSingleplayer'], false, "", true);
                $gameRoomArray[] = $gameRoom;
            }
        }else{
            $gameRoom = new GameRoom(0, 0, true, true, "Error!", false);
            $gameRoomArray[] = $gameRoom;
        }

        return $gameRoomArray;
    }
    /**
     * Methode postGameRoom.
     * Posts a GameRoom.
     * 
     * @param int $IdModule
     * @param bool $IsSingleplayer
     * 
     * @return GameRoom $GameRoom
     */
    function postGameRoom(int $IdModule, bool $IsSingleplayer): GameRoom
    {
        global $mysqli;
        $sql = "INSERT INTO gamerooms(IdModule, IsSingleplayer) VALUES ('$IdModule', '$IsSingleplayer')";
        $mysqli->query($sql);

        $result = getGameRoom($mysqli->insert_id);
        
        return $result;
    }
    /**
     * Methode updateGameRoom.
     * Updates a GameRoom.
     * 
     * @param GameRoom $GameRoom
     * 
     * @return GameRoom $GameRoom
     */
    function updateGameRoom(GameRoom $GameRoom): GameRoom
    {
        global $mysqli;

        $IdGameRoom = $GameRoom->getIdGameRoom();
        $IdModule = $GameRoom->getIdModule();
        $IsSingleplayer = $GameRoom->getIsSingleplayer();

        $sql = "UPDATE gamerooms SET IdModule='$IdModule', IsSingleplayer='$IsSingleplayer' WHERE IdGameRoom='$IdGameRoom'";
        $mysqli->query($sql);

        $result = getGameRoom($IdGameRoom);

        return $result;
    }
    /**
     * Methode deleteGameRoom.
     * Deletes a GameRoom.
     * 
     * @param int $IdGameRoom
     * 
     * @return GameRoom $GameRoom
     */
    function deleteGameRoom(int $IdGameRoom): GameRoom
    {
        global $mysqli;
        $sql = "DELETE FROM gamerooms WHERE IdGameRoom='$IdGameRoom'";
        $mysqli->query($sql);

        $result = getGameRoom($IdGameRoom);

        return $result;
    }



    // GameUser
    /**
     * Methode getGameUser.
     * Gets a GameUser by Id.
     * 
     * @param int $IdGameUser
     * 
     * @return GameUser $GameUser
     */
    function getGameUser(int $IdGameUser): GameUser
    {
        global $mysqli;
        $sql = "SELECT * FROM gameusers WHERE IdGameUser='$IdGameUser'";
        $result = $mysqli->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $gameUser = new GameUser($row['IdGameUser'], $row['IdUser'], $row['IdGameRoom'], false, "", true);
            }
        }else{
            $gameUser = new GameUser(0, 0, 0, true, "Error!", false);
        }

        return $gameUser;
    }
    /**
     * Methode getGameUserByGame.
     * Gets a GameUser by Game.
     * 
     * @param int $IdGameRoom
     * 
     * @return array $GameUsers
     */
    function getGameUserByGame(int $IdGameRoom): array
    {
        global $mysqli;
        $gameUserArray = array();
        $sql = "SELECT * FROM gameusers WHERE IdGameRoom='$IdGameRoom'";
        $result = $mysqli->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $gameUser = new GameUser($row['IdGameUser'], $row['IdUser'], $row['IdGameRoom'], false, "", true);
                $gameUserArray[] = $gameUser;
            }
        }else{
            $gameUser = new GameUser(0, 0, 0, true, "Error!", false);
            $gameUserArray[] = $gameUser;
        }

        return $gameUserArray;
    }
    /**
     * Methode postGameUser.
     * Posts a GameUser.
     * 
     * @param int $IdUser
     * @param int $IdGame
     * 
     * @return GameUser $GameUser
     */
    function postGameUser(int $IdUser, int $IdGame): GameUser
    {
        global $mysqli;
        $sql = "INSERT INTO gameusers(IdUser, IdGameRoom) VALUES ('$IdUser', '$IdGame')";
        $mysqli->query($sql);
        
        $result = getGameUser($mysqli->insert_id);

        return $result;
    }
    /**
     * Methode updateGameUser.
     * Updates a GameUser.
     * 
     * @param GameUser $GameUser
     * 
     * @return GameUser $GameUser
     */
    function updateGameUser(GameUser $GameUser): GameUser
    {
        global $mysqli;

        $IdGameUser = $GameUser->getIdGameUser();
        $IdUser = $GameUser->getIdUser();
        $IdGame = $GameUser->getIdGame();

        $sql = "UPDATE gameusers(IdUser, IdGameRoom) SET IdUser='$IdUser', IdGameRoom='$IdGame' WHERE IdGameUser='$IdGameUser'";
        $mysqli->query($sql);
        
        $result = getGameUser($IdGameUser);

        return $result;
    }
    /**
     * Methode deleteGameUser.
     * Deletes a GameUser.
     * 
     * @param int $IdGameRoom
     * 
     * @return GameUser $GameUser
     */
    function deleteGameUser(int $IdGameRoom): GameUser
    {
        global $mysqli;
        $sql = "DELETE FROM gameusers WHERE IdGameRoom='$IdGameRoom'";
        $mysqli->query($sql);
        
        $result = getGameUser($IdGameRoom);

        return $result;
    }



    // GameQuestion
    /**
     * Methode getGameQuestion.
     * Gets a GameQuestion by Id.
     * 
     * @param int $IdGameQuestion
     * 
     * @return GameQuestion $GameQuestion
     */
    function getGameQuestion(int $IdGameQuestion): GameQuestion
    {
        global $mysqli;
        $sql = "SELECT * FROM gamequestions WHERE IdGameQuestion='$IdGameQuestion'";
        $result = $mysqli->query($sql);
        
        if($result->num_rows == 1){
            while($row = $result->fetch_assoc()){
                $gameQuestion = new GameQuestion($row['IdGameQuestion'], $row['IdGameRoom'], $row['IdQuestion'], false, "", true);
            }
        }else{
            $gameQuestion = new GameQuestion(0, 0, 0, true, "Error!", false);
        }

        return $gameQuestion;
    }
    /**
     * Methode getGameQuestions.
     * Gets all GameQuestions by GameRoom.
     * 
     * @param int $IdGameRoom
     * 
     * @return array $GameQuestions
     */
    function getGameQuestions(int $IdGameRoom): array
    {
        global $mysqli;
        $gameQuestionArray = array();
        $sql = "SELECT * FROM gamequestions WHERE IdGameRoom='$IdGameRoom'";
        $result = $mysqli->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $gameQuestion = new GameQuestion($row['IdGameQuestion'], $row['IdGameRoom'], $row['IdQuestion'], false, "", true);
                $gameQuestionArray[] = $gameQuestion;
            }
        }else{
            $gameQuestion = new GameQuestion(0, 0, 0, true, "Error!", false);
            $gameQuestionArray[] = $gameQuestion;
        }

        return $gameQuestionArray;
    }
    /**
     * Methode getGameQuestions.
     * Gets all GameQuestions by GameRoom.
     * 
     * @param int $IdQuestion
     * 
     * @return array $GameQuestions
     */
    function getUsedGameQuestions(int $IdQuestion): array
    {
        global $mysqli;
        $gameQuestionArray = array();
        $sql = "SELECT * FROM gamequestions WHERE IdQuestion='$IdQuestion'";
        $result = $mysqli->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $gameQuestion = new GameQuestion($row['IdGameQuestion'], $row['IdGameRoom'], $row['IdQuestion'], false, "", true);
                $gameQuestionArray[] = $gameQuestion;
            }
        }else{
            $gameQuestion = new GameQuestion(0, 0, 0, true, "Error!", false);
            $gameQuestionArray[] = $gameQuestion;
        }

        return $gameQuestionArray;
    }
    /**
     * Methode postGameQuestion.
     * Posts a GameQuestion.
     * 
     * @param int $IdGameRoom
     * @param int $IdQuestion
     * 
     * @return GameQuestion $GameQuestion
     */
    function postGameQuestion(int $IdGameRoom, int $IdQuestion): GameQuestion
    {
        global $mysqli;
        $sql = "INSERT INTO gamequestions(IdGameRoom, IdQuestion) VALUES ('$IdGameRoom', '$IdQuestion')";
        $mysqli->query($sql);
        
        $result = getGameQuestion($mysqli->insert_id);

        return $result;
    }
    /**
     * Methode updateGameQuestion.
     * Updates a GameQuestion.
     * 
     * @param GameQuestion $GameQuestion
     * 
     * @return GameQuestion $GameQuestion
     */
    function updateGameQuestion(GameQuestion $GameQuestion): GameQuestion
    {
        global $mysqli;

        $IdGameQuestion = $GameQuestion->getIdGameQuestion();
        $IdGameRoom = $GameQuestion->getIdGameRoom();
        $IdQuestion = $GameQuestion->getIdQuestion();

        $sql = "UPDATE gamequestions SET IdGameRoom='$IdGameRoom', IdQuestion='$IdQuestion' WHERE IdGameQuestion='$IdGameQuestion'";
        $mysqli->query($sql);
        
        $result = getGameQuestion($IdGameQuestion);

        return $result;
    }
    /**
     * Methode deleteGameQuestion.
     * Deletes a GameQuestion.
     * 
     * @param int $IdGameQuestion
     * 
     * @return GameQuestion $GameQuestion
     */
    function deleteGameQuestion(int $IdGameRoom): GameQuestion
    {
        global $mysqli;
        $sql = "DELETE FROM gamequestions WHERE IdGameRoom='$IdGameRoom'";
        $mysqli->query($sql);
        
        $result = getGameQuestion($IdGameRoom);

        return $result;
    }



    // GamePoint
    /**
     * Methode getGamePoint.
     * Gets a GamePoint by IdGameUser and IdGameQuestion.
     * 
     * @param int $IdGameUser
     * @param int $IdGameQuestion
     * 
     * @return GamePoint $GamePoint
     */
    function getGamePoint(int $IdGameUser, int $IdGameQuestion): GamePoint
    {
        global $mysqli;
        $sql = "SELECT * FROM gamepoints WHERE IdGameUser='$IdGameUser' AND IdGameQuestion='$IdGameQuestion'";
        $result = $mysqli->query($sql);

        if($result->num_rows == 1){
            while($row = $result->fetch_assoc()){
                $gamePoint = new GamePoint($row['IdGameUser'], $row['IdGameQuestion'], $row['IsCorrect'], false, "", true);
            }
        }else{
            $gamePoint = new GamePoint(0, 0, false, true, "Error!", false);
        }

        return $gamePoint;
    }
    /**
     * Methode postGamePoint.
     * Posts a GamePoint.
     * 
     * @param int $IdGameUser
     * @param int $IdGameQuestion
     * @param bool $IsCorrect
     * 
     * @return GamePoint $GamePoint
     */
    function postGamePoint(int $IdGameUser, int $IdGameQuestion, bool $IsCorrect): GamePoint
    {
        global $mysqli;
        $sql = "INSERT INTO gamepoints(IdGameUser, IdGameQuestion, IsCorrect) VALUES ('$IdGameUser', '$IdGameQuestion', '$IsCorrect')";
        $mysqli->query($sql);

        $result = getGamePoint($IdGameUser, $IdGameUser);

        return $result;
    }
    /**
     * Methode updateGamePoint.
     * Updates a GamePoint.
     * 
     * @param GamePoint $GamePoint
     * 
     * @return GamePoint $GamePoint
     */
    function updateGamePoint(GamePoint $GamePoint): GamePoint
    {
        global $mysqli;

        $IdGameUser = $GamePoint->getIdGameUser();
        $IdGameQuestion = $GamePoint->getIdGameQuestion();
        $IsCorrect = $GamePoint->getIsCorrect();

        $sql = "UPDATE gamepoints SET IsCorrect='$IsCorrect' WHERE IdGameUser='$IdGameUser' AND IdGameQuestion='$IdGameQuestion'";
        $mysqli->query($sql);
        
        $result = getGamePoint($IdGameUser, $IdGameQuestion);

        return $result;
    }
    /**
     * Methode deleteGamePoint.
     * Deletes a GamePoint.
     * 
     * @param int $IdGameUser
     * @param int $IdGameQuestion
     * 
     * @return GamePoint $GamePoint
     */
    function deleteGamePoint(int $IdGameUser, int $IdGameQuestion): GamePoint
    {
        global $mysqli;
        $sql = "DELETE FROM gamepoints WHERE IdGameUser='$IdGameUser' AND IdGameQuestion='$IdGameQuestion'";
        $mysqli->query($sql);
        
        $result = getGamePoint($IdGameUser, $IdGameQuestion);

        return $result;
    }

?>