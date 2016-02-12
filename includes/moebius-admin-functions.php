<?php
function get_authors_meta_info($userID) {
    $author = [];
    $author['ID']         = get_the_author_meta( 'ID', $userID );
    $author['bio']        = get_the_author_meta( '_moebius_user_bio', $userID );
    $author['img']        = get_the_author_meta( '_moebius_user_img_id', $userID );
    $author['role_title'] = get_the_author_meta( '_moebius_user_role_title', $userID );
    $author['name']       = get_the_author_meta( 'display_name', $userID );
    $author['url']        = get_the_author_meta( 'user_url', $userID );
    $author['moebius_order'] = get_the_author_meta( 'moebius_order', $userID );
    return $author;
  }

function get_moebius_users() {
  $usersIDs = get_users( array(
    'fields' => array('ID'),
    'who' => 'authors'
  ) );

  $groups = array(
    'principal'    => '1',
    'colaborators' => '2'
  );

  $authors = [];
  foreach ($usersIDs as $id => $user) {
    $group = get_the_author_meta( '_moebius_user_group', $user->ID );

    if ( !empty($group) ) {
      $iPosition = get_the_author_meta( 'moebius_order', $user->ID );
      $iPosition = !empty( (int)$iPosition + 1 ) ? $iPosition : (int)$user->ID + 9999;

      if ( !array_key_exists($group, $authors) ) {
        $authors[$group] = [];
      }
      $authors[$group][$iPosition] = get_authors_meta_info($user->ID);
      ksort($authors[$group]);
    }
  }

  return array('authors' => $authors, 'groups' => $groups);
}