<?php

namespace app;

use liansu\core\Request;
use liansu\core\Response;
use liansu\core_plus\Controller;

class encrypt extends Controller
{
    public function index()
    {
        $this->display();
    }

    public function encrypt()
    {
        try {
            $str = Request::all('string');
            $type = Request::all('type');

            if (!$type) {
                throw new \Exception('请传入加密方式');
            }

            $result = $type($str);

            Response::json(Response::SUCCESS, '', ['result' => $result]);
        } catch (\Exception $e) {
            Response::json(1, $e->getMessage());
        }
    }
}
