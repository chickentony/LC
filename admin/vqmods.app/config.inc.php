<?php

  $app_config = array(
    'name' => language::translate('title_vqmods', 'vQmods'),
    'default' => 'vqmods',
    'theme' => array(
      'color' => '#a6dad7',
      'icon' => 'fa-plug',
    ),
    'menu' => array(
      array(
        'title' => language::translate('title_vqmods', 'vQmods'),
        'doc' => 'vqmods',
        'params' => array(),
      ),
    ),
    'docs' => array(
      'download' => 'download.inc.php',
      'vqmods' => 'vqmods.inc.php',
    ),
  );

?>