<?php
/**
 * @package Radix option panel sections
 * @since 1.0
 */

/* General */
Redux::setSection( $opt_name, array(
    'icon'      => 'el el-icon-cog',
    'title'     => __('General', 'wordflex'),
    'fields'    => array(
        array(
            'id'    => 'info_success',
            'type'  => 'info',
            'style' => 'success',
            'title' => __('Welcome to WordFlex Theme Option Panel', 'wordflex'),
            'icon'  => 'el el-icon-smiley',
            'desc'  => __( 'From here you can config your theme in the way you like.', 'wordflex')
        ),
        array(
            'id'        => 'opt-sticky-nav',
            'type'      => 'switch',
            'title'     => __('Sticky Navigation', 'wordflex'),
            'subtitle'  => __('Check if you want to disable sticky navigation.', 'wordflex'),
            'default'   => true,
            ),
        array(
            'id'        => 'opt-scroll-totop',
            'type'      => 'switch',
            'title'     => __('Enable Scroll To Top', 'wordflex'),
            'subtitle'  => __('Check if you want to Scroll To Top button.', 'wordflex'),
            'default'   => true,
            ),
        array(
            'id'        => 'opt-logo',
            'type'      => 'media',
            'url'       => true,
            'title'     => __('Logo', 'wordflex'),
            'subtitle'  => __('Upload your logo image here, or leave empty to show website title instead', 'wordflex'),
            'width'     => '50',
            'desc'      => __('Note: Allowed extensions are .jpg, .png and .svg', 'wordflex'),
            'default'   => array('url' => IMG_URI .'/logo-dark.svg'),
            ),
        array(
            'id'        =>'opt-logo-width',
            'type'      => 'slider',       
            'title'     => __('Logo Width', 'wordflex'), 
            'subtitle'  => __('Specify your logo width.', 'wordflex'),
            'desc'      => __(' Value in (px), Maximum width is: 200px'),
            'validate'  => 'numeric',
            "min"       => "0",
            "step"      => "1",
            "max"       => "200",
            'default'   => "28"          
            ),
        array(
            'id'        =>'opt-logo-height',
            'type'      => 'slider',       
            'title'     => __('Logo Height', 'wordflex'), 
            'subtitle'  => __('Specify your logo height.', 'wordflex'),
            'desc'      => __(' Value in (px), Maximum height is: 100px'),
            'validate'  => 'numeric',
            "min"       => "0",
            "step"      => "1",
            "max"       => "100",
            'default'   => "28"          
            ),

        )
) );

