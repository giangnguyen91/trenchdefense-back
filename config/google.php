<?php

return [
    'scope' => array(
        'https://www.googleapis.com/auth/userinfo.profile'
    ),
    'client_secret'=>env('GOOGLE_CLIENT_SECRET_PATH', null)
];