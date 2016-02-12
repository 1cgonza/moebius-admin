<?php

class Moebius_Admin {
  protected $loader;
  protected $moebius_admin;
  protected $version;

  public function __construct() {
    $this->moebius_admin = 'moebius-admin';
    $this->version = '1.0.0';

    $this->load_dependencies();
    $this->define_back_hooks();
    $this->define_front_hooks();
  }

  private function load_dependencies() {
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/moebius-admin-functions.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-moebius-admin-loader.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'back/class-moebius-admin-back.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'front/class-moebius-admin-front.php';

    $this->loader = new Moebius_Admin_Loader();
  }

  private function define_back_hooks() {
    $plugin_admin = new Moebius_Admin_Back( $this->get_moebius_admin(), $this->get_version() );
    $this->loader->add_action( 'wp_dashboard_setup', $plugin_admin, 'disable_default_dashboard_widgets' );
    $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
    $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
    $this->loader->add_action( 'cmb2_admin_init', $plugin_admin, 'register_user_profile_metabox' );
    $this->loader->add_action( 'admin_menu', $plugin_admin, 'register_users_options' );
  }

  private function define_front_hooks() {
    $plugin_public = new Moebius_Admin_Front( $this->get_moebius_admin(), $this->get_version() );
    $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
    $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
  }

  public function run() {
    $this->loader->run();
  }

  public function get_moebius_admin() {
    return $this->moebius_admin;
  }

  public function get_loader() {
    return $this->loader;
  }

  public function get_version() {
    return $this->version;
  }

}
