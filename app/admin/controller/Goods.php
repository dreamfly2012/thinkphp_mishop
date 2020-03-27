<?php
/**
 * ============================================================================
 * 版权所有 2015-2018
 *
 * ----------------------------------------------------------------------------
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 本程序采用thinkphp v5.0开发
 * ============================================================================
 *
 * Time: 2018/4/18 22:41
 */

namespace app\admin\controller;

use app\admin\model\Goods as Goodser;
use think\Db;
use think\Loader;
use think\Model;

class Goods extends Common
{
    /**
     * Title:商品列表
     * Notes:index
     * @return \
     */
    public function index()
    {
        $list = Goodser::where('gender', 1)->order('id desc')->field('content', true)->paginate(12);
        $this->assign('list', $list);
        return view();
    }

    /**
     * Title: 仓库商品列表
     * Notes:warehouse
     */
    public function warehouse()
    {
        $list = Goodser::warehouse();
        $this->assign('list', $list);
        return view();
    }
    /**
     * Title: 商品上/下架
     * Notes:gender
     */
    public function gender()
    {
        $id = input('id');
        $gender = Goodser::gender($id);
        return $gender;
    }
    /**
     * Title:选择要发布商品类别
     * Notes:cgtype
     * @return string
     */
    public function cgtype()
    {
        input('id') ? $data = input('id') : $data = 0;
        $cate = db('category')->where('pid', $data)->field('id,name')->order('id')->select();

        if (request()->isPost()) {
            if ($cate) {
                return json($cate);
            } else {
                return 'null';
            }
        } else {
            $this->assign('cate', $cate);
            return view();
        };
    }
    /**
     * Title:添加商品
     * Notes:add
     * @return \think\response\View
     */
    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $scene = empty($data['id']) ? 1 : 2; // 1 表示提交　2　表示更新
            $validate = Loader::validate('Goods');

            if (!$validate->check($data)) {
                return $validate->getError();
            }

            if ($data['gender'] == 1) {
                $data['starttime'] = time();
            } else {
                $data['starttime'] = strtotime($data['starttime']);
            }
            $data['prom'] = implode(',', $data['prom']); //转字符串
            $data['city'] = implode(',', $data['city']);
            $goods = new Goodser;

            if ($scene == 1) {
                $goods->data($data, true);
                $goods->allowField(true)->save();
            } else {
                $goods->allowField(true)->save($data, ['id' => $data['id']]);
            }
            $goods->afterSave($goods->id); //商品图片、商品规格
            Model('Goodsattr')->Goodsattrsave($goods->id, $scene); //商品属性参数
            return jsdata(200, '操作成功……', '/admin/goods');
        } else {
            $cmodel = model('category');
            $cid = input('cate');
            $this->assign('t_cate', $cmodel->get($cid)->name); //商品所属分类

            $brand = db('brand')->where('cid =' . $cid . ' or cid = 0')->where('isshow', 1)->select(); //品牌
            $ChinaCity = file_get_contents('./static/admin/ChinaCity/city_code.json'); //全国城区
            $specs = db('goods_spec')->where('cid', $cid)->order('sort, spec_id')->select(); //商品规格

            foreach ($specs as $k => $v) {
                $specs[$k]['attrs'] = db('goods_attr')->where('spec_id', $v['spec_id'])->order('sort, attr_id')->select(); //商品属性
            }

            $this->assign('specs', $specs);
            $this->assign('city', json_decode($ChinaCity, true));
            $this->assign('brand', $brand);
            $this->assign('cate', $cid);
            return view();
        }
    }
    /**
     * Title: 编辑商品
     * Notes:save
     * @return
     */
    public function save()
    {
        $id = input('id');
        $m = model('goods');
        $goods = $m::get($id);
        $brand = db('brand')->where('cid = ' . $goods->uid . ' or cid = 0')->where('isshow', 1)->select(); //品牌
        $attr = db('GoodsAttr')->where('cid', $goods->uid)->order('sort, id')->select(); //商品属性
        //        $attr = Db::query("select * from goodsattr as a,goods_attr as b where a.attr_id = b.id  and goods_id like ".$goods->id);    //属性
        $spec = db('spec')->where('cid', $goods->uid)->order('sort, id')->select(); //商品规格
        $ChinaCity = file_get_contents('./static/admin/ChinaCity/city_code.json'); //全国城区
        $goods_images = Db::name('goodsimages')->where('goodsid', $goods->id)->select(); //宝贝预览图片
        $goods_spec_key = Db::name('goodsseec')->where('goods_id', $goods->id)->column("group_concat(`key` order by store_count desc separator ',')");
        $goods_spec_key = explode(',', $goods_spec_key[0]);
        $attrs = $specs = [];

        foreach ($attr as $v) {
            $v['items'] = explode(',', $v['items']);
            $v['value'] = db('goodsattr')->where('attr_id', $v['id'])->value('attr_value');
            $attrs[] = $v;
        }

        foreach ($spec as $v) {
            $v['items'] = explode(',', $v['items']);
            $specs[] = $v;
        }

        $goods->prom = explode(',', $goods->prom);
        $this->assign('spec_keys', $goods_spec_key);
        $this->assign('goods_images', $goods_images);
        $this->assign('city', json_decode($ChinaCity, true));
        $this->assign('spec', $specs);
        $this->assign('attr', $attrs);
        $this->assign('brand', $brand);
        $this->assign('goods', $goods);
        return view();
    }
    /**
     * Title: 获取规格表
     * Notes:getspec
     */
    public function getspec()
    {
        $id = input('id');
        $spec = Db('goodsseec')->where('goods_id', $id)->select();
        $str = '<table class="table table-bordered table-hover" id="spec_input_tab"><thead><tr>';

        foreach ($spec as $v) {
            $key_name = explode(' ', $v['key_name']);
        }

        foreach ($key_name as $vo) {
            $key = explode(':', $vo);
            $str .= '<th>' . $key[0] . '</th>';
        }
        $str .= '<th>价格</th><th>库存</th><th>SKU</th></tr></thead>';

        foreach ($spec as $v) {
            $str .= '<tr>';
            $key_name = explode(' ', $v['key_name']);

            foreach ($key_name as $vo) {
                $vo = explode(':', $vo);
                $str .= '<td>' . $vo[1] . '</td>';
            }

            $str .= '<td><input type="text" class="form-control col-md-7 col-xs-12" placeholder="价格" name="item[' . $v["key"] . '][price]" value="' . $v["price"] . '"></td>';
            $str .= '<td><input type="text" class="form-control col-md-7 col-xs-12 item-store" placeholder="库存" name="item[' . $v["key"] . '][store_count]" value="' . $v["store_count"] . '"></td>';
            $str .= '<td><input type="text" class="form-control col-md-7 col-xs-12" placeholder="SKU" name="item[' . $v["key"] . '][sku]" value="' . $v["sku"] . '"><input type="hidden" name="item[' . $v["key"] . '][key_name]" value="' . $v["key_name"] . '"></td>';
            $str .= '</tr>';
        }
        $str .= "</table>";
        return $str;
    }

    /**
     * Title: 删除商品
     * Notes:del
     * @return array
     */
    public function del()
    {
        $id = input('id');
        $m = model('goods');
        $m::destroy($id);
        Db::name('goodsattr')->where('goods_id', $id)->delete();
        Db::name('goodsimages')->where('goodsid', $id)->delete();
        Db::name('goodsseec')->where('goods_id', $id)->delete();
        return jsdata(200, '删除成功……', '/admin/goods');
    }
}
