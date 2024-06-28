@extends('admin.main')

@php
    use App\Helpers\Template;
    $statusFilter = Template::showButtonFilter($ctrl, $countByStatus, $params);
    $searchArea = Template::showsearchArea($ctrl, $params);
@endphp
@section('content')
    <div class="right_col" role="main">
        <div class="page-header zvn-page-header clearfix">
            <div class="zvn-page-header-title">
                <h3>Danh sách User</h3>
            </div>
            <div class="zvn-add-new pull-right">
                <a href="/form" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</a>
            </div>
        </div>
        @if(session('notify'))
            @include($pathViewTemplate.'notify')
        @endif
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    @include($pathViewTemplate.'x_title', ['title' => 'Bộ lọc'])
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-6">{!! $statusFilter !!}</div>
                            <div class="col-md-6">{!! $searchArea !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--box-lists-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    @include($pathViewTemplate.'x_title', ['title' => 'Danh sách'])
                    @include($pathView.'list')
                </div>
            </div>
        </div>
        <!--end-box-lists-->
        <!--box-pagination-->
        @if (count($data) > 0)
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    @include($pathViewTemplate.'x_title', ['title' => 'Phân trang'])

                    @include($pathViewTemplate.'pagination', ['title' => 'Phân trang'])
                </div>
            </div>
        </div>
        @endif
        <!--end-box-pagination-->
    </div>
@endsection
