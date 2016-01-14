<?php

$app->group('/admin', function() {
    $this->get('', 'Fanta\\Controller\\Admin:index')->setName('admin-index');
    $this->get('/logout', 'Fanta\\Controller\\Admin:logout')->setName('admin-logout');
    $this->get('/users', 'Fanta\\Controller\\Admin:userList')->setName('user-list');
    $this->post('/users/add', 'Fanta\\Controller\\Admin:userAdd')->setName('user-add');
    $this->group('/leagues', function() {
        $this->get('', 'Fanta\\Controller\\Admin:leagueList')->setName('league-list');
        $this->post('/add', 'Fanta\\Controller\\Admin:leagueAdd')->setName('league-add');
        $this->group('/{league_id}', function() {
            $this->get('', 'Fanta\\Controller\\Admin:leagueDetail')->setName('league-detail');
            $this->post('/teams/add', 'Fanta\\Controller\\Admin:teamAdd')->setName('team-add');
            $this->group('/teams/{team_id}', function() {
                $this->get('', 'Fanta\\Controller\\Admin:teamDetail')->setName('team-detail');
                $this->post('/contract/add', 'Fanta\\Controller\\Admin:contractAdd')->setName('contract-add');
            });
        });
    });

})
    ->add(new \Slim\Middleware\HttpBasicAuthentication([
        "secure" => false,
        "users" => [
            "admin" => "password"
        ]
    ]))
;
