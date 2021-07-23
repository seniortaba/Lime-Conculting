<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use PDOStatement;
use PDOException;

class BaseController extends Controller
{
//  Base instances
    public function baseInstances()
    {
        $instances = [];
        //get databases ids which where selected
        $command = request()->get('base');
        if ( !isset($command) )
            return false;
        foreach ($command as $baseId) {

            $bases = DB::table('bases')->where('id', $baseId)->get();
            foreach ($bases as $base) {

                //Set DSN
                $dsn = 'mysql:host=' . $base->host . ';dbname=' . $base->dbname;

                //Set Options
                $options = array(
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                );

                // PDO instance
                try {
                    $instances[$baseId] = new PDO($dsn, $base->user, $base->password, $options);
                } catch (PDOException $e) {
                    die($e->getMessage());
                }
            }
        }

        return $instances;
    }

//  query function
    public function query($query, $instance)
    {
        $prepare = $instance->prepare($query);
        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_ASSOC);
    }
}
