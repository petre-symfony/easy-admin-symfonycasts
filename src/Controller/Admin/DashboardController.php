<?php

namespace App\Controller\Admin;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\Topic;
use App\Entity\User;
use App\Repository\QuestionRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController {
	private QuestionRepository $questionRepository;

	public function __construct(QuestionRepository $questionRepository) {
		$this->questionRepository = $questionRepository;
	}

	#[IsGranted('ROLE_ADMIN')]
	#[Route('/admin', name: 'admin')]
	public function index(): Response {
		$latestQuestions = $this->questionRepository->findLatest();
		$topVoted = $this->questionRepository->findTopVoted();

		return $this->render('admin/index.html.twig', [
			'latestQuestions' => $latestQuestions,
			'topVoted' => $topVoted
		]);
	}

	/**
	 * @param User $user
	 */
	public function configureUserMenu(UserInterface $user): UserMenu {
		if (!$user instanceof User) {
			throw new \Exception('Wrong user');
		}

		return parent::configureUserMenu($user)
			->setAvatarUrl($user->getAvatarUrl())
			->setMenuItems([
				MenuItem::linkToUrl('My Profile', 'fas fa-user', $this->generateUrl('app_profile_show'))
			]);
	}


	public function configureDashboard(): Dashboard {
		return Dashboard::new()
			->setTitle('Cauldron Overflow Admin');
	}

	public function configureMenuItems(): iterable {
		yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
		yield MenuItem::linkToCrud('Questions', 'fa fa-question-circle', Question::class);
		yield MenuItem::linkToCrud('Answers', 'fas fa-comment', Answer::class);
		yield MenuItem::linkToCrud('Topics', 'fas fa-folder', Topic::class);
		yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
		yield MenuItem::linkToUrl('Homepage', 'fas fa-home', $this->generateUrl('app_homepage'));
	}

	public function configureCrud(): Crud {
		return parent::configureCrud()
			->setDefaultSort([
				'id' => 'DESC'
			]);
	}


	public function configureActions(): Actions {
		return parent::configureActions()
			->add(Crud::PAGE_INDEX, Action::DETAIL);
	}

	public function configureAssets(): Assets {
		return parent::configureAssets()
			->addWebpackEncoreEntry('admin');
	}

}
