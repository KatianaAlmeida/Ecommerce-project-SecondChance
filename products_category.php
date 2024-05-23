<?php
session_start();
include('config/dbcon.php');
 include('components/header.php');
 include('components/navbar.php');
 include('components/frontbar.php');
 ?>
  <main>
  <div class="categoty_container">
        <div class="title">
          <h1>Product Category</h1>
        </div>
        <div class="category">
          <?php
            $sql = "SELECT * FROM categories";
            $result = mysqli_query($connection, $sql);

            if ($result) {
              if (mysqli_num_rows($result) > 0) {
                foreach ($result as $items) {
                  if ($items["status"] != "Hidden") {
                    ?>
                    <div class="each_category">
                      <a href="prodcuts.php?category=<?= $items["name"]; ?>">
                        <div class="image_container"><img src="admin/uploads/<?= $items["image"]; ?>" alt="<?= $items["name"]; ?>"></div>
                        <p><?= $items["name"]; ?></p>
                      </a>
                    </div>
                    <?php
                  }
                }
              } else {
                ?>
                <div class="each_category">
                  <p>No Categories Avaliable!</p>
                </div>
                <?php 
              }
            } else {
              ?>
              <div class="each_category">
                <p>Somehing Went Wrong! Sorry About that.</p>
              </div>
              <?php 
            }
          ?>
        </div>
      </div>
  </main>
<?php
 include('components/footer.php');
?>