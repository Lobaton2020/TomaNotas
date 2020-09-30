
<?php
/*----------------------------------------------------------------------------------------------------------------------*/
//                                                                                                                      |   
//               IF RECEIBE PARAMETERS MUST USE CONTROLLER AND METHOD EXPLICIT IN THE ROUTE                             |
//                                                                                                                      | 
/*----------------------------------------------------------------------------------------------------------------------*/


Router::get('/', function (Service $session) {
    $session->authentication();
    return httpResponse(200, "route", "Route without use")->json();
});
Router::get('/auth', 'AuthService@index');
Router::post('/auth/login', 'AuthService@login');
Router::post('/auth/logout', 'AuthService@destroy');

Router::get('/users', 'UserService@index');
Router::get('/users/edit', 'UserService@edit');
Router::post('/users/store', 'UserService@store');
Router::post('/users/disable', 'UserService@disable');
Router::post('/users/enable', 'UserService@enable');

Router::get('/rols', 'RolService@index');

Router::get('/links', 'LinkService@index');
Router::get('/links/edit', 'LinkService@edit');
Router::post('/links/store', 'LinkService@store');
Router::post('/links/disable', 'LinkService@disable');
Router::post('/links/share', 'LinkService@share');
