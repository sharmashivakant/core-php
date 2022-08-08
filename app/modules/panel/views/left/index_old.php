<div id="top-bar">
    <a href="{URL:panel/logout}" class="logout">Logout <img src="<?= _SITEDIR_; ?>public/images/backend/logout.png"></a>
</div>

<div id="left-column-nav">
    <div class="admin-profile">
        <?php if (User::get('image')) { ?>
            <div class="admin-profile-pic"><img src="<?= _SITEDIR_; ?>data/users/<?= User::get('image'); ?>"></div>
        <?php } else { ?>
            <div class="admin-profile-pic"><img src="<?= _SITEDIR_; ?>public/images/admin.png"></div>
        <?php } ?>

        <span class="welcomeback"> Welcome back,</span>
        <div class="admin-name"><?= User::get('firstname') . ' ' . User::get('lastname'); ?></div>
    </div>

    <div class="nav">
        <ul>
            <li class="<?= isset($slug) && $slug === "dashboard" ? 'active' : ''; ?>">
                <a href="{URL:panel}">
                    <div class="mh-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/dashboard.png"></div>
                    <span>Dashboard</span>
                </a>
            </li>


            <li class="subheader">
                <a>
                    <div class="mh-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/content_management.png"></div>
                    <span>Content Management</span>
                </a>
                <div class="sub-drop-items">
                    <ul style="margin-top: 0px; transform: translateY(-302px);">
                        <li class="">
                            <a href="{URL:panel/content_pages}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/content_pages.png"></div>
                                <div class="submenu-text">Content Pages</div>
                            </a>
                        </li>
<!--                        <li class="">-->
<!--                            <a href="{URL:panel/content_blocks}">-->
<!--                                <div class="sub-icon"><img src="--><?//= _SITEDIR_; ?><!--public/images/backend/dashboard-icons/content-management/content-blocks.png"></div>-->
<!--                                <div class="submenu-text">Content Blocks</div>-->
<!--                            </a>-->
<!--                        </li>-->
                        <li class="">
                            <a href="{URL:panel/blog/categories}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/blog_categories.png"></div>
                                <div class="submenu-text">Blog Categories</div>
                            </a>
                        </li>
                        <li class="">
                            <a href="{URL:panel/blog}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/blog_news.png"></div>
                                <div class="submenu-text">Blog / News</div>
                            </a>
                        </li>
                        <li class="">
                            <a href="{URL:panel/testimonials}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/testimonials.png"></div>
                                <div class="submenu-text">Testimonials</div>
                            </a>
                        </li>
                        <li class="">
                            <a href="{URL:panel/event_card}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/events.png"></div>
                                <div class="submenu-text">Events</div>
                            </a>
                        </li>
                        <li class="">
                            <a href="{URL:panel/videos}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/videos.png"></div>
                                <div class="submenu-text">Videos</div>
                            </a>
                        </li>
<!--                        <li class="">-->
<!--                            <a href="https://www.bolddev.co.uk/demositenew/admin/cases">-->
<!--                                <div class="sub-icon"><img src="https://www.bolddev.co.uk/demositenew/assets/css/backend/images/dashboard-icons/content-management/case-studies.png"></div>-->
<!--                                <div class="submenu-text">Case Studies</div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="">-->
<!--                            <a href="https://www.bolddev.co.uk/demositenew/admin/landings">-->
<!--                                <div class="sub-icon"><img src="https://www.bolddev.co.uk/demositenew/assets/css/backend/images/dashboard-icons/content-management/landingpages.png"></div>-->
<!--                                <div class="submenu-text">Landing Pages</div>-->
<!--                            </a>-->
<!--                        </li>-->
                    </ul>
                </div>
            </li>


            <li class="subheader">
                <a>
                    <div class="mh-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/client_microsites.png"></div>
                    <span>Client Microsites</span>
                </a>
                <div class="sub-drop-items">
                    <ul style="margin-top: 0px; transform: translateY(-34px);">
                        <li class="">
                            <a href="{URL:panel/microsites}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/client_microsites.png"></div>
                                <div class="submenu-text">Manage Microsites</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="subheader">
                <a>
                    <div class="mh-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/vacancy_management.png"></div>
                    <span>Vacancy Management</span>
                </a>
                <div class="sub-drop-items">
                    <ul style="margin-top: 0px; transform: translateY(-302px);">
                        <li class="">
                            <a href="{URL:panel/sectors}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/sectors_industries.png"></div>
                                <div class="submenu-text">Sectors / Industries</div>
                            </a>
                        </li>
<!--                        <li class="">-->
<!--                            <a href="{URL:panel/functions}">-->
<!--                                <div class="sub-icon"><img src="--><?//= _SITEDIR_; ?><!--public/images/backend/dashboard-icons/sectors-industries.png"></div>-->
<!--                                <div class="submenu-text">Functions</div>-->
<!--                            </a>-->
<!--                        </li>-->
                        <li class="">
                            <a href="{URL:panel/locations}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/locations.png"></div>
                                <div class="submenu-text">Locations</div>
                            </a>
                        </li>
