<?php
return [
    'table/([a-zA-Z]+)/([a-zA-Z]+)' => 'request/table/$1/$2',
    'request/([0-9]+)' => 'request/delete/$1',
    'request' => 'request/index',
];
