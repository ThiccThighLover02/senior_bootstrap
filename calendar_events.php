<?php
    include 'db_connect.php';
    date_default_timezone_set('Asia/Manila');
    $month = date("m");
    $events = $conn->prepare("SELECT * FROM activity_tbl WHERE MONTH(post_date)=? AND post_type='event'");
    $events->bind_param("s", $month);
    $events->execute();
    $event_res = $events->get_result();

    while($row = mysqli_fetch_assoc($event_res)){
        $event_array = array(
            'id' => $row['post_id'],
            'title' => $row['post_title'],
            'start' => $row['time_start'],
            'end' => $row['time_end'],
            'allDay' => false
        );

        $all_dates[] = $event_array;
    }

    $jsonString = json_encode($all_dates);
    echo $jsonString;
    

?>