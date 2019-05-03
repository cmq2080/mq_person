<?php
/**
 * 描述：
 * Created at 2019/5/3 15:03 by mq
 */

namespace App\Http\Controllers\Index;


use App\Http\Controllers\BaseController;
use App\Models\Project;

class ProjectController extends BaseController
{
    /**
     * 功能：项目列表
     * Created at 2019/5/3 15:06 by mq
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $projects = Project::all();
//        var_dump($this->requestInfo());
        return $this->customView(['projects' => $projects]);
    }
}