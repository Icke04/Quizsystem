<?php
    include_once("/xampp/htdocs/OnlineQuiz/Models/BaseModel.php");

    /**
     * Class Role.
     * Die Klasse ist eine Klasse, welche eine Rolle der Anwendung darstellt.
     * 
     * @author Robin Ickemeyer <robin.ickemeyer@iubh.de>
     * @version 1.0.0
     */
    class Role extends BaseModel{



        public int $IdRole;
        public string $Role;



        /**
         * Methode __construct.
         * Der Konstruktor zum Erstellen eines Role-Models.
         * 
         * @param int $IdRole
         * @param string $Role
         * @param bool $IsError
         * @param string $ErrorText
         * @param bool $DataAvailable
         * 
         * @return Role $Role
         */
        public function __construct(int $IdRole, string $Role, bool $IsError, string $ErrorText, bool $DataAvailable){
            $this->IdRole = intval($IdRole);
            $this->Role = $Role;
            $this->IsError = $IsError;
            $this->ErrorText = $ErrorText;
            $this->DataAvailable = $DataAvailable;
        }



        /**
         * Methode getIdRole.
         * Gets Id of the Role.
         * 
         * @return int $IdRole
         */
        public function getIdRole(): int
        {
            return $this->IdRole;
        }
        /**
         * Methode setIdRole.
         * Sets Id of the Role.
         * 
         * @param int $IdRole
         */
        public function setIdRole(int $IdRole): void
        {
            $this->IdRole = $IdRole;
        }



        /**
         * Methode getRole.
         * Gets the RoleName.
         * 
         * @return int $Role
         */
        public function getRole(): string
        {
            return $this->Role;
        }
        /**
         * Methode setRole.
         * Sets the RoleName.
         * 
         * @param string $Role
         */
        public function setRole(string $Role): void
        {
            $this->Role = $Role;
        }


        
    }
?>