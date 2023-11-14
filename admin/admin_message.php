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
        include "nav_style.php";
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
    $chat_sql = mysqli_query($conn, "SELECT first_name, last_name, id_pic, message_id FROM senior_tbl");
    while($row = mysqli_fetch_assoc($chat_sql)){
?>
    <a href="admin_message.php?message_id=<?= $row['message_id'] ?>" style="text-decoration:none; color: black;">
    <div class="row border-bottom border-gray">
        <div class="col-3 ratio ratio-1x1" style="width: 6vw">
            <img src="../senior/senior_pics/id_pics/<?= $row['id_pic'] ?>" class="img-fluid" alt="">
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
    </a>
<?php
    }
?>            
</div>
            </div>
            
        </div>
        <?php
            if(!isset($_GET['message_id'])){
        ?>
            <div class="col-lg-8 bg-white d-flex align-items-center justify-content-center">
                <h1>Please select a chat</h1>
            </div>
        <?php
            }
            elseif(isset($_GET['message_id'])){
            $sql_message = $conn->prepare("SELECT id_pic, first_name, last_name FROM senior_tbl WHERE message_id=?");
            $sql_message->bind_param("i", $_GET['message_id']);
            $sql_message->execute();
            $message_result = $sql_message->get_result();
            $message_row = mysqli_fetch_assoc($message_result);
        ?>
        <div class="col-lg-8 bg-white">
            <!-- Message header -->
            <div class="row bg-primary border-top border-white pt-1 pb-1" style="height: 9vh">
                <div class="col-lg-1 col-2 d-flex align-items-center">
                    <div class="ratio ratio-1x1">
                        <img src="../senior/senior_pics/id_pics/<?= $message_row['id_pic'] ?>" class="img-fluid rounded-circle border border-black" alt="">
                    </div>
                </div>
                <div class="col-8 text-white d-flex align-items-center">
                    <h3 class="align-self-center"><?= $message_row['first_name'] ?> <?= $message_row['last_name'] ?></h3>
                </div>
            </div>

            <div class="row overflow-y-scroll message-contain" style="height: 70vh" id="chat-area">

            </div>

            <!-- Footer -->
            <div class="row">
                <form action="#" id="message-form" class="message-form" autocomplete="off">
                    <div class="input-group mb-3"> 
                        <input type="text" value="<?= $_GET['message_id'] ?>" name="incoming" hidden>
                        <input type="text" value="<?= $_SESSION['admin_message'] ?>" name="outgoing" hidden>
                        <input type="text" name="input-field" class="form-control form-control-lg " id="message-input" placeholder="Aa" aria-label="Message" aria-describedby="basic-addon2">
                        <button class="input-group-text bg-primary text-white message-button" id="message-button"><i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </form>
            </div> 

        </div>

        <?php
            }
        ?>
        <!-- Table ends here -->
      </div>
    </div>
  </body>
  <script>
    const sideChat = document.querySelector("#side-chat");
    const chatArea = document.querySelector("#chat-area");
    const form = document.querySelector("#message-form");
    inputMessage = form.querySelector("#message-input");
    messageButton = document.querySelector("#message-button");

    form.onsubmit = (e)=>{
        e.preventDefault();
    }

    messageButton.onclick = ()=>{
        let xhr = new XMLHttpRequest(); //create xml object
        xhr.open("POST", "send_message.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    inputMessage.value = "";
                    scrollToBottom();
                }
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);
    }
    chatArea.onmouseenter = ()=>{
        chatArea.classList.add("active");
    }

    chatArea.onmouseleave = ()=>{
        chatArea.classList.remove("active");
    }

    setInterval(() => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "chat_messages.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    chatArea.innerHTML = data;
                    if(!chatArea.classList.contains("active")){
                        scrollToBottom();
                    }
                }
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);
    }, 500);

    function scrollToBottom(){
        chatArea.scrollTop = chatArea.scrollHeight;
    }

    // setInterval(() => {
    //     let xhr = new XMLHttpRequest();
    //     xhr.open("GET", "admin_chat_sidebar.php", true);
    //     xhr.onload = ()=>{
    //         if(xhr.readyState === XMLHttpRequest.DONE){
    //             if(xhr.status === 200){
    //                 let data = xhr.response;
    //                 sideChat.innerHTML = data;
    //             }
    //         }
    //     }
    //     xhr.send();
    // }, 500);
    
  </script>
</html>

<?php
    }
    // If there are no sessions you will be redirected back to the landing page
    else {
        header("Location: index.php");
    }
?>