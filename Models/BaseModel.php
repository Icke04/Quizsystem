<?php
    /**
     * Class BaseModel.
     * Die Klasse ist eine Klasse, welche das BaseModel der Anwendung darstellt.
     * 
     * @author Robin Ickemeyer <robin.ickemeyer@iubh.de>
     * @version 1.0.0
     */
    class BaseModel{



        public bool $DataAvailable;
        public bool $IsError;
        public string $ErrorText;



        /**
         * Methode getDataAvailable.
         * Gets the DataAvailable variable.
         * 
         * @return bool $DataAvailable
         */
        public function getDataAvailable(): bool
        {
            return $this->DataAvailable;
        }
        /**
         * Methode setDataAvailable.
         * Sets the DataAvailable variable.
         * 
         * @param bool $DataAvailable
         */
        public function setDataAvailable(bool $DataAvailable): void
        {
            $this->DataAvailable = $DataAvailable;
        }



        /**
         * Methode getIsError.
         * Gets the IsError variable.
         * 
         * @return bool $IsError
         */
        public function getIsError(): bool
        {
            return $this->IsError;
        }
        /**
         * Methode setIsError.
         * Sets the IsError variable.
         * 
         * @param bool $IsError
         */
        public function setIsError(bool $IsError): void
        {
            $this->IsError = $IsError;
        }


        
        /**
         * Methode getErrorText.
         * Gets the ErrorText variable.
         * 
         * @return string $ErrorText
         */
        public function getErrorText(): string
        {
            return $this->ErrorText;
        }
        /**
         * Methode setErrorText.
         * Sets the ErrorText variable.
         * 
         * @param string $ErrorText
         */
        public function setErrorText(string $ErrorText): void
        {
            $this->ErrorText = $ErrorText;
        }



    }
?>