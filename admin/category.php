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
        <h2>Category List</h2>
        <p class="description">View product categories below</p>  
        <div class="search_users">
          <div class="search_users_container">
            <input class="search_users_input" placeholder="Search for categories" >
            <div class="search_img_container"><img class="search_img" src="https://img.icons8.com/ios-glyphs/30/search--v1.png" alt="search--v1"/></div>
          </div>  
        </div>
        <?php
        include('functions/viewCategory.php');
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
        <h2>Add Category</h2>
        <p class="description">Add product categories</p>
        <form enctype="multipart/form-data" action="functions/add_category.php" method="POST">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" required>
          </div>  
          <div class="form-group">
            <label for="">Description</label>
            <textarea rows="4" name="description"></textarea>
          </div>
          <div class="form-group">
            <label for="image">Upload Image</label>
            <input type="file" name="image">
          </div>
          <div class="form-group">
            <p>Status</p>
            <div class="radio-container">
              <input type="radio" id="addAllowed" value="Visible" name="status" class="radio-input">
              <label for="addAllowed" class="radio-label">Visible</label>
            </div>
            <div class="radio-container">
              <input type="radio" id="addDenied" value="Hidden" name="status" class="radio-input">
              <label for="addDenied" class="radio-label">Hidden</label>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" name="add_category-btn">Save</button>
            <?php
            if(isset($_SESSION['message'])){ ?>
            <span class="message"> <?= $_SESSION['message'];?></span>
            <?php
              unset($_SESSION['message']);
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