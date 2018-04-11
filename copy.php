<?php
获取当前地区的检索范围
$area   = DB::select('SELECT `oid`,`level` FROM areas where id = ?', [$area_id]);
if(empty($area))  response()->json([], 200);
$limit  = $this->getAreasRangeByOid($area[0]->oid,$area[0]->level);

获取子地区编码检索范围
// 获取子地区编码
$areas = $this->getNextLevel($area_id, ' * ');
if(!isset($areas[0]))       return response()->json([], 200);
$sql = '';
foreach ($areas as $key => $val) {
    $limit = $this->getAreasRangeByOid($val->oid,$val->level);
}

年龄字段限定
$begin_year=ceil(time()/86400 - 365*$params->end_age);数大
$end_year=ceil(time()/86400 - 365*($params->begin_age-1));数小


正常形式
$total = 0;
$max   = 0;
foreach ($data as $key => $val) {
    $val->value = ceil($val->value/10000);
    $max = $val->value > $max ? $val->value : $max;
    $total += $val->value;
    $data[$key]->value = $val->value;
}
$data = ['total'=>$total, 'max'=>$max, 'data'=>$data];
        return response()->json($data, 200);
冒号形式：
$sum  = 0;
$max  = 0;
$newArray = [];
foreach ($data as $key => $val) {
    $max = $val->total_students > $max ? $val->total_students : $max;
    $sum += $val->total_students;
    $newArray['data'][$val->age] = $val->total_students;
}
$newArray['max'] = $max;
$newArray['sum'] = $sum;
return response()->json($newArray, 200);








