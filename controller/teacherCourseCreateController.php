<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/29/2018
 * Time: 4:14 PM
 */

require_once __DIR__.'/../model/Subject.php';
$MSub = new Subject();

$SUBLIST = [];

$fn = $MSub->input('fn');


if($fn=='addCourse'){
    $name = $MSub->input('name');
    $detail = $MSub->input('detail');
    $input = [
        'name'=>$name,
        'detail'=>$detail
    ];
    $result = $MSub->insertSubject($input);

}

elseif($fn=='editCourse'){
    $name = $MSub->input('name');
    $detail = $MSub->input('detail');
    $id = $MSub->input('course_id');
    $input = [
        'name'=>$name,
        'detail'=>$detail
    ];
    $result = $MSub->editSubject($input,['id'=>$id]);

}

elseif($fn=='removeCourse'){
    $id = $MSub->input('course_id');
    $result = $MSub->removeSubject($id);

}

$result = $MSub->selectSubRemove('N');
if(count($result)>0){
    $SUBLIST=$result;
}
