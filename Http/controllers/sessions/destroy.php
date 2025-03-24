<?php

use Core\Authenticator;

Authenticator::logout();
redirect(route('/login'));