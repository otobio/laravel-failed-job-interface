<?php namespace MoldersMedia\FailedJobInterface\Http\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Routing\Controller;

class AssetController extends Controller
{
    /**
     * @var Filesystem
     */
    private $fs;

    /**
     * AssetController constructor.
     * @param Filesystem $fs
     */
    public function __construct(Filesystem $fs)
    {
        $this->fs = $fs;
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function js()
    {
        $file = $this->fs->get(__DIR__ . '/../../../public/js/app.js');

        return response($file, 200, [
            'Content-Type' => 'text/js'
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function css()
    {
        $file = $this->fs->get(__DIR__ . '/../../../public/css/app.css');

        return response($file, 200, [
            'Content-Type' => 'text/css'
        ]);
    }
}