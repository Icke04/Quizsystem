<?php
    include_once("/xampp/htdocs/OnlineQuiz/Models/BaseModel.php");

    /**
     * Class GameUser.
     * Die Klasse ist eine Klasse, welche einen GameUser der Anwendung im Spiel darstellt.
     * 
     * @author Robin Ickemeyer <robin.ickemeyer@iubh.de>
     * @version 1.0.0
     */
    class GameUser extends BaseModel{



        public int $IdGameUser;
        public int $IdUser;
        public int $IdGame;



        /**
         * Methode __construct.
         * Der Konstruktor zum Erstellen eines GameUser-Models.
         * 
         * @param int $IdGameUser
         * @param int $IdUser
         * @param int $IdGame
         * @param bool $IsError
         * @param string $ErrorText
         * @param bool $DataAvailable
         * 
         * @return GameUser $GameUser
         */
        public function __construct(int $IdGameUser, int $IdUser, int $IdGame, bool $IsError, string $ErrorText, int $DataAvailable){
            $this->IdGameUser = intval($IdGameUser);
            $this->IdUser = intval($IdUser);
            $this->IdGame = intval($IdGame);
            $this->IsError = $IsError;
            $this->ErrorText = $ErrorText;
            $this->DataAvailable = $DataAvailable;
        }



        /**
         * Methode getIdGameUser.
         * Gets the Id of a GameUser.
         * 
         * @return int $IdGameUser
         */
        function getIdGameUser(): int
        {
            return $this->IdGameUser;
        }
        /**
         * Methode setIdGameUser.
         * Sets the Id of a GameUser.
         * 
         * @param int $IdGameUser
         */
        public function setIdGameUser(int $IdGameUser): void
        {
            $this->IdGameUser = $IdGameUser;
        }



        /**
         * Methode getIdGameUser.
         * Gets the Id of a GameUser.
         * 
         * @return int $IdGameUser
         */
        function getIdUser(): int
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
         * Methode getIdGame.
         * Gets the IdGame of a GameUser.
         * 
         * @return int $IdGame
         */
        function getIdGame(): int
        {
            return $this->IdGame;
        }
        /**
         * Methode setIdGame.
         * Sets the Id of the Game.
         * 
         * @param int $IdGame
         */
        public function setIdGame(int $IdGame): void
        {
            $this->IdGame = $IdGame;
        }



    }
?>