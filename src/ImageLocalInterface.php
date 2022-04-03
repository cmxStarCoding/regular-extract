<?php
namespace Image\Local;

//考虑后期扩展性，这里提取图片的逻辑定义为接口，由具体业务逻辑实现
interface ImageLocalInterface
{

    //从资源中提取图片路径
    public function extractImage();

    //将原始数据中的图片路径替换为本地化存贮之后的图片路径
    public function replaceImageSrc();

}