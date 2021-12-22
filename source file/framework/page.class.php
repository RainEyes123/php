<?php
class page{
    private $total;//总页数
    private $size;//每页记录数
    private $url;//URL 地址
    private $page;//当前页码
    /**
     * 构造方法
     * @param $total 总记录数
     * @param $size  每页记录数
     * @param url URL 地址
     */
    public function __construct($total,$size,$url = ''){
        //计算每页数，向上取整,总的记录数除以每一个记录数
        $this->total = ceil($total/$size);
        //每页记录数
        $this->size=$size;
        //为URL 添加 GEL 参数
        $this->url=$this->setUrl($url);
        //获得当前页码
        $this->page=$this->getNowPage();
    }
    /**
     * 获得当前页码
     */
    private function getNowPage(){
        $page = !empty($_GET['page'])?$_GET['page']:1;
        if($page < 1){
            $this->page = 1;
        }else if($page > $this->total){//小于1时为一，
            $page=$this->total;//大于总页码时等于当前总页数
        }
        return $page;
    }
    /**
     * 为 URL 添加 GET 参数，去掉 page 参数
     */
    private function setUrl($url){
        $url.="?";
        foreach($_GET as $k => $v){
            if($k!='page'){
                $url.="$k=$v&";
            }
        }
        return $url;
    }
    /**
     * 获得分页导航
     */
    public function getPageList(){
        //总页数不超过1时直接返回空结果
        if($this->total<=1){
            return '';
        }
        //拼接分页导航的HTML
        $html='';
        if($this->page>4){
            $html= "<a href=\"{$this->url}page=1\">1</a>...";
        }
        for($i=$this->page-3,$len=$this->page+3;$i<=$len && $i<=$this->total;$i++){//循环前三页后三页的导航联机
            if($i>0){
                if($i==$this->page){//是否为当前页，是的话加样式
                    $html.="<a href=\"{$this->url}page=$i\" class=\"curr\">$i</a>";
                }else{
                    $html.="<a href=\"{$this->url}page=$i\">$i</a>";
                }
            }  
        }
        if($this->page+3 < $this->total){//判断是否大于三页的情况
            $html.="...<a href=\"{$this->url}page={$this->total}\">{$this->total}</a>";
        }
        //返回拼接结果
        return $html;
    }
    /**
     * 获得SQL中的limit
     */
    public function getLimit(){
        if($this->total==0){//如果为0则返回0，0，否则返回当前页-1乘以每页这个数
            return '0,0';
        }
        return($this->page-1)*$this->size . ",{$this->size}";//{$this->size}每页显示的记录数，作为返回limit的条件
    }
}