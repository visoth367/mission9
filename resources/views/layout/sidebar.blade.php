
  <div class="sidebar">
    <div class="logo-details">

      <div class="logo_name">Management</div>
      <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="/home">
          <i class='bx bx-home'></i>
          <span class="links_name">Home</span>
        </a>
        <span class="tooltip">Home</span>
      </li>
      <li>
        <a href="/contact-us">
          <i class='bx bx-envelope'></i>
          <span class="links_name">Contact Us</span>
        </a>
        <span class="tooltip">Contact Us</span>
      </li>
      <li>
        <a href="/profile">
          <i class='bx bx-user'></i>
          <span class="links_name">User</span>
        </a>
        <span class="tooltip">User</span>
      </li>
      <li>
        <a href="/about-us">
          <i class='bx bx-book-content'></i>
          <span class="links_name">Content</span>
        </a>
        <span class="tooltip">Content</span>
      </li>
      <li>
        <a href="/video">
        <i class="fa-solid fa-video">V</i>
          <span class="links_name">Content</span>
        </a>
        <span class="tooltip">Upload Video</span>
      </li>
      <li>
        <a href="/purchased-courses">
        <i class="fa-solid fa-video">PV</i>
          <span class="links_name">Content</span>
        </a>
        <span class="tooltip">Purchased Video</span>
      </li>
      <!-- <li>
        <a href="#">
          <i class='bx bx-receipt'></i>
          <span class="links_name">Audit Log</span>
        </a>
        <span class="tooltip">Audit Log</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-flag'></i>
          <span class="links_name">Report</span>
        </a>
        <span class="tooltip">Report</span>
      </li> -->
        <!-- <li>
          <a href="#">
            <i class='bx bx-check-shield'></i>
            <span class="links_name">Policy</span>
          </a>
          <span class="tooltip">Policy</span>
        </li> -->

        <li class="profile">
          <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="logout-btn">
                  <i class='bx bx-log-out' id="log_out"></i>
                  <span class="links_name">Logout</span>
              </button>
          </form>
          <span class="tooltip">Logout</span>
      </li>
  
  <!-- <script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");

    closeBtn.addEventListener("click", () => {
      sidebar.classList.toggle("open");
      menuBtnChange();//calling the function(optional)
    });


    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
      if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
      } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");//replacing the iocns class
      }
    }
  </script> -->