<?php

class Moebius_Admin_Back {
  private $moebius_admin;
  private $version;

  public function __construct( $moebius_admin, $version ) {
    $this->moebius_admin = $moebius_admin;
    $this->version = $version;
  }

  public function enqueue_styles() {
    wp_enqueue_style( $this->moebius_admin, plugin_dir_url( __FILE__ ) . 'css/moebius-admin-back.css', array(), $this->version, 'all' );
  }

  public function enqueue_scripts() {
    wp_enqueue_script( 'sortable', '//cdnjs.cloudflare.com/ajax/libs/Sortable/1.4.2/Sortable.min.js', array(), '', true );
    wp_enqueue_script( $this->moebius_admin, plugin_dir_url( __FILE__ ) . 'js/moebius-admin-back.js', array( 'jquery', 'sortable' ), $this->version, true );
  }

  /*=================================================
  =            DISABLE DASHBOARD WIDGETS            =
  =================================================*/
  public function disable_default_dashboard_widgets() {
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

    // remove plugin dashboard boxes
    unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);
  }
  /*-----  End of DISABLE DASHBOARD WIDGETS  ------*/

  /*=============================
  =            USERS            =
  =============================*/
  public function register_user_profile_metabox() {
    $prefix = '_moebius_user_';

    $cmb_user = new_cmb2_box( array(
      'id'               => $prefix . 'profile',
      'title'            => 'Perfil de Usuario',
      'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta
      'show_names'       => true,
      'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
    ) );

    $cmb_user->add_field( array(
      'name'     => 'Informaci&oacute;n Adicional para usuarios de Moebius Animaci&oacute;n',
      'desc'     => 'Esta informaci&oacute; sera visible en algunas de las paginas, por ejemplo en Quienes Somos.',
      'id'       => $prefix . 'extra_info_title',
      'type'     => 'title',
      'on_front' => false,
    ) );

    $cmb_user->add_field( array(
      'name' => 'Biografia',
      'desc' => '',
      'id'   => $prefix . 'bio',
      'type' => 'wysiwyg',
      'options' => array(
        'textarea_rows' => 10,
        'teeny' => true,
        'media_buttons' => false,
      ),
    ) );

    $cmb_user->add_field( array(
      'name' => 'Imagen de Perfil',
      'desc' => 'La imagen que se publicara en tu perfil.',
      'id'   => $prefix . 'img',
      'type' => 'file',
      'options' => array(
        'url' => false,
        'add_upload_file_text' => 'Buscar archivo',
      ),
    ) );

    if ( current_user_can('edit_pages') ) {
      $cmb_user->add_field( array(
        'name' => 'Rol',
        'desc' => '',
        'id'   => $prefix . 'group',
        'type' => 'select',
        'show_option_none' => true,
        'options' => array(
          '1' => 'Equipo Principal',
          '2' => 'Colaborador',
        ),
      ) );

      $cmb_user->add_field( array(
        'name' => 'Titulo del Rol',
        'desc' => '',
        'id'   => $prefix . 'role_title',
        'type' => 'text',
      ) );
    }
  }
  /*=====  End of USERS  ======*/

  public function register_users_options() {
    add_submenu_page(
      'users.php',
      'Usuarios de Moebius',
      'Usuarios de Moebius',
      'manage_options',
      'moebius-users',
      array($this, 'render_users_options')
    );
  }

  public function render_users_options() {
    if ( !empty($_POST) ) {
      foreach ($_POST as $userID => $position) {
        update_user_option($userID, 'moebius_order', sanitize_text_field($position), true );
      }
    }
    require_once dirname( __FILE__ ) . '/partials/moebius-admin-back-display.php';
  }

}
