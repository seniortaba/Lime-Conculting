<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    private $base;
    private $instances;

    public function __construct()
    {
        $this->base = new BaseController();
        $this->instances = $this->base->baseInstances();
    }

//  Database list for index page
    public function getBases()
    {
        $bases = DB::table('bases')->get();
        return view("index")->with('bases', $bases);
    }

//  Get posts form selected databases
    public function getPosts()
    {
        $response = [];
        foreach ($this->instances as $baseId => $baseConnect)
            $response[$baseId] = $this->base->query("SELECT id, post_title, post_content FROM wp_posts", $baseConnect);

        return view('getData')->with('results', $response);
    }

    // Download csv and txt file
    public function Download()
    {
        $command = request()->get('base');
        $mode = request()->get('mode');
        if (!isset($command))
            return false;

        $file = $mode === 'csv' ? 'test.csv':"test.txt";
        $txt = fopen($file, "w") or die("Unable to open file!");
        if ( $mode === 'csv')
        fputcsv($txt, ['id', 'post_title', 'post_content']);

        $response = [];
        foreach ($this->instances as $baseId => $baseConnect)
        {
            $response[$baseId] = $this->base->query("SELECT id, post_title, post_content FROM wp_posts", $baseConnect);
            foreach ($response as $records) {

                foreach ($records as $record) {
                    $record['post_content'] = strip_tags($record['post_content'], '<p><br><h1><h2>');
                    if ( $mode === 'csv')
                        fputcsv($txt, $record);
                    else
                        fwrite($txt, $record['post_title'] .'/'. $record['post_content']);
                }

            }
        }

        fclose($txt);

        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        header("Content-Type: text/plain");
        readfile($file);

    }
}
