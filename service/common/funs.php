<?php
/**
 * 变量友好化打印输出
 * @example dump($a,$b,$c,$e,[.1]) 支持多变量，使用英文逗号符号分隔，默认方式 print_r，查看数据类型传入 .1
 * @version php4、5、7
 * @return void
 */
function dump()
{
    echo '<style>.php-print{background:#eee;padding:10px;border-radius:4px;border:1px solid #ccc;line-height:1.5;white-space:pre-wrap;font-family:Menlo,Monaco,Consolas,"Courier New",monospace;font-size:13px;}</style>', '<pre class="php-print">';
    $args = func_get_args();
    if(end($args) === .1){
        array_splice($args, -1, 1);
        foreach($args as $k => $v){
            echo $k>0 ? '<hr>' : '';
            ob_start();
            var_dump($v);
            echo preg_replace('/]=>\s+/', '] => <label>', ob_get_clean());
        }
    }else{
        foreach($args as $k => $v){
            echo $k>0 ? '<hr>' : '', print_r($v, true);
        }
    }
    echo '</pre>';
}


function repair_zero($number)
{
    return $number > 10 ? $number : '0'.$number;
}

/**
 * 转为树形结构
 *
 * 前提条件 $k必须是id
 *
 * @param array $arr
 * @param array $res
 * @param string $pid_key
 * @param string $children_key
 * @return array
 */
function to_tree(array $arr, $res = [], $pid_key = 'pid', $children_key = 'children')
{
    foreach ($arr as $k => $v) {
        isset($arr[$v[$pid_key]]) ? $arr[$v[$pid_key]][$children_key][] = &$arr[$k] : $res[] = &$arr[$k];
    }

    return $res;
}

/**
 * 异步请求响应
 *
 * @param string $status
 * @param array $data
 * @param string $msg
 * @return string
 */
function response($status, $data = [], $msg = '')
{
    echo json_encode([
        'status' => $status,
        'data' => $data,
        'message' => $msg,
    ], 256);die;
}

/**
 * 提示错误的响应
 *
 * @param string $msg
 */
function response_error($msg)
{
    response('error', [], $msg);
}

/**
 * 提示成功的响应
 *
 * @param array $data
 * @param string $msg
 */
function response_success(array $data = [], $msg = '')
{
    response('success', $data, $msg);
}