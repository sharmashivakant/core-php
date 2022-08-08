<?php
/**
 * PAGINATION
 */

class Pagination
{
    static public $page = 1;
    static public $countPage = 0;
    static public $start = 0;
    static public $end = 20;
    static public $allRecords = 0;


    /**
     * @param int $page
     * @param int $end
     * @param bool $allRecords
     */
    static public function calculate($page, $end = 20, $allRecords = false)
    {
        self::$page = intval($page);
        self::$countPage = ceil($allRecords / $end);
        self::$end = $end;
        self::$allRecords = $allRecords;

        if (self::$page <= 1 OR self::$page > self::$countPage) {
            self::$page = 1;
            self::$start = 0;
        } else
            self::$start = (self::$page-1) * self::$end;
    }

    /**
     * @param int $count
     * @param bool $urlType
     * @param string $partUrl
     * @return string
     */
    static public function printPagination($count = 2, $urlType = false, $partUrl = '')
    {
        if ($urlType == 'href') { // href

        } else { // any
            $partUrl = '?'.$partUrl;
        }

        if ($count === false) {
            if (self::$page > 1)
                $prev = self::$page-1;
            else
                $prev = 1;

            $html = '<div class="nav-links">';
            $html .= '<a class="prev page-numbers" href="'.$partUrl.'page='.$prev.'" ><span class="icon-chevron-left"></span></a>'; // onclick="load(\''.$partUrl.'page='.(self::$page-1).'\');"
            $html .= '<a class="next page-numbers" href="'.$partUrl.'page='.(self::$page+1).'" ><span class="icon-chevron-right"></span></a>'; // onclick="load(\''.$partUrl.'page='.(self::$page+1).'\');"
            $html .= '</div>';

            return $html;
        }


        $html = '<div class="nav-links">';

        if (self::$page > 1)
            $prev = self::$page-1;
        else
            $prev = 1;

//        if (self::$page > 1)
            $html .= '<a class="prev text page-numbers" href="'.$partUrl.'page=1" title="">First</a>';
            $html .= '<a class="prev page-numbers" href="'.$partUrl.'page='.$prev.'" title=""><span class="icon-chevron-left"></span></a>'; // onclick="'.ajaxLoad(''.$partUrl.'page='.(self::$page-1)).'"

        if (self::$page > $count)
            $from = self::$page - $count;
        else
            $from = 1;

        if (self::$countPage - self::$page >= $count)
            $to = self::$page + $count;
        else
            $to = self::$countPage;

        if (self::$page > $count+1)
            $html .= '<a class="page-numbers" href="'.$partUrl.'page=1">1</a>'; // onclick="'.ajaxLoad(''.$partUrl.'page=1').'"
        if (self::$page > $count+2)
            $html .= '<b style="margin: 0 8px;">...</b>';


        for ($from; $from <= $to; $from++) {
            if (self::$page == $from)
                $html .= '<span aria-current="page" class="page-numbers current">'.$from.'.</span>';
            else
                $html .= '<a class="page-numbers" href="'.$partUrl.'page='.$from.'" >'.$from.'.</a>'; // onclick="'.ajaxLoad(''.$partUrl.'page='.$from).'"
        }

        if (self::$page + $count < self::$countPage-1)
            $html .= '<b style="margin: 0 8px;">...</b>';
        if (self::$page + $count < self::$countPage)
            $html .= '<a class="page-numbers" href="'.$partUrl.'page='.self::$countPage.'" >'.self::$countPage.'</a>'; // onclick="'.ajaxLoad(''.$partUrl.'page='.self::$countPage).'"


        if (self::$page < self::$countPage)
            $html .= '<a class="next page-numbers" href="'.$partUrl.'page='.(self::$page+1).'" title=""><span class="icon-chevron-right"></span></a>'; // onclick="'.ajaxLoad(''.$partUrl.'page='.(self::$page+1)).'"

        $html .= '<a class="next text page-numbers" href="'.$partUrl.'page='.(self::$countPage).'" title="">Last</a>'; // onclick="'.ajaxLoad(''.$partUrl.'page='.(self::$page+1)).'"

        $html .= '</div>';

        return $html;
    }

