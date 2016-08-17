<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/17
 * Time: 17:42
 */

function smarty_function_widget($params) {
    return Model('Widget')->$params['name']();
}
