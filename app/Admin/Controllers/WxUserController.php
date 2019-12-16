<?php

namespace App\Admin\Controllers;

use App\Model\WxUserModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WxUserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '微信用户管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WxUserModel);

        $grid->column('u_id', __('U id'));
        $grid->column('openid', __('Openid'));
        $grid->column('subscribe_time', __('关注时间'))->display(function ($time){
            return date('Y-m-d H:i:s',$time);
        });
        $grid->column('sex', __('性别'))->display(function ($sex){
            if ($sex==1){
                return '男';
            }elseif ($sex==2){
                return '女';
            }else{
                return '保密';
            }
        });
        $grid->column('nickname', __('昵称'));

        $grid->column('headimgurl', __('头像'))->display(function ($img){
            return '<img src="'.$img.'">';
        });
        //$grid->column('created_at', __('Created at'));
        //$grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(WxUserModel::findOrFail($id));

        $show->field('u_id', __('U id'));
        $show->field('openid', __('Openid'));
        $show->field('subscribe_time', __('Subscribe time'));
        $show->field('sex', __('Sex'));
        $show->field('nickname', __('Nickname'));
        $show->field('created_at', __('Created at'));
        $show->field('headimgurl', __('Headimgurl'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new WxUserModel);

        $form->text('openid', __('Openid'));
//        $form->number('subscribe_time', __('Subscribe time'));
//        $form->switch('sex', __('Sex'));
//        $form->text('nickname', __('Nickname'));
        $form->text('headimgurl', __('Headimgurl'));

        return $form;
    }
}