    static public function ajaxPagination($count = 2, $separate = 'span', $data = array())
    {
        $html = null;

        if (self::$page > 1)
            $html .= '<'.$separate.'><a href="'.$data['href'].'" onclick="'.ajaxLoad($data['url'], $data['permit'], $data['fields'].'page:'.(self::$page-1)).'" title="'.Lang::translate('PAGINATION_PREV').'">'.Lang::translate('PAGINATION_PREV').'</a></'.$separate.'>';

        if (self::$page > $count)
            $from = self::$page - $count;
        else
            $from = 1;

        if (self::$countPage - self::$page >= $count)
            $to = self::$page + $count;
        else
            $to = self::$countPage;

        if (self::$page > $count+1)
            $html .= '<'.$separate.'><a href="'.$data['href'].'" onclick="'.ajaxLoad($data['url'], $data['permit'], $data['fields'].'page:1').'">1</a></'.$separate.'>';
        if (self::$page > $count+2)
            $html .= '<'.$separate.' class="interspace"><a>...</a></'.$separate.'>';

        for ($from; $from <= $to; $from++)
        {
            if (self::$page == $from)
                $html .= '<'.$separate.'><a class="active">'.$from.'</a></'.$separate.'>';
            else
                $html .= '<'.$separate.'><a href="'.$data['href'].'" onclick="'.ajaxLoad($data['url'], $data['permit'], $data['fields'].'page:'.$from).'">'.$from.'</a></'.$separate.'>';
        }

        if (self::$page + $count < self::$countPage-1)
            $html .= '<'.$separate.' class="interspace"><a>...</a></'.$separate.'>';
        if (self::$page + $count < self::$countPage)
            $html .= '<'.$separate.'><a href="'.$data['href'].'" onclick="'.ajaxLoad($data['url'], $data['permit'], $data['fields'].'page:'.self::$countPage).'">'.self::$countPage.'</a></'.$separate.'>';

        if (self::$page < self::$countPage)
            $html .= '<'.$separate.'><a href="'.$data['href'].'" onclick="'.ajaxLoad($data['url'], $data['permit'], $data['fields'].'page:'.(self::$page+1)).'" title="'.Lang::translate('PAGINATION_NEXT').'">'.Lang::translate('PAGINATION_NEXT').'</a></'.$separate.'>';

        return $html;
    }

    static public function ajaxPagination2($count = 2, $separate = 'span', $data = array())
    {
        $html = null;

        if (self::$page > 1)
            $html .= '<'.$separate.'><a href="'.$data['href'].'" onclick="'.ajaxLoad($data['url'], $data['permit'], $data['fields'].'page:'.(self::$page-1)).'" title="'.Lang::translate('PAGINATION_PREV').'">'.Lang::translate('PAGINATION_PREV').'</a></'.$separate.'>';

        if (self::$page > $count)
            $from = self::$page - $count;
        else
            $from = 1;

        if (self::$countPage - self::$page >= $count)
            $to = self::$page + $count;
        else
            $to = self::$countPage;

        if (self::$page > $count+1)
            $html .= '<'.$separate.'><a href="'.$data['href'].'" onclick="'.ajaxLoad($data['url'], $data['permit'], $data['fields'].'page:1').'">1</a></'.$separate.'>';
        if (self::$page > $count+2)
            $html .= '<'.$separate.'><a class="interspace">...</a></'.$separate.'>';

        for ($from; $from <= $to; $from++)
        {
            if (self::$page == $from)
                $html .= '<'.$separate.'><a class="active">'.$from.'</a></'.$separate.'>';
            else
                $html .= '<'.$separate.'><a href="'.$data['href'].'" onclick="'.ajaxLoad($data['url'], $data['permit'], $data['fields'].'page:'.$from).'">'.$from.'</a></'.$separate.'>';
        }

        if (self::$page + $count < self::$countPage-1)
            $html .= '<'.$separate.'><a class="interspace">...</a></'.$separate.'>';
        if (self::$page + $count < self::$countPage)
            $html .= '<'.$separate.'><a href="'.$data['href'].'" onclick="'.ajaxLoad($data['url'], $data['permit'], $data['fields'].'page:'.self::$countPage).'">'.self::$countPage.'</a></'.$separate.'>';

        if (self::$page < self::$countPage)
            $html .= '<'.$separate.'><a href="'.$data['href'].'" onclick="'.ajaxLoad($data['url'], $data['permit'], $data['fields'].'page:'.(self::$page+1)).'" title="'.Lang::translate('PAGINATION_NEXT').'">'.Lang::translate('PAGINATION_NEXT').'</a></'.$separate.'>';

        return $html;
    }
}
/* End of file */