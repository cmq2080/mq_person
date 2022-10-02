<?php

namespace app;

use liansu\core\Request;
use liansu\core\Response;
use liansu\core_plus\App;
use liansu\core_plus\Controller;

class qrcode extends Controller
{
    public function index()
    {
        $this->display();
    }

    public function mk_qrcode()
    {
        try {
            $url = Request::all('url');
            $tmpPath = App::instance()->runtimeDirectory . '/' . md5(microtime(true));
            \QRcode::png($url, $tmpPath);
            if (!is_file($tmpPath)) {
                throw new \Exception('生成二维码失败');
            }
            $base64 = base64_encode(file_get_contents($tmpPath));
            unlink($tmpPath);

            $img = '<img width="400" src="data:image/png;base64,' . $base64 . '">';

            Response::json(Response::SUCCESS, '', ['img' => $img]);
        } catch (\Exception $e) {
            Response::json(1, $e->getMessage());
        }
    }
}
