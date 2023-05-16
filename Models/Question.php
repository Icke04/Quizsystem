<?php
    include_once("/xampp/htdocs/OnlineQuiz/Models/BaseModel.php");

    /**
     * Class Question.
     * Die Klasse ist eine Klasse, welche eine Frage der Anwendung darstellt.
     * 
     * @author Robin Ickemeyer <robin.ickemeyer@iubh.de>
     * @version 1.0.0
     */
    class Question extends BaseModel{



        public int $IdQuestion;
        public string $Question;
        public string $CorrectAnswer;
        public string $WrongAnswer1;
        public string $WrongAnswer2;
        public string $WrongAnswer3;
        public bool $IsApproved;
        public int $IdModule;
        public Module $Module;
        public int $IdUser;



        /**
         * Methode __construct.
         * Der Konstruktor zum Erstellen eines Question-Models.
         * 
         * @param int $IdQuestion
         * @param string $Question
         * @param string $CorrectAnswer
         * @param string $WrongAnswer1
         * @param string $WrongAnswer2
         * @param string $WrongAnswer3
         * @param bool $IsApproved
         * @param int $IdModule
         * @param int $IdUser
         * @param bool $IsError
         * @param string $ErrorText
         * @param bool $DataAvailable
         * 
         * @return Question $Question
         */
        public function __construct(int $IdQuestion, string $Question, string $CorrectAnswer, string $WrongAnswer1, string $WrongAnswer2, string $WrongAnswer3, bool $IsApproved, int $IdModule, int $IdUser, bool $IsError, string $ErrorText, bool $DataAvailable){
            $this->IdQuestion = intval($IdQuestion);
            $this->Question = $Question;
            $this->CorrectAnswer = $CorrectAnswer;
            $this->WrongAnswer1 = $WrongAnswer1;
            $this->WrongAnswer2 = $WrongAnswer2;
            $this->WrongAnswer3 = $WrongAnswer3;
            $this->IsApproved = $IsApproved;
            $this->IdModule = intval($IdModule);
            $this->IdUser = intval($IdUser);
            $this->IsError = $IsError;
            $this->ErrorText = $ErrorText;
            $this->DataAvailable = $DataAvailable;
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



        /**
         * Methode getQuestion.
         * Gets the Question.
         * 
         * @return int $Question
         */
        public function getQuestion(): string
        {
            return $this->Question;
        }
        /**
         * Methode setQuestion.
         * Sets the Question.
         * 
         * @param string $Question
         */
        public function setQuestion(string $Question): void
        {
            $this->Question = $Question;
        }



        /**
         * Methode getCorrectAnswer.
         * Gets the CoorectAnswer of the Question.
         * 
         * @return int $CorrectAnswer
         */
        public function getCorrectAnswer(): string
        {
            return $this->CorrectAnswer;
        }
        /**
         * Methode setCorrectAnswer.
         * Sets the CoorectAnswer of the Question.
         * 
         * @param string $CorrectAnswer
         */
        public function setCorrectAnswer(string $CorrectAnswer): void
        {
            $this->CorrectAnswer = $CorrectAnswer;
        }



        /**
         * Methode getWrongAnswer1.
         * Gets a WrongAnswer of the Question.
         * 
         * @return string $WrongAnswer1
         */
        public function getWrongAnswer1(): string
        {
            return $this->WrongAnswer1;
        }
        /**
         * Methode setWrongAnswer1.
         * Sets a WrongAnswer of the Question.
         * 
         * @param string $WrongAnswer1
         */
        public function setWrongAnswer1(string $WrongAnswer1): void
        {
            $this->WrongAnswer1 = $WrongAnswer1;
        }



        /**
         * Methode getWrongAnswer2.
         * Gets a WrongAnswer of the Question.
         * 
         * @return string $WrongAnswer2
         */
        public function getWrongAnswer2(): string
        {
            return $this->WrongAnswer2;
        }
        /**
         * Methode setWrongAnswer2.
         * Sets a WrongAnswer of the Question.
         * 
         * @param string $WrongAnswer2
         */
        public function setWrongAnswer2(string $WrongAnswer2): void
        {
            $this->WrongAnswer2 = $WrongAnswer2;
        }



        /**
         * Methode getWrongAnswer3.
         * Gets a WrongAnswer of the Question.
         * 
         * @return string $WrongAnswer3
         */
        public function getWrongAnswer3(): string
        {
            return $this->WrongAnswer3;
        }
        /**
         * Methode setWrongAnswer3.
         * Sets a WrongAnswer of the Question.
         * 
         * @param string $WrongAnswer3
         */
        public function setWrongAnswer3(string $WrongAnswer3): void
        {
            $this->WrongAnswer3 = $WrongAnswer3;
        }



        /**
         * Methode getIsApproved.
         * Gets if the Question IsApproved.
         * 
         * @return bool $IsApproved
         */
        public function getIsApproved(): bool
        {
            return $this->IsApproved;
        }
        /**
         * Methode setIsApproved.
         * Sets if the Question IsApproved.
         * 
         * @param bool $IsApproved
         */
        public function setIsApproved(bool $IsApproved): void
        {
            $this->IsApproved = $IsApproved;
        }



        /**
         * Methode getIdModule.
         * Gets the Id of the Module where the Question belongs.
         * 
         * @return int $IdModule
         */
        public function getIdModule(): int
        {
            return $this->IdModule;
        }
        /**
         * Methode setIdModule.
         * Sets the Id of the Module where the Question belongs.
         * 
         * @param int $IdModule
         */
        public function setIdModule(int $IdModule): void
        {
            $this->IdModule = $IdModule;
        }



        /**
         * Methode getIdUser.
         * Gets the Id of the User who created the Question.
         * 
         * @return int $IdUser
         */
        public function getIdUser(): int
        {
            return $this->IdUser;
        }
        /**
         * Methode setIdUser.
         * Sets the Id of the User who created the Question.
         * 
         * @param int $IdUser
         */
        public function setIdUser(int $IdUser): void
        {
            $this->IdUser = $IdUser;
        }



        /**
         * Methode getIdQuestion.
         * Gets the Module where the Question belongs.
         * 
         * @return Module $Module
         */
        public function getModule(): Module
        {
            return $this->Module;
        }
        /**
         * Methode setModule.
         * Sets the Module where the Question belongs.
         * 
         * @param Module $Module
         */
        public function setModule(Module $Module): void
        {
            $this->Module = $Module;
        }


        
    }
?>