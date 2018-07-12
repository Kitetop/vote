<?php
namespace App\Action;

use Mx\Http\HttpFaultExc;
use Mx\Http\ActionAbstract;
use App\Service\Exc;

/**
 * Class: Main
 *
 * @see ActionAbstract
 * @author huangjide <hjd@duxze.com>
 * @license proprietary
 * @copyright Copyright (c) duxze.com
 */
class Main extends ActionAbstract
{
    protected function handleGet()
    {
        $this->response("hello","lalalla");
    }

    protected function handlePost()
    {
        $this->response("test post");
    }
}
