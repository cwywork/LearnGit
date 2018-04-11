10.适龄未入学或辍学原因的显示  (辍学原因ｔｉｔｌｅ)

http://epa.com/edu-records
是否适龄未入学　members 表里面has_neisa   0 =  否， 1 = 是'

辍学原因        members 表里面neisa_causes_id　适龄未入学原因

'1', '附近没有学校（幼儿园）', 
'2', '家庭缺乏劳动力',
'3', '入寺', 
'4', '早婚', 
'5', '打工', 
'6', '重度残疾', 
'7', '因病', 
'8', '厌学',
'10', '参军', 

14.每个人只显示最新教育记录
http://localhost:88/edu-records?member_id=6838112
不能使用groupby的解决方案
set sql_mode ='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';


2.贫困户管理查询搜索报异常无法正常查询

已解决，like语法错误，还有id_code的sql语句报错

category_id=2情况是php内存不够


4.高级检索关联权限
解决方案，增加level等级，等级大的不能访问等级小的
http://epa.com/areaParents?area_id=334885
根据当前区域ID查找其父级区域ID


5.添加贫困户五个步骤
POST的http://epa.com/families请求
少了一个remark字段  现在我给加了一个参数所以不报错

户主信息需要 家庭信息需要 remark   补充适龄未入学或辍学，辍学原因 



6.管理中心大表格的显示

17620天    1460
16160    11050 

15065    12145

m.birthday>11050 and m.birthday<16160  4到18
m.birthday>12145 and m.birthday<15065  7到15

高中，中职要分开


7.贫困状态,未脱贫/预脱贫/脱贫/反贫/未知 五个状态
加一个数据分析报表,户口人数分地区展示  学生数
family里面有字段
'poor_status', 'tinyint(1)', NULL, 'NO', '', '1', '', 'select,insert,update,references', '贫困状态（1=未脱贫; 2=预脱贫; 3=脱贫; 4=返贫）'

7.1各学龄段辍学生数据统计（http://epa.com/areas-ages-studrop/1）
	各学龄段辍学生列表　http://localhost:88/dropstudents

7.2各教育阶段学生情况
http://epa.com/areas-grade-students/1
http://epa.com/gradestudents


bug.1
是添加贫困户，不是添加贫困人口

bug.2删除一个贫困户成员

解决青海省教育扶贫经费套不上问题

解决培训套不上的问题

辍学原因   


//高级检索
$tday       =  ceil(time()/86400 - 365*intval($params->age_begin-1));


辍学生分析数据结构修改


解决是否省内就读读不到学校的情况



辍学生原因的分析
备注的修改
年龄的修改

解决教不显示的问题
添加学校名称

教育记录春秋季的报错处理
	(Request $request) 


冗余数据删除　delete from members where area_id=0

然后m.area_id is not null

是学生　地区统计110410  
			列表统计110410


解决教育阶段检索无变化的问题

解决年级异常的原因

培训需求异常的解决

1.zai xiao sheng he dui
  ka pian
http://epa.com/areas-basic/1?
Area@getBasicSurveyByarea

$fend_year   = ceil(time()/86400 - 356*intval(6));
$fbegin_year = ceil(time()/86400 - 356*intval(15));

select sum_families, sum_members, sum_funds, sum_students, sum_dropout_students, {$year} `year` from areas a 
left join (
    select count(1) sum_families, sum(members) sum_members, {$area_id} `area_id` from families f 
        left join areas a  on f.area_id = a.id 
    where  f.year = {$year} and a.oid BETWEEN {$limit->_skip} and {$limit->_limit})ff on ff.area_id = a.id 
left join(
    select sum(p.funds) sum_funds, {$area_id} `area_id` from edu_records_policies rp 
        left join epa_policies p on rp.epa_policy_id = p.id
        left join edu_records r  on rp.edu_record_id = r.id
        inner join areas a       on rp.area_id       = a.id
    where   a.oid BETWEEN {$limit->_skip} and {$limit->_limit})fp on fp.area_id = a.id
left join (   
    select count(1) sum_students, {$area_id} `area_id` from members m
        inner join areas a       on m.area_id   = a.id
    where m.year=2018 AND  a.oid BETWEEN {$limit->_skip} and {$limit->_limit} and m.edu_status=1 )ee on ee.area_id = a.id
left join (   
    select count(1) sum_dropout_students, {$area_id} `area_id` from members m
        inner join areas a       on m.area_id   = a.id
    where a.oid BETWEEN {$limit->_skip} and {$limit->_limit} and m.birthday between {$fbegin_year} and {$fend_year} and m.edu_status=0)dd on dd.area_id = a.id
