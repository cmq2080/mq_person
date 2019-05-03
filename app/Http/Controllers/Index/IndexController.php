<?php
/**
 * 描述：
 * Created at 2019/4/27 10:22 by mq
 */

namespace App\Http\Controllers\Index;


use App\Http\Controllers\BaseController;
use App\Models\Contact;
use App\Models\Section;
use App\Models\SectionPosition;

class IndexController extends BaseController
{
    /**
     * 功能：首页列表
     * Created at 2019/5/3 15:06 by mq
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $sectionPosition = SectionPosition::where('position_name', '首页')->first();
//        $this->requestInfo();
        if (!$sectionPosition) {

        }
        $sections = Section::where('position_id', $sectionPosition->id)->get();

        // 获取联系方式
        $contacts=Contact::all();
        return $this->customView(['sections' => $sections, 'contacts'=>$contacts]);
    }
}