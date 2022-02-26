<?php 

    // redirct to home page and time before redirect
    
    function redirect($themsg, $url = null, $seconds = 0) {

        if($url === null) {

            $url = "index.php";

            $link = "Home page";
        }
        else {

                    // if in details

            if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== "") {

                $url = $_SERVER['HTTP_REFERER'];

                $link = "Previous page";
            }
            else {

                $url = "index.php";

                $link = "Home page";
            }
            
        }

        echo $themsg;

        echo '<div class="alert alert-info">' . "you will be redirected to $link in " . $seconds . " seconds" . '</div>';

        header("refresh:$seconds;url=$url");

        exit();
    }

?>