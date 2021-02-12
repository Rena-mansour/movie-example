<?php

namespace App\Controllers;

use \Core\View as View;
use \Core\Controller as Controller;

/**
 * Class Home
 * @package App\Controllers
 */
class Home extends Controller
{
    /**
     * @throws \Exception
     */
    public function indexAction()
    {
        // get page number parameter from url
        $page = (int)$this->getParameter();
        $page = $page >= 1 ? $page : 1;
        //elements per page
        $perPage = 100;
        //limit start
        $limitStart = ($page - 1) * $perPage;
        //limit end
        $limitEnd = $perPage;
        //get file content
        $content = $this->getFileContent();
        //get number of elements in all pages
        $total = $content['count'];
        //get number of pages
        $pagesNumber = ceil($total / $limitEnd);
        //get elements in current page
        $data = $this->getPage($content['data'], $limitStart, $limitEnd);
        //render elements and pager data in view
        View::renderTemplate('Home/index.php',
            ['data' => $data, 'page' => $page, 'pagesNumber' => $pagesNumber, 'baseUrl' => $this->getBaseUrl()]);
    }

    /**
     * get directory
     * @param $level
     * @return string
     */
    protected function getDir($level)
    {
        $dir = dirname(__FILE__, $level);

        return $dir;
    }

    /**
     * get page number parameter from url
     * @return mixed
     */
    protected function getParameter()
    {
        if (isset($_GET['p'])) {
            $page = $_GET['p'];

            return $page;
        }
    }

    /**
     * get file content
     * @return array
     */
    protected function getFileContent()
    {
        $data = array();
        $isGerman = false;
        $count = 0;
        $content = file($this->getDir(2) . '/Resources/movie.jsonlines');
        foreach ($content as $line) {
            $jsonData = json_decode($line, true);

            if (isset($jsonData['Languages'])) {
                foreach ($jsonData['Languages'] as $language) {
                    if (strpos($language, 'Deutsch') !== false) {
                        $isGerman = true;
                    }
                }
            }

            if ($isGerman) {
                $count++;
                $data[] = $jsonData;
            }
        }

        return ['data' => $data, 'count' => $count];
    }

    /**
     * get elements per page
     * @param $data
     * @param $limitStart
     * @param $limitEnd
     * @return array
     */
    protected function getPage($data, $limitStart, $limitEnd)
    {
        return array_slice($data, $limitStart, $limitEnd);
    }

    /**
     * get Base Url
     * @return string
     */
    protected function getBaseUrl()
    {
        $path = $this->getDir(3);
        $directory = explode('/', $path);
        $url = $_SERVER['SERVER_NAME'] . '/' . $directory[count($directory) - 1];

        return $url;
    }
}