where a.id = {$area_id}



  biao ge
http://epa.com/areas-global/1?
Area@getGlobalByArea

$sql .= "select {$v->id} area_id , '{$v->name}' area_name, '{$v->level}' area_level, 
  (members_6 + members_12 + members_15 + members_18) sum_members, members_6,members_12, members_15, members_18,
  (students_3 + students_4 + students_5 + students_6 + students_7 + students_8 + students_9 + students_10 + students_11 + students_47 + students_51) sum_students,students_3,students_4, students_5, students_6,students_47 students_7,
  (students_7 + students_8 + students_9 + students_10 + students_11 + students_51) students_8,
  (dropout_6 + dropout_12 + dropout_15 + dropout_18) sum_dropout, dropout_6,dropout_12, dropout_15, dropout_18
  from areas a ";
foreach ($age as $key => $val) {
$byear = date('Y')-$val->id;
//                $begin_year = intval(strtotime($byear.'-'.date('m-d'))/86400);
$begin_year=ceil(time()/86400 - 365*$val->id);
$sql .= " left join (";
$sql .= "select mm.members members_{$val->id}, rr.dropout dropout_{$val->id}, {$v->id} area_id from (
          select count(1) members, {$year} `year` from members m 
              left join areas a on m.area_id = a.id 
          where birthday < {$end_year} and birthday > {$begin_year} and a.oid between {$limit->_skip} and {$limit->_limit} and m.year = {$year}
      ) mm  left join (
          select count(2) dropout, {$year} `year` from members m
              
              left join areas a on m.area_id = a.id 
          where m.birthday < {$end_year} and m.birthday > {$begin_year} and a.oid between {$limit->_skip} and {$limit->_limit} and m.`year` = {$year} and m.edu_status=0
      ) rr on mm.`year` = rr.`year`";
$sql .= ") m{$val->id} on a.id = m{$val->id}.area_id ";
//    return $sql;







$skip       = $val->id;
$end_year   = $begin_year;
}
// return $phase;
// $sql='';
foreach ($phase as $key => $val) {

$sql .= " left join (";
$sql .= "SELECT mm.stds students_{$val->id}, {$v->id} area_id from (
        	select count($val->id) stds from members m
            left join (select * FROM edu_records rr where not exists(select 1 from edu_records where rr.member_id = member_id and rr.id<id))r
            on r.member_id=m.id
    	left join areas a on r.area_id=a.id
      where m.edu_status=1 and r.phase_id = {$val->id} and a.oid between {$limit->_skip} and {$limit->_limit} )mm ";
$sql .= ") s{$val->id} on a.id = s{$val->id}.area_id ";

		areas
    select count(1) sum_students, {$area_id} `area_id` from members m
        inner join areas a       on m.area_id   = a.id
    where m.year=2018 AND  a.oid BETWEEN {$limit->_skip} and {$limit->_limit} and m.edu_status=1 )ee on ee.area_id = a.id


http://epa.com/areas-grade-students/1?

http://epa.com/gradestudents?skip=0&limit=16&area_id=1&grade_id=3

getStudentsByGradeNew
                $sql .= empty($sql) ? '' : ' union all ';
                $sql.="select ".$val->id." grade_id , '".$val->name."' name , count(1) value from members m
                left join (select * FROM edu_records rr where not exists(select 1 from edu_records where rr.member_id = member_id and rr.id<id))r
                on r.member_id=m.id
                left join areas a on m.area_id=a.id
                where r.phase_id={$val->id} and a.oid between {$limit->_skip} and {$limit->_limit} and m.`year` = {$year} and m.edu_status=1
                ";

select sum(p.funds) sum_funds, {$area_id} `area_id` from edu_records_policies rp 
        left join epa_policies p on rp.epa_policy_id = p.id
        left join edu_records r  on rp.edu_record_id = r.id
        inner join areas a       on rp.area_id       = a.id

http://epa.com/areas-edufunds/1?
getEduFundsByArea

$sql  .= "select count(1) people, sum(p.funds) `value`, {$val->id} edu_id,  '{$val->name}' name from edu_records_policies rp
            left join epa_policies p on rp.epa_policy_id = p.id
            left join edu_records er on rp.edu_record_id=er.id
            left join members m on er.member_id=m.id
            left join edu_phases ep on m.edu_phases_id=ep.id
            left join areas a on   m.area_id=a.id
            where ep.id={$val->id} and a.oid BETWEEN {$limit->_skip} and {$limit->_limit}"
            ;

