<?php

namespace app;

use liansu\core_plus\Controller;

class timestamp extends Controller
{
    public function index()
    {
        $this->assign('timestamp', time());

        $times         = [];
        $zeroTimestamp = strtotime(date('Y-m-d'));
        for ($timestamp = $zeroTimestamp; $timestamp >= $zeroTimestamp - 60 * 60 * 24 * 30; $timestamp -= 60 * 60 * 24) {
            $times[] = [
                'date'      => date('Y-m-d', $timestamp),
                'timestamp' => $timestamp
            ];
        }
        $this->assign('times', $times);
        $this->display();
    }
}
