## Installation

Install the latest version with

```bash
$ composer require image/local
```

## Basic Usage

```php
<?php

use Image\Local\Extract\RichTextExtractImageSrc;
use Image\Local\Exception\RichTextExtractImageException;

$content = '<p><img src="https://static001.geekbang.org/resource/image/df/40/df636a4aded0e97727db850d3c406840.jpg" /></p>';

$pattern = "/<[img|IMG|a].*[src|href]=[\\'|\"](.*?(?:[\\.png|\\.jpg]))[\\'|\"].*?[\\/]?>/";

$host = 'your_domain';

try{

    $richTextExtractObj = new RichTextExtractImageSrc();

    //自定义匹配规则
    $richTextExtractObj->setPattern($pattern);
    
    //链式调用获取匹配结果
    $richTextExtractObj->setPatternContent($content)
        ->setNowProjectHost($host)
        ->extractImage()
        ->replaceImageSrc();

    //从富文本中提取图片的结果集
    print_r($richTextExtractObj->patternResult);die;

    //替换富文本图片为本地图片后的富文本内容
//    var_dump($richTextExtractObj->patternContent);die;


}catch (RichTextExtractImageException $richTextExtractImageException){
    //实际项目需要日志记录异常

    //抛出异常
    throw new RichTextExtractImageException($richTextExtractImageException->getMessage());

}

```