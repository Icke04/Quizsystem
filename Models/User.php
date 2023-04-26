<?php
    include_once("/xampp/htdocs/OnlineQuiz/Models/BaseModel.php");

    /**
     * Class User.
     * Die Klasse ist eine Klasse, welche einen User der Anwendung darstellt.
     * 
     * @author Robin Ickemeyer <robin.ickemeyer@iubh.de>
     * @version 1.0.0
     */
    class User extends BaseModel {



        public int $IdUser;
        public string $Username;
        public string $Email;
        public string $Password;
        public int $IdRole;



        /**
         * Methode __construct.
         * Der Konstruktor zum Erstellen eines User-Models.
         * 
         * @param int $IdUser
         * @param string $Username
         * @param string $Email
         * @param string $Password
         * @param int $IdRole
         * @param bool $IsError
         * @param string $ErrorText
         * @param bool $DataAvailable
         * 
         * @return User $User
         */
        public function __construct(int $IdUser, string $Username, string $Email, string $Password, int $IdRole, bool $IsError, string $ErrorText, bool $DataAvailable){
            $this->IdUser = intval($IdUser);
            $this->Username = $Username;
            $this->Email = $Email;
            $this->Password = $Password;
            $this->IdRole = intval($IdRole);
            $this->IsError = $IsError;
            $this->ErrorText = $ErrorText;
            $this->DataAvailable = $DataAvailable;
        }



        /**
         * Methode getIdUser.
         * Gets the Id of the User.
         * 
         * @return int $IdUser
         */
        public function getIdUser(): int
        {
            return $this->IdUser;
        }
        /**
         * Methode setIdUser.
         * Sets the Id of the User.
         * 
         * @param $IdUser.
         */
        public function setIdUser(int $IdUser): void
        {
            $this->IdUser = $IdUser;
        }



        /**
         * Methode getUsername.
         * Gets the Username of the User.
         * 
         * @return $Username
         */
        public function getUsername(): string
        {
            return $this->Username;
        }
        /**
         * Methode setUsername.
         * Sets the Username of the User.
         * 
         * @param string $Username
         */
        public function setUsername(string $Username): void
        {
            $this->Username = $Username;
        }



        /**
         * Methode getEmail.
         * Gets the Email of the User.
         * 
         * @return $Email
         */
        public function getEmail(): string
        {
            return $this->Email;
        }
        /**
         * Methode setEmail.
         * Sets the Email of the User.
         * 
         * @param string $Email
         */
        public function setEmail(string $Email): void
        {
            $this->Email = $Email;
        }



        /**
         * Methode getPassword.
         * Gets the Password of the User.
         * 
         * @return $Password
         */
        public function getPassword(): string
        {
            return $this->Password;
        }
        /**
         * Methode setPassword.
         * Sets the Password of the User.
         * 
         * @param string $Password
         */
        public function setPassword(string $Password): void
        {
            $this->Password = $Password;
        }



        /**
         * Methode getRole.
         * Gets the Role of the User.
         * 
         * @return int $IdRole
         */
        public function getIdRole(): int
        {
            return $this->IdRole;
        }
        /**
         * Methode setRole.
         * Sets the Role of the User.
         * 
         * @param int $Role
         */
        public function setRole(int $IdRole): void
        {
            $this->IdRole = $IdRole;
        }


        
    }
?>