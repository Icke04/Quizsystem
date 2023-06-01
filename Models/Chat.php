<?php
    include_once("/xampp/htdocs/OnlineQuiz/Models/BaseModel.php");

    /**
     * Class Chat.
     * Die Klasse ist eine Klasse, welche eine Chatnachricht der Anwendung darstellt.
     * 
     * @author Robin Ickemeyer <robin.ickemeyer@iubh.de>
     * @version 1.0.0
     */
    class Chat extends BaseModel{
        


        public int $IdMessage;
        public string $Username;
        public string $Message;



        /**
         * Methode __construct.
         * Der Konstruktor zum Erstellen eines Chat-Models.
         * 
         * @param int $IdMessage
         * @param string $Username
         * @param string $Message
         * @param bool $IsError
         * @param string $ErrorText
         * @param bool $DataAvailable
         * 
         * @return Chat $Chat
         */
        public function __construct(int $IdMessage, string $Username, string $Message, bool $IsError, string $ErrorText, bool $DataAvailable){
            $this->IdMessage = intval($IdMessage);
            $this->Username = $Username;
            $this->Message = $Message;
            $this->IsError = $IsError;
            $this->ErrorText = $ErrorText;
            $this->DataAvailable = $DataAvailable;
        }


 
        /**
         * Methode getIdMessage.
         * Gets the Id of the Message.
         * 
         * @return int $IdMessage
         */
        public function getIdMessage(): int
        {
            return $this->IdMessage;
        }
        /**
         * Methode setIdMessage.
         * Sets the Id of the Message.
         * 
         * @param int $IdMessage
         */
        public function setIdMessage(int $IdMessage): void
        {
            $this->IdMessage = $IdMessage;
        }



        /**
         * Methode getUsername.
         * Gets the Username who wrote the Message.
         * 
         * @return string $Username
         */
        public function getUsername(): string
        {
            return $this->Username;
        }
        /**
         * Methode setUsername.
         * Sets the Username of the Message.
         * 
         * @param string $Username
         */
        public function setUsername(string $Username): void
        {
            $this->Username = $Username;
        }



        /**
         * Methode getMessage.
         * Gets the Message.
         * 
         * @return string $Message
         */
        public function getMessage(): string
        {
            return $this->Message;
        }
        /**
         * Methode setMessage.
         * Sets the Message.
         * 
         * @param string $Message
         */
        public function setMessage(string $Message): void
        {
            $this->Message = $Message;
        }



    }
?>