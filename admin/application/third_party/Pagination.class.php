<?php
/**
 * Pagination.class.php
 */
class Pagination
{
    private $totalRows;             // 总条目数
    private $listRows;              // 每页显示的条目数
    private $displayEntries;        // 每页显示的页数
    private $currentPage;           // 当前页
    private $totalPages;            // 总页数
    private $varPage;               // 分页变量
    private $firstText = '&lt;&lt;';
    private $prevText = '&lt;';
    private $nextText = '&gt;';
    private $lastText = '&gt;&gt;';

    public function __construct($totalRows, $listRows = 18, $displayEntries = 10, $varPage = 'p')
    {
        $this->totalRows = $totalRows;
        $this->listRows = $listRows ? : 10;
        $this->displayEntries = $displayEntries ? : 10;
        $this->varPage = $varPage ? $varPage : 'p';
        $this->totalPages = $this->listRows ? ceil($totalRows / $this->listRows) : 0;

        if(!isset($_GET[$this->varPage]))
        {
            $this->currentPage = 1;
        }
        else
        {
            $this->currentPage = intval($_GET[$this->varPage]) > $this->totalPages ? $this->totalPages : intval($_GET[$this->varPage]);
        }
    }

    public function listRows()
    {
        return $this->listRows;
    }

    public function currentPage()
    {
        return $this->currentPage;
    }

    /**
     * 构造分页并输出
     */
    public function show()
    {
        $res = '';
        if($this->totalPages > 1)
        {
            // 获取当前GET字符串[URI]
            $uri = $_SERVER['REQUEST_URI'];
            if(isset($_GET[$this->varPage]))
            {
                // 开头及中间
                $uri = preg_replace('/'.$this->varPage.'\=[a-z0-9-_]+(&)?/i', '', $uri);
                $uri = rtrim($uri, '&');
                $uri = rtrim($uri, '?');
            }
            if(preg_match('/\?[a-z0-9-_]+\=?/i', $uri))
            {
                $uri .= '&'.$this->varPage.'=';
            }
            else
            {
                $uri .= '?'.$this->varPage.'=';
            }

            $res = '<ul>';
            if($this->totalRows)
            {
                $first = $this->createLink(1, $uri, $this->firstText, '', false);
                $prev = $this->createLink($this->currentPage - 1, $uri, $this->prevText, '');
                $interval = $this->appendRange($uri);
                $next = $this->createLink($this->currentPage + 1, $uri, $this->nextText, '');
                $last = $this->createLink($this->totalPages, $uri, $this->lastText, '', false);
                $res .= $first.$prev.$interval.$next.$last;
            }
            $res .= '</ul>';
        }
        return $res;
    }

    /**
     * 起始条目、条目数
     */
    public function limit()
    {
        return $this->currentPage > 0 ? ' LIMIT '.$this->listRows * ($this->currentPage - 1).','.$this->listRows : '';
    }

    /**
     * 构造显示的条目
     */
    private function buildPage()
    {
        $page = array();
        // 总页数小于显示的页数
        if($this->totalPages < $this->displayEntries)
        {
            for($i = 0; $i < $this->totalPages; $i++)
            {
                $page[] = $i +1;
            }
        }
        // 总页数大于显示的页数
        else
        {
            // 当前页数小于显示页数的一半
            if($this->currentPage <= ceil($this->displayEntries / 2))
            {
                for($i = 0; $i < $this->displayEntries; $i++)
                {
                    $page[] = $i + 1;
                }
            }
            // 显示的最后一个页数大于总页数
            else if($this->currentPage <= $this->totalPages && $this->currentPage > $this->totalPages - $this->displayEntries + 1)
            {
                for($i = 0; $i < $this->displayEntries; $i++)
                {
                    $page[] = ($this->totalPages) - ($this->displayEntries) + 1 + $i;
                }
            }
            // 显示的最后一个页数小于总页数
            else
            {
                for($i = 0; $i < $this->displayEntries; $i++)
                {
                    $page[] = $this->currentPage - ceil($this->displayEntries / 2) + $i + 1;
                }
            }
        }
        return $page;
    }

    /**
     * 创建分页链接
     */
    private function createLink($page_id, $uri, $text = '', $class = '', $add_current_class = true)
    {
        // 首页、末页、当前页
        if($page_id == $this->currentPage || $page_id == 0 || $page_id == $this->totalPages + 1)
        {
            $link = '<li class="disabled"><a href="javascript:;">'.($text != '' ? $text : $page_id).'</a></li>';
        }
        // 上一页和下一页之间的数字链接
        else
        {
            $link = '<li><a href="'.$uri.$page_id.'"'.($class != '' ? ' class="'.$class.'"' : '').'>'.($text != '' ? $text : $page_id).'</a></li>';
        }
        return $link;
    }

    /**
     * 创建上一页和下一页之间的数字链接
     */
    private function appendRange($uri)
    {
        $link = '';
        $buildPage = $this->buildPage();
        foreach($buildPage as $page_id)
        {
            $link .= $this->createLink($page_id, $uri);
        }
        return $link;
    }
}
?>