/* Header */
Redux::setSection( $opt_name, array(
    'icon'      => 'el el-icon-user',
    'title'     => __('Header', 'wordflex'),
    'desc'      => __('These are options to modify and style your header area', 'wordflex'),
    'fields'    => array(
        array(
            'id'        => 'top_header_style_section',
            'icon'      => true,
            'type'      => 'info',
            'style'     => 'critical',
            'raw'       => __('<h3 style="margin: 3px;">Top Header </h3>'),
            ),
        array(
            'id'        => 'opt-header-layout',
            'type'      => 'image_select',
            'title'     => __('Header Layout', 'wordflex'),
            'subtitle'  => __('Choose your Header layout', 'wordflex'),
            'desc'      => __('1- Inline<br>2- Classic<br>3- Transparent', 'wordflex'),
            'options'   => array(
                '1' => array('alt' => 'Inline', 'img' => IMG_URI . '/header-inline.png'),
                '2' => array('alt' => 'Classic', 'img' => IMG_URI . '/header-classic.png'),
                '3' => array('alt' => 'Transparent', 'img' => IMG_URI . '/header-transparent.png'),
                ),
            'default'   => '1',
            ),
        array(
            'id'        => 'opt-top-header',
            'type'      => 'switch',
            'title'     => __('Show Top Header Area', 'wordflex') ,
            'subtitle'  => __('Check if you want to remove top bar.', 'wordflex'),
            'default'   => true,
            ),
        array(
            'id'        => 'contact_header_section',
            'icon'      => true,
            'type'      => 'info',
            'style'     => 'info',
            'required'  => array('opt-top-header', '=', true),
            'raw'       => __('<h4 style="margin: 3px;">Contact Header</h4>'),
            ),
        array(
            'id'        => 'opt-header-quick-contacts',
            'type'      => 'switch',
            'title'     => __('Show Quick Contacts', 'wordflex'),
            'subtitle'  => __('Check if you want to remove top Header area.', 'wordflex'),
            'required'  => array('opt-top-header', '=', true),
            'default'   => true,
            ),             
        array(
            'id'        => 'opt-phone-text',
            'type'      => 'text',      
            'title'     => __('Phone Number', 'wordflex'), 
            'subtitle'  => __('Insert phone number here.', 'wordflex'),
            'desc'      => __('i.e: 1-800-987-654. Leave it empty to hide it.', 'wordflex'),
            'required'  => array('opt-header-quick-contacts', '=', true),
            'default'   => '1-800-987-654'
            ),
        array(
            'id'        =>'opt-email-text',
            'type'      => 'text',      
            'title'     => __('Email Address', 'wordflex'), 
            'subtitle'  => __('Insert email address here.', 'wordflex'),
            'desc'      => __('Leave it empty to hide it.', 'wordflex'),
            'default'   => get_option('admin_email'),
            'required'  => array('opt-header-quick-contacts', '=', true),
            'validate'  => 'email'
            ),

        array(
            'id'        =>'opt-header-html',
            'type'      => 'text',      
            'title'     => __('Custom HTML', 'wordflex'), 
            'subtitle'  => __('Insert your custom HTML here.', 'wordflex'),
            'desc'      => __('Leave it empty to hide it.', 'wordflex'),
            'required'  => array('opt-header-quick-contacts', '=', true),
            'validate' => 'html',
            'default'   => '<a href="#"><i class="fas fa-link"></i> Quick Link</a>'
            ),
        array(
            'id'        => 'social_text_section',
            'icon'      => true,
            'type'      => 'info',
            'style'     => 'info',
            'required'  => array('opt-top-header', '=', true),
            'raw'       => __('<h4 style="margin: 3px;">Social Header</h4>'),
            ),

        array(
            'id'        => 'opt-header-quick-socials',
            'type'      => 'switch',
            'title'     => __('Show Social Header', 'wordflex'),
            'subtitle'  => __('Check if you want to remove header social icons.', 'wordflex'),
            'required'  => array('opt-top-header', '=', true),
            'default'   => true,
            ),
        array(
            'id'    => 'info_warning',
            'icon'  => 'el el-info-circle',
            'type'  => 'info',
            'title' => __('NOTE!', 'wordflex'),
            'style' => 'warning',
            'required'  => array('opt-header-quick-socials', '=', true),
            'desc'  => __('If you leave any field empty, icon will not show. <br> Please Note that these links will applied to the footer socials as well.', 'wordflex')
            ),
        array(
            'id'        =>'header-twitter',
            'type'      => 'text',      
            'title'     => __('Twitter', 'wordflex'), 
            'subtitle'  => __('Insert your Twitter page here.', 'wordflex'),
            'desc'      => "",
            'required'  => array('opt-header-quick-socials', '=', true),
            'default'   => "#"
            ),
        array(
            'id'        =>'header-facebook',
            'type'      => 'text',      
            'title'     => __('Facebook', 'wordflex'), 
            'subtitle'  => __('Insert your Facebook page here.', 'wordflex'),
            'desc'      => "",
            'required'  => array('opt-header-quick-socials', '=', true),
            'default'   => "#"
            ),
        array(
            'id'        =>'header-google-plus',
            'type'      => 'text',      
            'title'     => __('Google+', 'wordflex'), 
            'subtitle'  => __('Insert your Google+ page here.', 'wordflex'),
            'desc'      => "",
            'required'  => array('opt-header-quick-socials', '=', true),
            'default'   => "#"
            ),
        array(
            'id'        =>'header-pinterest',
            'type'      => 'text',      
            'title'     => __('Pinterest', 'wordflex'), 
            'subtitle'  => __('Insert your Pinterest page here.', 'wordflex'),
            'desc'      => "",
            'required'  => array('opt-header-quick-socials', '=', true),
            'default'   => "#"
            ),
         array(
            'id'        =>'header-instagram',
            'type'      => 'text',      
            'title'     => __('Instagram', 'wordflex'), 
            'subtitle'  => __('Insert your Instagram page here.', 'wordflex'),
            'desc'      => "",
            'required'  => array('opt-header-quick-socials', '=', true),
            'default'   => "#"
            ),                                                   
        array(
            'id'        =>'header-linkedin',
            'type'      => 'text',      
            'title'     => __('Linkedin', 'wordflex'), 
            'subtitle'  => __('Insert your Linkedin page here.', 'wordflex'),
            'desc'      => "",
            'required'  => array('opt-header-quick-socials', '=', true),
            'default'   => "#"
            ),
        )
) );


