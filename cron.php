<?php
// $Id: cron.php,v 1.3 2010/03/09 22:42:23 webmaster Exp $

/**
 * @file
 * Handles incoming requests to fire off regularly-scheduled tasks (cron jobs).
 */

include_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
drupal_cron_run();
