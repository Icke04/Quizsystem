<?php
    include_once("/xampp/htdocs/OnlineQuiz/Models/BaseModel.php");

    /**
     * Class IsTutor.
     * Die Klasse ist eine Klasse, welche einen Tutor mit einem Module verbindet.
     * 
     * @author Robin Ickemeyer <robin.ickemeyer@iubh.de>
     * @version 1.0.0
     */
    class IsTutor extends BaseModel{



        public int $IdUser;
        public int $IdModule;



        /**
         * Methode __construct.
         * Der Konstruktor zum Erstellen eines IsTutor-Models.
         * 
         * @param int $IdUser
         * @param int $IdModule
         * @param bool $IsError
         * @param string $ErrorText
         * @param bool $DataAvailable
         * 
         * @return IsTutor $IsTutor
         */
        public function __construct(int $IdUser, int $IdModule, bool $IsError, string $ErrorText, bool $DataAvailable){
            $this->IdUser = intval($IdUser);
            $this->IdModule = intval($IdModule);
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
         * @param int $IdUser
         */
        public function setIdUser(int $IdUser): void
        {
            $this->IdUser = $IdUser;
        }



        /**
         * Methode getIdModule.
         * Gets the Id of the Module.
         * 
         * @return int $IdModule
         */
        public function getIdModule(): int
        {
            return $this->IdModule;
        }
        /**
         * Methode setIdModule.
         * Sets the Id of the Module.
         * 
         * @param int $IdModule
         */
        public function setIdModule(int $IdModule): void
        {
            $this->IdModule = $IdModule;
        }



    }
?>