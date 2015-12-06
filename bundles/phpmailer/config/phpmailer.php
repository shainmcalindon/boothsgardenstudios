<?php

/**
 * Default Configuration
 *
 * For every option that is set here, if the value isn't null,
 * then that setting will be passed to the constructor when
 * starting a new mailer.
 *
 * For example, if the configuration contains:
 *
 *   array(
 *     'SetFrom'   => array('colin@example.com', 'Colin Viebrock'),
 *     'IsSMTP' => null,
 *     'Host'   => 'smtp@example.com',
 *   )
 *
 * that would be equivalent to running this when starting
 * a new mailer instance:
 *
 *   $mailer->SetFrom('Colin@example.com', 'Colin Viebrock');
 *   $mailer->IsSMTP();
 *   $mailer->Host = 'smtp@example.com';
 *
 * Sadly, this is a bit limited, mostly because of how PHPMailer handles
 * setting values.  Sometimes it's:
 *
 *    $foo->bar = $value
 *
 * and sometimes it's:
 *
 *    $foo->bar($value);
 *
 * Suggestions on how to better handle this are welcome, although the
 * most common elements that you might want to prepopulate (from address,
 * SMTP host and info) can be configured.
 */

return array(
	'SetFrom'       => array('noreply@shandydigital.co.uk','Booths Website Enquiry'),
	'IsSMTP'        => true,
  'SMTPDebug'     => 0,  // debugging: 1 = errors and messages, 2 = messages only
  'SMTPAuth'      => true,  // authentication enabled
  //'SMTPSecure'    => 'ssl', // secure transfer enabled REQUIRED for Gmail
  'Host'          => 'mail.shandydigital.co.uk',
  //'Port'          => 465,
  'Username'      => 'noreply@shandydigital.co.uk',
  'Password'      => '-Cbch-zg*%p;'
);