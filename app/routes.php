<?php
//$router->map();
//$router->map('POST', '/users/[i:id]/[delete|update:action]', 'usersController#doAction', 'users_do');
$x = array(array('GET|POST', '/', 'home#index', 'home'),
	array('GET', '/users/[i:id]', 'users#show', 'users_show'),
	array('POST', '/users/[i:id]/[delete|update:action]', 'usersController#doAction', 'users_do')
);
return $x;