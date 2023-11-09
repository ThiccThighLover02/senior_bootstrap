                <div class="col-12">
                <?php
                    $chat_sql = mysqli_query($conn, "SELECT first_name, last_name, id_pic FROM senior_tbl");
                    while($row = mysqli_fetch_assoc($chat_sql)){
                ?>
                    <div class="row border-bottom border-gray">
                        <div class="col-3 ratio ratio-1x1" style="width: 6vw">
                            <img src="../senior/senior_pics/id_pics/<?= $row['id_pic'] ?>" class="img-fluid rounded-circle" alt="">
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-9">
                                    <h5 class="text-left"><?= $row['first_name']?>  <?= $row['last_name'] ?></h5>
                                    <p>Message goes here</p>
                                </div>
                                <div class="col-3 d-flex align-items-end">
                                    <p>. 10:00am</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>            
                </div>
