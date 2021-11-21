<?php
namespace App\Services;
class randomLimitArray
{
    public static function make(array $array,int $number): array
    {
        if (count($array)>=$number){
            $limitVideo = array_rand($array,$number);
            foreach ($limitVideo as $key =>$value){
                $result[] = $array[$value];
            }
        }else{
            foreach ($array as $video_child)
                $result[]=$video_child;
        }
        return $result;
    }

}