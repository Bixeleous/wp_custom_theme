<div>User not Logged in</div>

<div><a href="<?php /*esc_url() for security*/  echo esc_url(wp_login_url());?>">Login</a></div>
<div><a href="<?php echo esc_url(wp_registration_url()); ?>"> Register</a></div>
