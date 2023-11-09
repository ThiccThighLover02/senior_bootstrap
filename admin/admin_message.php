<?php
    session_start();
    include "../db_connect.php";
    // If there is a admin status session
    if(isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == "Active"){

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include "admin_links.php";
    ?>
    <title>Senior System</title>
</head>
  <body class="bg-white" style="overflow: hidden;">
    <?php
      include 'admin_navbar.php';
    ?>
    <div class="container-fluid">
      <div class="row rounded" id="navbarSupportedContent" style="height: 90vh">
        <div class="col-lg-4 bg-white border-end border-gray offcanvas-lg" id="sideDiv">
            <div class="row bg-primary d-flex align-items-center border-top border-white" style="height: 9vh">
                <div class="col-2 sticky-top">
                    <a href="admin_home.php" class="text-white"><i class="fa-solid fa-arrow-left fa-2xl"></i></a>
                </div>
                <div class="col-8" id="">
                <h3 class="text-white float-start">Chats</h3>
                </div>
            </div>
            <div class="row border-bottom overflow-y-scroll chats" style="height: 80vh" id="side-chat">
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
            </div>
            
        </div>
        <div class="col-lg-8 bg-white">
            <!-- Message header -->
            <div class="row bg-primary border-top border-white pt-1 pb-1" style="height: 9vh">
                <div class="col-1">
                    <img src="admin_pic/admin_pic.jpg" class="img-fluid rounded-circle" alt="">
                </div>
                <div class="col-8 text-white">
                    <h3 class="align-self-center">Carlson Magtalas</h3>
                </div>
            </div>

            <div class="row overflow-y-scroll message-contain" style="height: 70vh">
                <!-- Incoming Message -->
                <div class="col-12 receive">
                    <div class="row p-3">
                        <div class="col-1 align-self-end">
                            <img src="admin_pic/admin_pic.jpg" class="img-fluid rounded-circle" alt="">
                        </div>
                        <div class="col-5 receive">
                            <p class="bg-secondary text-white p-2 rounded-4">This is a sample message, i don't know how long it should be but let's make it as long as we can hahahahhaahahahahah</p>
                        </div>
                    </div>
                </div>

                <!-- Outgoing Message -->
                <div class="col-12 send">
                    <div class="row p-3 justify-content-end send">
                        <div class="col-5">
                            <p class="bg-primary p-2 rounded-4 text-white">This is a sample message, i don't know how long it should be but let's make it as long as we can hahahahhaahahahahah
                                This is a sample message, i don't know
                            </p>

                            <p class="bg-primary p-2 rounded-4 text-white">
                                another message?
                            </p>
                            
                        </div>
                        <div class="col-1 align-self-end">
                            <img src="admin_pic/admin_pic.jpg" class="img-fluid rounded-circle" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="row">
                <form action="send_message.php" method="post" id="message-form">
                    <div class="input-group mb-3">
                        <input type="text" value="1" name="incoming" hidden>
                        <input type="text" value="2" name="outgoing" hidden>
                        <input type="text" name="message-input" class="form-control form-control-lg message-input" placeholder="Aa" aria-label="Message" aria-describedby="basic-addon2">
                        <button type="button" class="input-group-text bg-primary text-white message-button" id="basic-addon2"><i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>

        </div>
        <!-- Table ends here -->
      </div>
    </div>
  </body>
  <script>
    const sideChat = document.querySelector("#side-chat");
    const form = document.querySelector("#message-form");

    setInterval(() => {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "admin_view_chats.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    console.log(data);
                }
            }
        }
    }, 500);
    
  </script>
</html>

<?php
    }
    // If there are no sessions you will be redirected back to the landing page
    else {
        header("Location: index.php");
    }
?>