http://localhost:88/areas-major/1?
Area@getMembersByMajor

http://localhost:88/areas-stdreason/1?  zhi ping yuan yin


http://localhost:88/members/7130803?
members[$k]->age= date('Y')-date('Y',$members[$k]->birthday);

$data[0]->age=ceil((time()-$data[0]->birthday)/3600/24/365);
nian ling xiu gai


20:40:01	UPDATE areas SET level=2 WHERE id=1	Error Code: 1223. Can't execute the query because you have a conflicting read lock	0.00024 sec

jiao yu de gai xie

nian lin


http://localhost:88/areas-grade-students/1?
getStudentsByGradeNew

$sql.="select '7,8,9,10,11,51' grade_id,'大学及以上' name,count(1) value from members m
left join (select * FROM edu_records rr where not exists(select 1 from edu_records where rr.member_id = member_id and rr.id<id))r
on r.member_id=m.id
left join areas a on m.area_id=a.id
where r.phase_id=7 or r.phase_id=8 or r.phase_id=9 or r.phase_id=10 or r.phase_id=11 or r.phase_id=51 and a.oid between {$limit->_skip} and {$limit->_limit} and m.`year` = {$year} and m.edu_status=1
";

 $sql.="select ".$val->id." grade_id , '".$val->name."' name , count(1) value from members m
  left join (select * FROM edu_records rr where not exists(select 1 from edu_records where rr.member_id = member_id and rr.id<id))r
  on r.member_id=m.id
  left join areas a on m.area_id=a.id
  where r.phase_id={$val->id} and a.oid between {$limit->_skip} and {$limit->_limit} and m.`year` = {$year} and m.edu_status=1
  ";   zhe ge shi dui de

	$sql.="select count(*) total_students from edu_records r
        left join members m on m.edu_records_id=r.id
        left join areas a on m.area_id=a.id
        where  FIND_IN_SET(r.phase_id, $params->grade_id) and a.oid between {$limit->_skip} and {$limit->_limit} and m.edu_status=1 and m.family_id != 0";


shu ju ku suo ding

jin fei

http://221.207.50.188/areas-agefunds/1?

getAgeFundsByArea


http://localhost:88/areas-edufunds/1?


http://epa.com/areas-global/1?

$sql .= "select {$v->id} area_id , '{$v->name}' area_name, '{$v->level}' area_level, 

                    (students_3 + students_4 + students_5 + students_6 + students_7 + students_8 + students_9 + students_10 + students_11 + students_47 + students_51) sum_students,students_3,students_4, students_5, students_6,students_47 students_7,
                    (students_7 + students_8 + students_9 + students_10 + students_11 + students_51) students_8
                    from areas a ";

$sql .= "SELECT mm.stds students_{$val->id}, {$v->id} area_id from (
    	select count($val->id) stds from members m
      left join (select * FROM edu_records rr where not exists(select 1 from edu_records where rr.member_id = member_id and rr.id<id))r
      on r.member_id=m.id
      left join areas a on r.area_id=a.id
      where m.family_id != 0 and m.edu_status=1 and r.phase_id = {$val->id} and a.oid between 100000000 and 199999999 )mm ";
$sql .= ") s{$val->id} on a.id = s{$val->id}.area_id ";
}
$sql .= ' where a.id='.$v->id;

gai xie 
select 1 area_id ,students_3 from areas a
	left join (
		select mm.stds students_3 , 1 area_id from(
			select count(1) stds from members m
			left join (select * FROM edu_records rr where not exists(select 1 from edu_records where rr.member_id = member_id and rr.id<id))r
			on r.member_id=m.id
            where m.edu_status=1 and r.phase_id=3
	)mm) s_3 on a.id=s_3.area_id
	where a.oid between 100000000 and 199999999



	11:36:47	select 1 area_id ,students_3 from areas a  left join (   select mm.stds students_3 , 1 area_id from(    select count(1) stds from members m    left join (select * FROM edu_records rr where not exists(select 1 from edu_records where rr.member_id = member_id and rr.id<id))r    on r.member_id=m.id    where a.oid between 100000000 and 199999999  )mm) s_3 on a.id=s_3.area_id LIMIT 0, 1000	Error Code: 1054. Unknown column 'a.oid' in 'where clause'	0.022 sec



