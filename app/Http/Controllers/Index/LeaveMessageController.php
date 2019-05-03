<?php
/**
 * 描述：
 * Created at 2019/5/3 15:31 by mq
 */

namespace App\Http\Controllers\Index;


use App\Http\Controllers\BaseController;
use App\Models\LeaveMessage;

class LeaveMessageController extends BaseController
{
    private $interval = 300;

    public function index()
    {
        return view('index.leave-message.index');
    }

    public function add()
    {
        if (request()->isMethod('post')) {
            tc_session_start(); // 开启SESSION
            // 查验是否可以留言
            if ($this->canLeaveMessage() === false) {
                ajax_return(1, '操作过于频繁，请稍等片刻');
            }

            // 构建插入数据
            $input      = tc_array_trim(request()->all());
            $insertData = tc_array_select($input, ['content', 'from']);

            // 添加数据
            $leaveMessage = new LeaveMessage($insertData);
            if (!$leaveMessage->save()) {
                ajax_return(2, '留言失败');
            }

            $_SESSION[request()->getHost() . '_last_leave_message'] = time(); // 刷新最后留言时间，防止频繁留言
            ajax_return(0, '您已成功留言');
        }
    }

    /**
     * 功能：查验是否可以留言
     * Created at 2019/5/3 15:57 by mq
     * @return bool
     */
    private function canLeaveMessage()
    {
        if (isset($_SESSION[request()->getHost() . '_last_leave_message']) && $_SESSION[request()->getHost() . '_last_leave_message'] + $this->interval > time()) {
            return false;
        }
        return true;
    }
}