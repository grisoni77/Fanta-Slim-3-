<?php

$app->get('/', function($request, $response, $args) {
    $this->twig->render($response, 'fanta/front/index.twig', $args);
})->setName('front-index');

$c = $app->getContainer();
$app->group('/front', function() {
    $this->post('/login', 'Fanta\\Controller\\Front:login')->setName('front-login');
    $this->get('/logout', 'Fanta\\Controller\\Front:logout')->setName('front-logout');
    $this->group('/teams', function(){
        $this->get('', 'Fanta\\Controller\\Front:teamList')->setName('front-teams');
        $this->get('/{team_id}', 'Fanta\\Controller\\Front:teamDetail')->setName('front-team-detail');
    });
})
    ->add(new \Fanta\Middleware\Auth($c))
;