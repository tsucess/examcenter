<aside>
            <ul>
                <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                    <li>
                        <a href="dashboard.php" class="<?php if ($page === "dashboard") echo 'active'; ?>"><i class="uil uil-dashboard"></i>
                            <h5>Dashboard</h5>
                        </a>
                    </li>
                <?php else :  ?>
                    <li>
                        <a href="dashboard-user.php" class="<?php if ($page === "dashboard") echo 'active'; ?>"><i class="uil uil-dashboard"></i>
                            <h5>Dashboard</h5>
                        </a>
                    </li>
                <?php endif  ?>
                <li>
                    <a href="index.php" class="<?php if ($page === "index") echo 'active'; ?>"><i class="uil uil-user"></i>
                        <h5>User Profile</h5>
                    </a>
                </li>
                <li>
                    <a href="forms.php" class="<?php if ($page === "forms") echo 'active'; ?>"><i class="uil uil-postcard"></i>
                        <h5>Forms</h5>
                    </a>
                </li>
                <li>
                    <a href="available-courses.php" class="<?php if ($page === "courses") echo 'active'; ?>"><i class="uil uil-books"></i>
                        <h5>Available Subjects</h5>
                    </a>
                </li>
                <?php if ($_SESSION['user_is_admin'] == 2) :  ?>
                    <li>
                        <a href="manage-users.php" class="<?php if ($page === "users") echo 'active'; ?>"><i class="uil uil-users-alt"></i>
                            <h5>Manage Students</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-admin.php" class="<?php if ($page === "admin") echo 'active'; ?>"><i class="uil uil-edit"></i>
                            <h5>Manage Admins</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-posts.php" class="<?php if ($page === "posts") echo 'active'; ?>"><i class="uil uil-users-alt"></i>
                            <h5>Manage Post</h5>
                        </a>
                    </li>
                    <li>
                        <a href=" reports.php" class="<?php if ($page === "reports") echo 'active'; ?>"><i class="uil uil-list-ul"></i>
                            <h5>Reports</h5>
                        </a>
                    </li>
                <?php elseif ($_SESSION['user_is_admin'] == 1) :  ?>
                    <li>
                        <a href="manage-users.php" class="<?php if ($page === "users") echo 'active'; ?>"><i class="uil uil-users-alt"></i>
                            <h5>Manage Students</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-posts.php" class="<?php if ($page === "posts") echo 'active'; ?>"><i class="uil uil-users-alt"></i>
                            <h5>Manage Post</h5>
                        </a>
                    </li>
                <?php elseif ($_SESSION['user_is_admin'] == 0) :  ?>
                    <li>
                        <a href="registered-courses.php" class="<?php if ($page === "registered") echo 'active'; ?>"><i class="uil uil-book"></i>
                            <h5>Registered Subjects</h5>
                        </a>
                    </li>
                    <li>
                        <a href="payment-history.php" class="<?php if ($page === "history") echo 'active'; ?>"><i class="uil uil-book"></i>
                            <h5>Payment History</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>