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
    public function index()
    {
        $sectionPosition = SectionPosition::where('position_name', '首页')->first();
        $this->requestInfo();
        if (!$sectionPosition) {

        }
        $sections = Section::where('position_id', $sectionPosition->id)->get();

        // 获取联系方式
        $contacts=Contact::all();
        return $this->customView(['sections' => $sections, 'contacts'=>$contacts]);
    }
}