<?php

/**
 * @file
 * User delete - Administration page
 *
 * @author
 * ilo <inaki.lopez@gmail.com>
 */

/**
 * Administrative settings page
 *
 * @return array
 *   a form array
 */
function user_delete_settings() {

  // These email tokens are shared for all settings, so just define
  // the list once to help ensure they stay in sync.
  $email_token_help = t('Available variables are:') .' !username, !site, !password, !uri, !uri_brief, !mailto, !date, !login_uri, !edit_uri, !login_url.';

  $form['registration_cancellation'] = array(
    '#type' => 'fieldset',
    '#title' => t('Settings for account cancellation'),
  );

  $form['registration_cancellation']['user_cancel_method'] = array(
    '#type' => 'item',
    '#title' => t('When cancelling a user account'),
    '#description' => t('Users with the %select-cancel-method or %administer-users <a href="@permissions-url">permissions</a> can override this default method.', array('%select-cancel-method' => t('Select method for cancelling account'), '%administer-users' => t('Administer users'), '@permissions-url' => url('admin/user/permissions'))),
  );
  
  $form['registration_cancellation']['user_cancel_method'] += user_delete_cancel_methods();
  foreach (element_children($form['registration_cancellation']['user_cancel_method']) as $element) {
    // Remove all account cancellation methods that have #access defined, as
    // those cannot be configured as default method.
    if (isset($form['registration_cancellation']['user_cancel_method'][$element]['#access'])) {
      $form['registration_cancellation']['user_cancel_method'][$element]['#access'] = FALSE;
    }
    // Remove the description (only displayed on the confirmation form).
    else {
      unset($form['registration_cancellation']['user_cancel_method'][$element]['#description']);
    }
  }

  $form['email_cancel_confirm'] = array(
    '#type' => 'fieldset',
    '#title' => t('Account cancellation confirmation'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#description' => t('Edit the e-mail messages sent to users when they attempt to cancel their accounts.') . ' ' . $email_token_help,
  );
  $form['email_cancel_confirm']['user_mail_cancel_confirm_subject'] = array(
    '#type' => 'textfield',
    '#title' => t('Subject'),
    '#default_value' => _user_delete_mail_text('cancel_confirm_subject'),
    '#maxlength' => 180,
  );
  $form['email_cancel_confirm']['user_mail_cancel_confirm_body'] = array(
    '#type' => 'textarea',
    '#title' => t('Body'),
    '#default_value' => _user_delete_mail_text('cancel_confirm_body'),
    '#rows' => 3,
  );

  $form['email_canceled'] = array(
    '#type' => 'fieldset',
    '#title' => t('Account canceled'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#description' => t('Enable and edit e-mail messages sent to users when their accounts are canceled.') . ' ' . $email_token_help,
  );
  $form['email_canceled']['user_mail_status_canceled_notify'] = array(
    '#type' => 'checkbox',
    '#title' => t('Notify user when account is canceled.'),
    '#default_value' => variable_get('user_mail_status_canceled_notify', FALSE),
  );
  $form['email_canceled']['user_mail_status_canceled_subject'] = array(
    '#type' => 'textfield',
    '#title' => t('Subject'),
    '#default_value' => _user_delete_mail_text('status_canceled_subject'),
    '#maxlength' => 180,
  );
  $form['email_canceled']['user_mail_status_canceled_body'] = array(
    '#type' => 'textarea',
    '#title' => t('Body'),
    '#default_value' => _user_delete_mail_text('status_canceled_body'),
    '#rows' => 3,
  );

  return system_settings_form($form);
}

/**
 * Return subject and body strings for default _user_mail_notify function.
 * @param <type> $key
 * @param <type> $language
 * @param <type> $variables
 * @return <type>
 */
function _user_delete_mail_text($key, $language = NULL, $variables = array()) {
  $langcode = isset($language) ? $language->language : NULL;

  if ($admin_setting = variable_get('user_mail_'. $key, FALSE)) {
    // An admin setting overrides the default string.
    return strtr($admin_setting, $variables);
  }
  else {
    // No override, return default string.
    switch ($key) {
      case 'cancel_confirm_subject':
        return t('Account cancellation request for !username at !site', $variables, $langcode);
        break;
      case 'cancel_confirm_body':
        return t("!username,\n\nA request to cancel your account has been made at !site.\n\nYou may now cancel your account on !uri_brief by clicking this link or copying and pasting it into your browser:\n\n!cancelurl\n\nNOTE: The cancellation of your account is not reversible.\n\nThis link expires in one day and nothing will happen if it is not used.\n\n\n--  !site team", $variables, $langcode);
      case 'status_canceled_subject':
        return t('Account details for !username at !site (canceled)', $variables, $langcode);
      case 'status_canceled_body':
        return t("!username,\n\nYour account on !site has been canceled.\n\n\n--  !site team", $variables, $langcode);
        break;
    }
  }

}
