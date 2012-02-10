<?php



function mactimeline_views_views_data() {

  //$data['node']['table']['group'] = t('Node');

  $data['node']['mtl_title_description'] = array(

    'title' => t('Title, body'),
    'help' => t('Node title, body.'),
    'real field' => 'title',
    'field' => array(
      'handler' => 'mactimeline_views_handler_field_node_title_body',
      'click sortable' => TRUE,
    ),
    /*
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
    */
  );


  return $data;
}



/**
 * Implementation of hook_views_handlers() to register all of the basic handlers
 * views uses.
 */
function mactimeline_views_views_handlers() {
  return array(
    'info' => array(
      'path' => drupal_get_path('module', 'mactimeline_views') . '/views',
    ),
    'handlers' => array(
      // field handlers
      'mactimeline_views_handler_field_node_title_body' => array(
        'parent' => 'views_handler_field',
      ),

      'mactimeline_views_handler_field_node_update_severity' => array(
        'parent' => 'views_handler_field',
      ),
    ),
  );
}


