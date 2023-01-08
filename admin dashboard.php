<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="CSS/Admin Dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <img src="image/p&t logo.jpg" width="100" height="80"></i>
            
            <span class="logo-name">
            <span id="P">P</span>
            <span id="N">&</span>
            <span id="T">T</span>
            </span>

            

        </div>
        <ul class="nav-links">
            <li>
                <a href="#">
                    <i class="material-icons">&#xe88a;</i>
                    <span class="links-name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="admin product sales.html" class="links-name">
                    <i class="material-icons">&#xe1bd;</i>
                    <span class="links-name">Product Sales</span>
                </a>
            </li>
            <li>
                <a href="add admin.html" class="links-name">
                    <i class="material-icons">&#xea3d;</i>
                    <span class="links-name">Staff</span>
                </a>
            </li>
            <!-- <li>
                <a href="" class="links-name">
                    <i class="material-icons">&#xe7fb;</i>
                    <span class="links-name">Member</span>
                </a>
            </li> -->
            <li>
                <a href="" class="links-name">
                    <i class="material-icons">&#xe574;</i>
                    <span class="links-name">Product's Category</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="material-icons">&#xe8cc;</i>
                    <span class="links-name">Order</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="material-icons md-48">assessment</i>
                    <span class="links-name">Report</span>
                </a>
            </li>
            <li>
                <a href="edit profile.html">
                    <i class="material-icons">&#xe8b8;</i>
                    <span class="links-name">Setting</span>
                </a>
            </li>
            <li>
                <a href="Login page.html" class="links-name">
                    <i class="material-icons">&#xe9ba;</i>
                    <span class="links-name">Log out</span>
                </a>
            </li>
        </ul>
    </div>

   
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class="material-icons">&#xe5d2;</i>
                <span class="dashboard">Dashboard</span>
            </div>

            <div class="profile-details">
            <img src="image/user icon.png" alt="">
            <span class="admin_name">Hi,Admin</span>
            <i class="material-icons">&#xe5cf;</i>
        </div>
    </nav>

 <!--Home-content-->
    <div class="home-content">
        <div class="overview-boxes">
            <div class="box">
                <div class="left-side">
                    <div class="box-topic">Order List</div>
                        <div class="number">40,876</div>
                            <div class="indicator">
                                <i class="material-icons">&#xf182;</i>
                                <span class=""text>Up from yesterday</span>
                </div>
            </div>
            <i class="material-icons cart">&#xe8e5;</i>
            </div>

            <div class="box">
                <div class="left-side">
                    <div class="box-topic">Total Sales</div>
                        <div class="number">38,876</div>
                            <div class="indicator">
                                <i class="material-icons">&#xf182;</i>
                                <span class=""text>Up from yesterday</span>
                </div>
            </div>
            <i class="material-icons cart two">&#xe8e5;</i>
            </div>

            <div class="box">
                <div class="left-side">
                    <div class="box-topic">Total Profit</div>
                        <div class="number">12,876</div>
                            <div class="indicator">
                                <i class="material-icons">&#xf182;</i>
                                <span class=""text>Up from yesterday</span>
                            </div>
                </div>
            <i class="material-icons cart three">&#xe8e5;</i>
    </div>

    <div class="box">
        <div class="left-side">
            <div class="box-topic">Order List</div>
                <div class="number">400,876</div>
                    <div class="indicator">
                        <i class="material-icons down">&#xf181;</i>
                        <span class=""text>Down from yesterday</span>
                    </div>
        </div>
    <i class="material-icons cart four">&#xe8e3;</i>
    </div>
    </div>

   <div class="sales-boxes">
        <div class="recent-sales box">
        <div class="title">Recent Sales</div>
        <div class="sales-details">
        <ul class="details">
            <li class="topic">Date</a></li>
            <li><a href="#">02 Jan 2021</a></li>
            <li><a href="#">02 Jan 2021</a></li>
            <li><a href="#">02 Jan 2021</a></li>
            <li><a href="#">02 Jan 2021</a></li>
            <li><a href="#">02 Jan 2021</a></li>
            <li><a href="#">02 Jan 2021</a></li>
        </ul>
        <ul class="details">
            <li class="topic">Customer</a></li>
            <li><a href="#">Joanne</a></li>
            <li><a href="#">Piong Chuan Ho</a></li>
            <li><a href="#">Tan Kah Xin</a></li>
            <li><a href="#">Desmond</a></li>
            <li><a href="#">Muuhammad Nabil</a></li>
            <li><a href="#">Quan Ching Chong</a></li>
        </ul>

        <ul class="details">
            <li class="topic">Sales</a></li>
            <li><a href="#">Delivered</a></li>
            <li><a href="#">Delivered</a></li>
            <li><a href="#">Delivered</a></li>
            <li><a href="#">Delivered</a></li>
            <li><a href="#">Delivered</a></li>
            <li><a href="#">Delivered</a></li>
        </ul>

        <ul class="details">
            <li class="topic">Total</a></li>
            <li><a href="#">RM100</a></li>
            <li><a href="#">RM50.50</a></li>
            <li><a href="#">RM75.30</a></li>
            <li><a href="#">RM30.50</a></li>
            <li><a href="#">RM17.40</a></li>
            <li><a href="#">RM80.20</a></li>
        </ul>
        </div>
        <div class="button">
        <a href="#">See All</a>
        </div>
        </div>



        <!-- <div class="top-sales box">
            <div class="title">Top Selling Product</div>
            <ul>
            <li>
                <a href="#">
                    <img src="image/Hamburger.png" alt="">
                    <span class="product_name">McChicken</span>
                </a>
                <span class="price"></span>
            </li>
            <li>
                <a href="#">
                    <img src="image/Dessert&Sides.png" alt="">
                    <span class="product_name">McFlurry'Oreo</span>
                </a>
                <span class="price"></span>
            </li>
            </ul>
            </div> -->
            </div>
        </div>
    </div>

    </section>

    <script src="Script.js"></script>
</body>
</html>