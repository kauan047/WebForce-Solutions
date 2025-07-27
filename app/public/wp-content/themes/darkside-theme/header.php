<?php
/**
 * Header para WebForce Solutions - Estilo combinando com o footer
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    
    <style>
        /* --- [ESTILOS DO HEADER] --- */
        #masthead {
            background-color: #0a0a0a;
            border-bottom: 2px solid #00ffcc;
            padding: 15px 0;
            position: relative;
            z-index: 100;
        }
        
        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        
        .site-branding {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .site-title a {
            color: #fff;
            font-size: 24px;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .site-title a:hover {
            color: #00ffcc;
        }
        
        .site-description {
            color: #ccc;
            font-size: 14px;
            margin: 0;
        }
        
        /* --- [MENU PRINCIPAL] --- */
        .main-navigation {
            display: flex;
            align-items: center;
        }
        
        .main-navigation ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 25px;
        }
        
        .main-navigation li a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            position: relative;
        }
        
        .main-navigation li a:hover {
            color: #00ffcc;
        }
        
        .main-navigation li a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #00ffcc;
            transition: width 0.3s;
        }
        
        .main-navigation li a:hover::after {
            width: 100%;
        }
        
        /* --- [MENU MOBILE] --- */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            padding: 10px;
        }
        
        /* --- [RESPONSIVIDADE] --- */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .main-navigation {
                width: 100%;
                margin-top: 15px;
            }
            
            .main-navigation ul {
                flex-direction: column;
                gap: 10px;
                display: none;
            }
            
            .main-navigation ul.active {
                display: flex;
            }
            
            .menu-toggle {
                display: block;
                position: absolute;
                right: 20px;
                top: 20px;
            }
        }
    </style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'darkside-theme'); ?></a>

    <header id="masthead" class="site-header">
        <div class="header-container">
            <div class="site-branding">
                <?php the_custom_logo(); ?>
                <div>
                    <?php if (is_front_page() && is_home()) : ?>
                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                    <?php else : ?>
                        <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                    <?php endif; ?>
                    
                    <?php $darkside_theme_description = get_bloginfo('description', 'display');
                    if ($darkside_theme_description || is_customize_preview()) : ?>
                        <p class="site-description"><?php echo $darkside_theme_description; ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="menu-icon">☰</span>
                    <span class="screen-reader-text"><?php esc_html_e('Menu', 'darkside-theme'); ?></span>
                </button>
                
                <?php wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                    'menu_id' => 'primary-menu',
                    'container' => false,
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                )); ?>
            </nav>
        </div>
    </header>

    <script>
        // Menu mobile toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const primaryMenu = document.querySelector('#primary-menu');
            
            menuToggle.addEventListener('click', function() {
                primaryMenu.classList.toggle('active');
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !isExpanded);
            });
        });
    </script>