<div class="nav-container">
            <div>
                <div class="bar bar--sm visible-xs">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-3 col-sm-2">
                                <a href="<?php echo get_site_url(); ?>"> <img class="logo logo-dark" alt="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/Pentaschool-Logo2.png"> <img class="logo logo-light" alt="logo" src="img/logo-light.png"> </a>
                            </div>
                            <div class="col-xs-9 col-sm-10 text-right">
                                <a href="#" class="hamburger-toggle" data-toggle-class="#menu1;hidden-xs hidden-sm"> <i class="icon icon--sm stack-interface stack-menu"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <nav id="menu1" class="bar bar-1 hidden-xs">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-sm-2 hidden-xs">
                                <div class="bar__module">
                                    <a href="<?php echo get_site_url(); ?>"> <img class="logo logo-dark" alt="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/Pentaschool-Logo2.png"> <img class="logo logo-light" alt="logo" src="img/logo-light.png"> </a>
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-12 text-left text-left-xs text-left-sm">
								<div class="bar__module">
								<?php wp_nav_menu( array(
									'theme_location' => 'primary_navigation',
									'container'      => 'ul',
									'menu_class'     => 'menu-horizontal',
									
								) 
								); ?>
								</div>
                              
                            </div>
                        </div>
						
                    </div>
                </nav>
            </div>
</div>