select count(distinct(m.id)) people, sum(p.funds) `value`, 1 age_id,  "4~6岁" name from areas a
      left join members m on a.id=m.area_id
      left join families f on f.id=m.family_id
      left join (select * FROM edu_records rr where not exists(select 1 from edu_records where rr.member_id = member_id and rr.id<id))er
      on er.member_id=m.id
      left join edu_records_policies rp on rp.edu_record_id=er.id 
      left join epa_policies p on rp.epa_policy_id = p.id     
      where m.birthday>15441 and m.birthday<16536 and a.oid BETWEEN 100000000 and 199999999


15:35:11	select 1 area_id, std_1,std_2 from areas a  left join (    select count(1) std_1,1 area_id ,a.oid oid from members m             left join areas a on m.area_id=a.id    left join (select * FROM edu_records rr where not exists             (select 1 from edu_records where rr.member_id = member_id and rr.id<id)             )r    on r.member_id=m.id             where m.edu_status=1 and r.phase_id=3 and r.oid between 100000000 and 199999999     ) s_3      on a.id=s_3.area_id   left join (    select count(1) std_2,1 area_id,a.oid oid from members m             left join areas a on m.area_id=a.id    left join (select * FROM edu_records rr where not exists             (select 1 from edu_records where rr.member_id = member_id and rr.id<id)             )r    on r.member_id=m.id             where m.edu_status=1 and r.phase_id=4 and r.oid between 100000000 and 199999999     ) s_4      on a.id=s_4.area_id      where std_1 is not null LIMIT 0, 1000	Error Code: 1054. Unknown column 'r.oid' in 'where clause'	0.00037 sec



exportMembers
searchMembers
==========================================================================
<?php
 $params = $request->only('skip', 'limit','area_id', 'age_begin', 'age_end', 'edu_status', 'phase_id', 'grade', 'edu_phases_id', 'has_major', 'dropout_causes','has_local','has_boarding','school_id');

 if(isset($params->area_id) && intval($params->area_id) > 0){
            $limit = $this->getAreasRange($params->area_id);
            $where .= " and a.oid between ? and ? "; 
            $vWhere[] = $limit['_skip'];
            $vWhere[] = $limit['_limit'];
        }
        if(isset($params->age_begin) && intval($params->age_begin) > 0) {
            $tday       =  ceil(time()/86400 - 365*intval($params->age_begin-1));
            $where     .= " and m.birthday < ? ";
            $vWhere[]   = $tday;

        }

        if(isset($params->age_end) && intval($params->age_end) > 0) {
            $tday       = ceil(time()/86400 - 365*intval($params->age_end));
            $where     .= " and m.birthday > ? ";
            $vWhere[]   = $tday;
        }
//        return $vWhere;
        if(isset($params->edu_status)) {
            $where .= " and m.edu_status = ? ";
            $vWhere[] = intval($params->edu_status);
        }
        if(isset($params->edu_phases_id) && intval($params->edu_phases_id) > 0) {
            $where .= " and m.edu_phases_id = ? ";
            $vWhere[] = intval($params->edu_phases_id);
        }
        if(isset($params->grade) && intval($params->grade) > 0) {
            $where .= " and r.grade = ? ";
            $vWhere[] = intval($params->grade);
        }

        //3.21日添加学校是否省内has_local 是否提供住宿has_boarding
        if(isset($params->has_local) && intval($params->has_local) > 0) {
            $where .= " and r.has_local = ? ";
            $vWhere[] = intval($params->has_local);
        }
        if(isset($params->has_boarding) && intval($params->has_boarding) > 0) {
            $where .= " and r.has_boarding = ? ";
            $vWhere[] = intval($params->has_boarding);
        }
        if(isset($params->school_id) && intval($params->school_id) > 0) {
            $where .= " and r.school_id = ? ";
            $vWhere[] = intval($params->school_id);
        }
        if(isset($params->phase_id) && intval($params->phase_id) > 0) {
            $where .= " and r.phase_id = ? ";
            $vWhere[] = intval($params->phase_id);
        }
        if(isset($params->has_major)) {
            if($params->has_major == 0){
                $where .= " and v.edu_major_id is null ";
            }else{
                $where .= " and v.edu_major_id > 0 ";
            }
           
        }

        if(isset($params->dropout_causes) && strlen($params->dropout_causes) > 0) {
            $tmp = explode(',', $params->dropout_causes);
            $sw     = '';
            foreach ($tmp as $k => $v) {
                if(intval($v) > 0 ) {
                    $sw .= empty($sw) ? '' : ' or ';
                    $sw .= ' r.dropout_causes_id='. intval($v);
                }
            }
            // return $sw;
            $where .= 'and ('.$sw.')';
        }
        $fields = 'm.id, m.realname, m.gender, m.ethnic, m.id_code, substring(m.id_code,7,8) shenri, m.mobile, m.edu_status, m.edu_phases_id,a.name area_name, (m.birthday*86400) birthday, r.phase_id, r.grade,r.has_local,r.school_id ,s.sch_name,ep.name,eep.name jiaoyu';
        $sqlt = "select count(1) jcount from areas a 
                    left join members m on m.area_id = a.id 
                    left join (SELECT r.member_id, r.status, r.dropout_causes_id, r.grade, r.has_local,r.has_boarding,r.school_id,r.phase_id FROM edu_records r WHERE not EXISTS (SELECT 1 FROM edu_records where r.member_id = member_id AND r.id < id )) r on r.member_id = m.id
                 left join edu_ves v on v.member_id = m.id
                where {$where} and m.area_id is not null and m.family_id != 0";
