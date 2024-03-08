<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="javascript:void(0)" data-toggle="sidebar" class="nav-link nav-link-lg"><em class="fas fa-bars"></em></a></li>
            <li class="nav-item d-none d-sm-inline-block center">

                    <?php if (!ALLOW_MODIFICATION) { ?>
        	    <span class="right badge badge-danger">Modification in demo version is not allowed</span>
                <?php }?>
            </li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="<?= base_url(); ?>" data-toggle="dropdown" class="nav-link dropdown-toggle  nav-link-lg nav-link-user">
                <span class="user_profile_icon"><i class="fa fa-user-circle" aria-hidden="true"></i> </span>
                <div class="d-sm-none d-lg-inline-block">Hi, <?= ucwords($this->session->userdata('authName')); ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <?php if ($this->session->userdata('authStatus')) { ?>
                    <a href="<?php echo base_url(); ?>profile" class="dropdown-item has-icon">
                        <em class="fas fa-user"></em> Profile
                    </a>
                <?php } ?>
                <a href="<?php echo base_url(); ?>resetpassword" class="dropdown-item has-icon">
                    <em class="fas fa-key"></em> Reset Password
                </a>
                <a href="<?php echo base_url(); ?>logout" class="dropdown-item has-icon">
                    <em class="fas fa-sign-out-alt"></em> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <ul class="sidebar-menu">
            <div class="sidebar-brand my-1">
                <a href="<?= base_url(); ?>dashboard">
                    <?php if (!empty($full_logo)) { ?>
                        <img src="<?= base_url() . LOGO_IMG_PATH . $full_logo['message']; ?>" alt="logo" width="150" id="full_logo">
                    <?php } ?>
                </a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="<?= base_url(); ?>dashboard">
                    <?php if (!empty($half_logo)) { ?>
                        <img src="<?= base_url() . LOGO_IMG_PATH . $half_logo['message']; ?>" alt="logo" width="50">
                    <?php } ?>
                </a>
            </div>
            <li>
                <a class="nav-link" href="<?= base_url(); ?>dashboard"><em class="fas fa-home"></em> <span>Dashboard</span></a>
            </li>
            <?php if (has_permissions('read', 'categories') || has_permissions('read', 'subcategories') || has_permissions('read', 'category_order') || has_permissions('create', 'questions') || has_permissions('read', 'questions') || has_permissions('read', 'question_report')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-gift"></em><span>Quiz Zone</span></a>
                    <ul class="dropdown-menu">
                        <?php if (has_permissions('read', 'categories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>main-category">Main Category</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'subcategories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>sub-category">Sub Category</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'category_order')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>category-order">Category Order</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'questions')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>create-questions">Create Questions</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'questions')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>manage-questions">View Questions</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'questions')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>import-questions"> Import Questions</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'question_report')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>question-reports"> Question Reports</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'daily_quiz')) { ?>
                <li>
                    <a class="nav-link" href="<?= base_url(); ?>daily-quiz"><em class="fas fa-question"></em> <span>Daily Quiz</span></a>
                </li>
            <?php } ?>
            
            <?php if (has_permissions('read', 'manage_contest') || has_permissions('read', 'manage_contest_question') || has_permissions('read', 'import_contest_question')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-gift"></em> <span>Contests</span></a>
                    <ul class="dropdown-menu">
                        <?php if (has_permissions('read', 'manage_contest')) { ?>
                            <li><a href="<?= base_url(); ?>contest"> Manage Contest</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'manage_contest_question')) { ?>
                            <li><a href="<?= base_url(); ?>contest-questions"> Manage Questions</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'manage_contest_question')) { ?>
                            <li><a href="<?= base_url(); ?>contest-questions-import"> Import Questions</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'categories') || has_permissions('read', 'subcategories') || has_permissions('read', 'category_order') || has_permissions('read', 'fun_n_learn')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-book-open"></em><span>Fun 'N' Learn</span></a>
                    <ul class="dropdown-menu">
                        <?php if (has_permissions('read', 'categories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>fun-n-learn-category">Main Category</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'subcategories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>fun-n-learn-subcategory">Sub Category</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'category_order')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>fun-n-learn-category-order">Category Order</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'fun_n_learn')) { ?>
                            <li><a class="nav-link" href="<?= base_url() ?>fun-n-learn">Manage Fun 'N' Learn</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'categories') || has_permissions('read', 'subcategories') || has_permissions('read', 'category_order') || has_permissions('read', 'guess_the_word')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-atom"></em><span>Guess The Word</span></a>
                    <ul class="dropdown-menu">
                        <?php if (has_permissions('read', 'categories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>guess-the-word-category">Main Category</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'subcategories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>guess-the-word-subcategory">Sub Category</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'category_order')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>guess-the-word-category-order">Category Order</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'guess_the_word')) { ?>
                            <li><a class="nav-link" href="<?= base_url() ?>guess-the-word">Manage Guess The Word</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'categories') || has_permissions('read', 'subcategories') || has_permissions('read', 'category_order') || has_permissions('read', 'audio_question')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-microphone-alt"></em><span>Audio Questions</span></a>
                    <ul class="dropdown-menu">
                        <?php if (has_permissions('read', 'categories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>audio-question-category">Main Category</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'subcategories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>audio-question-subcategory">Sub Category</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'category_order')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>audio-question-category-order">Category Order</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'audio_question')) { ?>
                            <li><a class="nav-link" href="<?= base_url() ?>audio-question">Manage Audio Questions</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'categories') || has_permissions('read', 'subcategories') || has_permissions('read', 'category_order') || has_permissions('create', 'maths_questions') || has_permissions('read', 'maths_questions')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-book-open"></em><span>Maths Quiz</span></a>
                    <ul class="dropdown-menu">
                        <?php if (has_permissions('read', 'categories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>maths-question-category">Main Category</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'subcategories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>maths-question-subcategory">Sub Category</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'category_order')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>maths-question-category-order">Category Order</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'maths_questions')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>create-maths-questions">Create Questions</a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'maths_questions')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>manage-maths-questions">View Questions</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'exam_module')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-book"></em><span>Exam Module</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="<?= base_url(); ?>exam-module">Exam Module</a></li>
                        <li><a class="nav-link" href="<?= base_url(); ?>exam-module-questions-import">Import Exam Question</a></li>
                    </ul>
                </li>
            <?php } ?>
            
            <?php if (has_permissions('read', 'users')) { ?>
                <li>
                    <a class="nav-link" href="<?= base_url() ?>users"><em class="fas fa-users"></em> <span>Users</span></a>
                </li>
            <?php } ?>
            <?php if ($this->session->userdata('authStatus')) { ?>
                <li>
                    <a class="nav-link" href="<?= base_url() ?>activity-tracker"><em class="fas fa-chart-bar"></em> <span>Activity Tracker</span></a>
                </li>
            <?php } ?>
            <?php if ($this->session->userdata('authStatus')) { ?>
                <li>
                    <a class="nav-link" href="<?= base_url() ?>payment-requests"><em class="fas fa-rupee-sign"></em> <span>Payment Requests</span></a>
                </li>
            <?php } ?>
            <?php if ($this->session->userdata('authStatus')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-th"></em><span>Leaderboard</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="<?= base_url(); ?>global-leaderboard">All</a></li>
                        <li><a class="nav-link" href="<?= base_url(); ?>monthly-leaderboard">Monthly</a></li>
                        <li><a class="nav-link" href="<?= base_url(); ?>daily-leaderboard">Daily</a></li>
                    </ul>
                </li>
            <?php } ?>
            <?php if (is_language_mode_enabled()) { ?>
                <?php if (has_permissions('read', 'languages')) { ?>
                    <li>
                        <a class="nav-link" href="<?= base_url() ?>languages"><em class="fas fa-language"></em> <span>Languages</span></a>
                    </li>
                <?php } ?>
            <?php } ?>
            <?php if (has_permissions('read', 'system_configuration')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-cog"></em><span>Settings</span></a>
                    <ul class="dropdown-menu">
                        <?php if (has_permissions('read', 'system_configuration')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>system-configurations">System Configurations</a></li>
                        <?php } ?>


                        <?php if (has_permissions('read', 'system_configuration')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>system-utilities">System Utilities</a></li>
                        <?php } ?>

                        <?php if ($this->session->userdata('authStatus')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>firebase-configurations">Firebase Configurations</a></li>
                            <li><a class="nav-link" href="<?= base_url(); ?>payment-settings">Payment Settings</a></li>
                            <li><a class="nav-link" href="<?= base_url(); ?>ads-settings">Ads. Settings</a></li>
                            <li><a class="nav-link" href="<?= base_url(); ?>badges-settings">Badges Settings</a></li>
                            <li><a class="nav-link" href="<?= base_url(); ?>notification-settings">Notification Settings</a></li>
                            <li><a class="nav-link" href="<?= base_url(); ?>coin-store-settings">Coin Store Settings</a></li>
                            <li><a class="nav-link" href="<?= base_url(); ?>about-us">About Us</a></li>
                            <li><a class="nav-link" href="<?= base_url(); ?>contact-us">Contact Us</a></li>
                            <li><a class="nav-link" href="<?= base_url(); ?>instructions">How to Play</a></li>
                            <li><a class="nav-link" href="<?= base_url(); ?>privacy-policy">Privacy Policy</a></li>
                            <li><a class="nav-link" href="<?= base_url(); ?>terms-conditions">Terms Conditions</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            
            <?php if (has_permissions('read', 'send_notification')) { ?>
                <li>
                    <a class="nav-link" href="<?= base_url(); ?>send-notifications"><em class="fas fa-bullhorn"></em> <span>Send Notifications</span></a>
                </li>
            <?php } ?>            
            <?php if ($this->session->userdata('authStatus')) { ?>
                <li>
                    <a class="nav-link" href="<?= base_url(); ?>user-accounts-rights"><em class="fas fa-user"></em> <span>User Accounts and Rights</span></a>
                </li>
            <?php } ?>
            <?php if ($this->session->userdata('authStatus')) { ?>
            <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-cog"></em><span>Web Settings</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="<?= base_url('web-settings'); ?>">Settings</a></li>
                        <li><a class="nav-link" href="<?= base_url('web-home-settings'); ?>">Home Settings</a></li>
                        <!-- <li><a class="nav-link" href="<?= base_url('upload-languages'); ?>">Upload Languages</a></li> -->
                        <li><a class="nav-link" href="<?= base_url('sliders'); ?>">Sliders</a></li>
                    </ul>
            </li>
            <?php } ?>
            <?php if ($this->session->userdata('authStatus')) { ?>
                <li>
                    <a class="nav-link" href="<?= base_url(); ?>system-updates"><em class="fas fa-cloud-download-alt"></em> <span>System Update</span></a>
                </li>
            <?php } ?>
        </ul>
    </aside>
</div>
