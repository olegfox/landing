<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Site\MainBundle\Service\Export;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class ProjectController extends Controller
{
    /**
     * Ссылка на лендинг для предварительного просмотра
     *
     * @param $slug
     * @return Response
     */
    public function indexAction($slug)
    {
        $repository_project = $this->getDoctrine()->getRepository('SiteMainBundle:Project');

        $project = $repository_project->findOneBySlug($slug);

        return $this->render('SiteMainBundle:Frontend/Project:index.html.twig', array(
            'project' => $project
        ));
    }

    /**
     * Ссылка на лендинг для локальной копии
     *
     * @param $slug
     * @return Response
     */
    public function indexLocalAction($slug)
    {
        $repository_project = $this->getDoctrine()->getRepository('SiteMainBundle:Project');

        $project = $repository_project->findOneBySlug($slug);

        return $this->render('SiteMainBundle:Frontend/Project:index.local.html.twig', array(
            'project' => $project
        ));
    }

    /**
     * Генерация zip архива с лендингом
     *
     * @param $slug
     * @return Response
     */
    public function generateHtmlAction($slug)
    {
        $repository_project = $this->getDoctrine()->getRepository('SiteMainBundle:Project');

        $project = $repository_project->findOneBySlug($slug);

        $fs = new Filesystem();

        // Имя временного каталога
        $tmpName = mt_rand();
        $dir = 'export/src/' . $tmpName . '/';

        // Создание временного каталога для экспорта
        try {
            $fs->mkdir($dir);
        } catch (IOExceptionInterface $e) {
            echo "An error occurred while creating your directory at " . $e->getPath();
        }

        // Сохранение html файла во временный каталог
        $htmlContentFile = $this->renderView('SiteMainBundle:Frontend/Project:index.local.html.twig', array(
            'project' => $project
        ));
        file_put_contents($dir . 'index.html', $htmlContentFile);

        // Сохранение стилей, скриптов и картинок во временный каталог
        Export::rcopy('bundles/sitemain/frontend/', $dir);
        Export::rcopy('uploads/images/', $dir . 'uploads/images/');
        Export::rcopy('cache/', $dir . 'cache/');
        Export::rcopy('uploads/' . $project->getSlug() . '/', $dir . 'uploads/' . $project->getSlug() . '/');

        // Создание zip архива
        $dirZip = 'export/zip/';
        Export::zip($dir, $dirZip . $project->getSlug() . '.zip');

        // Удаление временного каталога
        Export::rrmdir($dir);

        $response = new Response(file_get_contents($dirZip . $project->getSlug() . '.zip'));

        $d = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $project->getSlug() . '.zip');
        $response->headers->set('Content-Disposition', $d);

        return $response;
    }
}
