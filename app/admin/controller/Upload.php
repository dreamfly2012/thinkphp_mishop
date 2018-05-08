<?php
/**
 * ============================================================================
 * 版权所有 2015-2018
 * 网站地址: https://www.xiaoxiang.ga
 * ----------------------------------------------------------------------------
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 本程序采用thinkphp v5.0开发
 * ============================================================================
 * Author: chiqing_85
 * Time: 2018/2/17 22:43
 */

namespace app\admin\controller;
use think\Controller;
use think\Image;

class Upload extends Controller
{
    /**
     * title 创建目录
     * Notes:checkPath
     * @param $path
     * @return bool
     */
    protected function checkPath($path)
    {
        if (is_dir($path)) {
            return true;
        }
        if (mkdir($path, 0755, true)) {
            return true;
        } else {
            $this->error("目录 {$path} 创建失败！");
            exit();
        }
    }

    /**
     * title 上传网站logo
     * Notes:index
     * @return string
     */
    public function index()
    {
        $files = request()->file('images');

        if($files)
        {
            $image = Image::open($files);
            $this->checkPath( realpath($_SERVER['DOCUMENT_ROOT']) . DS.'uploads/'. date('Ymd'));
            $thume = '/uploads/'. date('Ymd'). DS .md5(microtime(true)) .$files->getExtension();
            $image->thumb(200, 40)->save( realpath($_SERVER['DOCUMENT_ROOT']) . $thume);
            return $thume;
        } else {
            return '文件上传失败……';
        }
    }

    /**
     * Title:分类展示图片上传
     * Notes:cate
     * @return string
     */
    public function cate()
    {
        $files = request()->file('images');

        if($files)
        {
            $image = Image::open($files);
            $this->checkPath( realpath($_SERVER['DOCUMENT_ROOT']) . DS.'uploads/'. date('Ymd'));
            $thume = '/uploads/'. date('Ymd'). DS .md5(microtime(true)) .'.jpg';
            $image->thumb(80, 80)->save( realpath($_SERVER['DOCUMENT_ROOT']) . $thume);
            return $thume;
        } else {
            return '文件上传失败……';
        }
    }

    /**
     * Title:品牌logo
     * Notes:brand
     */
    public function brand()
    {
        $files = request()->file('images');

        if($files)
        {
            $thume = $files->move(realpath($_SERVER['DOCUMENT_ROOT']).'/uploads/');
            return '/uploads/'. $thume->getSaveName();
        } else {
            return '文件上传失败……';
        }
    }

    /**
     * Title: 商品预览图上传　
     * Notes:goods
     * @return int|mixed|string
     */
    public function goods()
    {
        $files = request()->file('images');

        if($files)
        {
           $info = $files->validate(['size'=>512000, 'ext'=>'jpeg,jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads/goods');
           if($info)
           {
               $savename = $info->getSaveName();
               $savename = str_replace('\\', '/', $savename);
               $image = Image::open($files);
               $this->checkPath( realpath($_SERVER['DOCUMENT_ROOT']) . DS.'uploads/goods/items/'. date('Ymd'));

               $thumem = '/uploads/goods/'. DS .$savename .'_430x430.jpg';
               $image->thumb(430, 430)->save( realpath($_SERVER['DOCUMENT_ROOT']) . $thumem);       //430*430缩略图
               $thumes = '/uploads/goods/'. DS .$savename .'_60x60.jpg';
               $image->thumb(60, 60)->save( realpath($_SERVER['DOCUMENT_ROOT']) . $thumes);        //60*60缩略图
               return '/uploads/goods/'.$savename;
           }
        } else {
            return '文件上传失败……';
        }
    }

    /**
     * Title: 上传广告
     * Notes:ad
     */
    public function ad()
    {

    }
}