<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\RecordExport;
use App\CustomField;
use Excel;

class SubscribeController extends Controller
{
    public function getQnas()
    {
        return CustomField::where('type', 'subs')->paginate(12);
    }

    public function export()
    {
        $users = array();
        $data = CustomField::where('type', 'subs')->get();

        foreach ($data as $key => $value) {
            array_push($users, [
                '訂閱者' => $value->content,
                '電子郵件' => $value->customField1,
            ]);
        }

        foreach ($users as &$user) {
            $user = (array)$user;
        }

        $export = new RecordExport($users);
        return Excel::download($export, '訂閱列表_'.time().'.xlsx');
    }
}
