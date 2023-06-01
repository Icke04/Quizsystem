<?php
    include_once("/xampp/htdocs/OnlineQuiz/Models/BaseModel.php");

    /**
     * Class GameQuestion.
     * Die Klasse ist eine Klasse, welche eine GameQuestion der Anwendung im Spiel darstellt.
     * 
     * @author Robin Ickemeyer <robin.ickemeyer@iubh.de>
     * @version 1.0.0
     */
    class GameQuestion extends BaseModel{



        public int $IdGameQuestion;
        public int $IdGameRoom;
        public int $IdQuestion;



        /**
         * Methode __construct.
         * Der Konstruktor zum Erstellen eines GameQuestion-Models.
         * 
         * @param int $IdGameQuestion
         * @param int $IdGameRoom
         * @param int $IdQuestion
         * @param bool $IsError
         * @param string $ErrorText
         * @param bool $DataAvailable
         * 
         * @return GameQuestion $GameQuestion
         */
        public function __construct(int $IdGameQuestion, int $IdGameRoom, int $IdQuestion, bool $IsError, string $ErrorText, bool $DataAvailable){
            $this->IdGameQuestion = intval($IdGameQuestion);
            $this->IdGameRoom = intval($IdGameRoom);
            $this->IdQuestion = intval($IdQuestion);
            $this->IsError = $IsError;
            $this->ErrorText = $ErrorText;
            $this->DataAvailable = $DataAvailable;
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
         * Methode getIdGameRoom.
         * Gets the Id of the GameRoom.
         * 
         * @return int $IdGameRoom
         */
        public function getIdGameRoom(): int
        {
            return $this->IdGameRoom;
        }
        /**
         * Methode setIdGameRoom.
         * Sets the Id of the GameRoom.
         * 
         * @param int $IdGameRoom
         */
        public function setIdGameRoom(int $IdGameRoom): void
        {
            $this->IdGameRoom = $IdGameRoom;
        }



        /**
         * Methode getIdQuestion.
         * Gets the Id of the Question.
         * 
         * @return int $IdQuestion
         */
        public function getIdQuestion(): int
        {
            return $this->IdQuestion;
        }
        /**
         * Methode setIdQuestion.
         * Sets the Id of the Question.
         * 
         * @param int $IdQuestion
         */
        public function setIdQuestion(int $IdQuestion): void
        {
            $this->IdQuestion = $IdQuestion;
        }



    }
?>