/* Blog */
Redux::setSection( $opt_name, array(
    'icon'      => 'el el-icon-blogger',
    'title'     => __('Blog', 'wordflex'),
    'desc'     => __('These are options to modify and style your main content area only', 'wordflex'),
    'fields'    => array(
        array(
            'id'        => 'sidebar_on_pages',
            'type'      => 'switch',
            'title'     => __('Page sidebars', 'wordflex'),
            'subtitle'  => __('Show sidebar on pages', 'wordflex'),
            'desc'      => __('Please note that Pages has a separated sidebar. You can always manage sidebar content in <a href="'. admin_url('widgets.php').'">Apperance / Widgets</a> page.', 'wordflex'),
            'default'   => false
            ),
        array(
            'id'        => 'opt-page-comments',
            'type'      => 'switch',
            'title'     => __('Comments on pages', 'wordflex'),
            'subtitle'  => __('turn off comments on pages', 'wordflex'),
            'default'   => false
            ),    
        array(
            'id'        =>'opt-excerpt-length',
            'type'      => 'slider',       
            'title'     => __('Excerpt Length Limits', 'wordflex'), 
            'subtitle'  => __('Enter the number of excerpt length limit to display.', 'wordflex'),
            'validate'  => 'numeric',
            "min"       => "5",
            "step"      => "5",
            "max"       => "100",
            'default'   => "55"          
            ),
        array(
            'id'        => 'opt-post-views',
            'type'      => 'switch',
            'title'     => __('Show Post Views', 'wordflex'),
            'subtitle'  => __('Enable / Disable post views count', 'wordflex'),
            'default'   => true,
            ), 
        array(
            'id'        => 'opt-post-socials',
            'type'      => 'switch',
            'title'     => __('Post Social Share', 'wordflex'),
            'subtitle'  => __('Check if you want to remove social share on single posts', 'wordflex'),
            'default'   => true,
            ),
        array(
            'id'        => 'opt-show-feedback',
            'type'      => 'switch',
            'title'     => __('Show Post Feedback', 'wordflex'),
            'subtitle'  => __('Check if you want to remove feedback option on single post', 'wordflex'),
            'default'   => true,
            ),
        array(
            'id'        =>'opt-feedback-text',
            'type'      => 'text',      
            'title'     => __('Feedback Text', 'wordflex'), 
            'subtitle'  => __('Change Feedback text here.', 'wordflex'),
            'required'  => array('show_feedback', '=', true),
            'default'   => "Was this helpful?"          
            ),        
        array(
            'id'        => 'opt-post-navigation',
            'type'      => 'switch',
            'title'     => __('Show post navigation', 'wordflex'),
            'subtitle'  => __('Check if you want to remove post navigation on single post', 'wordflex'),
            'default'   => true,
            ),
        array(
            'id'        => 'author_content_style_section',
            'icon'      => true,
            'type'      => 'info',
            'style'     => 'info',
            'raw'       => __('<h3 style="margin: 3px;">Author Box</h3>'),
            ),
        array(
            'id'        => 'opt-author-bio',
            'type'      => 'switch',
            'title'     => __('Enable author Bio', 'wordflex'),
            'subtitle'  => __('Enable / Disable author box', 'wordflex'),
            'default'   => true,
            ),        
        array(
            'id'        => 'opt-author-socials',
            'type'      => 'switch',
            'title'     => __('Author Social Share', 'wordflex'),
            'subtitle'  => __('Check if you want to remove social share from author box', 'wordflex'),
            'required'  => array('opt-author-bio', '=', true),
            'default'   => true,
            ),
        )
) );


