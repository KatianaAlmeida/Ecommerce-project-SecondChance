<?php
session_start();
include('../config/dbcon.php');
 include('includes/header.php');
 include('includes/sideBar.php');
 ?>
 <div class="dashboard_container">
 <div class="overlay_cover js-overlay_cover"></div>

  <?php
    include('includes/navBar.php');
  ?>
    <!-- content/page section -->
    <main class="content">
      <div class="form_container table-container">
        <h2>Customers Message List</h2>
        <p class="description">View and reply to customer/visitor message.</p>  
        <div class="search_users">
          <div class="search_users_container">
            <input class="search_users_input" placeholder="Search for message" >
            <div class="search_img_container"><img class="search_img" src="https://img.icons8.com/ios-glyphs/30/search--v1.png" alt="search--v1"/></div>
          </div>  
        </div>
        <table class="displayUser">
          <tr>
            <th>Role</th>
            <th>Name</th>
            <th>Subject</th>
            <th>Content</th>
            <th>Reply</th>
          </tr>
          <?php
          $sql = "SELECT 'Customer' AS Role, u.full_name AS Name, m.id, u.email, m.subject, m.content FROM message m JOIN users u ON m.user_id = u.id UNION ALL SELECT 'Visitor' AS Role, CONCAT(v.first_name, ' ', v.last_name) AS Name, m.id, v.email, m.subject, m.content FROM message m JOIN visitor v ON m.visitor_id = v.id;";
          $result =  mysqli_query($connection, $sql);

          if ($result) {
          if (mysqli_num_rows($result) > 0) {
            foreach ($result as $items) {
              ?>
                <tr>
                  <td class="user_row"><?= $items["Role"]; ?></td>
                  <td class="user_row"><?= $items["Name"]; ?></td>
                  <td class="user_row"><?= $items["subject"]; ?></td>
                  <td class="user_row"><?= $items["content"]; ?></td>
                  <td class="user_row">
                    <form action="/admin/functions/reply.php" method="POST">
                      <input type="hidden" name="id" value="<?= $items["id"]; ?>">
                      <input type="hidden" name="Name" value="<?= $items["Name"]; ?>">
                      <input type="hidden" name="email" value="<?= $items["email"]; ?>">
                      <button class="delete_button" name="reply-btn">Reply</button>
                    </form>
                  </td>
                </tr>
              <?        
            }
            ?>
        </table>
            <?
          } else {
            $_SESSION['message'] = 'No category found!';
            header('Location: ../category.php');
          }
        } else {
          $_SESSION['message'] = 'Execution Error: '. $connection->error;
          header('Location: ../category.php');
        }
        ?>
        <div class="form-group">
          <?php
          if(isset($_SESSION['message'])){ ?>
          <span class="message"> <?= $_SESSION['message'];?></span>
          <?php
            unset($_SESSION['message']);
          }
          ?>
        </div>
      </div>
      <div class="form_container">
        <h2>Message Reply</h2>
        <p class="description">Users will receive an email.</p>
        <form enctype="multipart/form-data" action="functions/reply.php" method="POST">
          <div class="form-group">
            <?php
            if(isset($_SESSION['reply_message'])){ ?>
            <input type="hidden" name="email" value="<?= $_SESSION['email'];?>">
            <input type="hidden" name="id" value="<?= $_SESSION['id'];?>">
            <span class="message"> <?= $_SESSION['reply_message'];?></span>
            <?php
              unset($_SESSION['reply_message']);
            }else{
            ?>
            <span class="message">Click the 'Reply' button to responde a message!</span>
            <?php
            }
            ?>
          </div>
          <div class="form-group">
            <label for="">Description</label>
            <textarea rows="6" name="message_reply"></textarea>
          </div>
          <div class="form-group">
            <button type="submit" name="send_reply-btn">Send Message</button>
            <?php
            if(isset($_SESSION['reply_to_message'])){ ?>
            <span class="message"> <?= $_SESSION['reply_to_message'];?></span>
            <?php
              unset($_SESSION['reply_to_message']);
            }
            ?>
          </div>
        </form>
      </div>
    </main>
  </div>
<?php
 include('includes/footer.php');
?>