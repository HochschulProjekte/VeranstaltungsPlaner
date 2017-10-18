<?php

    include_once __DIR__.'/../class/loginHandler.php';

    class LoginController {

        public $alert;

        public function __construct($POST_ARRAY) {
            $this->parsePostArray($POST_ARRAY);
        }
        
        private function parsePostArray($POST_ARRAY) {
            // Check, if inputs are filled
            if (isset($POST_ARRAY['login-username']) && isset($POST_ARRAY['login-password'])) {
                // Create LoginHandler
                $loginHandler = new LoginHandler();

                // Try to login user with form inputs
                $ret = $loginHandler->login($POST_ARRAY['login-username'], $POST_ARRAY['login-password']);

                // Check, if login was successful
                if ($ret['err'] == true) {
                    // => error occured -> set talert
                    $this->alert = array();
                    $this->alert['type'] = $ret['type'];
                    $this->alert['msg'] = $ret['msg'];
                } else {
                    // => login successful -> redirect user
                    $loginHandler->redirect('vstp/index.php');
                }
            } else {
                $this->alert = array();
                $this->alert['type'] = 'info';
                $this->alert['msg'] = 'Bitte geben Sie ihren Benutzernamen und ihr Passwort ein.';
            }
        }
    }

?>