<?php
    include_once("/xampp/htdocs/OnlineQuiz/Models/BaseModel.php");

    /**
     * Class GameRoom.
     * Die Klasse ist eine Klasse, welche einen GameRoom der Anwendung im Spiel darstellt.
     * 
     * @author Robin Ickemeyer <robin.ickemeyer@iubh.de>
     * @version 1.0.0
     */
    class GameRoom extends BaseModel{



        public int $IdGameRoom;
        public int $IdModule;
        public bool $IsSingleplayer;



        /**
         * Methode __construct.
         * Der Konstruktor zum Erstellen eines GameRoom-Models.
         * 
         * @param int $IdGameRoom
         * @param int $IdModule
         * @param bool $IsSingleplayer
         * @param bool $IsError
         * @param string $ErrorText
         * @param bool $DataAvailable
         * 
         * @return GameRoom $GameRoom
         */
        public function __construct(int $IdGameRoom, int $IdModule, bool $IsSingleplayer, bool $IsError, string $ErrorText, bool $DataAvailable){
            $this->IdGameRoom = intval($IdGameRoom);
            $this->IdModule = intval($IdModule);
            $this->IsSingleplayer = $IsSingleplayer;
            $this->IsError = $IsError;
            $this->ErrorText = $ErrorText;
            $this->DataAvailable = $DataAvailable;
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

        

        /**
         * Methode getIsSingleplayer.
         * Gets if the GameRoom is SinglePlayer.
         * 
         * @return bool $IsSingleplayer
         */
        public function getIsSingleplayer(): bool
        {
            return $this->IsSingleplayer;
        }
        /**
         * Methode setIsSingleplayer.
         * Sets if the GameRoom IsSingleplayer.
         * 
         * @param bool $IsSingleplayer
         */
        public function setIsSingleplayer(bool $IsSingleplayer): void
        {
            $this->IsSingleplayer = $IsSingleplayer;
        }


    }
?>