/* Footer */
Redux::setSection( $opt_name, array(
    'icon'      => 'el el-bookmark',
    'title'     => __('Footer', 'wordflex'),
    'desc'      => __('Manage settings for footer area', 'wordflex'),
    'fields'    => array(
         array(
            'id'        => 'opt-copyright',
            'type'      => 'switch',
            'title'     => __('Enable Copyright Area', 'wordflex'),
            'subtitle'  => __('Check if you want to include copyright area below footer','wordflex'),
            'default'   => true
            ),
         array(
            'id'        => 'opt-footer-menu',
            'type'      => 'switch',
            'title'     => __('Enable Footer Menu', 'wordflex'),
            'subtitle'  => __('Check if you want to show footer menu inside copyright area', 'wordflex'),
            'desc'  => __('Note: you need to set footer menu inside <a href="'.admin_url('nav-menus.php').'">Apperance / Menu</a>', 'wordflex'),
            'default'   => true,
            )
        )
) );

/* Typography */
Redux::setSection( $opt_name, array(
    'icon'      => 'el el-icon-font',
    'title'     => __('Typography', 'wordflex'),
    'desc'     => __('Manage fonts and typography settings', 'wordflex'),
    'fields'    => array(

        array(
            'id'          => 'main_font',
            'type'        => 'typography', 
            'title'       => __('Main text font', 'wordflex'),
            'google'      => true, 
            'compiler'    => true,
            'font-backup' => false,
            'font-size'   => true,
            'color'       => true,
            'subsets'     => false,
            'line-height' => true,
            'text-align'  => false,
            'all_styles'  => true,
            'output'      => array('body'),
            'units'       =>'px',
            'subtitle'    => __('Typography option with each property can be called individually.', 'wordflex'),
            'default'     => array(
                'google'        => true,
                'font-weight'   => '', 
                'font-family'   => '',
                'font-size'     => '',
                'color'         => '',
                ),
            'preview' => array(
                'always_display'=> true,
                'font-size'     => '14px',
                'text'          => 'We think that readibility is very important part of any WordPress theme. This is actually a rough example of how simple paragpraph of text will look like on your website so you have a simple preview here.'
                )
            ),

        array(
            'id'        => 'Heading_section',
            'icon'      => true,
            'type'      => 'info',
            'style'     => 'info',
            'raw'       => __('<h4 style="margin: 3px;">Heading Style</h4>'),
            ),
        array(
            'id'          => 'h1_font',
            'type'        => 'typography', 
            'title'       => __('H1 font', 'wordflex'),
            'google'      => true, 
            'font-backup' => false,
            'font-size'   => true,
            'color'       => true,
            'line-height' => true,
            'text-align'  => false,
            'subsets'     => false,
            'all_styles'  => true,
            'output'      => array('h1, .h1'),
            'units'       =>'px',
            'subtitle'    => __('Specify the H1 tag font properties.', 'wordflex'),
            'default'     => array(
                'google'        => true,
                'font-weight'   => '',
                'font-family'   => '',
                'font-size'     => '',
                'color'         => '',
                ),
            'preview' => array(
                'always_display' => true,
                'font-size' => '40px',
                'text' => 'There is no good blog without great readability'
                )
            ),
        array(
            'id'          => 'h2_font',
            'type'        => 'typography', 
            'title'       => __('H2 font', 'wordflex'),
            'google'      => true, 
            'font-backup' => false,
            'font-size'   => true,
            'color'       => true,
            'line-height' => true,
            'text-align'  => false,
            'subsets'     => false,
            'all_styles'  => true,
            'output'      => array('h2, .h2'),
            'units'       =>'px',
            'subtitle'    => __('Specify the H2 tag font properties.', 'wordflex'),
            'default'     => array(
                'google'        => true,
                'font-weight'   => '',
                'font-family'   => '',
                'font-size'     => '',
                'color'         => '',
                ),
            'preview' => array(
                'always_display' => true,
                'font-size' => '32px',
                'text' => 'There is no good blog without great readability'
                )
            ),
        array(
            'id'          => 'h3_font',
            'type'        => 'typography', 
            'title'       => __('H3 font', 'wordflex'),
            'google'      => true, 
            'font-backup' => false,
            'font-size'   => true,
            'color'       => true,
            'line-height' => true,
            'text-align'  => false,
            'subsets'     => false,
            'all_styles'  => true,
            'output'      => array('h3, .h3'),
            'units'       =>'px',
            'subtitle'    => __('Specify the H3 tag font properties.', 'wordflex'),
            'default'     => array(
                'google'        => true,
                'font-weight'   => '',
                'font-family'   => '',
                'font-size'     => '',
                'color'         => '',
                ),
            'preview' => array(
                'always_display' => true,
                'font-size' => '28px',
                'text' => 'There is no good blog without great readability'
                )
            ),
        array(
            'id'          => 'h4_font',
            'type'        => 'typography', 
            'title'       => __('H4 font', 'wordflex'),
            'google'      => true, 
            'font-backup' => false,
            'font-size'   => true,
            'color'       => true,
            'line-height' => true,
            'text-align'  => false,
            'subsets'     => false,
            'all_styles'  => true,
            'output'      => array('h4, .h4'),
            'units'       =>'px',
            'subtitle'    => __('Specify the H4 tag font properties.', 'wordflex'),
            'default'     => array(
                'google'      => true,
                'font-weight' => '',
                'font-family' => '',
                'font-size'   => '',
                'color'       => '',
                ),
            'preview' => array(
                'always_display' => true,
                'font-size' => '24px',
                'text' => 'There is no good blog without great readability'
                )
            ),
        array(
            'id'          => 'h5_font',
            'type'        => 'typography', 
            'title'       => __('H5 font', 'wordflex'),
            'google'      => true, 
            'font-backup' => false,
            'font-size'   => true,
            'color'       => true,
            'line-height' => true,
            'text-align'  => false,
            'subsets'     => false,
            'all_styles'  => true,
            'output'      => array('h5, .h5'),
            'units'       =>'px',
            'subtitle'    => __('Specify the H5 tag font properties.', 'wordflex'),
            'default'     => array(
                'google'        => true,
                'font-weight'   => '',
                'font-family'   => '',
                'font-size'     => '',
                'color'         => '',
                ),
            'preview' => array(
                'always_display' => true,
                'font-size' => '20px',
                'text' => 'There is no good blog without great readability'
                )
            ),
        array(
            'id'          => 'h6_font',
            'type'        => 'typography', 
            'title'       => __('H6 font', 'wordflex'),
            'google'      => true, 
            'font-backup' => false,
            'font-size'   => true,
            'color'       => true,
            'line-height' => true,
            'text-align'  => false,
            'subsets'     => false,
            'all_styles'  => true,
            'output'      => array('h6, .h6'),
            'units'       =>'px',
            'subtitle'    => __('Specify the H6 tag font properties.', 'wordflex'),
            'default'     => array(
                'google'        => true,
                'font-weight'   => '',
                'font-family'   => '',
                'font-size'     => '',
                'color'         => '',
                ),
            'preview' => array(
                'always_display' => true,
                'font-size' => '16px',
                'text' => 'There is no good blog without great readability'
                )
            ),
        array(
            'id'            => 'nav_font',
            'type'          => 'typography', 
            'title'         => __('Navigation font', 'wordflex'),
            'google'        => true, 
            'compiler'      => true,
            'font-backup'   => false,
            'font-size'     => true,
            'color'         => true,
            'line-height'   => true,
            'text-align'    => false,
            'subsets'       => false,
            'all_styles'  => true,
            'output'        => array('.navbar a'),
            'units'         =>'px',
            'subtitle'      => __('Typography option with each property can be called individually.', 'wordflex'),
            'default'       => array(
                'google'        => true,
                'font-weight'   => '', 
                'font-family'   => '',
                'font-size'     => '',
                ),
            'preview' => array(
                'always_display' => true,
                'font-size'      => '14px',
                'text'           => 'Home &nbsp;&nbsp;About &nbsp;&nbsp;Blog &nbsp;&nbsp;Contact'
                )

            ),                
        )
) );

