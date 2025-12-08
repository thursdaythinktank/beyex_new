<?php


new \Kirki\Panel(
    'unikon_panel',
    [
        'priority' => 10,
        'title' => esc_html__('Unikon Customizer', 'unikon'),
        'description' => esc_html__('Unikon Theme Customizer.', 'unikon'),
    ]
);

function unikon_theme_settings()
{

    new \Kirki\Section(
        'unikon_theme_settings_section',
        [
            'title' => esc_html__('Theme Settings', 'unikon'),
            'description' => esc_html__('Theme Controls.', 'unikon'),
            'panel' => 'unikon_panel',
            'priority' => 100,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'unikon_header_sticky',
            'label' => esc_html__('Header Sticky Switcher', 'unikon'),
            'description' => esc_html__('Header Sticky On/Off', 'unikon'),
            'section' => 'unikon_theme_settings_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'unikon'),
                'off' => esc_html__('Disable', 'unikon'),
            ],
        ]
    );
}
unikon_theme_settings();


function unikon_header_settings()
{

    new \Kirki\Section(
        'header_main_section',
        [
            'title' => esc_html__('Header Main Settings', 'unikon'),
            'description' => esc_html__('Header Main Controls.', 'unikon'),
            'panel' => 'unikon_panel',
            'priority' => 101,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'unikon_header_elementor_switch',
            'label' => esc_html__('Header Custom/Elementor Switch', 'unikon'),
            'description' => esc_html__('Header Custom/Elementor On/Off', 'unikon'),
            'section' => 'header_main_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'unikon'),
                'off' => esc_html__('Disable', 'unikon'),
            ],
        ]
    );

    new \Kirki\Field\Radio_Image(
        [
            'settings' => 'header_layout_custom',
            'label' => esc_html__('Chose Header Style', 'unikon'),
            'section' => 'header_main_section',
            'priority' => 10,
            'choices' => [
                'header_1' => get_template_directory_uri() . '/inc/img/header/header-1.png',
            ],
            'default' => 'header_1',
            'active_callback' => [
                [
                    'setting' => 'unikon_header_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $header_buildertype = array(
        'post_type' => 'wpr-header',
        'posts_per_page' => -1,
    );
    $header_buildertype_loop = get_posts($header_buildertype);

    $header_post_obj_arr = array();
    foreach ($header_buildertype_loop as $post) {
        $header_post_obj_arr[$post->ID] = $post->post_title;
    }


    wp_reset_query();


    new \Kirki\Field\Select(
        [
            'settings' => 'unikon_header_templates',
            'label' => esc_html__('Elementor Header Template', 'unikon'),
            'section' => 'header_main_section',
            'placeholder' => esc_html__('Choose an option', 'unikon'),
            'choices' => $header_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'unikon_header_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'header_right_switch',
            'label' => esc_html__('Header Right Switch', 'unikon'),
            'description' => esc_html__('Header Right On/Off', 'unikon'),
            'section' => 'header_main_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'unikon'),
                'off' => esc_html__('Disable', 'unikon'),
            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'unikon_header_right_btn_text',
            'label' => esc_html__('Header Right Button Text', 'unikon'),
            'section' => 'header_main_section',
            'default' => esc_html__('Lets Talk', 'unikon'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'header_right_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'unikon_header_right_btn_link',
            'label' => esc_html__('Header Right Button Link', 'unikon'),
            'section' => 'header_main_section',
            'default' => esc_html__('#', 'unikon'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'header_right_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
}
unikon_header_settings();

function unikon_logo_settings()
{
    // header_logo_section section 
    new \Kirki\Section(
        'header_logo_section',
        [
            'title' => esc_html__('Header Logo', 'unikon'),
            'description' => esc_html__('Header Logo Settings.', 'unikon'),
            'panel' => 'unikon_panel',
            'priority' => 101,
        ]
    );

    // header_logo_section section 
    new \Kirki\Field\Image(
        [
            'settings' => 'header_logo_black',
            'label' => esc_html__('Header Black Logo', 'unikon'),
            'description' => esc_html__('Theme Default/Primary Logo Here', 'unikon'),
            'section' => 'header_logo_section',
            'default' => get_template_directory_uri() . '/assets/img/logo.svg',
        ]
    );
    new \Kirki\Field\Image(
        [
            'settings' => 'header_logo_white',
            'label' => esc_html__('Header White Logo', 'unikon'),
            'description' => esc_html__('Theme White Logo Here', 'unikon'),
            'section' => 'header_logo_section',
            'default' => get_template_directory_uri() . '/assets/img/logo-light.svg',
        ]
    );

    new \Kirki\Field\Dimension(
        [
            'settings' => 'unikon_header_logo_width',
            'label' => __('Width', 'unikon'),
            'section' => 'header_logo_section',
            'responsive' => true,
            'default' => [
                'desktop' => [
                    'width' => '85px',
                ],
                'tablet' => [
                    'width' => '85px',
                ],
                'mobile' => [
                    'width' => '85px',
                ],
            ],
            'output' => [
                [
                    'element' => '.unikon-site-logo img',
                    'property' => 'width',
                    'media_query' => [
                        'desktop' => '@media (min-width: 1024px)',
                        'tablet' => '@media (min-width: 768px) and (max-width: 1023px)',
                        'mobile' => '@media (max-width: 767px)',
                    ],
                ],
            ],
        ]
    );
}
unikon_logo_settings();


function unikon_offcanvas_settings()
{

    new \Kirki\Section(
        'unikon_offcanvas_section',
        [
            'title' => esc_html__('Offcanvas Settings', 'unikon'),
            'description' => esc_html__('Offcanvas Controls.', 'unikon'),
            'panel' => 'unikon_panel',
            'priority' => 102,
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings' => 'unikon_offcanvas_logo',
            'label' => esc_html__('Offcanvas Logo', 'unikon'),
            'section' => 'unikon_offcanvas_section',
            'default' => get_template_directory_uri() . '/assets/img/logo-light-large.svg',
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Dimension(
        [
            'settings' => 'unikon_offcanvas_logo_width',
            'label' => __('Logo Width', 'unikon'),
            'section' => 'unikon_offcanvas_section',
            'responsive' => true,
            'default' => [
                'desktop' => '85px',
                'tablet' => '85px',
                'mobile' => '85px',
            ],
            'output' => [
                [
                    'element' => '.unikon-offcanvas-logo img',
                    'property' => 'width',
                    'media_query' => [
                        'desktop' => '@media (min-width: 1024px)',
                        'tablet' => '@media (min-width: 768px) and (max-width: 1023px)',
                        'mobile' => '@media (max-width: 767px)',
                    ],
                ],
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'unikon_offcanvas_content_switch',
            'label' => esc_html__('Offcanvas Content Switch', 'unikon'),
            'description' => esc_html__('Offcanvas Content On/Off', 'unikon'),
            'section' => 'unikon_offcanvas_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'unikon'),
                'off' => esc_html__('Disable', 'unikon'),
            ],
        ]
    );

    new \Kirki\Field\Textarea(
        [
            'settings' => 'unikon_offcanvas_content',
            'label' => esc_html__('Offcanvas Content', 'unikon'),
            'section' => 'unikon_offcanvas_section',
            'default' => esc_html__('Discover, Explore & Understanding The Product Description Maecenas ullamcorper eros libero, facilities tempore mi darius vel. Sed ut felid ligula. Pellentesque.', 'unikon'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'unikon_offcanvas_content_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'unikon_offcanvas_number_label',
            'label' => esc_html__('Offcanvas Number Label', 'unikon'),
            'section' => 'unikon_offcanvas_section',
            'default' => esc_html__('Contact Us 24/7', 'unikon'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'unikon_offcanvas_content_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'unikon_offcanvas_number',
            'label' => esc_html__('Offcanvas Number', 'unikon'),
            'section' => 'unikon_offcanvas_section',
            'default' => esc_html__('+55 (9900) 666 22', 'unikon'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'unikon_offcanvas_content_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'unikon_offcanvas_email_label',
            'label' => esc_html__('Offcanvas Email Label', 'unikon'),
            'section' => 'unikon_offcanvas_section',
            'default' => esc_html__('Contact Mail', 'unikon'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'unikon_offcanvas_content_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'unikon_offcanvas_email',
            'label' => esc_html__('Offcanvas Email', 'unikon'),
            'section' => 'unikon_offcanvas_section',
            'default' => esc_html__('info.unikon@demo.com', 'unikon'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'unikon_offcanvas_content_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'unikon_offcanvas_location_label',
            'label' => esc_html__('Offcanvas Location Label', 'unikon'),
            'section' => 'unikon_offcanvas_section',
            'default' => esc_html__('Contact Location', 'unikon'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'unikon_offcanvas_content_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'unikon_offcanvas_location',
            'label' => esc_html__('Offcanvas Location', 'unikon'),
            'section' => 'unikon_offcanvas_section',
            'default' => esc_html__('18/2, Topkhana Road, Australia.', 'unikon'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'unikon_offcanvas_content_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'unikon_offcanvas_copyright',
            'label' => esc_html__('Offcanvas Copyright', 'unikon'),
            'section' => 'unikon_offcanvas_section',
            'default' => esc_html__('@Unikon.Copyright © 2024', 'unikon'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'unikon_offcanvas_content_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
}

unikon_offcanvas_settings();


function unikon_back_to_top_section()
{

    new \Kirki\Section(
        'back_to_top_section',
        [
            'title' => esc_html__('Back To Top Settings', 'unikon'),
            'description' => esc_html__('Back To Top Controls.', 'unikon'),
            'panel' => 'unikon_panel',
            'priority' => 103,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'unikon_backtotop_switch',
            'label' => esc_html__('Back To Top Switch', 'unikon'),
            'description' => esc_html__('Back To Top On/Off', 'unikon'),
            'section' => 'back_to_top_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'unikon'),
                'off' => esc_html__('Disable', 'unikon'),
            ],
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'back_to_top_bg',
            'label' => __('Back To Top BG Color', 'unikon'),
            'description' => esc_html__('You can change Back To Top bg color from here.', 'unikon'),
            'section' => 'back_to_top_section',
            'default' => '#fff',
            'output' => [
                [
                    'element' => '.back-to-top-btn',
                    'property' => 'background',
                ],
            ],
            'active_callback' => [
                [
                    'setting' => 'unikon_backtotop_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'back_to_top_icon_color',
            'label' => __('Back To Top Icon Color', 'unikon'),
            'description' => esc_html__('You can change Back To Top icon color from here.', 'unikon'),
            'section' => 'back_to_top_section',
            'default' => '#000',
            'output' => [
                [
                    'element' => '.back-to-top-btn i',
                    'property' => 'color',
                ],
            ],
            'active_callback' => [
                [
                    'setting' => 'unikon_backtotop_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
}
unikon_back_to_top_section();


function unikon_preloader_settings()
{

    new \Kirki\Section(
        'preloader_section',
        [
            'title' => esc_html__('Preloader Settings', 'unikon'),
            'description' => esc_html__('Preloader Controls.', 'unikon'),
            'panel' => 'unikon_panel',
            'priority' => 104,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'unikon_preloader_switch',
            'label' => esc_html__('Preloader Switch', 'unikon'),
            'description' => esc_html__('Preloader On/Off', 'unikon'),
            'section' => 'preloader_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'unikon'),
                'off' => esc_html__('Disable', 'unikon'),
            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'unikon_preloader_loading_text',
            'label' => esc_html__('Preloader Loading Text', 'unikon'),
            'section' => 'preloader_section',
            'default' => esc_html__('Unikon', 'unikon'),
            'priority' => 11,
            'active_callback' => [
                [
                    'setting' => 'unikon_preloader_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
}

unikon_preloader_settings();

function unikon_breadcrumb_settings()
{
    new \Kirki\Section(
        'unikon_breadcrumb_section',
        [
            'title' => esc_html__('Breadcrumb Settings', 'unikon'),
            'description' => esc_html__('Breadcrumb Settings.', 'unikon'),
            'panel' => 'unikon_panel',
            'priority' => 105,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'breadcrumb_switch',
            'label' => esc_html__('Show Breadcrumb Globally', 'unikon'),
            'description' => esc_html__('Breadcrumb On/Off', 'unikon'),
            'section' => 'unikon_breadcrumb_section',
            'default' => true,
            'choices' => [
                'on' => esc_html__('Show', 'unikon'),
                'off' => esc_html__('Hide', 'unikon'),
            ],

        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'unikon_breadcrumb_elementor_switch',
            'label' => esc_html__('Breadcrumb Custom/Elementor Switch', 'unikon'),
            'description' => esc_html__('Breadcrumb Custom/Elementor On/Off', 'unikon'),
            'section' => 'unikon_breadcrumb_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'unikon'),
                'off' => esc_html__('Disable', 'unikon'),
            ],
        ]
    );

    new \Kirki\Field\Radio_Image(
        [
            'settings' => 'breadcrumb_layout_custom',
            'label' => esc_html__('Chose Breadcrumb Style', 'unikon'),
            'section' => 'unikon_breadcrumb_section',
            'priority' => 10,
            'choices' => [
                'breadcrumb_1' => get_template_directory_uri() . '/inc/img/breadcrumb/breadcrumb_1.png',
            ],
            'default' => 'breadcrumb_1',
            'active_callback' => [
                [
                    'setting' => 'unikon_breadcrumb_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $breadcrumb_buildertype = array(
        'post_type' => 'wpr-breadcrumb',
        'posts_per_page' => -1,
    );
    $breadcrumb_buildertype_loop = get_posts($breadcrumb_buildertype);

    $breadcrumb_post_obj_arr = array();
    foreach ($breadcrumb_buildertype_loop as $post) {
        $breadcrumb_post_obj_arr[$post->ID] = $post->post_title;
    }

    wp_reset_query();

    new \Kirki\Field\Select(
        [
            'settings' => 'unikon_breadcrumb_templates_kirki',
            'label' => esc_html__('Elementor Breadcrumb Template', 'unikon'),
            'section' => 'unikon_breadcrumb_section',
            'placeholder' => esc_html__('Choose an option', 'unikon'),
            'choices' => $breadcrumb_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'unikon_breadcrumb_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Radio_Buttonset(
        [
            'settings' => 'breadcrumb_typography_responsive_control',
            'label' => esc_html__('Typography Control', 'unikon'),
            'section' => 'unikon_breadcrumb_section',
            'default' => 'desktop',
            'priority' => 10,
            'choices' => [
                'desktop' => esc_html__('Desktop', 'unikon'),
                'tablet' => esc_html__('Tablet', 'unikon'),
                'mobile' => esc_html__('Mobile', 'unikon'),
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'breadcrumb_typography_desktop',
            'label' => esc_html__('Typography Control', 'unikon'),
            'description' => esc_html__('Set typography for desktop', 'unikon'),
            'section' => 'unikon_breadcrumb_section',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '#0f0f0f',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'active_callback' => [
                [
                    'setting' => 'breadcrumb_typography_responsive_control',
                    'operator' => '==',
                    'value' => 'desktop'
                ]
            ],
            'output' => [
                [
                    'element' => '.wpr-breadcrumb__title',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'breadcrumb_typography_tablet',
            'label' => esc_html__('Typography Control', 'unikon'),
            'description' => esc_html__('Set typography for tablet', 'unikon'),
            'section' => 'unikon_breadcrumb_section',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '#0f0f0f',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'active_callback' => [
                [
                    'setting' => 'breadcrumb_typography_responsive_control',
                    'operator' => '==',
                    'value' => 'tablet'
                ]
            ],
            'output' => [
                [
                    'element' => '.wpr-breadcrumb__title',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'breadcrumb_typography_mobile',
            'label' => esc_html__('Typography Control', 'unikon'),
            'description' => esc_html__('Set typography for mobile', 'unikon'),
            'section' => 'unikon_breadcrumb_section',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '#0f0f0f',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'active_callback' => [
                [
                    'setting' => 'breadcrumb_typography_responsive_control',
                    'operator' => '==',
                    'value' => 'mobile'
                ]
            ],
            'output' => [
                [
                    'element' => '.wpr-breadcrumb__title',
                ],
            ],
        ]
    );

    new \Kirki\Field\Dimensions(
        [
            'settings' => 'unikon_breadcrumb_padding',
            'label' => __('Padding', 'unikon'),
            'section' => 'unikon_breadcrumb_section',
            'responsive' => true,
            'default' => [
                'desktop' => [
                    'padding-top' => '100px',
                    'padding-bottom' => '100px',
                ],
                'tablet' => [
                    'padding-top' => '100px',
                    'padding-bottom' => '100px',
                ],
                'mobile' => [
                    'padding-top' => '80px',
                    'padding-bottom' => '80px',
                ],
            ],
            'output' => [
                [
                    'element' => '.unikon-breadcrumb-padding',
                    'media_query' => [
                        'desktop' => '@media (min-width: 1024px)',
                        'tablet' => '@media (min-width: 768px) and (max-width: 1023px)',
                        'mobile' => '@media (max-width: 767px)',
                    ],
                ],
            ],
        ]
    );
}
unikon_breadcrumb_settings();

function unikon_blog_settings()
{
    // blog_section section 
    new \Kirki\Section(
        'blog_section',
        [
            'title' => esc_html__('Blog Settings', 'unikon'),
            'description' => esc_html__('Blog Section Settings.', 'unikon'),
            'panel' => 'unikon_panel',
            'priority' => 106,
        ]
    );

    new \Kirki\Field\Dimensions(
        [
            'settings' => 'unikon_blog_full_width_padding',
            'label' => esc_html__('Vertical Padding', 'unikon'),
            'description' => esc_html__('Change Vertical Padding here', 'unikon'),
            'section' => 'blog_section',
            'responsive' => true,
            'default' =>
                [
                    'desktop' => [
                        'padding-top' => '170px',
                        'padding-bottom' => '170px',
                    ],
                    'tablet' => [
                        'padding-top' => '70px',
                        'padding-bottom' => '70px',
                    ],
                    'mobile' => [
                        'padding-top' => '40px',
                        'padding-bottom' => '40px',
                    ],
                ],
            'output' => [
                [
                    'element' => '.unikon-blog-single-height',
                    'media_query' => [
                        'desktop' => '@media (min-width: 1024px)',
                        'tablet' => '@media (min-width: 768px) and (max-width: 1023px)',
                        'mobile' => '@media (max-width: 767px)',
                    ],
                ],
            ],
            'active_callback' => [
                [
                    'setting' => 'unikon_blog_single_layout',
                    'operator' => '==',
                    'value' => 'blog_single_classic'
                ]
            ]
        ]
    );

    new \Kirki\Field\Dimensions(
        [
            'settings' => 'unikon_blog_classic_padding',
            'label' => esc_html__('Vertical Padding', 'unikon'),
            'description' => esc_html__('Change Vertical Padding here', 'unikon'),
            'section' => 'blog_section',
            'responsive' => true,
            'default' => [
                'desktop' => [
                    'padding-top' => '170px',
                    'padding-bottom' => '70px',
                ],
                'tablet' => [
                    'padding-top' => '100px',
                    'padding-bottom' => '70px',
                ],
                'mobile' => [
                    'padding-top' => '70px',
                    'padding-bottom' => '40px',
                ],
            ],
            'output' => [
                [
                    'element' => '.blog-details-without-sidebar',
                    'media_query' => [
                        'desktop' => '@media (min-width: 1024px)',
                        'tablet' => '@media (min-width: 768px) and (max-width: 1023px)',
                        'mobile' => '@media (max-width: 767px)',
                    ],
                ],
            ],
            'active_callback' => [
                [
                    'setting' => 'unikon_blog_single_layout',
                    'operator' => '==',
                    'value' => 'blog_single_classic'
                ]
            ]
        ]
    );

    new \Kirki\Field\Dimensions(
        [
            'settings' => 'unikon_blog_default_padding',
            'label' => esc_html__('Vertical Padding', 'unikon'),
            'description' => esc_html__('Change Vertical Padding here', 'unikon'),
            'section' => 'blog_section',
            'responsive' => true,
            'default' => [
                'desktop' => [
                    'padding-top' => '100px',
                    'padding-bottom' => '100px',
                ],
                'tablet' => [
                    'padding-top' => '70px',
                    'padding-bottom' => '70px',
                ],
                'mobile' => [
                    'padding-top' => '40px',
                    'padding-bottom' => '40px',
                ],
            ],
            'output' => [
                [
                    'element' => '.unikon-blog-single-padding',
                    'media_query' => [
                        'desktop' => '@media (min-width: 1024px)',
                        'tablet' => '@media (min-width: 768px) and (max-width: 1023px)',
                        'mobile' => '@media (max-width: 767px)',
                    ],
                ],
            ],
            'active_callback' => [
                [
                    'setting' => 'unikon_blog_single_layout',
                    'operator' => '==',
                    'value' => 'blog_single_default'
                ]
            ]
        ]
    );

    new \Kirki\Field\Dimension(
        [
            'settings' => 'unikon_blog_full_width_height_set',
            'label' => esc_html__('Set Height', 'unikon'),
            'description' => esc_html__('Adjust height of hero section.', 'unikon'),
            'section' => 'blog_section',
            'responsive' => true,
            'default' => [
                'desktop' => '800px',
                'tablet' => '600px',
                'mobile' => '450px',
            ],
            'choices' => [
                'accept_unitless' => true,
            ],
            'output' => [
                [
                    'element' => '.unikon-blog-single-height',
                    'property' => 'height',
                    'media_query' => [
                        'desktop' => '@media (min-width: 1024px)',
                        'tablet' => '@media (min-width: 768px) and (max-width: 1023px)',
                        'mobile' => '@media (max-width: 767px)',
                    ],
                ],
            ],
            'active_callback' => [
                [
                    'setting' => 'unikon_blog_single_layout',
                    'operator' => '==',
                    'value' => 'blog_single_full_width'
                ]
            ]
        ]
    );

    // blog_section BTN 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'unikon_blog_cat',
            'label' => esc_html__('Blog Category Meta On/Off', 'unikon'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    // blog_section Author Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'unikon_blog_author',
            'label' => esc_html__('Blog Author Meta On/Off', 'unikon'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'unikon_blog_date',
            'label' => esc_html__('Blog Date Meta On/Off', 'unikon'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'unikon_blog_comments',
            'label' => esc_html__('Blog Comments Meta On/Off', 'unikon'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'unikon_blog_tags',
            'label' => esc_html__('Blog Tags Meta On/Off', 'unikon'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'unikon_post_box_social_switch',
            'label' => esc_html__('Post Box Social On/Off', 'unikon'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'unikon_blog_btn_switch',
            'label' => esc_html__('Blog BTN On/Off', 'unikon'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'unikon_blog_single_social',
            'label' => esc_html__('Single Blog Social Share', 'unikon'),
            'section' => 'blog_section',
            'default' => false,
            'priority' => 10,
        ]
    );

    // blog_section Blog BTN text 
    new \Kirki\Field\Text(
        [
            'settings' => 'unikon_blog_btn',
            'label' => esc_html__('Blog Button Text', 'unikon'),
            'section' => 'blog_section',
            'default' => "Read More",
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'unikon_blog_btn_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'unikon_blog_single_related',
            'label' => esc_html__('Enable Related Post?', 'unikon'),
            'description' => esc_html__('Related Post For Single On/Off', 'unikon'),
            'section' => 'blog_section',
            'default' => false,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'unikon_blog_related_title',
            'label' => esc_html__('Blog Related Title', 'unikon'),
            'section' => 'blog_section',
            'default' => "Related Posts",
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'unikon_blog_single_related',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
}
unikon_blog_settings();

function error_404_section()
{
    // 404_section section 
    new \Kirki\Section(
        'error_404_section',
        [
            'title' => esc_html__('404 Page', 'unikon'),
            'description' => esc_html__('404 Page Settings.', 'unikon'),
            'panel' => 'unikon_panel',
            'priority' => 107,
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings' => 'unikon_error_thumb',
            'label' => esc_html__('Error Image', 'unikon'),
            'description' => esc_html__('Error Image Here', 'unikon'),
            'section' => 'error_404_section',
            'default' => get_template_directory_uri() . '/assets/img/error/error.png',
        ]
    );

    // 404_section 
    new \Kirki\Field\Text(
        [
            'settings' => 'unikon_error_title',
            'label' => esc_html__('Not Found Title', 'unikon'),
            'section' => 'error_404_section',
            'default' => "Oops!",
            'priority' => 10,
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings' => 'unikon_error_title_sm',
            'label' => esc_html__('Something went Wrong...', 'unikon'),
            'section' => 'error_404_section',
            'default' => "Oops! Page not found",
            'priority' => 10,
        ]
    );

    // 404_section description
    new \Kirki\Field\Textarea(
        [
            'settings' => 'unikon_error_desc',
            'label' => esc_html__('Not Found description', 'unikon'),
            'section' => 'error_404_section',
            'default' => "Sorry, we couldn\'t find your page.",
            'priority' => 10,
        ]
    );

    // 404_section description
    new \Kirki\Field\Text(
        [
            'settings' => 'unikon_error_link_text',
            'label' => esc_html__('Error Link Text', 'unikon'),
            'section' => 'error_404_section',
            'default' => "Back To Home",
            'priority' => 10,
        ]
    );
}
error_404_section();


function full_site_typography()
{
    new \Kirki\Section(
        'full_site_typography',
        [
            'title' => esc_html__('Typography', 'unikon'),
            'description' => esc_html__('Typography Settings.', 'unikon'),
            'panel' => 'unikon_panel',
            'priority' => 190,
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_h1',
            'label' => esc_html__('H1 Typography Control', 'unikon'),
            'description' => esc_html__('The full set of options.', 'unikon'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h1',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_h2',
            'label' => esc_html__('H2 Typography Control', 'unikon'),
            'description' => esc_html__('The full set of options.', 'unikon'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h2',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_h3',
            'label' => esc_html__('H3 Typography Control', 'unikon'),
            'description' => esc_html__('The full set of options.', 'unikon'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h3',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_h4',
            'label' => esc_html__('H4 Typography Control', 'unikon'),
            'description' => esc_html__('The full set of options.', 'unikon'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h4',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_h5',
            'label' => esc_html__('H5 Typography Control', 'unikon'),
            'description' => esc_html__('The full set of options.', 'unikon'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h5',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_h6',
            'label' => esc_html__('H6 Typography Control', 'unikon'),
            'description' => esc_html__('The full set of options.', 'unikon'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h6',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_body',
            'label' => esc_html__('Body Typography Control', 'unikon'),
            'description' => esc_html__('The full set of options.', 'unikon'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'body',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_p',
            'label' => esc_html__('Paragraph Typography Control', 'unikon'),
            'description' => esc_html__('The full set of options.', 'unikon'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'p',
                ],
            ],
        ]
    );
}
full_site_typography();

function unikon_theme_colors()
{
    new \Kirki\Section(
        'unikon_theme_color_section',
        [
            'title' => esc_html__('Theme Colors', 'unikon'),
            'description' => esc_html__('Theme Color Settings.', 'unikon'),
            'panel' => 'unikon_panel',
            'priority' => 190,
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'unikon_color_1',
            'label' => __('Theme Color 1', 'unikon'),
            'description' => esc_html__('Choose Your Color 1', 'unikon'),
            'section' => 'unikon_theme_color_section',
            'default' => '#0f0f0f',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'unikon_color_2',
            'label' => __('Theme Color 2', 'unikon'),
            'description' => esc_html__('Choose Your Color 1', 'unikon'),
            'section' => 'unikon_theme_color_section',
            'default' => '#ffbb7b',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'unikon_color_3',
            'label' => __('Theme Color 3', 'unikon'),
            'description' => esc_html__('Choose Your Color 2', 'unikon'),
            'section' => 'unikon_theme_color_section',
            'default' => '#c89b51',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'unikon_color_33',
            'label' => __('Theme Color 3 Light', 'unikon'),
            'description' => esc_html__('Choose Your Color 2', 'unikon'),
            'section' => 'unikon_theme_color_section',
            'default' => '#f0f1e7',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'unikon_color_4',
            'label' => __('Theme Color 4', 'unikon'),
            'description' => esc_html__('Choose Your Color 3', 'unikon'),
            'section' => 'unikon_theme_color_section',
            'default' => '#f0b64b',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'unikon_color_5',
            'label' => __('Theme Color 5', 'unikon'),
            'description' => esc_html__('Choose Your Color 4', 'unikon'),
            'section' => 'unikon_theme_color_section',
            'default' => '#f5f5f5',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'unikon_color_6',
            'label' => __('Theme Color 6', 'unikon'),
            'description' => esc_html__('Choose Your Color 5', 'unikon'),
            'section' => 'unikon_theme_color_section',
            'default' => '#fcfcfc',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'unikon_color_7',
            'label' => __('Theme Color 7', 'unikon'),
            'description' => esc_html__('Choose Your Color 6', 'unikon'),
            'section' => 'unikon_theme_color_section',
            'default' => '#fffdfc',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'unikon_color_8',
            'label' => __('Theme Color 8', 'unikon'),
            'description' => esc_html__('Choose Your Color 7', 'unikon'),
            'section' => 'unikon_theme_color_section',
            'default' => '#c9f31d',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'unikon_color_9',
            'label' => __('Theme Color 9', 'unikon'),
            'description' => esc_html__('Choose Your Color 8', 'unikon'),
            'section' => 'unikon_theme_color_section',
            'default' => '#f0a362',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'unikon_color_10',
            'label' => __('Theme Color 10', 'unikon'),
            'description' => esc_html__('Choose Your Color 8', 'unikon'),
            'section' => 'unikon_theme_color_section',
            'default' => '#f5ca78',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'unikon_color_11',
            'label' => __('Health Gradient', 'unikon'),
            'description' => esc_html__('Choose Your Color', 'unikon'),
            'section' => 'unikon_theme_color_section',
            'default' => 'linear-gradient(90deg, #3a9fd8 0%, #8363de 100%)',
        ]
    );
}

unikon_theme_colors();


function unikon_footer_settings()
{

    new \Kirki\Section(
        'unikon_footer_section',
        [
            'title' => esc_html__('Footer', 'unikon'),
            'description' => esc_html__('Footer Settings.', 'unikon'),
            'panel' => 'unikon_panel',
            'priority' => 190,
        ]
    );
    // footer_widget_number section 
    new \Kirki\Field\Select(
        [
            'settings' => 'footer_widget_number',
            'label' => esc_html__('Footer Widget Number', 'unikon'),
            'section' => 'unikon_footer_section',
            'default' => '4',
            'placeholder' => esc_html__('Choose an option', 'unikon'),
            'choices' => [
                '1' => esc_html__('1', 'unikon'),
                '2' => esc_html__('2', 'unikon'),
                '3' => esc_html__('3', 'unikon'),
                '4' => esc_html__('4', 'unikon'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'unikon_footer_elementor_switch',
            'label' => esc_html__('Footer Custom/Elementor Switch', 'unikon'),
            'description' => esc_html__('Footer Custom/Elementor On/Off', 'unikon'),
            'section' => 'unikon_footer_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'unikon'),
                'off' => esc_html__('Disable', 'unikon'),
            ],
        ]
    );

    new \Kirki\Field\Radio_Image(
        [
            'settings' => 'footer_layout_custom',
            'label' => esc_html__('Footer Layout Control', 'unikon'),
            'section' => 'unikon_footer_section',
            'priority' => 10,
            'choices' => [
                'footer_1' => get_template_directory_uri() . '/inc/img/footer/footer-1.png',

            ],
            'default' => 'footer_1',
            'active_callback' => [
                [
                    'setting' => 'unikon_footer_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $footer_buildertype = array(
        'post_type' => 'wpr-footer',
        'posts_per_page' => -1,
    );
    $footer_buildertype_loop = get_posts($footer_buildertype);
    $footer_post_obj_arr = array();
    foreach ($footer_buildertype_loop as $post) {
        $footer_post_obj_arr[$post->ID] = $post->post_title;
    }

    wp_reset_postdata();

    new \Kirki\Field\Select(
        [
            'settings' => 'unikon_footer_templates',
            'label' => esc_html__('Elementor Footer Template', 'unikon'),
            'section' => 'unikon_footer_section',
            'placeholder' => esc_html__('Choose an option', 'unikon'),
            'choices' => $footer_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'unikon_footer_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'unikon_copyright',
            'label' => esc_html__('Footer Copyright', 'unikon'),
            'section' => 'unikon_footer_section',
            'default' => esc_html__('© 2024 Unikon. All rights reserved.', 'unikon'),
            'priority' => 10,
        ]
    );
}
unikon_footer_settings();

// unikon_post_type_slug_section
function unikon_post_type_slug_section()
{
    new \Kirki\Section(
        'unikon_post_type_slug_section',
        [
            'title' => esc_html__('Slug Settings', 'unikon'),
            'panel' => 'unikon_panel',
            'priority' => 190,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'unikon_portfolios_slug',
            'label' => esc_html__('Portfolios Slug', 'unikon'),
            'section' => 'unikon_post_type_slug_section',
            'default' => __('wpr-portfolios', 'unikon'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'unikon_services_slug',
            'label' => esc_html__('Services Slug', 'unikon'),
            'section' => 'unikon_post_type_slug_section',
            'default' => __('wpr-services', 'unikon'),
            'priority' => 10,
        ]
    );

}
unikon_post_type_slug_section();