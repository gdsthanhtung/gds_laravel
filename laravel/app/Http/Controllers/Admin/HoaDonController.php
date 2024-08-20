<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\HoaDonModel as MainModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Requests\HoaDonRequest  as MainRequest;
use App\Helpers\Notify;
use Config;

use App\Models\HopDongModel;
use App\Helpers\Template;

class HoaDonController extends Controller
{
    private $mainModel;
    private $pathView;
    private $pathViewTemplate;
    private $moduleName = "hoadon";
    private $pageTitle = "Hóa Đơn";
    private $params = [];

    public function __construct(){
        $this->mainModel = new MainModel();
        $this->pathView = "admin.pages.$this->moduleName.";
        $this->pathViewTemplate = "admin.templates.";

        $this->params["pagination"]['perPage'] = 10;

        $ctrl = Config::get("custom.route.$this->moduleName.ctrl");
        View::share([
            'ctrl' => $ctrl,
            'pathView' => $this->pathView,
            'pathViewTemplate' => $this->pathViewTemplate,
            'pageTitle' => $this->pageTitle
        ]);
    }

    private function getPathView(string $file = 'index'){
        return $this->pathView.$file;
    }

    //=====================================================

    public function show(Request $rq)
    {
        $searchField = $rq->input('searchField', 'all');
        $fieldAccepted = Config::get("custom.enum.selectionInModule.".$this->moduleName);

        $this->params['filter']['fieldAccepted'] = $fieldAccepted;
        $this->params['filter']['searchField'] = (in_array($searchField, $fieldAccepted)) ? $searchField : 'all';
        $this->params['filter']['searchValue'] = $rq->input('searchValue', '');

        $this->params['filter']['status'] = $rq->input('status', 'all');

        $data = $this->mainModel->listItems($this->params, ['task' => 'admin-list-items']);
        $countByStatus = $this->mainModel->countItems($this->params, ['task' => 'admin-count-items']);

        $shareData = [
            'data' => $data,
            'countByStatus' => $countByStatus,
            'params' => $this->params
        ];
        return view($this->getPathView('index'), $shareData);
    }

    public function form(Request $rq)
    {
        $data = [];
        $id = $rq->id;

        if($id){
             $params = [
                'id'    => $id
            ];
            $data = $this->mainModel->getItem($params, ['task' => 'get-item']);
        }

        if(!$data && $id)
            return redirect()->route($this->moduleName)->with('notify', ['type' => 'danger', 'message' => $this->pageTitle.' id is invalid!']);

        $hopDongModel = new HopDongModel();
        $dataHopDongTmp = $hopDongModel->listItems([], ['task' => 'admin-list-items-for-select']);

        $selectHopDong = $dataHopDong = [];
        if($dataHopDongTmp) foreach($dataHopDongTmp as $hd){
            $selectHopDong[$hd['id']] = $hd['ma_hop_dong'].' - '.$hd['pt_name'].' - '.$hd['cd_fullname'];
            $dataHopDong[$hd['id']] = $hd;
        }
        dump($selectHopDong);

        $shareData = [
            'data' => $data,
            'id' => $id,
            'dataHopDong' => $dataHopDong,
            'selectHopDong' => $selectHopDong
        ];
        return view($this->getPathView('form'), $shareData);

    }

    public function delete(Request $rq)
    {
        $params = [
            'id'    => $rq->id
        ];
        $rs = $this->mainModel->delete($params);
        return redirect()->route($this->moduleName)->with('notify', Notify::export($rs));
    }

    public function change_status(Request $rq)
    {
        $params = [
            'id'    => $rq->id,
            'status'  => $rq->status
        ];

        $rs = $this->mainModel->saveItem($params, ['task' => 'change-status']);
        return redirect()->route($this->moduleName)->with('notify', Notify::export($rs));

    }

    public function save(MainRequest $rq)
    {
        if($rq->method() == 'POST'){
            $params = $rq->all();

            $task = ($params['id'] == null) ? 'add' : 'edit';

            $rs = $this->mainModel->saveItem($params, ['task' => $task]);
        }
        return redirect()->route($this->moduleName)->with('notify', Notify::export($rs));
    }
}
