<?php
// Routes

$app->get('/hello/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    //return $this->renderer->render($response, 'index.phtml', $args);
    // usa twig
    return $this->twig->render($response, 'index.twig', $args);
})
// middleware example
//    ->add(
//        function ($request, $response, $next) {
//            $response->getBody()->write('BEFORE');
//            $response = $next($request, $response);
//            $response->getBody()->write('AFTER');
//
//            return $response;
//        }
//    )
;

