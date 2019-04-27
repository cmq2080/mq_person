<?php
/**
 * 描述：
 * Created at 2019/4/27 10:22 by mq
 */

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as Controller;


class BaseController extends Controller
{
    /**
     * 功能：获取请求的URL基本信息
     * Created at 2019/4/27 13:56 by mq
     * @param string $mode
     * @param string $glue
     * @return 0|bool|string
     */
    public function requestInfo($mode = 'all', $glue = '_')
    {
        $actionArray = request()->route()->getAction(); // 获取路由详细信息
        $controller  = str_replace($actionArray['namespace'], '', $actionArray['controller']);

        // 分别获取模块、控制器和动作的名称
        $actionName = substr($controller, strpos($controller, '@') + 1);
        $controller = substr($controller, 0, strpos($controller, '@'));

        $controllers = array_values(array_filter(explode('\\', $controller)));
        if (count($controllers) > 1) { // 有model
            $modelName      = $controllers[0];
            $controllerName = trim($controllers[1], 'Controller');
        } else { // 无model
            $modelName      = '';
            $controllerName = trim($controllers[0], 'Controller');
        }

        switch ($mode) {
            case 'm':
                return $modelName;
                break;
            case 'c':
                return $controllerName;
                break;
            case 'a':
                return $actionName;
                break;
            case 'all':
                return $modelName . $glue . $controllerName . $glue . $actionName;
                break;
            default:
        }
    }

    /**
     * 功能：自定义返回视图
     * Created at 2019/4/27 13:55 by mq
     * @param array $extData
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customView($extData = [])
    {
        $data = [
            'm' => $this->requestInfo('m'),
            'c' => $this->requestInfo('c'),
            'a' => $this->requestInfo('a'),
        ];
        if ($extData) {
            $data = array_merge($data, $extData);
        }
        return view(strtolower($this->requestInfo('all', '/')), $data);
    }
}