<?php
function mactimeline_feed_icon($url, $title) {
  if ($image = theme('image', 'themes/mactimeline/images/icons/feed.png', t('Syndicate content'), $title)) {
    return '<a href="'. check_url($url) .'" class="feed-icon">RSS '. $image .'</a>';
  }
}

function mactimeline_links($links, $attributes = array('class' => 'links')) {
  global $language;
  $arguments = explode('/', $_REQUEST['q']);
  $output = '';

  if (count($links) > 0) {
    $output = '<ul'. drupal_attributes($attributes) .'>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $link['path'] = drupal_get_path_alias($link['href']);
      $class = $key;
      
      // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $class .= ' first';
      }
      if ($i == $num_links) {
        $class .= ' last';
      }
      if (strstr($arguments['0'],$link['path']) || isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
          && (empty($link['language']) || $link['language']->language == $language->language)) {        
        $class .= ' active';
      }
      if($arguments['0'] == 'event' && $link['path'] == 'events') {
        $class .= ' active';
      }
      if ($i != 1)$output .= '| ';
      $output .= '<li'. drupal_attributes(array('class' => $class)) .'>';

      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
        $output .= l($link['title'], $link['href'], $link);
      }
      else if (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span'. $span_attributes .'>'. $link['title'] .'</span>';
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}

function mactimeline_preprocess_date_views_filter_form(&$vars) {
  $vars['form']['value']['month']['#weight'] = 0;
  $form = $vars['form'];
  $vars['date'] = drupal_render($form['valuedate']);
  $vars['mindate'] = drupal_render($form['mindate']);
  $vars['maxdate'] = drupal_render($form['maxdate']);
  $vars['adjustment'] = drupal_render($form['valueadjustment']);
  $vars['minadjustment'] = drupal_render($form['minadjustment']);
  $vars['maxadjustment'] = drupal_render($form['maxadjustment']);
  $vars['description'] = drupal_render($form['description']) . drupal_render($form);
}

function mactimeline_preprocess_vote_up_down_widget(&$variables) {  
  $values = vote_up_down_vote_percents($variables['cid'],$variables['type']);

  $variables['percent1'] = $values['percent1'].'%';
  $variables['percent2'] = $values['percent2'].'%';

  if ($variables['cid'] == arg(1)) {
    $variables['page'] = true;
    $variables['up_count'] = $values['up_count'];
    $variables['down_count'] = $values['down_count'];
  }  
}

function mactimeline_comment_wrapper($content, $node) {
  if (!$content || $node->type == 'forum') {
    return '<div id="comments">'. $content .'</div>';
  }
  else {
    return '<div id="comments"><h2 class="comments">'. t('Comments (!number)', array('!number' => $node->comment_count)) .'</h2>'. $content .'</div>';
  }
}

function mactimeline_theme($existing, $type, $theme, $path) {
  return array(

    'box' => array(
      'function' => '_themename_box',
      'arguments' => array('title' => null, 'content' => null, 'region' => 'main'),
    ),
/*esem*/
    'user_login_block' => array(
      'template' => 'user-login',
      'arguments' => array('form' => NULL),
      // other theme registration code...
    ),
/*end esem*/
  );
}

function _themename_box($title, $content, $region = 'main') {
  $backtrace = debug_backtrace();
  $funcs = array();
  foreach($backtrace as $k => $bt) {
    if (isset($bt['function'])) {
      $funcs[] = $bt['function'];
    }
  }

  switch(true) {
    case in_array('comment_form_box', $funcs) :
      $output = $content;
    break;
  }

  return $output;
}

function mactimeline_username($object) {

  if ($object->uid && $object->name) {
    // Shorten the name when it is too long or it will break many tables.
    if (drupal_strlen($object->name) > 20) {
      $name = drupal_substr($object->name, 0, 15) .'...';
    }
    else {
      $name = $object->name;
    }

    if (user_access('access user profiles')) {
      $output = l($name, 'user/'. $object->uid, array('attributes' => array('title' => t('View user profile.'))));
    }
    else {
      $output = check_plain($name);
    }
  }
  else if ($object->name) {
    // Sometimes modules display content composed by people who are
    // not registered members of the site (e.g. mailing list or news
    // aggregator modules). This clause enables modules to display
    // the true author of the content.
    if (!empty($object->homepage)) {
      $output = l($object->name, $object->homepage, array('attributes' => array('rel' => 'nofollow')));
    }
    else {
      $output = check_plain($object->name);
    }

    //$output .= ' ('. t('not verified') .')';
  }
  else {
    $output = variable_get('anonymous', t('Anonymous'));
  }

  return $output;
}

