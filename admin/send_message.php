<?php
    include 'db_connect.php';

    $incoming_id = $_POST['incoming'];
    $outgoing_id = $_POST['outgoing'];
    $message = $_POST['message-input'];

?>

    <script>
        console.log("<?= $incoming_id ?> . <?= $outgoing_id ?> . <?= $message ?>");
    </script>
