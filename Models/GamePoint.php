<?php
    include_once("/xampp/htdocs/OnlineQuiz/Models/BaseModel.php");

    /**
     * Class GamePoints.
     * Die Klasse ist eine Klasse, welche die GamePoints der Anwendung im Spiel darstellt.
     * 
     * @author Robin Ickemeyer <robin.ickemeyer@iubh.de>
     * @version 1.0.0
     */
    class GamePoint extends BaseModel{



        public int $IdGameUser;
        public int $IdGameQuestion;
        public bool $IsCorrect;



        /**
         * Methode __construct.
         * Der Konstruktor zum Erstellen eines GamePoint-Models.
         * 
         * @param int $IdGameUser
         * @param int $IdGameQuestion
         * @param bool $IsCorrect
         * @param bool $IsError
         * @param string $ErrorText
         * @param bool $DataAvailable
         * 
         * @return GamePoints $GamePoints
         */
        public function __construct(int $IdGameUser, int $IdGameQuestion, bool $IsCorrect, bool $IsError, string $ErrorText, bool $DataAvailable){
            $this->IdGameUser = intval($IdGameUser);
            $this->IdGameQuestion = intval($IdGameQuestion);
            $this->IsCorrect = $IsCorrect;
            $this->IsError = $IsError;
            $this->ErrorText = $ErrorText;
            $this->DataAvailable = $DataAvailable;
        }


        
        /**
         * Methode getIdGameUser.
         * Gets the Id of the GameUser.
         * 
         * @return int $IdGameUser
         */
        public function getIdGameUser(): int
        {
            return $this->IdGameUser;
        }
        /**
         * Methode setIdGameUser.
         * Sets the Id of the GameUser.
         * 
         * @param int $IdGameUser
         */
        public function setIdGameUser(int $IdGameUser): void
        {
            $this->IdGameUser = $IdGameUser;
        }



        /**
         * Methode getIdGameQuestion.
         * Gets the Id of the GameQuestion.
         * 
         * @return int $IdGameQuestion
         */
        public function getIdGameQuestion(): int
        {
            return $this->IdGameQuestion;
        }
        /**
         * Methode setIdGameQuestion.
         * Sets the Id of the GameQuestion.
         * 
         * @param int $IdGameQuestion
         */
        public function setIdGameQuestion(int $IdGameQuestion): void
        {
            $this->IdGameQuestion = $IdGameQuestion;
        }



        /**
         * Methode getIsCorrect.
         * Gets if answer IsCorrect.
         * 
         * @return bool $IsCorrect
         */
        public function getIsCorrect(): bool
        {
            return $this->IsCorrect;
        }
        /**
         * Methode setIsCorrect.
         * Sets if the answer IsCorrect.
         * 
         * @param bool $IsCorrect
         */
        public function setIsCorrect(bool $IsCorrect): void
        {
            $this->IsCorrect = $IsCorrect;
        }



    }
?>