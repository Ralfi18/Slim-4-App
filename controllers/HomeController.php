<?php
namespace Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
// use Entity\Users;
use Doctrine\ORM\EntityManager;


class HomeController {
	private $entityManager = null;
	public function __construct($container)
	{
		$this->entityManager = $container->get(EntityManager::class);
	}

	public function index(Request $request, Response $response, $args): Response {		
		$userRepository = $this->entityManager->getRepository('Entity\Users');
		$users = $userRepository->findAll();
		$view = Twig::fromRequest($request);
		return $view->render($response, 'home.html.twig', [
			'heading' => "Home Page",
			'users' => $users
		]);
	}
}