function mactimeline_content_multigroup_display_table_multiple($element) {
  $header = array();
  foreach ($element['#fields'] as $field_name => $field) {
    $label_display = isset($field['display_settings']['label']['format']) ? $field['display_settings']['label']['format'] : 'above';
    switch ($field['widget']['label']) {
      case 'US':
        $field['widget']['label'] = l($field['widget']['label'],'http://store.apple.com/us',array('attributes' => array('target' => '_blank')));
        break;
      case 'UK':
        $field['widget']['label'] = l($field['widget']['label'],'http://store.apple.com/uk',array('attributes' => array('target' => '_blank')));
        break;
      case 'Canada':
        $field['widget']['label'] = l($field['widget']['label'],'http://store.apple.com/ca',array('attributes' => array('target' => '_blank')));
        break;
      case 'Germany':
        $field['widget']['label'] = l($field['widget']['label'],'http://store.apple.com/de',array('attributes' => array('target' => '_blank')));
        break;
      case 'Japan':
        $field['widget']['label'] = l($field['widget']['label'],'http://store.apple.com/jp',array('attributes' => array('target' => '_blank')));
        break;
      case 'Australia':
        $field['widget']['label'] = l($field['widget']['label'],'http://store.apple.com/au',array('attributes' => array('target' => '_blank')));
        break;
    }
    $header[] = $label_display != 'hidden' ? t($field['widget']['label']) : '';
  }
  $rows = array();
  foreach (element_children($element) as $delta) {
    $cells = array();
    foreach ($element['#fields'] as $field_name => $field) {
      $cells[] = array('data' => drupal_render($element[$delta][$field_name]), 'class' => $element[$delta]['#attributes']['class']);
    }
    $rows[] = $cells;
  }
  return count($rows) > 0 && $rows['0']['0']['data'] ? theme('table', $header, $rows, $element['#attributes']) : '';
}

function mactimeline_form_element($element, $value) {
  // This is also used in the installer, pre-database setup.
  $t = get_t();

  $output = '<div class="form-item"';
  if (!empty($element['#id'])) {
    $output .= ' id="'. $element['#id'] .'-wrapper"';
  }
  $output .= ">\n";
  //$required = !empty($element['#required']) ? '<span class="form-required" title="'. $t('This field is required.') .'">*</span>' : '';

  if (!empty($element['#title'])) {
    $title = $element['#title'];
    if (!empty($element['#id'])) {
      $output .= ' <label for="'. $element['#id'] .'">'. $t('!title: !required', array('!title' => filter_xss_admin($title), '!required' => $required)) ."</label>\n";
    }
    else {
      $output .= ' <label>'. $t('!title: !required', array('!title' => filter_xss_admin($title), '!required' => $required)) ."</label>\n";
    }
  }

  $output .= " $value\n";

  if (!empty($element['#description'])) {
    $output .= ' <div class="description">'. $element['#description'] ."</div>\n";
  }

  $output .= "</div>\n";

  return $output;
}
/*esem: for user-login-block-bar*/
function mactimeline_preprocess_user_login_block(&$variables)
{
// $variables['form']['name']['#value'] = $variables['form']['name']['#title'];
// $variables['form']['pass']['#value'] = $variables['form']['pass']['#title'];
// $variables['form']['name']['#attributes']['OnClick'] = 'this.value=""';
// $variables['form']['pass']['#attributes']['OnClick'] = 'this.value=""';
  
// Add a custom placeholder to username and password fields.
//$variables['form']['name']['#value'] = $variables['form']['name']['#title'];
//$variables['form']['name']['#attributes']['onblur'] = "if (this.value == '') {this.value = '".$variables['form']['name']['#title']."';} ;";
//$variables['form']['name']['#attributes']['onfocus'] = "if (this.value == '".$variables['form']['name']['#title']."') {this.value = '';} ;";
//$variables['form']['pass']['#value'] = $variables['form']['pass']['#title'];
//$variables['form']['pass']['#attributes']['onblur'] = "if (this.value == '') {this.value = '".$variables['form']['pass']['#title']."';} ;";
//$variables['form']['pass']['#attributes']['onfocus'] = "if (this.value == '".$variables['form']['pass']['#title']."') {this.value = '';} ;";
  
  // Redefine id for username and password inputs
  $variables['form']['name']['#id'] = 'name-hint';
  $variables['form']['pass']['#id'] = 'pass-hint';

  // Remove the "Username" & "Password" labels from the form.
  unset($variables['form']['name']['#title']);
  unset($variables['form']['pass']['#title']);
  
  $variables['form']['name']['#size'] = 15;
  $variables['form']['pass']['#size'] = 15;
  
  $variables['form']['submit']['#value'] = t('LOGIN');
  
  //Remove New User & Forgot Pass links
  //unset($variables['form']['links']);
  
  $variables['intro_text'] = t('');
 // $variables['rendered'] = drupal_render($variables['form']);
 
  $variables['rendered'] = $variables['form'];
  $variables['display_form'] = drupal_render($variables['rendered']);
}
/*end esem*/
?>
