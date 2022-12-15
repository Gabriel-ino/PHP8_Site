<?php

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::setDefaultNamespace('system\Controller');

SimpleRouter::get(BASE_URL, 'SiteController@index');
SimpleRouter::get(BASE_URL."about", "SiteController@about");

SimpleRouter::start();