/* Advanced options */
Redux::setSection( $opt_name, array(
    'icon' => 'el el-icon-cogs',
    'icon_class' => 'el el-icon-large',
    'title' => __('Advanced Options', 'wordflex'),
    'desc'     => __('Advanced options for avanced users here', 'wordflex'),
    'fields' => array(
        array(
            'id'        => 'opt-disable-emoji',
            'type'      => 'switch',
            'title'     => __('Disable WordPress Emojis', 'wordflex'),
            'subtitle'  => __('disable Emojis', 'wordflex'),
            'desc'      => __('If you don’t want to install another plugin, you can also just disable emojis with this option.', 'wordflex'),
            'default'   => false,
            ),
        array(
            'id'        => 'additional_codes',
            'icon'      => true,
            'type'      => 'info',
            'style'     => 'info',
            'raw'       => __('<h4 style="margin: 3px;">Custom Codes</h4>'),
            ),
        array(
            'id'       => 'opt-custom-css',
            'type'     => 'ace_editor',
            'title'    => __('Additional CSS', 'wordflex'),
            'subtitle' => __('Use this field to write or paste CSS code and modify default theme styling', 'wordflex'),
            'mode'     => 'css',
            'theme'    => 'monokai',
            'default' => ".example {\nmargin: 0 auto;\n}"
            ),
        array(
            'id'       => 'opt-custom-js',
            'type'     => 'ace_editor',
            'title'    => __('Additional JavaScript', 'wordflex'),
            'subtitle' => __('Use this field to write or paste additional JavaScript code to this theme', 'wordflex'),
            'mode'     => 'javascript',
            'theme'    => 'chrome',
            'default'  => "(function($){\n/* standard on load code goes here with $ prefix */\n})(jQuery);"
            
            ),
        )
) );