//        return $vWhere;
//        return $sqlt;
        $sqld = "select {$fields} from members m 
                    left join edu_phases ep on m.edu_phases_id=ep.id
                    left join areas a on m.area_id = a.id 
                    left join (SELECT r.id, r.member_id, r.status, r.dropout_causes_id, r.grade, r.has_local,r.has_boarding,r.school_id,r.phase_id FROM edu_records r WHERE not EXISTS (SELECT 1 FROM edu_records where r.member_id = member_id AND r.id < id)) r on r.member_id = m.id
                    left join edu_phases eep on eep.id=r.phase_id
                    left join schools s on s.id=r.school_id 
                    left join edu_ves v on v.member_id = m.id
                where {$where} and m.area_id is not null and m.family_id != 0 limit {$params->skip} , {$params->limit}";
//        return $sqlt;


getBasicSurveyByarea
$sql="select sum_families, sum_members, sum_funds, sum_students, sum_dropout_students, 2018 `year` from areas a
left join
select sum(p.funds) sum_funds, 1 `area_id` from edu_records_policies rp 
    left join epa_policies p on rp.epa_policy_id = p.id
    left join edu_records r  on rp.edu_record_id = r.id
    inner join areas a       on rp.area_id       = a.id
where   a.oid BETWEEN 100000000 and 199999999)fp on fp.area_id = a.id"


getEduFundsByArea
$sql  .= "select count(distinct(er.member_id)) people, sum(p.funds) `value`, {$val->id} edu_id,  '{$val->name}' name from edu_records_policies rp
    left join epa_policies p on rp.epa_policy_id = p.id
    left join edu_records er on rp.edu_record_id=er.id
    left join areas a on   er.area_id=a.id
    where er.phase_id={$val->id} and a.oid BETWEEN {$limit->_skip} and {$limit->_limit}"
    ;

$sql  .= "select count(distinct(m.id)) people, sum(p.funds) `value`, {$val['id']} age_id,  \"{$val['name']}\" name from edu_records_policies rp
			    left join epa_policies p on rp.epa_policy_id = p.id
			    left join edu_records er on rp.edu_record_id=er.id
			    left join members m on m.edu_records_id=er.id
			    left join areas a on   er.area_id=a.id
          where m.birthday>{$age_end} and m.birthday<{$age_begin} and a.oid BETWEEN {$limit->_skip} and {$limit->_limit}
          " ;

getFundsByArea
$sql  .= "select count(1) people, sum(p.funds) `value`, {$val->id} area_id, '{$val->name}' name from edu_records_policies rp 
            left join epa_policies p on rp.epa_policy_id = p.id
            
            left join edu_records er on rp.edu_record_id=er.id
            
            left join areas a          on rp.area_id = a.id
        where a.oid BETWEEN {$limit->_skip} and {$limit->_limit}";



$sqlt = "select count(1) jcount from areas a 
            left join members m on m.area_id = a.id 
            left join (SELECT r.member_id, r.status, r.dropout_causes_id, r.grade, r.has_local,r.has_boarding,r.school_id,r.phase_id FROM edu_records r WHERE not EXISTS (SELECT 1 FROM edu_records where r.member_id = member_id AND r.id < id )) r on r.member_id = m.id
         left join edu_ves v on v.member_id = m.id
        where {$where} and m.area_id is not null and m.family_id != 0";