<!--                        <li class="">-->
<!--                            <a href="{URL:panel/tech_stack}">-->
<!--                                <div class="sub-icon"><img src="--><?//= _SITEDIR_; ?><!--public/images/backend/dashboard-icons/integrations.png"></div>-->
<!--                                <div class="submenu-text">Tech Stack</div>-->
<!--                            </a>-->
<!--                        </li>-->
                        <li class="">
                            <a href="{URL:panel/vacancies}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/vacancy_manager.png"></div>
                                <div class="submenu-text">Vacancy Manager</div>
                            </a>
                        </li>
                        <li class="">
                            <a href="{URL:panel/uploaded_vacancies}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/cv_library.png"></div>
                                <div class="submenu-text">CV Library</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="subheader">
                <a>
                    <div class="mh-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/talent_pool.png"></div>
                    <span>Talent Pool</span>
                </a>
                <div class="sub-drop-items">
                    <ul style="margin-top: 0px; transform: translateY(-34px);">
                        <li class="">
                            <a href="{URL:panel/candidates}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/talent_pool.png"></div>
                                <div class="submenu-text">Candidate Registrations</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="subheader">
                <a>
                    <div class="mh-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/team_management.png"></div>
                    <span>Team Management</span>
                </a>
                <div class="sub-drop-items">
                    <ul style="margin-top: 0px; transform: translateY(-34px);">
                        <li class="">
                            <a href="{URL:panel/team}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/team_management.png"></div>
                                <div class="submenu-text">Team Manager</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="subheader">
                <a>
                    <div class="mh-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/analytics_and_reporting.png"></div>
                    <span>Analytics & Reporting</span>
                </a>
                <div class="sub-drop-items">
                    <ul style="margin-top: 0px; transform: translateY(-34px);">
                        <li class="">
                            <a href="{URL:panel/analytics}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/google_analytics.png"></div>
                                <div class="submenu-text">Google Analytics</div>
                            </a>
                        </li>

                        <li class="">
                            <a href="{URL:panel/analytics/subscribers}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/subscribers.png"></div>
                                <div class="submenu-text">Subscribers</div>
                            </a>
                        </li>

                        <li class="">
                            <a href="{URL:panel/logs}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/logs.png"></div>
                                <div class="submenu-text">Logs</div>
                            </a>
                        </li>
                        <li class="">
                            <a href="{URL:panel/analytics/include_code}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/include_js.png"></div>
                                <div class="submenu-text">Include JS</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="subheader">
                <a>
                    <div class="mh-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/settings.png"></div>
                    <span>Settings</span>
                </a>
                <div class="sub-drop-items">
                    <ul style="margin-top: 0px; transform: translateY(-34px);">
                        <li class="">
                            <a href="{URL:panel/setting}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/settings_in.png"></div>
                                <div class="submenu-text">Setting</div>
                            </a>
                        </li>
                        <li class="">
                            <a href="{URL:panel/data_generator}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/data_generator.png"></div>
                                <div class="submenu-text">Data generator</div>
                            </a>
                        </li>
                        <li class="">
                            <a href="{URL:panel/dashboard_settings}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/dashboard_in.png"></div>
                                <div class="submenu-text">Dashboard</div>
                            </a>
                        </li>

                        <li class="">
                            <a href="{URL:panel/dashboard_settings/maps}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/google_maps.png"></div>
                                <div class="submenu-text">Google Maps</div>
                            </a>
                        </li>

                        <li class="">
                            <a href="{URL:panel/sitemap}">
                                <div class="sub-icon"><img src="<?= _SITEDIR_; ?>public/images/backend/icons/sitemap.png"></div>
                                <div class="submenu-text">Site map</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <?php
            /*
            foreach ($plugin_groups as $group_title) {
                $group_plugins = array_filter($plugins, function ($plugin) use ($group_title) {
                    return $plugin['group'] === $group_title && $plugin['enabled'] === TRUE;
                });

                if (count($group_plugins) > 0) {
                    $firstRec = reset($group_plugins);
                    $group_icon = isset($firstRec['group_icon']) ? $firstRec['group_icon'] : '';
                    ?>
                    <li class="subheader">

                        <?php if (!empty($group_icon)) {	?>
                        <a>
                            <div class="mh-icon"><img src="<?php echo $group_icon;?>"></div>

                            <?php } ?>
                            <span><?php echo $group_title; ?></span>
                        </a>
                        <div class="sub-drop-items">
                            <ul>
                                <?php
                                foreach ($group_plugins as $plugin) {

                                    if (!isset($plugin['hidden']) || (isset($plugin['hidden']) && $plugin['hidden'] === FALSE)) {
                                        ?>
                                        <li class="<?php echo isset($slug) && $slug === $plugin['slug'] ? 'active' : ''; ?>">
                                            <a href="<?php echo site_url($plugin['slug']); ?>">
                                                <div class="sub-icon"><img src="<?php echo $plugin['icon']; ?>"></div>
                                                <div class="submenu-text"><?php echo $plugin['title']; ?></div>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </li>

                    <?php
                }
            }
            */
            ?>
        </ul>
    </div>
</div>
<?php /**/ ?>