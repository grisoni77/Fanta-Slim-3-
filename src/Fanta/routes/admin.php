<?php

$app->group('/admin', function() {
    $this->get('/', 'Fanta\\Controller\\Admin:index');
    $this->get('/users', 'Fanta\\Controller\\Admin:userList')->setName('user-list');
    $this->post('/users/add', 'Fanta\\Controller\\Admin:userAdd')->setName('user-add');
    $this->get('/leagues', 'Fanta\\Controller\\Admin:leagueList')->setName('league-list');
    $this->post('/leagues/add', 'Fanta\\Controller\\Admin:leagueAdd')->setName('league-add');
    $this->get('/leagues/{league_id}', 'Fanta\\Controller\\Admin:leagueDetail')->setName('league-detail');
    $this->post('/leagues/{league_id}/teams/add', 'Fanta\\Controller\\Admin:teamAdd')->setName('team-add');
    $this->get('/leagues/{league_id}/teams/{team_id}', 'Fanta\\Controller\\Admin:teamDetail')->setName('team-detail');
});