<?php

$router->get(       '/'						    , 'index.php'               );
$router->get(       '/vegan'                    , 'vegan.php'               );
$router->get(       '/about'                    , 'about.php'               );
$router->get(       '/activism'				    , 'activism.php'            );
$router->get(       '/guidelines'				, 'guidelines.php'          );
$router->get(       '/training'				    , 'training.php'            );
$router->get(       '/videos'				    , 'videos.php'              );
$router->get(       '/handouts'				    , 'handouts.php'            );
$router->get(       '/privacy'				    , 'privacy.php'             );
$router->get(       '/organizer'                , 'organizer.php'           );
$router->get(       '/donate'                   , 'donate.php'              );
$router->get(       '/captcha'                  , 'captcha.php'             );

$router->get(       '/unsubscribe'              , 'unsubscribe.php'         );
$router->post(      '/unsubscribe'              , 'unsubscribe.php'         );

$router->get(       '/contact'				    , 'contact.php'             );
$router->post(      '/contact'				    , 'contact.php'             );

$router->get(       '/login'                    , 'sessions/create.php'     )->only('guest');
$router->post(      '/sessions'                 , 'sessions/store.php'      )->only('guest');
$router->delete(    '/sessions'                 , 'sessions/destroy.php'    )->only('auth');
$router->get(       '/admin'                    , 'admin.php'               )->only('auth');

$router->get(       '/admin/groups'			    , 'groups/index.php'        )->only('auth');
$router->get(       '/admin/groups/create'	    , 'groups/create.php'       )->only('auth');
$router->post(      '/admin/groups'			    , 'groups/store.php'        )->only('auth');
$router->get(       '/admin/groups/{id}'        , 'groups/show.php'         )->only('auth');
$router->get(       '/admin/groups/{id}/edit'   , 'groups/edit.php'         )->only('auth');
$router->patch(     '/admin/groups/{id}'        , 'groups/update.php'       )->only('auth');
$router->get(       '/admin/groups/{id}/delete' , 'groups/delete.php'       )->only('auth');
$router->delete(    '/admin/groups/{id}'        , 'groups/destroy.php'      )->only('auth');

$router->get(       '/admin/users'			    , 'users/index.php'         )->only('admin');
$router->get(       '/admin/users/create'	    , 'users/create.php'        )->only('admin');
$router->post(      '/admin/users'			    , 'users/store.php'         )->only('admin');
$router->get(       '/admin/users/{id}'         , 'users/show.php'          )->only('admin');
$router->get(       '/admin/users/{id}/edit'    , 'users/edit.php'          )->only('admin');
$router->patch(     '/admin/users/{id}'         , 'users/update.php'        )->only('auth');
$router->get(       '/admin/users/{id}/delete'  , 'users/delete.php'        )->only('admin');
$router->delete(    '/admin/users/{id}'         , 'users/destroy.php'       )->only('admin');

$router->get(       '/admin/applications'                   , 'applications/index.php'          )->only('auth');
$router->post(      '/admin/applications'                   , 'applications/store.php'          );
$router->get(       '/admin/applications/{id}'              , 'applications/show.php'           )->only('auth');
$router->delete(    '/admin/applications/{id}'              , 'applications/destroy.php'        )->only('auth');
$router->post(      '/admin/applications/{id}/prefill-group', 'applications/prefill-group.php'  )->only('auth');

$router->get(       '/admin/posts'			    , 'posts/index.php'         )->only('auth');
$router->get(       '/admin/posts/create'	    , 'posts/create.php'        )->only('auth');
$router->post(      '/admin/posts'			    , 'posts/store.php'         )->only('auth');
$router->get(       '/admin/posts/{id}'         , 'posts/show.php'          )->only('auth');
$router->get(       '/admin/posts/{id}/edit'    , 'posts/edit.php'          )->only('auth');
$router->patch(     '/admin/posts/{id}'         , 'posts/update.php'        )->only('auth');
$router->get(       '/admin/posts/{id}/delete'  , 'posts/delete.php'        )->only('auth');
$router->delete(    '/admin/posts/{id}'         , 'posts/destroy.php'       )->only('auth');

$router->get(       '/admin/subscribers'        , 'subscribers/index.php'   )->only('auth');
$router->post(      '/admin/subscribers'        , 'subscribers/store.php'   );

$router->post(      '/admin/uploads'            , 'uploads/store.php'       )->only('auth');
$router->delete(    '/admin/uploads'            , 'uploads/destroy.php'     )->only('auth');

$router->get(       '/admin/emails'			    , 'emails/index.php'        )->only('auth');
$router->get(       '/admin/emails/create'	    , 'emails/create.php'       )->only('auth');
$router->post(      '/admin/emails'			    , 'emails/store.php'        )->only('auth');
$router->get(       '/admin/emails/{id}'        , 'emails/show.php'         )->only('auth');
$router->post(      '/admin/emails/{id}'        , 'emails/show.php'         )->only('auth');
$router->get(       '/admin/emails/{id}/edit'   , 'emails/edit.php'         )->only('auth');
$router->patch(     '/admin/emails/{id}'        , 'emails/update.php'       )->only('auth');
$router->get(       '/admin/emails/{id}/delete' , 'emails/delete.php'       )->only('auth');
$router->delete(    '/admin/emails/{id}'        , 'emails/destroy.php'      )->only('auth');
$router->get(       '/admin/emails/{id}/preview', 'emails/preview.php'      )->only('auth');
$router->post(      '/admin/emails/{id}/send'   , 'emails/send.php'         )->only('auth'); // send email

$router->get(       '/admin/settings'           , 'settings.php'            )->only('auth');
$router->post(      '/admin/settings'           , 'settings.php'            )->only('auth');

$router->get(       '/admin/account'            , 'account.php'             )->only('auth');

$router->get(       '/admin/recover'            , 'recover.php'             )->only('guest');
$router->post(      '/admin/recover'            , 'recover.php'             )->only('guest');

$router->prefix('{locale}');