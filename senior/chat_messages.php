<?php
    date_default_timezone_set("Asia/Manila");
    session_start();
    include '../db_connect.php';
    if(isset($_SESSION['senior_status']) && $_SESSION['senior_status'] == "Active"){

        
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming']);
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing']);
        
        $sql = mysqli_query($conn, "SELECT * FROM message_tbl WHERE (outgoing_id={$outgoing_id} AND incoming_id={$incoming_id}) OR (outgoing_id={$incoming_id} AND incoming_id={$outgoing_id}) ORDER BY message_id ASC");
        if(mysqli_num_rows($sql) > 0){
            while($row = mysqli_fetch_assoc($sql)){
                if($row['outgoing_id'] === $outgoing_id){
?>
    <div class="row d-flex justify-content-end">
        <div class="col-6 d-flex justify-content-end">
            <p class="bg-primary rounded-4 p-2 text-white" style="width:fit-content;"><?= $row['messages'] ?></p>
        </div>
    </div>
<?php
                }
                else{
?>
    <div class="row">
        <div class="col-6">
            <p class="bg-info rounded-4 p-2 text-white" style="width: fit-content;"><?= $row['messages'] ?></p>
        </div>
    </div>
<?php
                }
            }
        }

    }

    else{
        
    }


?>
