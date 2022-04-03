<?php

namespace Image\Local\Extract;

use Image\Local\Exception\RichTextExtractImageException;
use Image\Local\ImageLocalInterface;
/*
 * 富文本字符串提取图片资源路径
 */
class RichTextExtractImageSrc implements ImageLocalInterface{

    //匹配规则
    public string $pattern = '';

    //匹配内容
    public string $patternContent = '';

    //匹配结果
    public array $patternResult = [];

    //当前项目host
    public string $nowProjectHost = '';

    /**
     * 设置匹配模式
     * @param string $pattern
     * @return self
     */
    public function setPattern(string $pattern):self
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * 设置匹配内容
     * @param string $patternContent
     * @return self
     */
    public function setPatternContent(string $patternContent):self
    {
        $this->patternContent = $patternContent;
        return $this;
    }

    /**
     * 设置当前项目host
     * @param string $nowProjectHost
     * @return self
     */
    public function setNowProjectHost(string $nowProjectHost):self
    {
        $this->nowProjectHost = $nowProjectHost;
        return $this;
    }

    /**
     * 从富文本字符串里面提取出图片路径
     * @return self
     * @throws RichTextExtractImageException
     */
    public function extractImage():self
    {
        if(!check_is_regular($this->pattern)){
            throw new RichTextExtractImageException('this pattern valid');
        }
        if(empty($this->patternContent)){
            throw new RichTextExtractImageException('please set patternContent');
        }
        //匹配
        preg_match_all($this->pattern, $this->patternContent,$match);
        //匹配结果赋值
        $this->patternResult =  $match[1] ? array_values($match[1]) : [];
        return $this;
    }

    /**
     * 将原始数据中的图片路径替换为本地化存贮之后的图片路径
     * @return selfß
     * @throws RichTextExtractImageException
     */
    public function replaceImageSrc():self
    {
        if(empty($this->patternResult)) {
            throw new RichTextExtractImageException('this patternResult is empty');
        }
        if(empty($this->nowProjectHost)){
            throw new RichTextExtractImageException('please set nowProjectHost');
        }
        foreach ($this->patternResult as &$value){
            //解析url
            $url = parse_url($value);
            //替换
            $replace = sprintf('%s://%s%s',$url['scheme'] ?? '', $this->nowProjectHost, $url['path'] ?? '');
            //赋值
            $this->patternContent = str_replace($value, $replace, $this->patternContent);
        }
        return $this;
    }
}