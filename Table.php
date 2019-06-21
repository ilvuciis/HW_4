
<?php
    class Table {
        private $db;
        private $limit;

        public function __construct($db, int $limit=10) {
            $this->db = $db;
            $this->limit = $limit;
            $this->render();
        }

        public function render() {
            // HERE we get the date from the table
            if (isset($_SESSION) && isset($_SESSION['user'])) {
                echo "<br>";
                    echo "<h2>Priecājamies Tevi redzēt, " . $_SESSION['user'] . "! </h2>";
                 //   echo "<p>Your user ID is " . $_SESSION['uid'] . "</p>";
            }
            $uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : 0;
           // echo "<p>Your user ID is " . $uid . "</p>";
            $tableheader = false;
            
           
           //here we control what information to give users
            $query = "SELECT * FROM Tracks WHERE uid = ? LIMIT ?";

            $sth = $this->db->prepare($query);
 
            if(!$sth->execute([$uid, $this->limit])) {
                die('Error');
            }

            //we get all rows here!
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);

            //render should realy start here
            echo "<br>";
            echo "<table>";
            foreach ($rows as $row) {
                if($tableheader == false) {
              //      echo '<tr><th>IMG</th>';
                    
                    foreach($row as $key=>$value) {
                    //    echo "<th>{$key}</th>";
                    }
                    echo '</tr>';
                    $tableheader = true;
                }
                echo "<tr id='row" . $row['id'] . "'>";
            //    echo "<td><img src='" . $row['img'] . "' class='icons'></td>";
                echo "<form   action='update.php' method='POST'>";
                foreach($row as $key=>$value) {
                    if ($key == 'id') {
                     //   echo "<td class='rowid'>{$value}</td>";
                    } else {
                        if (in_array($key, ["name",	"album"	])) {
                            echo "<td id='tableviens' class='$key'><input type='text' name='$key' value = '$value'></td>";
                        } else {
                            echo "<td class='$key'>{$value}</td>";
                           
                        }
                        
                    }

                    //, 

                }
               // echo "<td><form><button name='updbtn' value='" . $row['id'] . "'>LABOT</button></td></form>";
               echo "<td><form action='update.php' method='POST'><button name='updbtn' value='" . $row['id'] . "'>LABOT</button></form></td>";
               
               echo "<td><form action='delete.php' method='POST'><button name='delbut' value='" . $row['id'] . "'>IZDZĒST</button></form></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
?>



