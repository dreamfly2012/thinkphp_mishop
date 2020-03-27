<?php
namespace app\admin\controller;

use think\Cache;
use think\Db;

class Index extends Common
{
    /**
     * Title: 后台首页
     * Notes:index
     * @return view()
     */
    public function index()
    {
        $os = Cache::remember('os', function () {
            return [
                ['name' => '操作系统', 'value' => PHP_OS],
                ['name' => 'PHP版本', 'value' => phpversion()],
                ['name' => 'Mysql版本', 'value' => Db::query('SELECT VERSION() as version')[0]['version']],
                ['name' => '运行环境', 'value' => substr($_SERVER['SERVER_SOFTWARE'], 0, 13)],
                ['name' => '框架版本', 'value' => 'ThinkPHP v' . THINK_VERSION],
                ['name' => 'gzip支持', 'value' => Extension_Loaded('zlib') ? 'YES' : 'NO'],
                ['name' => '最大上传限制', 'value' => @ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'unknown'],
            ];
        }, 3600 * 24 * 30);
        $copy = Config('copy');

        $this->assign('affiche', db::name('config')->where('keyname', 'Affiche')->order('id')->value('v'));
        $this->assign('goods', Db::name('goods')->count()); //商品数量
        $this->assign('log', Db::name('user_log')->count()); //访问量
        $this->assign('users', Db::name('users')->count()); //会员数
        $this->assign('comment', Db::name('goods_comment')->count()); //商品评论量
        $this->assign('orders', Db::name('orders')->count()); //总订单数
        $this->assign('d_orders', Db::name('orders')->whereTime('order_time', 'd')->count()); //今日订单
        $this->assign('orders_t', Db::name('orders')->where('order_status', 2)->count()); //待发货
        $this->assign('orders_shipping', Db::name('orders')->where('order_status', 3)->count()); //订单运输中
        $this->assign('orders_o', Db::name('orders')->where('order_status', 5)->count()); //待发货
        $this->assign('login_d', Db::name('user_log')->whereTime('time', 'd')->count()); //今日访问
        $this->assign('os', $os); //系统配置
        $this->assign('copy', $copy);
        $highcharts = json_encode($this->OrderJson());
        $this->assign('highcharts', $highcharts);
        return view();
    }

    /**
     * Title: 月销售统计
     * Notes:OrderJson
     */
    public function OrderJson()
    {
        $order = Db('orders')->whereTime('order_time', 'm')->where('order_status', 'in', [0, 1, 2])->field('FROM_UNIXTIME(order_time,"%e") as time, sum(order_price) as price')->group('time')->select();
        $order_m = Db('orders')->whereTime('order_time', 'last month')->where('order_status', 'in', [0, 1, 2])->field('FROM_UNIXTIME(order_time,"%e") as time, sum(order_price) as price')->group('time')->select(); //上个月

        $days = date('t'); //当前月天数
        $t_1 = date('t', strtotime('-1 month')); //上个月天数

        $m = high($days, $order);
        $m_1 = high($t_1, $order_m);
        $highcharts = ['chart' => ['style' => ['margin' => '3px auto 0']], 'yAxis' => ['title' => ['text' => null]], 'xAxis' => ['categories' => []], 'title' => ['text' => null], 'credits' => ['enabled' => false], 'plotOptions' => ['series' => ['connectNulls' => 'true']]];
        $highcharts['series'][] = array('name' => date('n', strtotime('-1 month')) . ' 月', 'data' => $m_1, 'color' => '#b9dcfd');
        $highcharts['series'][] = array('name' => date('n') . '月', 'data' => $m, 'color' => '#1b91d9');
        return $highcharts;
    }
    /**
     * Title:清除缓存
     * Notes:cache_clear
     * @return array
     */
    public function cache_clear()
    {
        Cache::clear();
        return jsdata(200, '缓存文件已清除……', '', 2);
    }
}
