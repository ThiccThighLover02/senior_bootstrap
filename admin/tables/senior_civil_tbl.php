<?php
    $civil_stat = $_GET['filtu'];
    if($civil_stat == "all"){
      $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN civil_tbl C ON S.civil_id=C.civil_id ORDER BY civil_status ASC");
      $sql->execute();
      $result = $sql->get_result();
    }
    else{
      $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN civil_tbl C ON S.civil_id=C.civil_id WHERE S.civil_id=?");
      $sql->bind_param("i", $civil_stat);
      $sql->execute();
      $result = $sql->get_result();
    }
    
?>

<table class="table table-striped table-bordered align-middle thead-dark" id="myTable">
            <thead>
              <tr>
                <th>Senior No</th>
                <th>Status</th>
                <th>Name</th>
                <th>Civil Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php
              // this loop will iterate the rows and display the data
              while($row = mysqli_fetch_assoc($result)){
              $senior_stat = "";
              // if status is active the icon will be color green
              if($row['status'] == "Active"){
                $senior_stat = "text-success";
              }
              // if not the icon will be color red
              else{
                $senior_stat = "text-danger";
              }
            ?>
              <tr>
                <!-- display all the data in the row -->
                <td class="align-middle senior_id"><?= str_pad($row['senior_id'], 6, 0, STR_PAD_LEFT) ?></td>
                <td class="align-middle"><i class="fa-solid fa-circle fa-2xs <?= $senior_stat ?>"></i> <?= $row['status'] ?></td>
                <td class="align-middle"><?= $row['full_name'] ?></td>
                <td class="align-middle"><?= $row['civil_status'] ?></td>
                <td class="align-middle d-grid">
                  <a href="admin_senior_acc.php?id=<?= $row['senior_id'] ?>" class="btn btn-sm btn-primary btn-block text-white">View Senior</a>
                </td>
              </tr>
            <?php
              }
            ?>

            </tbody>
          </table>