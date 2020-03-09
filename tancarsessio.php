<?php

if (isset($_REQUEST["tancarSessio"])) {
                session_destroy();
                header('Location: index.html');
            }
?>