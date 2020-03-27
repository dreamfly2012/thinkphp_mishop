<?php
//返回
function jsdata($status, $msg, $url = '', $wait = 3)
{
    $return_arr = array(
        'status' => $status,
        'msg' => $msg,
        'wait' => $wait,
        'url' => $url,
    );
    return $return_arr;
}

//获取规格名称
function getSpecNameById($spec_id)
{
    $spec_name = db('goods_spec')->where(['spec_id' => $spec_id])->value('spec_name');
    return $spec_name;
}

//获取分类名称
function getCategoryNameBySpecId($spec_id)
{
    $cid = db('goods_spec')->where(['spec_id' => $spec_id])->value('cid');

    $category_name = db('category')->where(['id' => $cid])->value('name');
    return $category_name;
}

//无限分类
function unlinlist($data, $pid = 0)
{
    $arr = array();
    foreach ($data as $v) {
        if ($v['pid'] == $pid) {
            $v['level'] = unlinlist($data, $v['id']);
            $arr[] = $v;
        }
    }
    ;
    return $arr;
}

function le($data, $pid = 0, $level = 0, $html = "")
{
    $arr = array();
    foreach ($data as $v) {
        if ($v['pid'] == $pid) {
            $v['level'] = $level;
            $v['html'] = str_repeat($html, $level);
            $arr[] = $v;
            $arr = array_merge($arr, le($data, $v['id'], $level + 1, $html = '|—　'));
        }
    }
    return $arr;
};

function format_bytes($size, $delimiter = '')
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) {
        $size /= 1024;
    }

    return round($size, 2) . $delimiter . $units[$i];
}

/**
 * Title: 商品所属类
 * Notes:category
 * @param $uid
 * @return mixed
 */
function category($uid)
{
    $pid = db('category')->where('id', $uid)->value('pid');

    $name = db('category')->where('id', $pid)->value('name');

    return $name;

}

function adp($pid)
{
    $adposts = Config('adposts');

    foreach ($adposts as $v) {
        if ($pid == $v['id']) {
            return $v['name'];
        }

    }
}

/**
 * Title: highcharts折线图
 * Notes:high
 * @param $days
 * @param $order
 * @return array
 */
function high($days, $order)
{
    $price = [];
    foreach ($order as $k => $v) {
        $price[$v['time']][] = $v['price'];
    }
    $data = [];
    for ($i = 0; $i <= $days; $i++) {
        $data[] = empty($price[$i]) ? 0 . ',' : $price[$i]['0'] * 1;
    }
    return $data;
}
