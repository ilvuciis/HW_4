
<?php
    class Form {
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
            $form = '<form action="process.php" method="POST" enctype="multipart/form-data">';
            $form .= '<input class= "formaviens" type="text" name="sname" required placeholder="Ieraksti darāmo uzdevumu!">';
            $form .= '<input class= "formadivi" type="text" name="album" placeholder="Uzdevuma svarīgums">';
         //   $form .= '<input class= "formadivi" type="text" name="artist" placeholder="Uzdevuma svarīgums">';
            $form .= '<button type="submit">PIEVIENOT</button>';
            $form .= '</form>';
            echo $form;     
            
        }

       

        public function process() {
            //we check for keys and set default values if key does not exist
           
            $sname = array_key_exists('sname', $_POST) ? $_POST['sname'] : "New Song";
         //   $artist = array_key_exists('artist', $_POST) ? $_POST['artist'] : "Unknown";
            $album = array_key_exists('album', $_POST) ? $_POST['album'] : "N/A";
            if (isset($_SESSION) && isset($_SESSION['uid'])) {
                $uid = $_SESSION['uid'];
            } else {
                //FIXME remove die!
                die("Lietotājs nav specificēts!");
                return;
            }

            $sql = "INSERT INTO tracks (name,  album,  uid)
            VALUES (?, ?, ?)";
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $upstm = $this->db->prepare($sql);
            if(!$upstm->execute([$sname, $album,  $uid])) {
                die('Not good');
            }
            //We can only reload using header if no html has been sent to page here
            //
            header("Location: index.php");
        }
    }
?>