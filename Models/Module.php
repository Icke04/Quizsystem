<?php
    include_once("/xampp/htdocs/OnlineQuiz/Models/BaseModel.php");

    /**
     * Class Module.
     * Die Klasse ist eine Klasse, welche ein Modul der Anwendung darstellt.
     * 
     * @author Robin Ickemeyer <robin.ickemeyer@iubh.de>
     * @version 1.0.0
     */
    class Module extends BaseModel{
        


        public int $IdModule;
        public string $Abbreviation;
        public string $FullDesignation;



        /**
         * Methode __construct.
         * Der Konstruktor zum Erstellen eines Module-Models.
         * 
         * @param int $IdModule
         * @param string $Abbreviation
         * @param string $FullDesignation
         * @param bool $IsError
         * @param string $ErrorText
         * @param bool $DataAvailable
         * 
         * @return Module $Module
         */
        public function __construct(int $IdModule, string $Abbreviation, string $FullDesignation, bool $IsError, string $ErrorText, bool $DataAvailable){
            $this->IdModule = intval($IdModule);
            $this->Abbreviation = $Abbreviation;
            $this->FullDesignation = $FullDesignation;
            $this->IsError = $IsError;
            $this->ErrorText = $ErrorText;
            $this->DataAvailable = $DataAvailable;
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
         * @return string $IdModule
         */
        public function setIdModule(int $IdModule): void
        {
            $this->IdModule = $IdModule;
        }



        /**
         * Methode getAbbreviation.
         * Gets the Abbreviation of the Module.
         * 
         * @return string $Abbreviation
         */
        public function getAbbreviation(): string
        {
            return $this->Abbreviation;
        }
        /**
         * Methode setAbbreviation.
         * Sets the Abbreviation of the Module.
         * 
         * @return string $Abbreviation
         */
        public function setAbbreviation(string $Abbreviation): void
        {
            $this->Abbreviation = $Abbreviation;
        }



        /**
         * Methode getFullDesignation.
         * Gets the FullDesignation of the Module.
         * 
         * @return string $FullDesignation
         */
        public function getFullDesignation(): string
        {
            return $this->FullDesignation;
        }
        /**
         * Methode setFullDesignation.
         * Sets the FullDesignation of the Module.
         * 
         * @return string $FullDesignation
         */
        public function setFullDesignation(string $FullDesignation): void
        {
            $this->FullDesignation = $FullDesignation;
        }



    }
?>