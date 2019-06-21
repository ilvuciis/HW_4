<?php
    class Register {
        private $db;
        public function __construct($db) {
            $this->db = $db;
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->process();
            } else { //should really only be for GET
                $this->render();
            }
        }
        public function render() {
            if (isset($_SESSION) && isset ($_SESSION['user'])) {
                echo "<h2>Sveicināti, " . $_SESSION['user'] . "!</h2>";
                echo "<br>";
            } else {
                echo "<h2>Tu neesi ielogojies! </h2><br>";
            }
            $form = '<form action="register.php" method="POST">';
            $form .= '<input type="text" name="username" placeholder="Lietotājvārds" required>';
            $form .= '<input type="text" name="lastname" placeholder="Uzvārds" required>';
            $form .= '<input type="email" name="email" placeholder="Ieraksti savu e-pastu! ">';
            $form .= '<input type="password" name="pw" placeholder="Parole" required>';
            $form .= '<button type="submit">Reģistrēties</button>';
            $form .= '</form>';
            echo $form;     
            
        }

        public function process() {
            //we check for keys and set default values if key does not exist
            //TODO check if user already 
            //TODO you might want additional validation here
            $username = array_key_exists('username', $_POST) ? $_POST['username'] : "";
            $lastname = array_key_exists('lastname', $_POST) ? $_POST['lastname'] : "";
            $email = array_key_exists('email', $_POST) ? $_POST['email'] : "email";
            
            $hash = password_hash($_POST['pw'], PASSWORD_DEFAULT);
            //TODO REMOVE THIS!!!! 
            // setcookie("PW", $_POST['pw'], time() + (86400 * 30), "/");
            // setcookie("HASH", $hash, time() + (86400 * 30), "/");


 
            $sql = "INSERT INTO users (username, lastname, email, pwhash)
            VALUES (?, ?, ?, ?)";
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $upstm = $this->db->prepare($sql);
            if(!$upstm->execute([$username,$lastname, $email, $hash])) {
                die('Not good');
            }
            $_SESSION['user'] = $username;
            //We can only reload using header if no html has been sent to page here
            header("Location: register.php");
        }
    }
?>