/* Custom Login */
Redux::setSection( $opt_name, array(
    'icon'      => 'el el-icon-user',
    'title'     => __('Custom Login', 'wordflex'),
    'desc'      => __('Manage login page', 'wordflex'),
    'fields'    => array(
        array(
            'id'        => 'opt-login-logo',
            'type'      => 'media',
            'url'       => true,
            'title'     => __('Custom Login Logo', 'wordflex'),
            'subtitle'  => __('Upload your custom login logo image here', 'wordflex'),
            'desc'      => __('Note: Allowed extensions are .jpg, .png and .svg', 'wordflex'),
            'default'   => array('url' => IMG_URI .'/logo-danger.svg'),
            ),
        array(
            'id'        =>'opt-login-logo-width',
            'type'      => 'slider',       
            'title'     => __('Logo Width', 'wordflex'), 
            'subtitle'  => __('Specify your logo width.', 'wordflex'),
            'desc'      => __(' Value in (px), Maximum width is: 200px'),
            'validate'  => 'numeric',
            "min"       => "0",
            "step"      => "1",
            "max"       => "200",
            'default'   => "84"          
            ),
        array(
            'id'        =>'opt-login-logo-height',
            'type'      => 'slider',       
            'title'     => __('Logo Height', 'wordflex'), 
            'subtitle'  => __('Specify your logo height.', 'wordflex'),
            'desc'      => __(' Value in (px), Maximum height is: 200px'),
            'validate'  => 'numeric',
            "min"       => "0",
            "step"      => "1",
            "max"       => "200",
            'default'   => "84"          
            ),
        array(
            'id'        => 'opt-login-bg',
            'type'      => 'media',
            'url'       => true,
            'title'     => __('Custom Login Background', 'wordflex'),
            'subtitle'  => __('Upload your custom background image here', 'wordflex'),
            'desc'      => __('Note: Allowed extensions are .jpg, .png and .gif', 'wordflex'),
            'default'   => array('url' => IMG_URI .'/login-background.jpg'),
            ), 
        )
) );

/* maintenance */
Redux::setSection( $opt_name, array(
    'icon'      => 'el el-icon-warning-sign',
    'title'     => __('Maintenance Mode', 'wordflex'),
    'desc'      => __('Basic maintenance mode', 'wordflex'),
    'fields'    => array(
        array(
            'id'        => 'opt-maintenance-mode',
            'type'      => 'switch',
            'title'     => __('Maintenance mode', 'wordflex'),
            'subtitle'  => __('Enable maintenance mode.', 'wordflex'),
             'desc'  => __('Check if you want to enable the default wordpress maintenance mode.', 'wordflex'),
            'default'   => false,
            ),
        array(
            'id'        => 'maintenance-text',
            'type'      => 'editor',
            'title'     => __('Maintenance message', 'wordflex'), 
            'subtitle'  => __('Edit your maintenance message. You can use any HTML tags in text field', 'wordflex'),
            'default'   => 'Site is temporarily unavailable.',
            'required'  => array('opt-maintenance-mode', '=', true),
            'args'   => array(
                'teeny'            => true,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                )
            )
        )
) );