<?php

class Moebius_Admin_Front {
  private $moebius_admin;
  private $version;

  public function __construct( $moebius_admin, $version ) {
    $this->moebius_admin = $moebius_admin;
    $this->version = $version;
  }

  public function enqueue_styles() {
    wp_enqueue_style( $this->moebius_admin, plugin_dir_url( __FILE__ ) . 'css/moebius-admin-front.css', array(), $this->version, 'all' );
  }

  public function enqueue_scripts() {
    wp_enqueue_script( $this->moebius_admin, plugin_dir_url( __FILE__ ) . 'js/moebius-admin-front.js', array( 'jquery' ), $this->version, false );
  }

}
